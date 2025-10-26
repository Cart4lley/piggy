<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History - PIGGY Bank</title>
  
  <!-- Modern fonts -->
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
      padding: 20px;
    }

    .container {
      max-width: 1400px;
      margin: 0 auto;
    }

    /* Header Section */
    .page-header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 20px 40px rgba(255, 152, 152, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .page-title {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .page-title i {
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      width: 50px;
      height: 50px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }

    .page-title h1 {
      font-size: 32px;
      font-weight: 700;
      color: #2d3748;
      font-family: 'Poppins', sans-serif;
    }

    .back-button {
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      padding: 12px 24px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .back-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(255, 152, 152, 0.3);
      color: white;
      text-decoration: none;
    }

    /* Statistics Cards */
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
      padding: 25px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(255, 152, 152, 0.15);
    }

    .stat-icon {
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      width: 60px;
      height: 60px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin: 0 auto 15px;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 700;
      color: #2d3748;
      margin-bottom: 5px;
      font-family: 'Poppins', sans-serif;
    }

    .stat-label {
      color: #718096;
      font-size: 14px;
      font-weight: 500;
    }

    /* Filters Section */
    .filters-section {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 25px;
      margin-bottom: 30px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .filters-header {
      display: flex;
      justify-content: between;
      align-items: center;
      margin-bottom: 20px;
    }

    .filters-title {
      font-size: 18px;
      font-weight: 600;
      color: #2d3748;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .filter-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      align-items: end;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-size: 14px;
      font-weight: 500;
      color: #4a5568;
      margin-bottom: 8px;
    }

    .form-input, .form-select {
      padding: 12px 16px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      transition: all 0.3s ease;
      background: white;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #FF9898;
      box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
    }

    .quick-filters {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 15px;
    }

    .quick-filter {
      padding: 8px 16px;
      background: rgba(255, 152, 152, 0.1);
      color: #FF7B7B;
      border: 1px solid rgba(255, 152, 152, 0.3);
      border-radius: 25px;
      font-size: 13px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .quick-filter.active,
    .quick-filter:hover {
      background: #FF9898;
      color: white;
      text-decoration: none;
    }

    .filter-buttons {
      display: flex;
      gap: 10px;
    }

    .btn {
      padding: 12px 20px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
    }

    .btn-secondary {
      background: rgba(113, 128, 150, 0.1);
      color: #718096;
      border: 1px solid rgba(113, 128, 150, 0.3);
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    /* Transactions Table */
    .transactions-section {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .section-header {
      padding: 25px 30px;
      border-bottom: 1px solid rgba(226, 232, 240, 0.5);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .section-title {
      font-size: 20px;
      font-weight: 600;
      color: #2d3748;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .export-btn {
      background: rgba(34, 197, 94, 0.1);
      color: #22c55e;
      border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .export-btn:hover {
      background: #22c55e;
      color: white;
    }

    .transactions-table {
      width: 100%;
      border-collapse: collapse;
    }

    .transactions-table th {
      background: rgba(249, 250, 251, 0.8);
      padding: 15px 20px;
      text-align: left;
      font-weight: 600;
      color: #374151;
      font-size: 14px;
      border-bottom: 1px solid rgba(226, 232, 240, 0.5);
    }

    .transactions-table td {
      padding: 20px;
      border-bottom: 1px solid rgba(226, 232, 240, 0.3);
      vertical-align: middle;
    }

    .transactions-table tbody tr:hover {
      background: rgba(255, 152, 152, 0.05);
    }

    .transaction-row {
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .transaction-id {
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      color: #6b7280;
      background: rgba(107, 114, 128, 0.1);
      padding: 4px 8px;
      border-radius: 6px;
      display: inline-block;
    }

    .transaction-type {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .type-deposit {
      background: rgba(34, 197, 94, 0.1);
      color: #22c55e;
    }

    .type-withdrawal {
      background: rgba(239, 68, 68, 0.1);
      color: #ef4444;
    }

    .transaction-amount {
      font-weight: 600;
      font-size: 16px;
      font-family: 'Poppins', sans-serif;
    }

    .amount-positive {
      color: #22c55e;
    }

    .amount-negative {
      color: #ef4444;
    }

    .transaction-status {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }

    .status-completed {
      background: rgba(34, 197, 94, 0.1);
      color: #22c55e;
    }

    .status-pending {
      background: rgba(251, 191, 36, 0.1);
      color: #f59e0b;
    }

    .status-failed {
      background: rgba(239, 68, 68, 0.1);
      color: #ef4444;
    }

    .transaction-date {
      color: #6b7280;
      font-size: 14px;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: #9ca3af;
    }

    .empty-state i {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.5;
    }

    .empty-state h3 {
      font-size: 20px;
      margin-bottom: 10px;
      color: #6b7280;
    }

    .empty-state p {
      font-size: 14px;
    }

    /* Pagination */
    .pagination-wrapper {
      padding: 25px 30px;
      border-top: 1px solid rgba(226, 232, 240, 0.5);
      display: flex;
      justify-content: between;
      align-items: center;
    }

    .pagination-info {
      color: #6b7280;
      font-size: 14px;
    }

    /* Modal Styles */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(8px);
      z-index: 1000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-content {
      background: white;
      border-radius: 20px;
      max-width: 600px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }

      .header-top {
        flex-direction: column;
        gap: 15px;
        text-align: center;
      }

      .page-title h1 {
        font-size: 24px;
      }

      .filter-form {
        grid-template-columns: 1fr;
      }

      .transactions-table {
        font-size: 14px;
      }

      .transactions-table th,
      .transactions-table td {
        padding: 12px 8px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Page Header -->
    <div class="page-header">
      <div class="header-top">
        <div class="page-title">
          <i class="fas fa-exchange-alt"></i>
          <h1>Transaction History</h1>
        </div>
        <a href="{{ route('dashboard') }}" class="back-button">
          <i class="fas fa-arrow-left"></i>
          Back to Dashboard
        </a>
      </div>

      <!-- Account Info -->
      <div class="account-info">
        <p style="color: #718096; font-size: 14px;">
          Account: {{ $account->account_number }} | 
          Current Balance: <strong style="color: #2d3748;">₱{{ number_format($account->balance, 2) }}</strong>
        </p>
      </div>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-list"></i>
        </div>
        <div class="stat-value">{{ $stats['total_transactions'] }}</div>
        <div class="stat-label">Total Transactions</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-plus"></i>
        </div>
        <div class="stat-value">₱{{ number_format($stats['total_deposits'], 2) }}</div>
        <div class="stat-label">Total Deposits</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-minus"></i>
        </div>
        <div class="stat-value">₱{{ number_format($stats['total_withdrawals'], 2) }}</div>
        <div class="stat-label">Total Withdrawals</div>
      </div>

      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-value">₱{{ number_format($stats['average_transaction'], 2) }}</div>
        <div class="stat-label">Average Transaction</div>
      </div>
    </div>

    <!-- Filters Section -->
    <div class="filters-section">
      <div class="filters-header">
        <h3 class="filters-title">
          <i class="fas fa-filter"></i>
          Filter Transactions
        </h3>
      </div>

      <form method="GET" action="{{ route('transactions.index') }}" class="filter-form">
        <div class="form-group">
          <label class="form-label">Search</label>
          <input type="text" name="search" class="form-input" 
                 placeholder="Search by description, ID, or reference"
                 value="{{ request('search') }}">
        </div>

        <div class="form-group">
          <label class="form-label">Type</label>
          <select name="type" class="form-select">
            <option value="">All Types</option>
            <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposits</option>
            <option value="withdrawal" {{ request('type') == 'withdrawal' ? 'selected' : '' }}>Withdrawals</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="">All Status</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Date From</label>
          <input type="date" name="date_from" class="form-input" value="{{ request('date_from') }}">
        </div>

        <div class="form-group">
          <label class="form-label">Date To</label>
          <input type="date" name="date_to" class="form-input" value="{{ request('date_to') }}">
        </div>

        <div class="filter-buttons">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
            Apply Filters
          </button>
          <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i>
            Clear
          </a>
        </div>
      </form>

      <!-- Quick Filters -->
      <div class="quick-filters">
        <a href="{{ route('transactions.index', ['quick_date' => 'today']) }}" 
           class="quick-filter {{ request('quick_date') == 'today' ? 'active' : '' }}">Today</a>
        <a href="{{ route('transactions.index', ['quick_date' => 'this_week']) }}" 
           class="quick-filter {{ request('quick_date') == 'this_week' ? 'active' : '' }}">This Week</a>
        <a href="{{ route('transactions.index', ['quick_date' => 'this_month']) }}" 
           class="quick-filter {{ request('quick_date') == 'this_month' ? 'active' : '' }}">This Month</a>
        <a href="{{ route('transactions.index', ['quick_date' => 'last_month']) }}" 
           class="quick-filter {{ request('quick_date') == 'last_month' ? 'active' : '' }}">Last Month</a>
        <a href="{{ route('transactions.index', ['type' => 'deposit']) }}" 
           class="quick-filter {{ request('type') == 'deposit' ? 'active' : '' }}">Deposits Only</a>
        <a href="{{ route('transactions.index', ['type' => 'withdrawal']) }}" 
           class="quick-filter {{ request('type') == 'withdrawal' ? 'active' : '' }}">Withdrawals Only</a>
      </div>
    </div>

    <!-- Transactions Table -->
    <div class="transactions-section">
      <div class="section-header">
        <h3 class="section-title">
          <i class="fas fa-receipt"></i>
          Transactions
          @if($transactions->total() > 0)
            ({{ $transactions->total() }} {{ $transactions->total() == 1 ? 'transaction' : 'transactions' }})
          @endif
        </h3>
        @if($transactions->count() > 0)
        <a href="{{ route('transactions.export', request()->all()) }}" class="btn export-btn">
          <i class="fas fa-download"></i>
          Export CSV
        </a>
        @endif
      </div>

      @if($transactions->count() > 0)
        <table class="transactions-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Transaction ID</th>
              <th>Type</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Balance After</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transactions as $transaction)
            <tr class="transaction-row" onclick="showTransactionDetails({{ $transaction->id }})">
              <td>
                <div class="transaction-date">
                  {{ $transaction->created_at->format('M j, Y') }}<br>
                  <small style="color: #9ca3af;">{{ $transaction->created_at->format('g:i A') }}</small>
                </div>
              </td>
              <td>
                <span class="transaction-id">{{ $transaction->transaction_id }}</span>
              </td>
              <td>
                <span class="transaction-type type-{{ $transaction->type }}">
                  {{ ucfirst($transaction->type) }}
                </span>
              </td>
              <td>
                <div style="max-width: 200px;">
                  {{ Str::limit($transaction->description, 50) }}
                  @if($transaction->reference)
                    <br><small style="color: #9ca3af;">Ref: {{ $transaction->reference }}</small>
                  @endif
                </div>
              </td>
              <td>
                <span class="transaction-amount {{ $transaction->type == 'deposit' ? 'amount-positive' : 'amount-negative' }}">
                  {{ $transaction->type == 'deposit' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                </span>
              </td>
              <td>
                <span style="color: #6b7280; font-weight: 500;">
                  ₱{{ number_format($transaction->balance_after, 2) }}
                </span>
              </td>
              <td>
                <span class="transaction-status status-{{ $transaction->status }}">
                  {{ ucfirst($transaction->status) }}
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-wrapper">
          <div class="pagination-info">
            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
          </div>
          <div>
            {{ $transactions->links() }}
          </div>
        </div>
      @else
        <div class="empty-state">
          <i class="fas fa-inbox"></i>
          <h3>No Transactions Found</h3>
          <p>
            @if(request()->hasAny(['search', 'type', 'status', 'date_from', 'date_to', 'quick_date']))
              No transactions match your current filters. Try adjusting your search criteria.
            @else
              You haven't made any transactions yet. Start by making a deposit or withdrawal.
            @endif
          </p>
        </div>
      @endif
    </div>
  </div>

  <!-- Transaction Details Modal -->
  <div id="transactionModal" class="modal-overlay">
    <div class="modal-content">
      <!-- Modal content will be loaded here via AJAX -->
    </div>
  </div>

  <script>
    // Show transaction details modal
    function showTransactionDetails(transactionId) {
      const modal = document.getElementById('transactionModal');
      const content = modal.querySelector('.modal-content');
      
      // Show loading state
      content.innerHTML = `
        <div style="padding: 40px; text-align: center;">
          <i class="fas fa-spinner fa-spin" style="font-size: 32px; color: #FF9898; margin-bottom: 20px;"></i>
          <p>Loading transaction details...</p>
        </div>
      `;
      
      modal.style.display = 'flex';
      
      // Fetch transaction details
      fetch(`/transactions/${transactionId}/details`)
        .then(response => response.json())
        .then(data => {
          content.innerHTML = createTransactionModal(data.transaction, data.formatted);
        })
        .catch(error => {
          content.innerHTML = `
            <div style="padding: 40px; text-align: center;">
              <i class="fas fa-exclamation-triangle" style="font-size: 32px; color: #ef4444; margin-bottom: 20px;"></i>
              <h3>Error Loading Transaction</h3>
              <p>Unable to load transaction details. Please try again.</p>
              <button onclick="closeModal()" style="margin-top: 20px; padding: 10px 20px; background: #FF9898; color: white; border: none; border-radius: 8px; cursor: pointer;">Close</button>
            </div>
          `;
        });
    }

    function createTransactionModal(transaction, formatted) {
      return `
        <div style="padding: 30px;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #e5e7eb; padding-bottom: 20px;">
            <h2 style="font-size: 24px; font-weight: 600; color: #2d3748;">Transaction Details</h2>
            <button onclick="closeModal()" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #9ca3af;">&times;</button>
          </div>
          
          <div style="display: grid; gap: 20px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div>
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Transaction ID</label>
                <div style="font-family: monospace; background: #f3f4f6; padding: 8px 12px; border-radius: 6px; margin-top: 5px;">${transaction.transaction_id}</div>
              </div>
              <div>
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Date & Time</label>
                <div style="font-weight: 500; margin-top: 5px;">${formatted.date}</div>
              </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div>
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Type</label>
                <div style="margin-top: 5px;">
                  <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; background: ${transaction.type == 'deposit' ? 'rgba(34, 197, 94, 0.1)' : 'rgba(239, 68, 68, 0.1)'}; color: ${transaction.type == 'deposit' ? '#22c55e' : '#ef4444'};">
                    ${formatted.type_label}
                  </span>
                </div>
              </div>
              <div>
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Status</label>
                <div style="margin-top: 5px;">
                  <span style="padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; background: ${transaction.status == 'completed' ? 'rgba(34, 197, 94, 0.1)' : transaction.status == 'pending' ? 'rgba(251, 191, 36, 0.1)' : 'rgba(239, 68, 68, 0.1)'}; color: ${transaction.status == 'completed' ? '#22c55e' : transaction.status == 'pending' ? '#f59e0b' : '#ef4444'};">
                    ${formatted.status_label}
                  </span>
                </div>
              </div>
            </div>
            
            <div>
              <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Description</label>
              <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-top: 5px; border-left: 4px solid #FF9898;">
                ${transaction.description}
              </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div style="background: ${transaction.type == 'deposit' ? 'rgba(34, 197, 94, 0.05)' : 'rgba(239, 68, 68, 0.05)'}; padding: 20px; border-radius: 12px; text-align: center;">
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Amount</label>
                <div style="font-size: 28px; font-weight: 700; color: ${transaction.type == 'deposit' ? '#22c55e' : '#ef4444'}; margin-top: 8px;">
                  ${transaction.type == 'deposit' ? '+' : '-'}${formatted.amount}
                </div>
              </div>
              <div style="background: rgba(107, 114, 128, 0.05); padding: 20px; border-radius: 12px; text-align: center;">
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Balance After</label>
                <div style="font-size: 24px; font-weight: 600; color: #2d3748; margin-top: 8px;">
                  ${formatted.balance_after}
                </div>
              </div>
            </div>
            
            ${transaction.reference ? `
              <div>
                <label style="font-size: 14px; color: #6b7280; font-weight: 500;">Reference</label>
                <div style="font-family: monospace; background: #f3f4f6; padding: 8px 12px; border-radius: 6px; margin-top: 5px;">${transaction.reference}</div>
              </div>
            ` : ''}
          </div>
          
          <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; text-align: center;">
            <button onclick="closeModal()" style="background: linear-gradient(135deg, #FF9898, #FF7B7B); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 500; cursor: pointer;">
              Close
            </button>
          </div>
        </div>
      `;
    }

    function closeModal() {
      document.getElementById('transactionModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('transactionModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeModal();
      }
    });
  </script>
</body>
</html>