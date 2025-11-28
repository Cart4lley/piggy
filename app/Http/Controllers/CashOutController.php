<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\CashOut;
use Illuminate\Support\Facades\DB;

class CashOutController extends Controller
{
    /**
     * Show the cash out form
     */
    public function index()
    {
        $user = Auth::user();
        $account = $user->account;
        
        return view('cashout.index', compact('account'));
    }

    /**
     * Process cash out request (withdraw from PIGGY account)
     */
    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:255',
            'recipient_account_number' => 'required|string|min:10|max:20',
            'recipient_bank' => 'required|string|max:100',
            'amount' => 'required|numeric|min:1|max:1000000',
            'reference_note' => 'nullable|string|max:500',
        ], [
            'recipient_name.required' => 'Recipient name is required.',
            'recipient_account_number.required' => 'Recipient account number is required.',
            'recipient_account_number.min' => 'Account number must be at least 10 digits.',
            'recipient_bank.required' => 'Recipient bank is required.',
            'amount.required' => 'Cash out amount is required.',
            'amount.min' => 'Minimum cash out amount is ₱1.',
            'amount.max' => 'Maximum cash out amount is ₱1,000,000.',
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

            // Check if account has sufficient balance
            if ($account->balance < $request->amount) {
                return redirect()->back()
                    ->with('error', 'Insufficient balance. Available balance: ₱' . number_format($account->balance, 2))
                    ->withInput();
            }

            // Generate cash out reference number
            $cashOutReference = 'CO' . date('Ymd') . rand(100000, 999999);

            // Create cash out record
            $cashOut = CashOut::create([
                'account_id' => $account->id,
                'recipient_name' => $request->recipient_name,
                'recipient_account_number' => $request->recipient_account_number,
                'recipient_bank' => $request->recipient_bank,
                'amount' => $request->amount,
                'reference_number' => $cashOutReference,
                'reference_note' => $request->reference_note,
                'status' => 'completed',
                'processed_at' => now(),
            ]);

            // Update account balance
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
                'description' => "Cash Out to {$request->recipient_name} ({$request->recipient_bank})",
                'reference_number' => $cashOutReference,
                'status' => 'completed',
                'metadata' => json_encode([
                    'transfer_type' => 'cash_out',
                    'recipient_name' => $request->recipient_name,
                    'recipient_account' => $request->recipient_account_number,
                    'recipient_bank' => $request->recipient_bank,
                    'reference_note' => $request->reference_note,
                ]),
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', "Cash out of ₱" . number_format($request->amount, 2) . " to {$request->recipient_name} has been successfully processed! Reference: {$cashOutReference}");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Cash out processing failed. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show cash out history
     */
    public function history()
    {
        $user = Auth::user();
        $account = $user->account;
        
        $cashOuts = CashOut::where('account_id', $account->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('cashout.history', compact('cashOuts'));
    }
}
