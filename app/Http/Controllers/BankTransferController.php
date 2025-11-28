<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\BankTransfer;
use Illuminate\Support\Facades\DB;

class BankTransferController extends Controller
{
    /**
     * Show the bank transfer form
     */
    public function index()
    {
        $user = Auth::user();
        $account = $user->account;
        
        return view('bank-transfer', compact('account'));
    }

    /**
     * Process incoming bank transfer (deposit to PIGGY account)
     */
    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:255',
            'sender_account_number' => 'required|string|min:10|max:20',
            'sender_bank' => 'required|string|max:100',
            'amount' => 'required|numeric|min:1|max:1000000',
            'reference_note' => 'nullable|string|max:500',
        ], [
            'sender_name.required' => 'Sender name is required.',
            'sender_account_number.required' => 'Sender account number is required.',
            'sender_account_number.min' => 'Account number must be at least 10 digits.',
            'sender_bank.required' => 'Sender bank is required.',
            'amount.required' => 'Transfer amount is required.',
            'amount.min' => 'Minimum transfer amount is ₱1.',
            'amount.max' => 'Maximum transfer amount is ₱1,000,000.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $account = $user->account;

            // Generate transfer reference number
            $transferReference = 'BT' . date('Ymd') . rand(100000, 999999);

            // Create bank transfer record
            $bankTransfer = BankTransfer::create([
                'recipient_account_id' => $account->id,
                'sender_name' => $request->sender_name,
                'sender_account_number' => $request->sender_account_number,
                'sender_bank' => $request->sender_bank,
                'amount' => $request->amount,
                'reference_number' => $transferReference,
                'reference_note' => $request->reference_note,
                'status' => 'completed',
                'processed_at' => now(),
            ]);

            // Update account balance
            $balanceBefore = $account->balance;
            $account->balance += $request->amount;
            $account->available_balance += $request->amount;
            $account->save();

            // Create transaction record
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'deposit',
                'amount' => $request->amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $account->balance,
                'description' => "Bank Transfer from {$request->sender_name} ({$request->sender_bank})",
                'reference_number' => $transferReference,
                'status' => 'completed',
                'metadata' => json_encode([
                    'transfer_type' => 'bank_transfer',
                    'sender_name' => $request->sender_name,
                    'sender_account' => $request->sender_account_number,
                    'sender_bank' => $request->sender_bank,
                    'reference_note' => $request->reference_note,
                ]),
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', "Bank transfer of ₱" . number_format($request->amount, 2) . " from {$request->sender_name} has been successfully processed! Reference: {$transferReference}");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Transfer processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Process outgoing bank transfer (withdraw from PIGGY to external bank)
     */
    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:255',
            'recipient_account_number' => 'required|string|min:10|max:20',
            'recipient_bank' => 'required|string|max:100',
            'amount' => 'required|numeric|min:100|max:50000',
            'purpose' => 'nullable|string|max:500',
        ], [
            'recipient_name.required' => 'Account holder name is required.',
            'recipient_account_number.required' => 'Account number is required.',
            'recipient_account_number.min' => 'Account number must be at least 10 digits.',
            'recipient_bank.required' => 'Bank is required.',
            'amount.required' => 'Transfer amount is required.',
            'amount.min' => 'Minimum transfer amount is ₱100.',
            'amount.max' => 'Maximum transfer amount is ₱50,000.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $account = $user->account;

            // Check sufficient balance
            if ($account->balance < $request->amount) {
                return redirect()->back()
                    ->with('error', 'Insufficient balance for this transfer.')
                    ->withInput();
            }

            // Generate transfer reference number
            $transferReference = 'BTO' . date('Ymd') . rand(100000, 999999);

            // Update account balance (deduct)
            $balanceBefore = $account->balance;
            $account->balance -= $request->amount;
            $account->available_balance -= $request->amount;
            $account->save();

            // Create transaction record
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'withdrawal',
                'amount' => $request->amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $account->balance,
                'description' => "Bank Transfer to {$request->recipient_name} ({$request->recipient_bank})" . ($request->purpose ? " - {$request->purpose}" : ""),
                'reference_number' => $transferReference,
                'status' => 'completed',
                'metadata' => json_encode([
                    'transfer_type' => 'bank_withdrawal',
                    'recipient_name' => $request->recipient_name,
                    'recipient_account' => $request->recipient_account_number,
                    'recipient_bank' => $request->recipient_bank,
                    'purpose' => $request->purpose,
                ]),
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', "Bank transfer of ₱" . number_format($request->amount, 2) . " to {$request->recipient_name} ({$request->recipient_bank}) has been successfully processed! Reference: {$transferReference}");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Transfer processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Process card deposit (deposit via debit/credit card)
     */
    public function cardDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|string|min:13|max:19',
            'card_expiry' => 'required|string|regex:/^\d{2}\/\d{2}$/',
            'card_cvv' => 'required|string|min:3|max:4',
            'amount' => 'required|numeric|min:1|max:50000',
        ], [
            'cardholder_name.required' => 'Cardholder name is required.',
            'card_number.required' => 'Card number is required.',
            'card_number.min' => 'Card number must be at least 13 digits.',
            'card_number.max' => 'Card number must not exceed 19 digits.',
            'card_expiry.required' => 'Card expiry date is required.',
            'card_expiry.regex' => 'Card expiry must be in MM/YY format.',
            'card_cvv.required' => 'CVV is required.',
            'card_cvv.min' => 'CVV must be 3-4 digits.',
            'amount.required' => 'Deposit amount is required.',
            'amount.min' => 'Minimum deposit amount is ₱1.',
            'amount.max' => 'Maximum deposit amount is ₱50,000.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $account = $user->account;

            // Generate transaction reference number
            $cardReference = 'CD' . date('Ymd') . rand(100000, 999999);

            // Mask card number for security (show only last 4 digits)
            $cardNumberClean = preg_replace('/\s+/', '', $request->card_number);
            $maskedCardNumber = '****' . substr($cardNumberClean, -4);

            // Update account balance
            $balanceBefore = $account->balance;
            $account->balance += $request->amount;
            $account->available_balance += $request->amount;
            $account->save();

            // Create transaction record
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'deposit',
                'amount' => $request->amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $account->balance,
                'description' => "Card Deposit from {$maskedCardNumber}",
                'reference_number' => $cardReference,
                'status' => 'completed',
                'metadata' => json_encode([
                    'transfer_type' => 'card_deposit',
                    'cardholder_name' => $request->cardholder_name,
                    'card_number' => $maskedCardNumber,
                    'payment_method' => 'card',
                ]),
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', "Card deposit of ₱" . number_format($request->amount, 2) . " has been successfully processed! Reference: {$cardReference}");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Card deposit processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show transfer history
     */
    public function history()
    {
        $user = Auth::user();
        $account = $user->account;
        
        $transfers = BankTransfer::where('recipient_account_id', $account->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('bank-transfer.history', compact('transfers'));
    }
}
