<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhilippinePhoneNumber;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Only authenticated users can update their accounts
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = auth()->user();
        $userId = $user ? $user->id : null;

        return [
            // Personal Information Updates
            'first_name' => 'sometimes|required|string|min:2|max:50|regex:/^[a-zA-Z\s\-\.]+$/',
            'last_name' => 'sometimes|required|string|min:2|max:50|regex:/^[a-zA-Z\s\-\.]+$/',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'phone' => ['sometimes', 'required', 'string', 'max:20', new PhilippinePhoneNumber()],
            'date_of_birth' => 'sometimes|required|date|before:today|after:1900-01-01|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),

            // Address Information Updates  
            'address' => 'sometimes|required|string|min:10|max:500',
            'city' => 'sometimes|required|string|min:2|max:100|regex:/^[a-zA-Z\s\-\.]+$/',
            'zip_code' => 'sometimes|required|string|min:4|max:10|regex:/^[0-9]{4,10}$/',

            // Employment Information Updates
            'occupation' => 'sometimes|required|string|min:2|max:100',
            'employment_status' => 'sometimes|required|in:employed,self-employed,student,unemployed,retired',
            'monthly_income' => 'sometimes|required|numeric|min:0|max:10000000',
            'employer_name' => 'sometimes|nullable|string|max:255|required_if:employment_status,employed',

            // Account Preferences
            'username' => [
                'sometimes',
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9._-]+$/',
                Rule::unique('users', 'name')->ignore($userId)
            ],
            'preferred_language' => 'sometimes|nullable|in:en,tl,ceb,ilo,hil,war,pam,mag,pan,mar',
            'timezone' => 'sometimes|nullable|string|max:50',

            // Security Updates
            'current_password' => 'sometimes|required_with:new_password|current_password',
            'new_password' => [
                'sometimes',
                'nullable',
                'string',
                'min:8',
                'max:128',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
            'new_password_confirmation' => 'sometimes|required_with:new_password',

            // Notification Preferences
            'email_notifications' => 'sometimes|boolean',
            'sms_notifications' => 'sometimes|boolean',
            'marketing_emails' => 'sometimes|boolean',
            'transaction_alerts' => 'sometimes|boolean',
            'login_alerts' => 'sometimes|boolean',

            // Security Settings
            'two_factor_enabled' => 'sometimes|boolean',
            'session_timeout' => 'sometimes|nullable|integer|min:5|max:120', // minutes

            // Account Limits (admin or special permissions required)
            'daily_transaction_limit' => 'sometimes|nullable|numeric|min:1000|max:1000000',
            'monthly_transaction_limit' => 'sometimes|nullable|numeric|min:10000|max:5000000',
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
            'email.unique' => 'This email address is already taken.',
            'phone.required' => 'Phone number is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old.',

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

            // Security Messages
            'current_password.required_with' => 'Current password is required to change password.',
            'current_password.current_password' => 'Current password is incorrect.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'new_password_confirmation.required_with' => 'Password confirmation is required.',

            // Notification Messages
            'email_notifications.boolean' => 'Email notifications must be true or false.',
            'sms_notifications.boolean' => 'SMS notifications must be true or false.',

            // Limits Messages
            'daily_transaction_limit.min' => 'Daily transaction limit must be at least ₱1,000.',
            'daily_transaction_limit.max' => 'Daily transaction limit cannot exceed ₱1,000,000.',
            'monthly_transaction_limit.min' => 'Monthly transaction limit must be at least ₱10,000.',
            'monthly_transaction_limit.max' => 'Monthly transaction limit cannot exceed ₱5,000,000.',

            // Session Messages
            'session_timeout.min' => 'Session timeout must be at least 5 minutes.',
            'session_timeout.max' => 'Session timeout cannot exceed 120 minutes.',
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
            'current_password' => 'current password',
            'new_password' => 'new password',
            'new_password_confirmation' => 'password confirmation',
            'email_notifications' => 'email notifications',
            'sms_notifications' => 'SMS notifications',
            'marketing_emails' => 'marketing emails',
            'transaction_alerts' => 'transaction alerts',
            'login_alerts' => 'login alerts',
            'two_factor_enabled' => 'two-factor authentication',
            'session_timeout' => 'session timeout',
            'daily_transaction_limit' => 'daily transaction limit',
            'monthly_transaction_limit' => 'monthly transaction limit',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if email change requires verification
            $user = auth()->user();
            if ($this->has('email') && $user && $this->input('email') !== $user->email) {
                // Could add logic here to require email verification for email changes
                // For now, we'll allow direct email changes
            }

            // Validate that new limits are reasonable
            if ($this->has('daily_transaction_limit') && $this->has('monthly_transaction_limit')) {
                $dailyLimit = $this->input('daily_transaction_limit');
                $monthlyLimit = $this->input('monthly_transaction_limit');
                
                if ($dailyLimit && $monthlyLimit && ($dailyLimit * 30) > $monthlyLimit) {
                    $validator->errors()->add(
                        'monthly_transaction_limit',
                        'Monthly limit should be higher than 30 times the daily limit.'
                    );
                }
            }

            // Check if user is trying to update sensitive fields
            $sensitiveFields = ['employment_status', 'monthly_income', 'date_of_birth'];
            $updatingSensitive = false;
            foreach ($sensitiveFields as $field) {
                if ($this->has($field) && $user && $this->input($field) !== $user->$field) {
                    $updatingSensitive = true;
                    break;
                }
            }

            // Could add additional verification requirements for sensitive updates
            if ($updatingSensitive) {
                // For now, we'll allow these updates
                // In the future, you might want to require additional verification
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean and format phone number
        if ($this->has('phone')) {
            $phone = $this->input('phone');
            $phone = preg_replace('/[\s\-\(\)]/', '', $phone);
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

        // Convert boolean strings to actual booleans
        $booleanFields = [
            'email_notifications', 'sms_notifications', 'marketing_emails',
            'transaction_alerts', 'login_alerts', 'two_factor_enabled'
        ];
        
        foreach ($booleanFields as $field) {
            if ($this->has($field)) {
                $value = $this->input($field);
                if (is_string($value)) {
                    $this->merge([$field => filter_var($value, FILTER_VALIDATE_BOOLEAN)]);
                }
            }
        }
    }
}
