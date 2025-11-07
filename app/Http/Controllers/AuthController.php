<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\PendingRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PendingRegistrationVerification;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Show the sign-in form
     */
    public function showSignin()
    {
        return view('signin');
    }

    /**
     * Handle user registration (create pending registration)
     */
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date|before:today|after:1900-01-01',
            'gender' => 'nullable|in:male,female,other,prefer-not-to-say',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'occupation' => 'required|string|max:100',
            'employment_status' => 'required|in:employed,self-employed,student,unemployed,retired',
            'monthly_income' => 'required|numeric|min:0|max:10000000',
            'employer_name' => 'nullable|string|max:255',
            'initial_deposit' => 'required|numeric|min:500|max:1000000',
            'username' => 'required|string|min:3|max:50|unique:users,name',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
            'terms_agreement' => 'required|accepted',
            'age_verification' => 'required|accepted',
            'marketing_consent' => 'nullable',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'phone.required' => 'Phone number is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before' => 'You must be at least 18 years old.',
            'date_of_birth.after' => 'Please enter a valid birth date.',
            'address.required' => 'Home address is required.',
            'city.required' => 'City is required.',
            'zip_code.required' => 'ZIP code is required.',
            'occupation.required' => 'Occupation is required.',
            'employment_status.required' => 'Employment status is required.',
            'monthly_income.required' => 'Monthly income is required.',
            'monthly_income.min' => 'Monthly income cannot be negative.',
            'monthly_income.max' => 'Monthly income seems unusually high.',
            'initial_deposit.required' => 'Initial deposit amount is required.',
            'initial_deposit.min' => 'Minimum initial deposit is ₱500.',
            'initial_deposit.max' => 'Maximum initial deposit is ₱1,000,000.',
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.unique' => 'This username is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'terms_agreement.required' => 'You must agree to the Terms & Conditions.',
            'terms_agreement.accepted' => 'You must agree to the Terms & Conditions.',
            'age_verification.required' => 'You must verify that you are at least 18 years old.',
            'age_verification.accepted' => 'You must verify that you are at least 18 years old.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle checkbox values (checkboxes don't send anything when unchecked)
        $marketingConsent = $request->has('marketing_consent') ? true : false;

        try {
            // Create user account directly (no email verification required)
            $user = User::create([
                'name' => $request->username ?: ($request->first_name . ' ' . $request->last_name),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'address' => $request->address,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'occupation' => $request->occupation,
                'employment_status' => $request->employment_status,
                'monthly_income' => $request->monthly_income,
                'employer_name' => $request->employer_name,
                'marketing_consent' => $marketingConsent,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(), // Mark as verified immediately
            ]);

            // Create initial savings account with the deposit
            $account = \App\Models\Account::create([
                'user_id' => $user->id,
                'account_number' => \App\Models\Account::generateAccountNumber(),
                'account_type' => 'savings',
                'balance' => $request->initial_deposit,
                'available_balance' => $request->initial_deposit,
                'status' => 'active',
                'branch_code' => '001001'
            ]);

            // Create initial deposit transaction
            \App\Models\Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => \App\Models\Transaction::generateTransactionId(),
                'type' => 'deposit',
                'amount' => $request->initial_deposit,
                'balance_before' => 0,
                'balance_after' => $request->initial_deposit,
                'description' => 'Initial Deposit - Account Opening',
                'reference_number' => 'INIT' . rand(100000, 999999),
                'status' => 'completed',
            ]);

            // Log the user in automatically
            Auth::login($user);
            
            return redirect()->route('dashboard')
                ->with('success', 'Welcome to PIGGY Bank! Your account has been created successfully with an initial deposit of $' . number_format($request->initial_deposit, 2) . '.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Verify registration and create actual user account
     */
    public function verifyRegistration(Request $request, $token)
    {
        try {
            // Find pending registration
            $pendingRegistration = \App\Models\PendingRegistration::where('verification_token', $token)->first();

            if (!$pendingRegistration) {
                return redirect()->route('register')
                    ->with('error', 'Invalid verification link. Please register again.');
            }

            if ($pendingRegistration->isExpired()) {
                return redirect()->route('register')
                    ->with('error', 'Verification link has expired. Please register again.');
            }

            if ($pendingRegistration->isVerified()) {
                return redirect()->route('signin')
                    ->with('success', 'Account already created! You can now sign in.');
            }

            // Mark as verified
            $pendingRegistration->markAsVerified();

            // Now create the actual user account
            $user = User::create([
                'name' => $pendingRegistration->first_name . ' ' . $pendingRegistration->last_name,
                'first_name' => $pendingRegistration->first_name,
                'last_name' => $pendingRegistration->last_name,
                'email' => $pendingRegistration->email,
                'phone' => $pendingRegistration->phone,
                'date_of_birth' => $pendingRegistration->date_of_birth,
                'gender' => $pendingRegistration->gender,
                'address' => $pendingRegistration->address,
                'city' => $pendingRegistration->city,
                'zip_code' => $pendingRegistration->zip_code,
                'occupation' => $pendingRegistration->occupation,
                'monthly_income' => $pendingRegistration->monthly_income,
                'initial_deposit' => $pendingRegistration->initial_deposit,
                'password' => $pendingRegistration->password_hash,
                'email_verified_at' => now(), // Mark as verified immediately
            ]);

            // Create savings account
            $account = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => Account::TYPE_SAVINGS,
                'balance' => 0.00,
                'available_balance' => 0.00,
                'status' => Account::STATUS_ACTIVE,
                'branch_code' => '001001'
            ]);

            // Make initial deposit if specified
            if ($pendingRegistration->initial_deposit > 0) {
                $account->deposit(
                    $pendingRegistration->initial_deposit, 
                    'Initial deposit upon account opening',
                    [
                        'deposit_type' => 'initial_opening',
                        'source' => 'registration',
                        'currency' => 'PHP'
                    ]
                );
            }

            // Clean up - delete the pending registration
            $pendingRegistration->delete();

            return redirect()->route('signin')
                ->with('success', 'Account created successfully! You can now sign in to access your PIGGY Bank account.');

        } catch (\Exception $e) {
            return redirect()->route('register')
                ->with('error', 'Account creation failed. Please try registering again.');
        }
    }

    /**
     * Handle user sign-in
     */
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // Support both email and username login
        $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $loginField => $request->email,
            'password' => $request->password
        ];
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Email verification check temporarily disabled for testing
            // if (!Auth::user()->hasVerifiedEmail()) {
            //     Auth::logout();
            //     return redirect()->route('registration.status')
            //         ->with('warning', 'Please verify your email before signing in.');
            // }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    /**
     * Show email verification notice page
     */
    public function verificationNotice(Request $request)
    {
        // Get email from session if available
        $email = session('user_email', '');
        
        // Count pending registrations for this email if provided
        $pendingCount = 0;
        if ($email) {
            $pendingCount = PendingRegistration::where('email', $email)->count();
        }
        
        return view('auth.verification-notice', [
            'email' => $email,
            'pendingCount' => $pendingCount,
            'hasPending' => $pendingCount > 0
        ]);
    }
}
