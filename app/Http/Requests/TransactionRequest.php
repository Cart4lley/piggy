<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidAccountNumber;
use App\Rules\PhilippinePhoneNumber;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Only authenticated users can make transactions
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $transactionType = $this->input('transaction_type', 'transfer');

        $baseRules = [
            'transaction_type' => 'required|in:transfer,deposit,withdrawal,payment,cash_out',
            'amount' => 'required|numeric|min:1|max:1000000',
            'description' => 'nullable|string|max:500',
            'pin' => 'nullable|digits:6', // PIN verification (placeholder for future implementation)
        ];

        switch ($transactionType) {
            case 'transfer':
                return array_merge($baseRules, [
                    'recipient_account' => ['required', 'string', new ValidAccountNumber()],
                    'recipient_name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
                    'recipient_bank' => 'nullable|string|max:100',
                    'transfer_type' => 'required|in:internal,external',
                    'reference_note' => 'nullable|string|max:255',
                ]);

            case 'cash_out':
            case 'withdrawal':
                return array_merge($baseRules, [
                    'recipient_name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
                    'recipient_account_number' => ['required', 'string', new ValidAccountNumber()],
                    'recipient_bank' => 'required|string|max:100',
                    'reference_note' => 'nullable|string|max:500',
                ]);

            case 'deposit':
                return array_merge($baseRules, [
                    'sender_name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s\-\.]+$/',
                    'sender_account_number' => ['required', 'string', new ValidAccountNumber()],
                    'sender_bank' => 'required|string|max:100',
                    'deposit_type' => 'required|in:bank_transfer,cash,check,online',
                    'reference_note' => 'nullable|string|max:500',
                ]);

            case 'payment':
                return array_merge($baseRules, [
                    'payee_name' => 'required|string|min:2|max:255',
                    'payment_category' => 'required|string|max:100',
                    'payment_method' => 'required|in:online,card,bank_transfer',
                    'reference_number' => 'nullable|string|max:100|alpha_num',
                ]);

            default:
                return $baseRules;
        }
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Base transaction messages
            'transaction_type.required' => 'Transaction type is required.',
            'transaction_type.in' => 'Invalid transaction type.',
            'amount.required' => 'Transaction amount is required.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Minimum transaction amount is ₱1.00.',
            'amount.max' => 'Maximum transaction amount is ₱1,000,000.00.',

            // Transfer messages
            'recipient_account.required' => 'Recipient account number is required.',
            'recipient_name.required' => 'Recipient name is required.',
            'recipient_name.regex' => 'Recipient name can only contain letters, spaces, hyphens, and periods.',
            'recipient_bank.required' => 'Recipient bank is required.',
            'transfer_type.required' => 'Transfer type is required.',
            'transfer_type.in' => 'Invalid transfer type.',

            // Cash out/Withdrawal messages
            'recipient_account_number.required' => 'Recipient account number is required.',

            // Deposit messages
            'sender_name.required' => 'Sender name is required.',
            'sender_name.regex' => 'Sender name can only contain letters, spaces, hyphens, and periods.',
            'sender_account_number.required' => 'Sender account number is required.',
            'sender_bank.required' => 'Sender bank is required.',
            'deposit_type.required' => 'Deposit type is required.',
            'deposit_type.in' => 'Invalid deposit type.',

            // Payment messages
            'payee_name.required' => 'Payee name is required.',
            'payment_category.required' => 'Payment category is required.',
            'payment_method.required' => 'Payment method is required.',
            'payment_method.in' => 'Invalid payment method.',
            'reference_number.alpha_num' => 'Reference number can only contain letters and numbers.',

            // General messages
            'description.max' => 'Description cannot exceed 500 characters.',
            'reference_note.max' => 'Reference note cannot exceed 500 characters.',
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
            'transaction_type' => 'transaction type',
            'amount' => 'amount',
            'recipient_account' => 'recipient account',
            'recipient_name' => 'recipient name',
            'recipient_bank' => 'recipient bank',
            'recipient_account_number' => 'recipient account number',
            'sender_name' => 'sender name',
            'sender_account_number' => 'sender account number',
            'sender_bank' => 'sender bank',
            'payee_name' => 'payee name',
            'payment_category' => 'payment category',
            'payment_method' => 'payment method',
            'reference_number' => 'reference number',
            'reference_note' => 'reference note',
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
            $user = auth()->user();
            $transactionType = $this->input('transaction_type');
            $amount = $this->input('amount', 0);

            if (!$user || !$user->account) {
                $validator->errors()->add('account', 'User account not found.');
                return;
            }

            // Check balance for outgoing transactions
            $outgoingTypes = ['transfer', 'cash_out', 'withdrawal', 'payment'];
            if (in_array($transactionType, $outgoingTypes)) {
                $availableBalance = $user->account->balance;
                
                if ($amount > $availableBalance) {
                    $validator->errors()->add(
                        'amount',
                        'Insufficient balance. Available: ₱' . number_format($availableBalance, 2)
                    );
                }

                // Check daily transaction limits
                $dailyLimit = 100000; // ₱100,000 daily limit
                $todayTransactions = $user->account->transactions()
                    ->whereIn('type', $outgoingTypes)
                    ->whereDate('created_at', today())
                    ->sum('amount');

                if (($todayTransactions + $amount) > $dailyLimit) {
                    $remaining = $dailyLimit - $todayTransactions;
                    $validator->errors()->add(
                        'amount',
                        'Daily transaction limit exceeded. Remaining limit: ₱' . number_format($remaining, 2)
                    );
                }
            }

            // Check for duplicate transactions (same amount, recipient, within 5 minutes)
            if (in_array($transactionType, ['transfer', 'cash_out', 'payment'])) {
                $recipientField = $transactionType === 'payment' ? 'payee_name' : 'recipient_name';
                $recipientName = $this->input($recipientField);

                if ($recipientName) {
                    $recentTransaction = $user->account->transactions()
                        ->where('type', $transactionType)
                        ->where('amount', $amount)
                        ->where('metadata->recipient_name', $recipientName)
                        ->where('created_at', '>=', now()->subMinutes(5))
                        ->first();

                    if ($recentTransaction) {
                        $validator->errors()->add(
                            'amount',
                            'Duplicate transaction detected. Please wait 5 minutes before making the same transaction.'
                        );
                    }
                }
            }

            // Validate account ownership for internal transfers
            if ($transactionType === 'transfer' && $this->input('transfer_type') === 'internal') {
                $recipientAccount = $this->input('recipient_account');
                // Here you would check if the account exists in your system
                // This is a placeholder for the actual account verification logic
            }
        });
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean amount
        if ($this->has('amount')) {
            $amount = $this->input('amount');
            $amount = preg_replace('/[₱,\s]/', '', $amount);
            $this->merge(['amount' => $amount]);
        }

        // Clean and format names
        $nameFields = ['recipient_name', 'sender_name', 'payee_name'];
        foreach ($nameFields as $field) {
            if ($this->has($field)) {
                $this->merge([
                    $field => ucwords(strtolower(trim($this->input($field))))
                ]);
            }
        }

        // Clean account numbers
        $accountFields = ['recipient_account', 'recipient_account_number', 'sender_account_number'];
        foreach ($accountFields as $field) {
            if ($this->has($field)) {
                $account = preg_replace('/[\s\-]/', '', $this->input($field));
                $this->merge([$field => $account]);
            }
        }

        // Clean reference number
        if ($this->has('reference_number')) {
            $this->merge([
                'reference_number' => strtoupper(trim($this->input('reference_number')))
            ]);
        }
    }
}
