<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidAccountNumber;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Only authenticated users can make payments
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            // Common payment fields
            'amount' => 'required|numeric|min:1|max:1000000',
            'customer_name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
            'category_slug' => 'required|string',
            'company_slug' => 'required|string',
        ];

        // Dynamic field validation based on company requirements
        // This allows for flexible field validation for different companies
        for ($i = 0; $i < 10; $i++) { // Support up to 10 dynamic fields
            $fieldKey = "field_{$i}";
            if ($this->has($fieldKey)) {
                $rules[$fieldKey] = 'required|string|max:255';
                
                // Special validation for account numbers
                if (str_contains(strtolower($this->input($fieldKey . '_label', '')), 'account')) {
                    $rules[$fieldKey] = ['required', 'string', new ValidAccountNumber()];
                }
                
                // Special validation for reference numbers
                if (str_contains(strtolower($this->input($fieldKey . '_label', '')), 'reference')) {
                    $rules[$fieldKey] = 'required|string|min:5|max:50|alpha_num';
                }
            }
        }

        // Card payment validation (if applicable)
        if ($this->input('payment_method') === 'card') {
            $rules = array_merge($rules, [
                'card_number' => 'required|string|regex:/^[0-9\s]{13,19}$/|luhn',
                'card_expiry' => 'required|string|regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
                'card_cvv' => 'required|string|regex:/^[0-9]{3,4}$/',
                'cardholder_name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
            ]);
        }

        // Bank transfer validation (if applicable)
        if ($this->input('payment_method') === 'bank') {
            $rules = array_merge($rules, [
                'bank_name' => 'required|string|max:100',
                'account_number' => ['required', 'string', new ValidAccountNumber()],
                'account_holder' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
            ]);
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Amount validation messages
            'amount.required' => 'Payment amount is required.',
            'amount.numeric' => 'Payment amount must be a valid number.',
            'amount.min' => 'Minimum payment amount is ₱1.00.',
            'amount.max' => 'Maximum payment amount is ₱1,000,000.00.',

            // Customer information messages
            'customer_name.required' => 'Customer name is required.',
            'customer_name.min' => 'Customer name must be at least 2 characters.',
            'customer_name.regex' => 'Customer name can only contain letters, spaces, hyphens, and periods.',

            // Category and company messages
            'category_slug.required' => 'Payment category is required.',
            'company_slug.required' => 'Payment company is required.',

            // Card payment messages
            'card_number.required' => 'Card number is required.',
            'card_number.regex' => 'Please enter a valid card number.',
            'card_number.luhn' => 'Card number is invalid.',
            'card_expiry.required' => 'Card expiry date is required.',
            'card_expiry.regex' => 'Please enter expiry date in MM/YY format.',
            'card_cvv.required' => 'CVV is required.',
            'card_cvv.regex' => 'CVV must be 3 or 4 digits.',
            'cardholder_name.required' => 'Cardholder name is required.',
            'cardholder_name.regex' => 'Cardholder name can only contain letters, spaces, hyphens, and periods.',

            // Bank transfer messages
            'bank_name.required' => 'Bank name is required.',
            'account_number.required' => 'Account number is required.',
            'account_holder.required' => 'Account holder name is required.',
            'account_holder.regex' => 'Account holder name can only contain letters, spaces, hyphens, and periods.',

            // Dynamic field messages
            'field_0.required' => 'This field is required.',
            'field_1.required' => 'This field is required.',
            'field_2.required' => 'This field is required.',
            'field_3.required' => 'This field is required.',
            'field_4.required' => 'This field is required.',
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
            'amount' => 'payment amount',
            'customer_name' => 'customer name',
            'card_number' => 'card number',
            'card_expiry' => 'expiry date',
            'card_cvv' => 'CVV',
            'cardholder_name' => 'cardholder name',
            'account_number' => 'account number',
            'account_holder' => 'account holder name',
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
            // Check if user has sufficient balance
            $user = auth()->user();
            if ($user && $user->account) {
                $requestedAmount = $this->input('amount', 0);
                $availableBalance = $user->account->balance;

                if ($requestedAmount > $availableBalance) {
                    $validator->errors()->add(
                        'amount',
                        'Insufficient balance. Available balance: ₱' . number_format($availableBalance, 2)
                    );
                }
            }

            // Validate card expiry date is in the future
            if ($this->input('payment_method') === 'card' && $this->has('card_expiry')) {
                $expiry = $this->input('card_expiry');
                if (preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $expiry, $matches)) {
                    $month = (int)$matches[1];
                    $year = 2000 + (int)$matches[2];
                    
                    if ($year < date('Y') || ($year == date('Y') && $month < date('n'))) {
                        $validator->errors()->add('card_expiry', 'Card has expired.');
                    }
                }
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean amount - remove commas and currency symbols
        if ($this->has('amount')) {
            $amount = $this->input('amount');
            $amount = preg_replace('/[₱,\s]/', '', $amount);
            $this->merge(['amount' => $amount]);
        }

        // Clean card number - remove spaces and dashes
        if ($this->has('card_number')) {
            $cardNumber = preg_replace('/[\s\-]/', '', $this->input('card_number'));
            $this->merge(['card_number' => $cardNumber]);
        }

        // Clean names
        if ($this->has('customer_name')) {
            $this->merge([
                'customer_name' => ucwords(strtolower(trim($this->input('customer_name'))))
            ]);
        }

        if ($this->has('cardholder_name')) {
            $this->merge([
                'cardholder_name' => strtoupper(trim($this->input('cardholder_name')))
            ]);
        }
    }
}
