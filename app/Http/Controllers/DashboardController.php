<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Transaction;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard with account details
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's primary account
        $account = $user->account;
        
        if (!$account) {
            // If no account exists, create one (shouldn't happen in normal flow)
            $account = Account::create([
                'user_id' => $user->id,
                'account_number' => Account::generateAccountNumber(),
                'account_type' => Account::TYPE_SAVINGS,
                'balance' => 0.00,
                'available_balance' => 0.00,
                'status' => Account::STATUS_ACTIVE,
                'branch_code' => '001001'
            ]);
        }

        // Get recent transactions
        $recentTransactions = $account->getRecentTransactions(5);
        
        // Calculate statistics
        $transactionCount = $account->transactions()->count();
        $totalDeposits = $account->transactions()
            ->whereIn('type', [Transaction::TYPE_DEPOSIT, Transaction::TYPE_INITIAL_DEPOSIT, Transaction::TYPE_INTEREST])
            ->sum('amount');
        $totalWithdrawals = $account->transactions()
            ->whereIn('type', [Transaction::TYPE_WITHDRAWAL, Transaction::TYPE_PAYMENT, Transaction::TYPE_FEE])
            ->sum('amount');

        return view('account-dashboard', compact(
            'user', 
            'account', 
            'recentTransactions', 
            'transactionCount', 
            'totalDeposits', 
            'totalWithdrawals'
        ));
    }

    /**
     * Show all transactions
     */
    public function transactions()
    {
        $user = Auth::user();
        $account = $user->account;
        
        if (!$account) {
            return redirect()->route('dashboard')->with('error', 'Account not found.');
        }

        $transactions = $account->transactions()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('transactions', compact('user', 'account', 'transactions'));
    }

    /**
     * Send money to another account
     */
    public function sendMoney(Request $request)
    {
        $request->validate([
            'recipient_account' => 'required|string|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1|max:1000000',
            'description' => 'nullable|string|max:255'
        ]);

        $user = Auth::user();
        $senderAccount = $user->account;

        if (!$senderAccount || !$senderAccount->isActive()) {
            return back()->with('error', 'Your account is not available for transactions.');
        }

        // Find recipient account
        $recipientAccount = Account::where('account_number', $request->recipient_account)->first();
        
        if (!$recipientAccount || !$recipientAccount->isActive()) {
            return back()->with('error', 'Recipient account not found or inactive.');
        }

        // Check if trying to send to own account
        if ($senderAccount->id === $recipientAccount->id) {
            return back()->with('error', 'Cannot send money to your own account.');
        }

        // Check sufficient funds
        if ($senderAccount->balance < $request->amount) {
            return back()->with('error', 'Insufficient funds. Your current balance is ₱' . number_format($senderAccount->balance, 2));
        }

        try {
            \DB::transaction(function() use ($senderAccount, $recipientAccount, $request) {
                // Generate unique reference for both transactions
                $reference = 'TRF' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                
                $description = $request->description ?: 'Money Transfer';
                
                // Debit from sender
                $senderAccount->withdraw(
                    $request->amount,
                    "Sent to " . $recipientAccount->account_number . ": " . $description,
                    [
                        'transfer_type' => 'send',
                        'recipient_account' => $recipientAccount->account_number,
                        'recipient_name' => $recipientAccount->user->name,
                        'reference' => $reference,
                        'currency' => 'PHP'
                    ]
                );

                // Credit to recipient
                $recipientAccount->deposit(
                    $request->amount,
                    "Received from " . $senderAccount->account_number . ": " . $description,
                    [
                        'transfer_type' => 'receive',
                        'sender_account' => $senderAccount->account_number,
                        'sender_name' => $senderAccount->user->name,
                        'reference' => $reference,
                        'currency' => 'PHP'
                    ]
                );
            });

            return back()->with('success', "Successfully sent ₱" . number_format($request->amount, 2) . " to account " . $request->recipient_account);
            
        } catch (\Exception $e) {
            \Log::error('Money transfer failed: ' . $e->getMessage());
            return back()->with('error', 'Money transfer failed. Please try again.');
        }
    }
}
