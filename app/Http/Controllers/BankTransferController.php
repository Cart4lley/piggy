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
        
        return view('bank-transfer.index', compact('account'));
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
