<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transaction History - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #FFB6C1 0%, #FF9898 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
        }

        .nav-section {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .nav-link {
            text-decoration: none;
            color: #6b7280;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #FF7B7B;
            background: rgba(255, 123, 123, 0.1);
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 16px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .summary-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--card-color);
        }

        .summary-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .summary-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Filters Section */
        .filters-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .filters-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .filters-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .filters-toggle {
            background: none;
            border: none;
            color: #FF7B7B;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .filter-input, .filter-select {
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }

        .filter-input:focus, .filter-select:focus {
            outline: none;
            border-color: #FF7B7B;
        }

        .filter-actions {
            display: flex;
            gap: 12px;
            grid-column: span 2;
        }

        .btn-filter, .btn-clear, .btn-export {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-filter {
            background: #FF7B7B;
            color: white;
        }

        .btn-filter:hover {
            background: #FF5E5E;
            transform: translateY(-2px);
        }

        .btn-clear {
            background: #6b7280;
            color: white;
        }

        .btn-clear:hover {
            background: #4b5563;
        }

        .btn-export {
            background: #10b981;
            color: white;
        }

        .btn-export:hover {
            background: #059669;
        }

        /* Transactions Table */
        .transactions-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .transactions-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .transactions-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .sort-controls {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sort-label {
            font-size: 14px;
            color: #6b7280;
        }

        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .transactions-table th {
            background: #f9fafb;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }

        .transactions-table td {
            padding: 16px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .transactions-table tr:hover {
            background: rgba(255, 123, 123, 0.02);
        }

        .transaction-type {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .type-deposit {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .type-withdrawal {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .type-transfer {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }

        .type-payment {
            background: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
        }

        .amount-positive {
            color: #059669;
            font-weight: 600;
        }

        .amount-negative {
            color: #dc2626;
            font-weight: 600;
        }

        .transaction-link {
            color: #FF7B7B;
            text-decoration: none;
            font-weight: 500;
        }

        .transaction-link:hover {
            text-decoration: underline;
        }

        /* Pagination */
        .pagination-section {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 14px;
        }

        .pagination-links {
            display: flex;
            gap: 8px;
        }

        .pagination-link {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            background: white;
            color: #374151;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .pagination-link:hover, .pagination-link.active {
            background: #FF7B7B;
            color: white;
            border-color: #FF7B7B;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .main-container {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 24px;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: span 1;
                flex-direction: column;
            }

            .transactions-table {
                font-size: 14px;
            }

            .nav-section {
                display: none;
            }

            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Export Modal */
        .export-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .export-modal-content {
            background: white;
            padding: 32px;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .export-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .export-modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .export-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6b7280;
        }

        .export-options {
            display: grid;
            gap: 16px;
        }

        .export-option {
            padding: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .export-option:hover, .export-option.selected {
            border-color: #FF7B7B;
            background: rgba(255, 123, 123, 0.05);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <span class="brand-name">PIGGY</span>
            </div>
            
            <div class="nav-section">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('payment.index') }}" class="nav-link">
                    <i class="fas fa-credit-card"></i> Payments
                </a>
                <a href="{{ route('history.index') }}" class="nav-link active">
                    <i class="fas fa-history"></i> History
                </a>
            </div>

            <div class="user-section">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $user->first_name ?? $user->name }} {{ $user->last_name ?? '' }}</h3>
                        <p>{{ $account->account_number }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">📊 Transaction History</h1>
            <p class="page-subtitle">
                View, filter, and analyze your complete banking transaction history with advanced search and export capabilities.
            </p>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid">
            <div class="summary-card" style="--card-color: #3b82f6;">
                <div class="summary-label">Total Transactions</div>
                <div class="summary-value">{{ number_format($summary['total_transactions']) }}</div>
            </div>
            <div class="summary-card" style="--card-color: #10b981;">
                <div class="summary-label">Total Deposits</div>
                <div class="summary-value">₱{{ number_format($summary['total_deposits'], 2) }}</div>
            </div>
            <div class="summary-card" style="--card-color: #f59e0b;">
                <div class="summary-label">Total Withdrawals</div>
                <div class="summary-value">₱{{ number_format($summary['total_withdrawals'], 2) }}</div>
            </div>
            <div class="summary-card" style="--card-color: #8b5cf6;">
                <div class="summary-label">Total Payments</div>
                <div class="summary-value">₱{{ number_format($summary['total_payments'], 2) }}</div>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filters-section">
            <div class="filters-header">
                <h3 class="filters-title">
                    <i class="fas fa-filter"></i>
                    Advanced Filters
                </h3>
                <button class="filters-toggle" onclick="toggleFilters()">
                    <i class="fas fa-chevron-up" id="filtersIcon"></i>
                    <span id="filtersText">Hide Filters</span>
                </button>
            </div>

            <form method="GET" action="{{ route('history.index') }}" id="filtersForm">
                <div class="filters-grid" id="filtersGrid">
                    <div class="filter-group">
                        <label class="filter-label">Date From</label>
                        <input type="date" name="date_from" class="filter-input" value="{{ $dateFrom }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Date To</label>
                        <input type="date" name="date_to" class="filter-input" value="{{ $dateTo }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Transaction Type</label>
                        <select name="type" class="filter-select">
                            <option value="all" {{ $transactionType === 'all' ? 'selected' : '' }}>All Types</option>
                            <option value="deposit" {{ $transactionType === 'deposit' ? 'selected' : '' }}>Deposits</option>
                            <option value="withdrawal" {{ $transactionType === 'withdrawal' ? 'selected' : '' }}>Withdrawals</option>
                            <option value="transfer" {{ $transactionType === 'transfer' ? 'selected' : '' }}>Transfers</option>
                            <option value="payment" {{ $transactionType === 'payment' ? 'selected' : '' }}>Payments</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Amount From</label>
                        <input type="number" name="amount_from" class="filter-input" placeholder="Min amount" step="0.01" value="{{ $amountFrom }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Amount To</label>
                        <input type="number" name="amount_to" class="filter-input" placeholder="Max amount" step="0.01" value="{{ $amountTo }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" name="search" class="filter-input" placeholder="Description, reference, ID..." value="{{ $search }}">
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Sort By</label>
                        <select name="sort" class="filter-select">
                            <option value="created_at" {{ $sortBy === 'created_at' ? 'selected' : '' }}>Date</option>
                            <option value="amount" {{ $sortBy === 'amount' ? 'selected' : '' }}>Amount</option>
                            <option value="type" {{ $sortBy === 'type' ? 'selected' : '' }}>Type</option>
                            <option value="description" {{ $sortBy === 'description' ? 'selected' : '' }}>Description</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="filter-label">Direction</label>
                        <select name="direction" class="filter-select">
                            <option value="desc" {{ $sortDirection === 'desc' ? 'selected' : '' }}>Newest First</option>
                            <option value="asc" {{ $sortDirection === 'asc' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">
                            <i class="fas fa-search"></i>
                            Apply Filters
                        </button>
                        <a href="{{ route('history.index') }}" class="btn-clear">
                            <i class="fas fa-times"></i>
                            Clear All
                        </a>
                        <button type="button" class="btn-export" onclick="openExportModal()">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Transactions Table -->
        <div class="transactions-section">
            <div class="transactions-header">
                <h3 class="transactions-title">
                    Transaction Records 
                    @if($transactions->total() > 0)
                        <span style="color: #6b7280; font-weight: 400; font-size: 16px;">
                            ({{ number_format($transactions->total()) }} found)
                        </span>
                    @endif
                </h3>
                
                <div class="sort-controls">
                    <span class="sort-label">Show:</span>
                    <select onchange="changePerPage(this.value)" class="filter-select" style="width: auto;">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                <div style="font-weight: 500;">{{ $transaction->created_at->format('M j, Y') }}</div>
                                <div style="font-size: 12px; color: #6b7280;">{{ $transaction->created_at->format('g:i A') }}</div>
                            </td>
                            <td>
                                <span class="transaction-type type-{{ $transaction->type }}">
                                    @if($transaction->type === 'deposit')
                                        <i class="fas fa-plus-circle"></i> Deposit
                                    @elseif($transaction->type === 'withdrawal')
                                        <i class="fas fa-minus-circle"></i> Withdrawal
                                    @elseif($transaction->type === 'transfer')
                                        <i class="fas fa-exchange-alt"></i> Transfer
                                    @elseif($transaction->type === 'payment')
                                        <i class="fas fa-credit-card"></i> Payment
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ $transaction->description }}</div>
                                @if($transaction->reference_number)
                                <div style="font-size: 12px; color: #6b7280;">Ref: {{ $transaction->reference_number }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="amount-{{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? 'positive' : 'negative' }}">
                                    {{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? '+' : '-' }}₱{{ number_format(abs($transaction->amount), 2) }}
                                </span>
                            </td>
                            <td>₱{{ number_format($transaction->balance_after, 2) }}</td>
                            <td>
                                <code style="font-size: 12px; background: #f3f4f6; padding: 2px 4px; border-radius: 4px;">
                                    {{ $transaction->transaction_id }}
                                </code>
                            </td>
                            <td>
                                <a href="{{ route('history.show', $transaction->id) }}" class="transaction-link">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination-section">
                    <div class="pagination-info">
                        Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of {{ number_format($transactions->total()) }} transactions
                    </div>
                    <div class="pagination-links">
                        {{ $transactions->links('pagination::simple-bootstrap-4') }}
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <h3>No Transactions Found</h3>
                    <p>No transactions match your current filters. Try adjusting your search criteria.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Export Modal -->
    <div class="export-modal" id="exportModal">
        <div class="export-modal-content">
            <div class="export-modal-header">
                <h3 class="export-modal-title">Export Transactions</h3>
                <button class="export-close" onclick="closeExportModal()">&times;</button>
            </div>
            
            <form action="{{ route('history.export') }}" method="GET" id="exportForm">
                <!-- Copy current filters -->
                <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                <input type="hidden" name="date_to" value="{{ $dateTo }}">
                <input type="hidden" name="type" value="{{ $transactionType }}">
                
                <div class="export-options">
                    <div class="export-option" onclick="selectExportFormat('csv')">
                        <h4><i class="fas fa-file-csv"></i> CSV Format</h4>
                        <p>Spreadsheet compatible format for Excel, Google Sheets</p>
                    </div>
                    <div class="export-option" onclick="selectExportFormat('pdf')">
                        <h4><i class="fas fa-file-pdf"></i> PDF Report</h4>
                        <p>Professional report format for printing and sharing</p>
                    </div>
                </div>
                
                <input type="hidden" name="format" id="exportFormat" value="">
                
                <div style="margin-top: 24px; text-align: right;">
                    <button type="button" class="btn-clear" onclick="closeExportModal()">Cancel</button>
                    <button type="submit" class="btn-export" id="exportButton" disabled>
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleFilters() {
            const grid = document.getElementById('filtersGrid');
            const icon = document.getElementById('filtersIcon');
            const text = document.getElementById('filtersText');
            
            if (grid.style.display === 'none') {
                grid.style.display = 'grid';
                icon.className = 'fas fa-chevron-up';
                text.textContent = 'Hide Filters';
            } else {
                grid.style.display = 'none';
                icon.className = 'fas fa-chevron-down';
                text.textContent = 'Show Filters';
            }
        }

        function changePerPage(perPage) {
            const url = new URL(window.location);
            url.searchParams.set('per_page', perPage);
            window.location = url.toString();
        }

        function openExportModal() {
            document.getElementById('exportModal').style.display = 'flex';
        }

        function closeExportModal() {
            document.getElementById('exportModal').style.display = 'none';
            // Reset selections
            document.querySelectorAll('.export-option').forEach(option => {
                option.classList.remove('selected');
            });
            document.getElementById('exportFormat').value = '';
            document.getElementById('exportButton').disabled = true;
        }

        function selectExportFormat(format) {
            // Remove previous selections
            document.querySelectorAll('.export-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Select current option
            event.currentTarget.classList.add('selected');
            document.getElementById('exportFormat').value = format;
            document.getElementById('exportButton').disabled = false;
        }
    </script>
</body>
</html>