<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;

class AccountController extends Controller
{
    public function dashboard()
    {
        // For demo purposes, we'll use the first user
        $user = User::with(['accounts.transactions' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(5);
        }])->first();

        if (!$user) {
            return redirect('/')->with('error', 'No user accounts found. Please seed the database.');
        }

        $accounts = $user->accounts;
        $totalBalance = $accounts->sum('balance');
        $recentTransactions = Transaction::whereIn('account_id', $accounts->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('dashboard', compact('user', 'accounts', 'totalBalance', 'recentTransactions'));
    }

    public function transactions()
    {
        $user = User::first();
        $accounts = $user->accounts ?? collect();
        $transactions = Transaction::whereIn('account_id', $accounts->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('transaction', compact('user', 'transactions'));
    }

    public function history()
    {
        $user = User::first();
        $accounts = $user->accounts ?? collect();
        $transactions = Transaction::whereIn('account_id', $accounts->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history', compact('user', 'transactions'));
    }
}
