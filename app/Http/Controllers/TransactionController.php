<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display user's transaction history
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $account = $user->account;
        
        if (!$account) {
            return redirect()->route('dashboard')
                ->with('error', 'No account found. Please contact support.');
        }

        // Base query for user's transactions
        $query = Transaction::where('account_id', $account->id)
                           ->with('account')
                           ->orderBy('created_at', 'desc');

        // Apply filters
        $this->applyFilters($query, $request);

        // Get transactions with pagination
        $transactions = $query->paginate(15)->appends($request->all());

        // Calculate summary statistics
        $stats = $this->calculateStats($account->id, $request);

        return view('transactions.index', compact('transactions', 'account', 'stats'));
    }

    /**
     * Show transaction details
     */
    public function show(Transaction $transaction)
    {
        $user = Auth::user();
        
        // Ensure user can only view their own transactions
        if ($transaction->account_id !== $user->account->id) {
            abort(403, 'Unauthorized access to transaction.');
        }

        return view('transactions.show', compact('transaction'));
    }

    /**
     * Get transaction details for AJAX modal
     */
    public function details(Transaction $transaction)
    {
        $user = Auth::user();
        
        // Ensure user can only view their own transactions
        if ($transaction->account_id !== $user->account->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'transaction' => $transaction->load('account'),
            'formatted' => [
                'amount' => '₱' . number_format($transaction->amount, 2),
                'date' => $transaction->created_at->format('M j, Y g:i A'),
                'type_label' => ucfirst($transaction->type),
                'status_label' => ucfirst($transaction->status),
                'balance_after' => '₱' . number_format($transaction->balance_after, 2)
            ]
        ]);
    }

    /**
     * Export transactions to CSV
     */
    public function export(Request $request)
    {
        $user = Auth::user();
        $account = $user->account;
        
        if (!$account) {
            return redirect()->route('transactions.index')
                ->with('error', 'No account found for export.');
        }

        $query = Transaction::where('account_id', $account->id)
                           ->orderBy('created_at', 'desc');

        // Apply same filters as index
        $this->applyFilters($query, $request);
        
        $transactions = $query->get();

        $filename = 'piggy-transactions-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'Date',
                'Transaction ID',
                'Type',
                'Description',
                'Amount',
                'Balance After',
                'Status',
                'Reference'
            ]);

            // CSV Data
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->created_at->format('Y-m-d H:i:s'),
                    $transaction->transaction_id,
                    ucfirst($transaction->type),
                    $transaction->description,
                    number_format($transaction->amount, 2),
                    number_format($transaction->balance_after, 2),
                    ucfirst($transaction->status),
                    $transaction->reference ?? ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Apply filters to the transaction query
     */
    private function applyFilters($query, Request $request)
    {
        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Quick date filters
        if ($request->filled('quick_date')) {
            switch ($request->quick_date) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', yesterday());
                    break;
                case 'this_week':
                    $query->whereBetween('created_at', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);
                    break;
                case 'last_week':
                    $query->whereBetween('created_at', [
                        now()->subWeek()->startOfWeek(),
                        now()->subWeek()->endOfWeek()
                    ]);
                    break;
                case 'this_month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'last_month':
                    $query->whereMonth('created_at', now()->subMonth()->month)
                          ->whereYear('created_at', now()->subMonth()->year);
                    break;
                case 'this_year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        // Transaction type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Amount range filter
        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->amount_min);
        }

        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->amount_max);
        }

        // Search in description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_id', 'LIKE', "%{$search}%")
                  ->orWhere('reference', 'LIKE', "%{$search}%");
            });
        }
    }

    /**
     * Calculate transaction statistics
     */
    private function calculateStats($accountId, Request $request)
    {
        $baseQuery = Transaction::where('account_id', $accountId);
        
        // Apply same filters for stats
        $this->applyFilters($baseQuery, $request);
        
        $stats = [
            'total_transactions' => (clone $baseQuery)->count(),
            'total_deposits' => (clone $baseQuery)->where('type', 'deposit')->sum('amount'),
            'total_withdrawals' => (clone $baseQuery)->where('type', 'withdrawal')->sum('amount'),
            'average_transaction' => (clone $baseQuery)->avg('amount') ?? 0,
        ];

        $stats['net_flow'] = $stats['total_deposits'] - $stats['total_withdrawals'];

        return $stats;
    }
}
