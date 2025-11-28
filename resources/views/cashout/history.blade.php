<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Out History - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ff9999 0%, #ffb3b3 50%, #ffc9c9 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23FFD3D3" stop-opacity="0.15"/><stop offset="100%" stop-color="%23FFD3D3" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="200" fill="url(%23a)"/><circle cx="400" cy="700" r="100" fill="url(%23a)"/><circle cx="900" cy="800" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
            background-size: cover;
            pointer-events: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            color: #f59e0b;
            font-family: 'Lalezar', sans-serif;
            font-size: 32px;
            font-weight: normal;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            color: #6B7280;
            font-size: 16px;
            line-height: 1.6;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #f59e0b;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            color: #d97706;
            transform: translateX(-3px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 24px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #6B7280;
            font-size: 14px;
            font-weight: 600;
        }

        .filters {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #E5E7EB;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: #FAFBFC;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #f59e0b;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .filter-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
        }

        .history-table {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-header {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 20px 30px;
        }

        .table-header h3 {
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-content {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #F3F4F6;
        }

        th {
            background: #F9FAFB;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            color: #1F2937;
            font-weight: 500;
        }

        .amount {
            font-weight: 700;
            color: #f59e0b;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .status.completed {
            background: #D1FAE5;
            color: #065F46;
        }

        .status.failed {
            background: #FEE2E2;
            color: #991B1B;
        }

        .status.processing {
            background: #EFF6FF;
            color: #1E40AF;
        }

        .no-data {
            text-align: center;
            padding: 60px 20px;
            color: #6B7280;
        }

        .no-data i {
            font-size: 64px;
            color: #E5E7EB;
            margin-bottom: 20px;
        }

        .no-data h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #374151;
        }

        .no-data p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .new-cashout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .new-cashout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .reference-number {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 12px;
            background: #F3F4F6;
            padding: 4px 8px;
            border-radius: 6px;
            color: #6B7280;
        }

        /* Enhanced Responsive Design - Mobile First Approach */
        
        /* Base mobile styles */
        .container {
            padding: 15px 12px;
        }
        
        .header,
        .filters {
            padding: 20px 16px;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .filter-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        /* Small Mobile (320px - 479px) */
        @media (max-width: 479px) {
            .container {
                padding: 10px 8px;
            }

            .header,
            .filters,
            .history-table {
                margin: 8px 0;
                border-radius: 12px;
            }

            .header,
            .filters {
                padding: 16px 14px;
            }
            
            .header h1 {
                font-size: 24px;
                margin-bottom: 8px;
            }
            
            .header p {
                font-size: 13px;
                line-height: 1.4;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .stat-card {
                padding: 16px;
                text-align: center;
            }
            
            .stat-icon {
                width: 45px;
                height: 45px;
                font-size: 18px;
                margin-bottom: 12px;
            }
            
            .stat-value {
                font-size: 20px;
                margin-bottom: 6px;
            }
            
            .stat-label {
                font-size: 12px;
            }

            .filter-grid {
                gap: 10px;
            }
            
            .filter-group label {
                font-size: 12px;
                margin-bottom: 6px;
            }
            
            .filter-group select,
            .filter-group input {
                padding: 10px 12px;
                font-size: 13px;
                border-radius: 8px;
            }
            
            .filter-btn {
                padding: 10px 16px;
                font-size: 13px;
                border-radius: 8px;
            }

            .table-content {
                font-size: 12px;
            }

            th, td {
                padding: 10px 12px;
                font-size: 12px;
            }
            
            th {
                font-size: 11px;
            }

            .reference-number {
                font-size: 9px;
                padding: 3px 6px;
                border-radius: 4px;
            }
            
            .status {
                padding: 4px 8px;
                font-size: 9px;
                border-radius: 12px;
            }
            
            .back-btn {
                font-size: 12px;
                padding: 8px 12px;
                margin-bottom: 12px;
            }
            
            .no-data {
                padding: 40px 15px;
            }
            
            .no-data i {
                font-size: 48px;
                margin-bottom: 15px;
            }
            
            .no-data h3 {
                font-size: 16px;
                margin-bottom: 8px;
            }
            
            .no-data p {
                font-size: 13px;
                margin-bottom: 15px;
            }
            
            .new-cashout-btn {
                padding: 10px 18px;
                font-size: 13px;
                border-radius: 8px;
            }
        }

        /* Mobile (480px - 599px) */
        @media (min-width: 480px) and (max-width: 599px) {
            .container {
                padding: 12px 10px;
            }

            .header,
            .filters {
                padding: 18px 16px;
            }
            
            .header h1 {
                font-size: 26px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
            
            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            
            th, td {
                padding: 11px 13px;
                font-size: 13px;
            }
            
            .reference-number {
                font-size: 10px;
            }
        }
        
        /* Large Mobile/Small Tablet (600px - 767px) */
        @media (min-width: 600px) and (max-width: 767px) {
            .container {
                padding: 15px 12px;
            }

            .header,
            .filters {
                padding: 22px 20px;
            }
            
            .header h1 {
                font-size: 28px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            
            .filter-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 14px;
            }
            
            th, td {
                padding: 12px 14px;
                font-size: 13px;
            }
        }

        /* Tablet (768px - 1023px) */
        @media (min-width: 768px) and (max-width: 1023px) {
            .container {
                padding: 20px 15px;
            }

            .header,
            .filters,
            .history-table {
                margin: 15px 0;
                border-radius: 18px;
            }

            .header,
            .filters {
                padding: 25px 22px;
            }
            
            .header h1 {
                font-size: 30px;
            }

            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
            }

            .filter-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 16px;
            }

            .table-content {
                font-size: 14px;
            }

            th, td {
                padding: 14px 16px;
            }

            .reference-number {
                font-size: 11px;
            }
            
            .back-btn {
                font-size: 14px;
                padding: 10px 16px;
                margin-bottom: 18px;
            }
        }

        /* Desktop (1024px - 1439px) */
        @media (min-width: 1024px) and (max-width: 1439px) {
            .container {
                max-width: 1100px;
                padding: 25px 20px;
            }

            .header,
            .filters {
                padding: 30px 28px;
            }
            
            .header h1 {
                font-size: 32px;
            }

            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .filter-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 18px;
            }

            th, td {
                padding: 16px 18px;
            }
        }

        /* Large Desktop (1440px+) */
        @media (min-width: 1440px) {
            .container {
                max-width: 1300px;
                padding: 30px 25px;
            }

            .header,
            .filters {
                padding: 35px 32px;
            }
            
            .header h1 {
                font-size: 34px;
            }

            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 25px;
            }

            .filter-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            th, td {
                padding: 18px 20px;
            }
            
            .reference-number {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="header">
            <h1>
                <i class="fas fa-history"></i>
                Cash Out History
            </h1>
            <p>Track all your cash out transactions and their status. Keep records of your money transfers to external banks.</p>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value">₱{{ number_format($totalAmount, 2) }}</div>
                <div class="stat-label">Total Amount</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-value">{{ $totalTransactions }}</div>
                <div class="stat-label">Total Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $completedTransactions }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">{{ $pendingTransactions }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" action="{{ route('cashout.history') }}">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="date_from">From Date</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="filter-group">
                        <label for="date_to">To Date</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="filter-group">
                        <button type="submit" class="filter-btn">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- History Table -->
        <div class="history-table">
            <div class="table-header">
                <h3>
                    <i class="fas fa-table"></i>
                    Cash Out Transactions
                </h3>
            </div>
            
            <div class="table-content">
                @if($cashouts->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Recipient</th>
                                <th>Bank</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cashouts as $cashout)
                            <tr>
                                <td>
                                    <div class="reference-number">{{ $cashout->reference_number }}</div>
                                </td>
                                <td>{{ $cashout->created_at->format('M d, Y g:i A') }}</td>
                                <td class="amount">₱{{ number_format($cashout->amount, 2) }}</td>
                                <td>
                                    <div style="font-weight: 600;">{{ $cashout->recipient_name }}</div>
                                    <div style="font-size: 12px; color: #6B7280;">
                                        ****{{ substr($cashout->recipient_account_number, -4) }}
                                    </div>
                                </td>
                                <td>{{ $cashout->recipient_bank }}</td>
                                <td>
                                    <span class="status {{ $cashout->status }}">
                                        @if($cashout->status === 'pending')
                                            <i class="fas fa-clock"></i>
                                        @elseif($cashout->status === 'processing')
                                            <i class="fas fa-spinner fa-spin"></i>
                                        @elseif($cashout->status === 'completed')
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-times"></i>
                                        @endif
                                        {{ ucfirst($cashout->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>No Cash Out Transactions Yet</h3>
                        <p>You haven't made any cash out requests yet. Start by transferring money to an external bank account.</p>
                        <a href="{{ route('cashout.index') }}" class="new-cashout-btn">
                            <i class="fas fa-plus"></i>
                            Make Your First Cash Out
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>