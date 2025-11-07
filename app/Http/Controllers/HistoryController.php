<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $account = $user->account;
        
        if (!$account) {
            return redirect()->route('dashboard')->with('error', 'No account found.');
        }

        // Get filter parameters
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $transactionType = $request->get('type');
        $amountFrom = $request->get('amount_from');
        $amountTo = $request->get('amount_to');
        $search = $request->get('search');
        $sortBy = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $perPage = $request->get('per_page', 20);

        // Build query
        $query = Transaction::where('account_id', $account->id);

        // Apply filters
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        
        if ($transactionType && $transactionType !== 'all') {
            $query->where('type', $transactionType);
        }
        
        if ($amountFrom) {
            $query->where('amount', '>=', $amountFrom);
        }
        
        if ($amountTo) {
            $query->where('amount', '<=', $amountTo);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $query->orderBy($sortBy, $sortDirection);

        // Get transactions with pagination
        $transactions = $query->paginate($perPage)->appends($request->query());

        // Get summary statistics
        $summaryQuery = Transaction::where('account_id', $account->id);
        
        // Apply same filters to summary (except pagination)
        if ($dateFrom) $summaryQuery->whereDate('created_at', '>=', $dateFrom);
        if ($dateTo) $summaryQuery->whereDate('created_at', '<=', $dateTo);
        if ($transactionType && $transactionType !== 'all') $summaryQuery->where('type', $transactionType);
        if ($amountFrom) $summaryQuery->where('amount', '>=', $amountFrom);
        if ($amountTo) $summaryQuery->where('amount', '<=', $amountTo);
        if ($search) {
            $summaryQuery->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('reference_number', 'like', "%{$search}%")
                  ->orWhere('transaction_id', 'like', "%{$search}%");
            });
        }

        $summary = [
            'total_transactions' => $summaryQuery->count(),
            'total_deposits' => $summaryQuery->where('type', 'deposit')->sum('amount'),
            'total_withdrawals' => $summaryQuery->where('type', 'withdrawal')->sum('amount'),
            'total_transfers_out' => $summaryQuery->where('type', 'transfer')->where('amount', '<', 0)->sum(DB::raw('ABS(amount)')),
            'total_transfers_in' => $summaryQuery->where('type', 'transfer')->where('amount', '>', 0)->sum('amount'),
            'total_payments' => $summaryQuery->where('type', 'payment')->sum('amount'),
        ];

        return view('history.index', compact(
            'user', 
            'account', 
            'transactions', 
            'summary',
            'dateFrom',
            'dateTo',
            'transactionType',
            'amountFrom',
            'amountTo',
            'search',
            'sortBy',
            'sortDirection',
            'perPage'
        ));
    }

    public function show($transactionId)
    {
        $user = Auth::user();
        $account = $user->account;
        
        $transaction = Transaction::where('account_id', $account->id)
                                ->where('id', $transactionId)
                                ->firstOrFail();
        
        return view('history.show', compact('user', 'account', 'transaction'));
    }

    public function export(Request $request)
    {
        $user = Auth::user();
        $account = $user->account;
        
        $format = $request->get('format', 'csv');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $transactionType = $request->get('type');

        // Build export query
        $query = Transaction::where('account_id', $account->id);
        
        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }
        
        if ($transactionType && $transactionType !== 'all') {
            $query->where('type', $transactionType);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        if ($format === 'csv') {
            return $this->exportCsv($transactions, $account);
        } elseif ($format === 'pdf') {
            return $this->exportPdf($transactions, $account, $dateFrom, $dateTo);
        }

        return redirect()->back()->with('error', 'Invalid export format.');
    }

    private function exportCsv($transactions, $account)
    {
        $filename = "transaction_history_{$account->account_number}_" . date('Y-m-d') . ".csv";
        
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
                'Balance Before',
                'Balance After',
                'Reference Number',
                'Status'
            ]);

            // CSV Data
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->created_at->format('Y-m-d H:i:s'),
                    $transaction->transaction_id,
                    ucfirst($transaction->type),
                    $transaction->description,
                    number_format($transaction->amount, 2),
                    number_format($transaction->balance_before, 2),
                    number_format($transaction->balance_after, 2),
                    $transaction->reference_number,
                    ucfirst($transaction->status)
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPdf($transactions, $account, $dateFrom, $dateTo)
    {
        // For now, return a simple HTML that can be converted to PDF
        // In a real application, you might use packages like DomPDF or wkhtmltopdf
        
        $html = view('history.export-pdf', compact('transactions', 'account', 'dateFrom', 'dateTo'))->render();
        
        $filename = "transaction_report_{$account->account_number}_" . date('Y-m-d') . ".html";
        
        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }

    public function analytics(Request $request)
    {
        $user = Auth::user();
        $account = $user->account;
        
        $period = $request->get('period', '30'); // Default 30 days
        $startDate = Carbon::now()->subDays((int)$period);

        // Transaction analytics
        $analytics = [
            'period' => $period,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => Carbon::now()->format('Y-m-d'),
            
            // Transaction counts by type
            'transaction_counts' => Transaction::where('account_id', $account->id)
                ->where('created_at', '>=', $startDate)
                ->select('type', DB::raw('count(*) as count'))
                ->groupBy('type')
                ->pluck('count', 'type'),
                
            // Daily transaction volumes
            'daily_volumes' => Transaction::where('account_id', $account->id)
                ->where('created_at', '>=', $startDate)
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get(),
                
            // Monthly summaries
            'monthly_summary' => Transaction::where('account_id', $account->id)
                ->where('created_at', '>=', $startDate)
                ->select(
                    'type',
                    DB::raw('SUM(amount) as total_amount'),
                    DB::raw('COUNT(*) as transaction_count'),
                    DB::raw('AVG(amount) as average_amount')
                )
                ->groupBy('type')
                ->get(),
                
            // Top payment categories (if metadata exists)
            'payment_categories' => Transaction::where('account_id', $account->id)
                ->where('type', 'payment')
                ->where('created_at', '>=', $startDate)
                ->whereNotNull('metadata')
                ->get()
                ->map(function($transaction) {
                    $metadata = json_decode($transaction->metadata, true);
                    return $metadata['category'] ?? 'Unknown';
                })
                ->countBy()
                ->take(5),
        ];

        return view('history.analytics', compact('user', 'account', 'analytics'));
    }
}
