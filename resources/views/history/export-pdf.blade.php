<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report - PIGGY Bank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }

        .report-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #FF7B7B;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #FF7B7B;
            margin-bottom: 5px;
        }

        .report-title {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }

        .report-info {
            font-size: 14px;
            color: #888;
        }

        .account-info {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .account-info h3 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
        }

        .info-label {
            font-weight: bold;
            color: #666;
        }

        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .transactions-table th {
            background: #FF7B7B;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
        }

        .transactions-table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .transactions-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .transaction-type {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .type-deposit {
            background: #d1fae5;
            color: #065f46;
        }

        .type-withdrawal {
            background: #fee2e2;
            color: #991b1b;
        }

        .type-transfer {
            background: #dbeafe;
            color: #1e40af;
        }

        .type-payment {
            background: #ede9fe;
            color: #6b21a8;
        }

        .amount-positive {
            color: #059669;
            font-weight: bold;
        }

        .amount-negative {
            color: #dc2626;
            font-weight: bold;
        }

        .summary-section {
            margin-top: 30px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .summary-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .summary-label {
            font-weight: bold;
            color: #666;
        }

        .summary-value {
            font-weight: bold;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
            
            .page-break {
                page-break-before: always;
            }
        }

        .no-transactions {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="report-header">
        <div class="logo">🐷 PIGGY Bank</div>
        <div class="report-title">Transaction History Report</div>
        <div class="report-info">
            Generated on {{ now()->format('F j, Y \a\t g:i A') }}
            @if($dateFrom || $dateTo)
                <br>Period: 
                @if($dateFrom && $dateTo)
                    {{ \Carbon\Carbon::parse($dateFrom)->format('M j, Y') }} - {{ \Carbon\Carbon::parse($dateTo)->format('M j, Y') }}
                @elseif($dateFrom)
                    From {{ \Carbon\Carbon::parse($dateFrom)->format('M j, Y') }}
                @else
                    Until {{ \Carbon\Carbon::parse($dateTo)->format('M j, Y') }}
                @endif
            @endif
        </div>
    </div>

    <div class="account-info">
        <h3>Account Information</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Account Holder:</span>
                <span>{{ $account->user->first_name ?? $account->user->name }} {{ $account->user->last_name ?? '' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Account Number:</span>
                <span>{{ $account->account_number }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Account Type:</span>
                <span>{{ ucfirst($account->account_type) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Current Balance:</span>
                <span>₱{{ number_format($account->balance, 2) }}</span>
            </div>
        </div>
    </div>

    @if($transactions->count() > 0)
        <table class="transactions-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Balance</th>
                    <th>Reference</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('M j, Y g:i A') }}</td>
                    <td>
                        <span class="transaction-type type-{{ $transaction->type }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td>{{ $transaction->description }}</td>
                    <td class="amount-{{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? 'positive' : 'negative' }}">
                        {{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? '+' : '-' }}₱{{ number_format(abs($transaction->amount), 2) }}
                    </td>
                    <td>₱{{ number_format($transaction->balance_after, 2) }}</td>
                    <td>{{ $transaction->reference_number }}</td>
                    <td>{{ ucfirst($transaction->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary-section">
            <div class="summary-title">Transaction Summary</div>
            <div class="summary-grid">
                <div class="summary-item">
                    <span class="summary-label">Total Transactions:</span>
                    <span class="summary-value">{{ number_format($transactions->count()) }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Deposits:</span>
                    <span class="summary-value">₱{{ number_format($transactions->where('type', 'deposit')->sum('amount'), 2) }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Withdrawals:</span>
                    <span class="summary-value">₱{{ number_format($transactions->where('type', 'withdrawal')->sum('amount'), 2) }}</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Payments:</span>
                    <span class="summary-value">₱{{ number_format($transactions->where('type', 'payment')->sum('amount'), 2) }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="no-transactions">
            <h3>No Transactions Found</h3>
            <p>No transactions match the selected criteria for the specified period.</p>
        </div>
    @endif

    <div class="footer">
        <p><strong>PIGGY Bank</strong> - Your trusted banking partner</p>
        <p>This report is generated electronically and contains {{ $transactions->count() }} transaction(s)</p>
        <p>For inquiries, please contact our customer service</p>
    </div>
</body>
</html>