<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::get('/login', [AuthController::class, 'showSignin'])->name('login'); // Laravel default login route alias
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Success Page
Route::get('/registration-success', function () {
    return view('auth.registration-success');
})->name('registration.success');

// Registration Verification Route
Route::get('/verify-registration/{token}', [AuthController::class, 'verifyRegistration'])
    ->name('registration.verify');

// Registration Status Check (different from Laravel's email verification)
Route::get('/registration-status', [AuthController::class, 'verificationNotice'])
    ->name('registration.status');

// Test and admin routes for development
Route::get('/test-registration', function () {
    return view('test-registration');
})->name('test.registration');

Route::get('/simple-test', function () {
    return view('simple-test');
})->name('simple.test');

Route::get('/status', function () {
    $totalPending = \App\Models\PendingRegistration::count();
    $totalUsers = \App\Models\User::count();
    $todayRegistrations = \App\Models\PendingRegistration::whereDate('created_at', today())->count();
    $expiredPending = \App\Models\PendingRegistration::where('expires_at', '<', now())->count();
    
    $recentPending = \App\Models\PendingRegistration::orderBy('created_at', 'desc')->take(5)->get();
    $recentUsers = \App\Models\User::with('account')->orderBy('created_at', 'desc')->take(5)->get();
    
    return view('status', compact('totalPending', 'totalUsers', 'todayRegistrations', 'expiredPending', 'recentPending', 'recentUsers'));
})->name('status');

Route::get('/admin/pending-registrations', function () {
    $pendingCount = \App\Models\PendingRegistration::count();
    $todayCount = \App\Models\PendingRegistration::whereDate('created_at', today())->count();
    $expiredCount = \App\Models\PendingRegistration::where('expires_at', '<', now())->count();
    
    $pendingRegistrations = \App\Models\PendingRegistration::orderBy('created_at', 'desc')->take(10)->get();
    
    return view('admin.pending-registrations', compact('pendingCount', 'todayCount', 'expiredCount', 'pendingRegistrations'));
})->name('admin.pending.registrations');

// Additional testing routes
Route::get('/test-accounts', function () {
    return view('test-accounts');
})->name('test.accounts');

Route::get('/test-direct-account', function () {
    try {
        // Create a test user directly
        $user = \App\Models\User::create([
            'name' => 'Maria Santos',
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'email' => 'maria@directtest.com',
            'phone' => '+639171234568',
            'date_of_birth' => '1992-05-15',
            'gender' => 'female',
            'address' => '456 Direct St., Quezon City, Metro Manila',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        // Create account with initial deposit
        $account = \App\Models\Account::create([
            'user_id' => $user->id,
            'account_number' => \App\Models\Account::generateAccountNumber(),
            'account_type' => \App\Models\Account::TYPE_SAVINGS,
            'balance' => 0.00,
            'available_balance' => 0.00,
            'status' => \App\Models\Account::STATUS_ACTIVE,
            'branch_code' => '001001'
        ]);

        // Make initial deposit
        $account->deposit(5000.00, 'Account opening deposit', [
            'deposit_type' => 'account_opening',
            'source' => 'direct_test',
            'currency' => 'PHP'
        ]);

        return redirect()->route('test.accounts')->with('success', "Account created successfully! User: {$user->email}, Account: {$account->account_number}, Balance: ₱5,000.00");
    } catch (\Exception $e) {
        return redirect()->route('test.accounts')->with('error', "Account creation failed: " . $e->getMessage());
    }
})->name('test.direct.account');

Route::get('/test-transactions', function () {
    try {
        $account = \App\Models\Account::with('user')->latest()->first();
        
        if (!$account) {
            return redirect()->route('test.accounts')->with('error', 'No accounts found. Create an account first.');
        }

        // Test deposit
        $account->deposit(1500.00, 'Test deposit transaction', [
            'source' => 'test_function',
            'type' => 'test'
        ]);

        // Test withdrawal  
        $account->withdraw(500.00, 'Test withdrawal transaction', [
            'source' => 'test_function',
            'type' => 'test'
        ]);

        $newBalance = $account->fresh()->balance;
        
        return redirect()->route('test.accounts')->with('success', "Transactions completed! Account: {$account->account_number}, New Balance: ₱" . number_format($newBalance, 2));
    } catch (\Exception $e) {
        return redirect()->route('test.accounts')->with('error', "Transaction failed: " . $e->getMessage());
    }
})->name('test.transactions');

Route::get('/test-login', function () {
    $testAccounts = \App\Models\User::with('account')->latest()->take(5)->get();
    return view('test-login', compact('testAccounts'));
})->name('test.login');

// Email Verification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        // If already verified, redirect to dashboard
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect('/dashboard')->with('success', 'Email already verified!');
        }
        return view('auth.verify-email');
    })->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard')->with('success', 'Email verified successfully!');
    })->middleware(['signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Protected routes - require authentication and email verification
Route::middleware(['auth', 'verified'])->group(function () {
    // Account Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/account/transactions', [\App\Http\Controllers\DashboardController::class, 'transactions'])->name('account.transactions');
    Route::post('/account/send-money', [\App\Http\Controllers\DashboardController::class, 'sendMoney'])->name('account.send-money');
    
    // Transaction Management
    Route::get('/transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/transactions/{transaction}/details', [\App\Http\Controllers\TransactionController::class, 'details'])->name('transactions.details');
    Route::get('/transactions/export/csv', [\App\Http\Controllers\TransactionController::class, 'export'])->name('transactions.export');
    
    // Legacy routes for existing features
    Route::get('/transaction', [AccountController::class, 'transactions']);
    Route::get('/history', [AccountController::class, 'history']);
    Route::get('/withdrawal', function () {
        return view('withdrawal');
    });
    Route::get('/payment', function () {
        return view('payment');
    });
    Route::get('/reports', function () {
        return view('reports');
    });
});

Route::get('/withdrawal', function () {
    return view('withdrawal');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/reports', function () {
    return view('reports');
});
