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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #FFB6C1 0%, #FF9898 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header/Navigation */
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

        .user-details h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .user-details p {
            font-size: 14px;
            color: #718096;
        }

        .logout-btn {
            background: #FF9898;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #FF7B7B;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 152, 152, 0.3);
        }

        /* Main Content */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Welcome Section */
        .welcome-section {
            margin-bottom: 32px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 32px;
        }

        /* Account Card */
        .account-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .account-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
        }

        .account-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .account-info h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .account-number {
            font-size: 14px;
            color: #718096;
            font-family: 'Courier New', monospace;
        }

        .account-status {
            background: #f0fdf4;
            color: #16a34a;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .balance-section {
            margin-bottom: 24px;
        }

        .balance-label {
            font-size: 14px;
            color: #718096;
            margin-bottom: 8px;
        }

        .balance-amount {
            font-size: 36px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .balance-currency {
            font-size: 14px;
            color: #718096;
        }

        .account-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .action-btn {
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-send-money {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-send-money:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .btn-history {
            background: linear-gradient(135deg, #FF9898, #FF7B7B);
            color: white;
        }

        .btn-history:hover {
            background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        /* Stats Card */
        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 24px;
        }

        .stats-grid {
            display: grid;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-label {
            font-size: 14px;
            color: #718096;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .stat-positive {
            color: #16a34a;
        }

        .stat-negative {
            color: #dc2626;
        }

        /* Transactions Section */
        .transactions-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .transactions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .transactions-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .view-all-btn {
            background: #FF9898;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            background: #FF7B7B;
        }

        .transactions-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .transaction-item:last-child {
            border-bottom: none;
        }

        .transaction-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .icon-deposit {
            background: #16a34a;
        }

        .icon-withdraw {
            background: #dc2626;
        }

        .transaction-details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .transaction-details p {
            font-size: 12px;
            color: #718096;
        }

        .transaction-amount {
            text-align: right;
        }

        .amount {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .amount-positive {
            color: #16a34a;
        }

        .amount-negative {
            color: #dc2626;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* Modals */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 32px;
            width: 100%;
            max-width: 500px;
            margin: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #718096;
            cursor: pointer;
            padding: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #FF9898;
            box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
        }

        .form-submit {
            width: 100%;
            padding: 14px;
            background: #FF9898;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .form-submit:hover {
            background: #FF7B7B;
            transform: translateY(-2px);
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-hint {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        .transfer-summary {
            background: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .transfer-summary h4 {
            margin: 0 0 15px 0;
            color: #1e40af;
            font-size: 16px;
            font-weight: 600;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #1e40af;
        }

        .summary-item span:first-child {
            color: #6b7280;
            font-size: 14px;
        }

        .summary-item span:last-child {
            font-weight: 500;
            color: #374151;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .main-container {
                padding: 20px 16px;
            }

            .account-card, .stats-card, .transactions-section {
                padding: 24px 20px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .balance-amount {
                font-size: 28px;
            }

            .user-info {
                display: none;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">🐷</div>
                <div class="brand-name">PIGGY</div>
            </div>
            
            <div class="user-section">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1 class="welcome-title">Welcome back, {{ $user->first_name }}! 👋</h1>
            <p class="welcome-subtitle">Here's what's happening with your PIGGY Bank account today.</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Account Card -->
            <div class="account-card">
                <div class="account-header">
                    <div class="account-info">
                        <h3>{{ ucfirst($account->account_type) }} Account</h3>
                        <p class="account-number">{{ $account->account_number }}</p>
                    </div>
                    <div class="account-status">{{ ucfirst($account->status) }}</div>
                </div>

                <div class="balance-section">
                    <p class="balance-label">Available Balance</p>
                    <h2 class="balance-amount">₱{{ number_format($account->balance, 2) }}</h2>
                    <p class="balance-currency">Philippine Peso</p>
                </div>

                <div class="account-actions">
                    <button class="action-btn btn-send-money" onclick="openModal('sendMoneyModal')">
                        <i class="fas fa-paper-plane"></i>
                        Send Money
                    </button>
                    <a href="{{ route('transactions.index') }}" class="action-btn btn-history">
                        <i class="fas fa-history"></i>
                        View History
                    </a>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="stats-card">
                <div class="stats-header">
                    <h3>Account Summary</h3>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Total Transactions</span>
                        <span class="stat-value">{{ $transactionCount }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total Deposits</span>
                        <span class="stat-value stat-positive">₱{{ number_format($totalDeposits, 2) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total Withdrawals</span>
                        <span class="stat-value stat-negative">₱{{ number_format($totalWithdrawals, 2) }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Account Type</span>
                        <span class="stat-value">{{ ucfirst($account->account_type) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="transactions-section">
            <div class="transactions-header">
                <h3>Recent Transactions</h3>
                <a href="{{ route('transactions.index') }}" class="view-all-btn">View All Transactions</a>
            </div>

            <div class="transactions-list">
                @forelse($recentTransactions as $transaction)
                    <div class="transaction-item">
                        <div class="transaction-info">
                            <div class="transaction-icon {{ $transaction->type === 'deposit' ? 'icon-deposit' : 'icon-withdraw' }}">
                                <i class="fas {{ $transaction->type === 'deposit' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                            </div>
                            <div class="transaction-details">
                                <h4>{{ $transaction->description }}</h4>
                                <p>{{ $transaction->created_at->format('M d, Y - h:i A') }}</p>
                            </div>
                        </div>
                        <div class="transaction-amount">
                            <div class="amount {{ $transaction->type === 'deposit' ? 'amount-positive' : 'amount-negative' }}">
                                {{ $transaction->type === 'deposit' ? '+' : '-' }}₱{{ number_format($transaction->amount, 2) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-receipt"></i>
                        <h4>No Recent Transactions</h4>
                        <p>Your transaction history will appear here once you start making deposits or withdrawals.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Send Money Modal -->
    <div id="sendMoneyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-paper-plane"></i>
                    Send Money
                </h3>
                <button class="close-btn" onclick="closeModal('sendMoneyModal')">&times;</button>
            </div>
            
            <form method="POST" action="{{ route('account.send-money') }}">
                @csrf
                <div class="form-group">
                    <label for="recipient_account" class="form-label">
                        <i class="fas fa-user"></i>
                        Recipient Account Number
                    </label>
                    <input type="text" id="recipient_account" name="recipient_account" class="form-input" 
                           placeholder="Enter account number (e.g., PIGGY123456)" 
                           pattern="PIGGY[0-9]{6}" 
                           title="Account number must be in format PIGGY123456"
                           required>
                    <small class="input-hint">Enter the recipient's PIGGY account number</small>
                </div>
                
                <div class="form-group">
                    <label for="send_amount" class="form-label">
                        <i class="fas fa-peso-sign"></i>
                        Amount
                    </label>
                    <input type="number" id="send_amount" name="amount" class="form-input" 
                           placeholder="0.00" min="1" max="{{ $account->balance }}" step="0.01" required>
                    <small class="input-hint">Available balance: ₱{{ number_format($account->balance, 2) }}</small>
                </div>
                
                <div class="form-group">
                    <label for="send_description" class="form-label">
                        <i class="fas fa-comment"></i>
                        Message (Optional)
                    </label>
                    <input type="text" id="send_description" name="description" class="form-input" 
                           placeholder="What's this transfer for?" maxlength="100">
                    <small class="input-hint">Add a message for the recipient</small>
                </div>

                <div class="transfer-summary" id="transferSummary" style="display: none;">
                    <h4>Transfer Summary</h4>
                    <div class="summary-item">
                        <span>From:</span>
                        <span>{{ $account->account_number }} (You)</span>
                    </div>
                    <div class="summary-item">
                        <span>To:</span>
                        <span id="summaryRecipient">-</span>
                    </div>
                    <div class="summary-item">
                        <span>Amount:</span>
                        <span id="summaryAmount">₱0.00</span>
                    </div>
                    <div class="summary-item">
                        <span>Your balance after:</span>
                        <span id="summaryBalance">₱{{ number_format($account->balance, 2) }}</span>
                    </div>
                </div>
                
                <button type="submit" class="form-submit">
                    <i class="fas fa-paper-plane"></i>
                    Send Money
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('show');
            
            // If opening send money modal, setup the form listeners
            if (modalId === 'sendMoneyModal') {
                setupSendMoneyForm();
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
            
            // Reset form if closing send money modal
            if (modalId === 'sendMoneyModal') {
                resetSendMoneyForm();
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.modal.show');
                modals.forEach(modal => modal.classList.remove('show'));
            }
        });

        // Send Money Form Functions
        function setupSendMoneyForm() {
            const recipientInput = document.getElementById('recipient_account');
            const amountInput = document.getElementById('send_amount');
            const summaryDiv = document.getElementById('transferSummary');
            
            // Add event listeners for real-time updates
            recipientInput.addEventListener('input', updateTransferSummary);
            amountInput.addEventListener('input', updateTransferSummary);
            
            // Format account number input
            recipientInput.addEventListener('input', function(e) {
                let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                if (value.length > 6 && !value.startsWith('PIGGY')) {
                    value = 'PIGGY' + value.substring(5, 11);
                }
                e.target.value = value;
            });
        }

        function updateTransferSummary() {
            const recipientAccount = document.getElementById('recipient_account').value;
            const amount = parseFloat(document.getElementById('send_amount').value) || 0;
            const currentBalance = {{ $account->balance }};
            const summaryDiv = document.getElementById('transferSummary');
            
            // Show/hide summary based on whether we have both values
            if (recipientAccount && amount > 0) {
                summaryDiv.style.display = 'block';
                
                // Update summary values
                document.getElementById('summaryRecipient').textContent = recipientAccount;
                document.getElementById('summaryAmount').textContent = '₱' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                
                const balanceAfter = currentBalance - amount;
                document.getElementById('summaryBalance').textContent = '₱' + balanceAfter.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                
                // Add warning if insufficient funds
                const balanceSpan = document.getElementById('summaryBalance');
                if (balanceAfter < 0) {
                    balanceSpan.style.color = '#dc2626';
                    balanceSpan.textContent += ' (Insufficient Funds)';
                } else {
                    balanceSpan.style.color = '#374151';
                }
            } else {
                summaryDiv.style.display = 'none';
            }
        }

        function resetSendMoneyForm() {
            document.getElementById('recipient_account').value = '';
            document.getElementById('send_amount').value = '';
            document.getElementById('send_description').value = '';
            document.getElementById('transferSummary').style.display = 'none';
        }
    </script>
</body>
</html>