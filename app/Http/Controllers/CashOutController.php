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
        
        return view('cash-out', compact('account'));
    }

    /**
     * Process cash out request (withdraw from PIGGY account)
     */
    public function withdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:100|max:50000',
            'purpose' => 'nullable|string|in:personal_expense,bills_payment,emergency,business,other',
        ], [
            'amount.required' => 'Withdrawal amount is required.',
            'amount.min' => 'Minimum withdrawal amount is ₱100.',
            'amount.max' => 'Maximum withdrawal amount is ₱50,000 per transaction.',
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
                    ->with('error', 'Insufficient balance. Available: ₱' . number_format($account->balance, 2))
                    ->withInput();
            }

            // Generate withdrawal reference number
            $withdrawalReference = 'WD' . date('Ymd') . rand(100000, 999999);

            // Get purpose display name
            $purposeNames = [
                'personal_expense' => 'Personal Expense',
                'bills_payment' => 'Bills Payment',
                'emergency' => 'Emergency',
                'business' => 'Business',
                'other' => 'Other',
            ];
            $purposeText = isset($purposeNames[$request->purpose]) ? " - {$purposeNames[$request->purpose]}" : '';

            // Update account balance
            $balanceBefore = $account->balance;
            $account->balance -= $request->amount;
            $account->save();

            // Create transaction record
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'withdrawal',
                'amount' => $request->amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $account->balance,
                'description' => "Cash withdrawal{$purposeText}",
                'reference_number' => $withdrawalReference,
                'status' => 'completed',
                'metadata' => json_encode([
                    'purpose' => $request->purpose,
                ]),
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', "Withdrawal of ₱" . number_format($request->amount, 2) . " successful! Reference: {$withdrawalReference}");

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Withdrawal processing failed. Please try again. Error: ' . $e->getMessage())
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
