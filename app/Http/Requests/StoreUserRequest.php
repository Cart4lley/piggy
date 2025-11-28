<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhilippinePhoneNumber;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all registration requests
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Information
            'first_name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s\-\.]+$/',
            'last_name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z\s\-\.]+$/',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email|unique:pending_registrations,email',
            'phone' => ['required', 'string', 'max:20', new PhilippinePhoneNumber()],
            'date_of_birth' => 'required|date|before:today|after:1900-01-01|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            'gender' => 'nullable|in:male,female,other,prefer-not-to-say',
            
            // Address Information
            'address' => 'required|string|min:10|max:500',
            'city' => 'required|string|min:2|max:100|regex:/^[a-zA-Z\s\-\.]+$/',
            'zip_code' => 'required|string|min:4|max:10|regex:/^[0-9]{4,10}$/',
            
            // Employment Information
            'occupation' => 'required|string|min:2|max:100',
            'employment_status' => 'required|in:employed,self-employed,student,unemployed,retired',
            'monthly_income' => 'required|numeric|min:0|max:10000000',
            'employer_name' => 'nullable|string|max:255|required_if:employment_status,employed',
            
            // Account Information
            'username' => 'required|string|min:3|max:50|regex:/^[a-zA-Z0-9._-]+$/|unique:users,name',
            'initial_deposit' => 'required|numeric|min:500|max:1000000',
            
            // Security
            'password' => [
                'required',
                'string',
                'min:8',
                'max:128',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
            'password_confirmation' => 'required',
            
            // Legal Agreements
            'terms_agreement' => 'required|accepted',
            'age_verification' => 'required|accepted',
            'privacy_consent' => 'required|accepted',
            'marketing_consent' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Personal Information Messages
            'first_name.required' => 'First name is required.',
            'first_name.min' => 'First name must be at least 2 characters.',
            'first_name.regex' => 'First name can only contain letters, spaces, hyphens, and periods.',
            'last_name.required' => 'Last name is required.',
            'last_name.min' => 'Last name must be at least 2 characters.',
            'last_name.regex' => 'Last name can only contain letters, spaces, hyphens, and periods.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'phone.required' => 'Phone number is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before' => 'Invalid date of birth.',
            'date_of_birth.after' => 'Please enter a valid birth date.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old to create an account.',
            
            // Address Messages
            'address.required' => 'Home address is required.',
            'address.min' => 'Please enter a complete address.',
            'city.required' => 'City is required.',
            'city.regex' => 'City name can only contain letters, spaces, hyphens, and periods.',
            'zip_code.required' => 'ZIP code is required.',
            'zip_code.regex' => 'ZIP code must be 4-10 digits only.',
            
            // Employment Messages
            'occupation.required' => 'Occupation is required.',
            'employment_status.required' => 'Employment status is required.',
            'monthly_income.required' => 'Monthly income is required.',
            'monthly_income.min' => 'Monthly income cannot be negative.',
            'monthly_income.max' => 'Monthly income seems unusually high.',
            'employer_name.required_if' => 'Employer name is required for employed individuals.',
            
            // Account Messages
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.regex' => 'Username can only contain letters, numbers, periods, underscores, and hyphens.',
            'username.unique' => 'This username is already taken.',
            'initial_deposit.required' => 'Initial deposit is required.',
            'initial_deposit.min' => 'Minimum initial deposit is ₱500.',
            'initial_deposit.max' => 'Maximum initial deposit is ₱1,000,000.',
            
            // Security Messages
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            
            // Legal Agreement Messages
            'terms_agreement.required' => 'You must agree to the Terms & Conditions.',
            'terms_agreement.accepted' => 'You must agree to the Terms & Conditions.',
            'age_verification.required' => 'You must verify that you are at least 18 years old.',
            'age_verification.accepted' => 'You must verify that you are at least 18 years old.',
            'privacy_consent.required' => 'You must consent to our Privacy Policy.',
            'privacy_consent.accepted' => 'You must consent to our Privacy Policy.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'first name',
            'last_name' => 'last name',
            'email' => 'email address',
            'phone' => 'phone number',
            'date_of_birth' => 'date of birth',
            'zip_code' => 'ZIP code',
            'monthly_income' => 'monthly income',
            'initial_deposit' => 'initial deposit',
            'password_confirmation' => 'password confirmation',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean and format phone number
        if ($this->has('phone')) {
            $phone = $this->input('phone');
            // Remove extra spaces and formatting
            $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
            // Ensure it starts with +63 if it's a Philippine number
            if (preg_match('/^0?9[0-9]{9}$/', $phone)) {
                $phone = '+63' . ltrim($phone, '0');
            } elseif (preg_match('/^63[0-9]{10}$/', $phone)) {
                $phone = '+' . $phone;
            } elseif (!str_starts_with($phone, '+63')) {
                $phone = '+63' . $phone;
            }
            $this->merge(['phone' => $phone]);
        }

        // Clean username
        if ($this->has('username')) {
            $this->merge([
                'username' => strtolower(trim($this->input('username')))
            ]);
        }

        // Clean names
        if ($this->has('first_name')) {
            $this->merge([
                'first_name' => ucwords(strtolower(trim($this->input('first_name'))))
            ]);
        }
        
        if ($this->has('last_name')) {
            $this->merge([
                'last_name' => ucwords(strtolower(trim($this->input('last_name'))))
            ]);
        }
    }
}
