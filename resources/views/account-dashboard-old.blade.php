<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name }}'s Dashboard - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FF9898 0%, #FFB6C1 50%, #FF7B7B 100%);
            min-height: 100vh;
            color: #333;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-family: 'Lalezar', cursive;
            font-size: 2rem;
            color: #FF7B7B;
            text-decoration: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 600;
            color: #333;
        }

        .logout-btn {
            background: #FF7B7B;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #FF6B6B;
            transform: translateY(-1px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .account-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .account-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .account-icon {
            background: linear-gradient(135deg, #FF7B7B, #FF9898);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .account-info h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .account-number {
            color: #666;
            font-size: 0.9rem;
        }

        .balance-display {
            text-align: center;
            margin: 2rem 0;
        }

        .balance-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .balance-amount {
            font-size: 3rem;
            font-weight: 700;
            color: #FF7B7B;
            text-shadow: 0 2px 10px rgba(255, 123, 123, 0.3);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-form {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 15px;
            border: 2px solid #e9ecef;
        }

        .action-form h4 {
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #FF7B7B;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-deposit {
            background: #28a745;
            color: white;
        }

        .btn-deposit:hover {
            background: #218838;
            transform: translateY(-1px);
        }

        .btn-withdraw {
            background: #dc3545;
            color: white;
        }

        .btn-withdraw:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        .transactions-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .transactions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .transactions-header h3 {
            font-size: 1.25rem;
            color: #333;
        }

        .view-all-link {
            color: #FF7B7B;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .transaction-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .transaction-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .transaction-icon.deposit {
            background: #d4edda;
            color: #155724;
        }

        .transaction-icon.withdrawal {
            background: #f8d7da;
            color: #721c24;
        }

        .transaction-icon.transfer {
            background: #d1ecf1;
            color: #0c5460;
        }

        .transaction-icon.initial_deposit {
            background: #fff3cd;
            color: #856404;
        }

        .transaction-details h4 {
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .transaction-details .date {
            font-size: 0.8rem;
            color: #666;
        }

        .transaction-details .id {
            font-size: 0.75rem;
            color: #999;
            font-family: monospace;
        }

        .transaction-amount {
            font-weight: 600;
            font-size: 1rem;
        }

        .transaction-amount.positive {
            color: #28a745;
        }

        .transaction-amount.negative {
            color: #dc3545;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF7B7B;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #ddd;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .balance-amount {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <a href="#" class="logo">🐷 PIGGY</a>
            <div class="user-info">
                <span class="user-name">Welcome, {{ $user->first_name }}!</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="dashboard-grid">
            <!-- Account Overview and Actions -->
            <div class="account-card">
                <div class="account-header">
                    <div class="account-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="account-info">
                        <h2>{{ ucfirst($account->account_type) }} Account</h2>
                        <div class="account-number">{{ $account->account_number }}</div>
                    </div>
                </div>

                <div class="balance-display">
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount">{{ $account->formatted_balance }}</div>
                </div>

                <div class="quick-actions">
                    <!-- Deposit Form -->
                    <div class="action-form">
                        <h4><i class="fas fa-plus"></i> Deposit Money</h4>
                        <form action="{{ route('account.deposit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="deposit_amount">Amount (₱)</label>
                                <input type="number" 
                                       id="deposit_amount" 
                                       name="amount" 
                                       class="form-control" 
                                       step="0.01" 
                                       min="1" 
                                       max="1000000"
                                       placeholder="0.00" 
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="deposit_description">Description (optional)</label>
                                <input type="text" 
                                       id="deposit_description" 
                                       name="description" 
                                       class="form-control" 
                                       placeholder="e.g., Salary, Gift, etc.">
                            </div>
                            <button type="submit" class="btn btn-deposit">
                                <i class="fas fa-plus"></i> Deposit
                            </button>
                        </form>
                    </div>

                    <!-- Withdraw Form -->
                    <div class="action-form">
                        <h4><i class="fas fa-minus"></i> Withdraw Money</h4>
                        <form action="{{ route('account.withdraw') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="withdraw_amount">Amount (₱)</label>
                                <input type="number" 
                                       id="withdraw_amount" 
                                       name="amount" 
                                       class="form-control" 
                                       step="0.01" 
                                       min="1" 
                                       max="{{ $account->balance }}"
                                       placeholder="0.00" 
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="withdraw_description">Description (optional)</label>
                                <input type="text" 
                                       id="withdraw_description" 
                                       name="description" 
                                       class="form-control" 
                                       placeholder="e.g., ATM Withdrawal, Purchase, etc.">
                            </div>
                            <button type="submit" class="btn btn-withdraw" 
                                    {{ $account->balance <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-minus"></i> Withdraw
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="transactions-card">
                <div class="transactions-header">
                    <h3>Recent Transactions</h3>
                    <a href="{{ route('account.transactions') }}" class="view-all-link">
                        View All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                @if($recentTransactions->count() > 0)
                    @foreach($recentTransactions as $transaction)
                    <div class="transaction-item">
                        <div class="transaction-left">
                            <div class="transaction-icon {{ $transaction->type }}">
                                @if($transaction->type === 'deposit' || $transaction->type === 'initial_deposit')
                                    <i class="fas fa-arrow-down"></i>
                                @elseif($transaction->type === 'withdrawal')
                                    <i class="fas fa-arrow-up"></i>
                                @else
                                    <i class="fas fa-exchange-alt"></i>
                                @endif
                            </div>
                            <div class="transaction-details">
                                <h4>{{ $transaction->description }}</h4>
                                <div class="date">{{ $transaction->created_at->format('M j, Y g:i A') }}</div>
                                <div class="id">{{ $transaction->transaction_id }}</div>
                            </div>
                        </div>
                        <div class="transaction-amount {{ $transaction->isCredit() ? 'positive' : 'negative' }}">
                            {{ $transaction->direction }}{{ $transaction->formatted_amount }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <p>No transactions yet</p>
                        <small>Make your first deposit to get started!</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-value">{{ $transactionCount }}</div>
                <div class="stat-label">Total Transactions</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-value">₱{{ number_format($totalDeposits, 2) }}</div>
                <div class="stat-label">Total Deposits</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💸</div>
                <div class="stat-value">₱{{ number_format($totalWithdrawals, 2) }}</div>
                <div class="stat-label">Total Withdrawals</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📅</div>
                <div class="stat-value">{{ $account->created_at->format('M j, Y') }}</div>
                <div class="stat-label">Account Opened</div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus on amount inputs when forms are expanded
            const depositAmount = document.getElementById('deposit_amount');
            const withdrawAmount = document.getElementById('withdraw_amount');

            // Format number inputs
            [depositAmount, withdrawAmount].forEach(input => {
                input.addEventListener('input', function() {
                    let value = parseFloat(this.value);
                    if (!isNaN(value)) {
                        this.style.color = value > 0 ? '#28a745' : '#333';
                    }
                });
            });

            // Withdraw validation
            withdrawAmount.addEventListener('input', function() {
                const maxAmount = {{ $account->balance }};
                const currentAmount = parseFloat(this.value);
                const submitBtn = this.closest('form').querySelector('button[type="submit"]');
                
                if (currentAmount > maxAmount) {
                    this.style.borderColor = '#dc3545';
                    submitBtn.disabled = true;
                } else {
                    this.style.borderColor = '#ddd';
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
</body>
</html>