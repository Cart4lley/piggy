<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cash Out - PIGGY Bank</title>
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
            background: linear-gradient(135deg, #ff9999 0%, #ffb3b3 50%, #ffc9c9 100%);
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

        .back-btn {
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
        }

        .back-btn:hover {
            background: #FF7B7B;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 152, 152, 0.3);
        }

        /* Main Content */
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
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

        /* Form Card */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #FF9898;
            box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
        }

        .input-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        /* Quick Amount Buttons */
        .quick-amounts {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
        }

        .quick-btn {
            background: rgba(239, 68, 68, 0.1);
            border: 2px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            color: #ef4444;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quick-btn:hover {
            background: #ef4444;
            border-color: #ef4444;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
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
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        /* Withdrawal Summary */
        .withdrawal-summary {
            background: rgba(239, 68, 68, 0.05);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }

        .withdrawal-summary h4 {
            margin: 0 0 15px 0;
            color: #dc2626;
            font-size: 16px;
            font-weight: 600;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(239, 68, 68, 0.1);
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #dc2626;
            padding-top: 15px;
            margin-top: 5px;
            border-top: 2px solid rgba(239, 68, 68, 0.2);
        }

        .summary-item span:first-child {
            color: #6b7280;
            font-size: 14px;
        }

        .summary-item span:last-child {
            font-weight: 500;
            color: #374151;
            font-size: 15px;
        }

        /* Confirmation Modal */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        .confirmation-modal.show {
            display: block;
        }

        .confirmation-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .confirmation-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 20px;
            padding: 0;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        .confirmation-modal-header {
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .confirmation-modal-header i {
            font-size: 24px;
            color: #f59e0b;
        }

        .confirmation-modal-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .confirmation-modal-body {
            padding: 32px;
        }

        .confirmation-modal-body > p {
            margin: 0 0 16px 0;
            color: #6b7280;
            font-size: 15px;
        }

        .confirmation-details {
            background: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-row.highlight {
            margin-top: 10px;
            padding-top: 15px;
            border-top: 2px solid #ef4444;
            background: rgba(239, 68, 68, 0.05);
            margin-left: -10px;
            margin-right: -10px;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 8px;
        }

        .detail-label {
            font-size: 14px;
            color: #6b7280;
            font-weight: 500;
        }

        .detail-value {
            font-size: 15px;
            color: #1f2937;
            font-weight: 600;
        }

        .detail-row.highlight .detail-value {
            color: #ef4444;
            font-size: 18px;
        }

        .confirmation-question {
            margin-top: 20px;
            font-weight: 500;
            color: #374151;
        }

        .confirmation-modal-footer {
            padding: 20px 32px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-cancel, .btn-confirm {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-confirm:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translate(-50%, -40%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
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

            .form-card {
                padding: 24px 20px;
            }

            .page-title {
                font-size: 24px;
            }

            .quick-amounts {
                flex-direction: column;
            }

            .quick-btn {
                width: 100%;
            }
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
            
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-money-bill-wave"></i>
                Cash Out
            </h1>
            <p class="page-subtitle">Withdraw cash from your PIGGY account</p>
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

        <!-- Withdrawal Form -->
        <div class="form-card">
            <form id="withdrawalForm" method="POST" action="{{ route('cash-out.withdraw') }}">
                @csrf
                
                <div class="form-group">
                    <label for="amount" class="form-label">
                        <i class="fas fa-peso-sign"></i>
                        Amount
                    </label>
                    <input type="number" id="amount" name="amount" class="form-input" 
                           placeholder="0.00" min="100" max="{{ auth()->user()->balance ?? 50000 }}" step="0.01" 
                           value="{{ old('amount') }}"
                           required>
                    <small class="input-hint">Available balance: ₱{{ number_format(auth()->user()->balance ?? 50000, 2) }} • Minimum: ₱100.00</small>
                    @error('amount')
                        <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="quick-amounts">
                    <button type="button" class="quick-btn" data-amount="500">₱500</button>
                    <button type="button" class="quick-btn" data-amount="1000">₱1,000</button>
                    <button type="button" class="quick-btn" data-amount="2000">₱2,000</button>
                    <button type="button" class="quick-btn" data-amount="5000">₱5,000</button>
                    <button type="button" class="quick-btn" data-amount="10000">₱10,000</button>
                </div>
                
                <div class="form-group">
                    <label for="purpose" class="form-label">
                        <i class="fas fa-comment"></i>
                        Purpose (Optional)
                    </label>
                    <select id="purpose" name="purpose" class="form-select">
                        <option value="">Select purpose</option>
                        <option value="personal_expense">Personal Expense</option>
                        <option value="bills_payment">Bills Payment</option>
                        <option value="emergency">Emergency</option>
                        <option value="business">Business</option>
                        <option value="other">Other</option>
                    </select>
                    <small class="input-hint">Help us understand your withdrawal purpose</small>
                </div>

                <div class="withdrawal-summary" id="withdrawalSummary" style="display: none;">
                    <h4><i class="fas fa-receipt"></i> Withdrawal Summary</h4>
                    <div class="summary-item">
                        <span>Withdrawal Amount:</span>
                        <span id="summaryAmount">₱0.00</span>
                    </div>
                    <div class="summary-item">
                        <span>Your balance after:</span>
                        <span id="summaryBalance">₱{{ number_format(auth()->user()->balance ?? 50000, 2) }}</span>
                    </div>
                </div>
                
                <button type="submit" class="form-submit">
                    <i class="fas fa-money-bill-wave"></i>
                    Withdraw Cash Now
                </button>
            </form>
        </div>
    </main>

    <!-- Custom Confirmation Modal -->
    <div id="confirmationModal" class="confirmation-modal">
        <div class="confirmation-modal-overlay"></div>
        <div class="confirmation-modal-content">
            <div class="confirmation-modal-header">
                <i class="fas fa-exclamation-circle"></i>
                <h3>Confirm Withdrawal</h3>
            </div>
            <div class="confirmation-modal-body">
                <p>You are about to withdraw cash from your account:</p>
                <div class="confirmation-details">
                    <div class="detail-row">
                        <span class="detail-label">Account:</span>
                        <span class="detail-value">{{ auth()->user()->account->account_number ?? 'PIGGY000000' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Purpose:</span>
                        <span class="detail-value" id="confirmPurpose">-</span>
                    </div>
                    <div class="detail-row highlight">
                        <span class="detail-label">Amount:</span>
                        <span class="detail-value" id="confirmAmount">₱0.00</span>
                    </div>
                </div>
                <p class="confirmation-question">Do you want to proceed with this withdrawal?</p>
            </div>
            <div class="confirmation-modal-footer">
                <button type="button" class="btn-cancel" onclick="closeConfirmationModal()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="button" class="btn-confirm" onclick="confirmWithdrawal()">
                    <i class="fas fa-check"></i>
                    Confirm Withdrawal
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('withdrawalForm');
            const amountInput = document.getElementById('amount');
            const purposeSelect = document.getElementById('purpose');
            const summaryDiv = document.getElementById('withdrawalSummary');
            const quickBtns = document.querySelectorAll('.quick-btn');
            
            // Quick amount buttons
            quickBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const amount = this.getAttribute('data-amount');
                    amountInput.value = amount;
                    updateWithdrawalSummary();
                });
            });
            
            // Amount input
            amountInput.addEventListener('input', updateWithdrawalSummary);
            
            function updateWithdrawalSummary() {
                const amount = parseFloat(amountInput.value) || 0;
                const currentBalance = {{ auth()->user()->balance ?? 50000 }};
                
                if (amount > 0) {
                    summaryDiv.style.display = 'block';
                    
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
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const amount = parseFloat(amountInput.value);
                const purpose = purposeSelect.value;
                
                // Basic validation
                if (!amount || amount < 100) {
                    alert('Please enter a valid withdrawal amount (minimum ₱100)');
                    return;
                }
                
                const currentBalance = {{ auth()->user()->balance ?? 50000 }};
                
                if (amount > currentBalance) {
                    alert('Insufficient balance for this withdrawal');
                    return;
                }
                
                // Show custom confirmation modal
                showConfirmationModal(amount, purpose);
            });
            
            // Initialize
            updateWithdrawalSummary();
        });

        // Confirmation Modal Functions
        let pendingWithdrawal = null;

        function showConfirmationModal(amount, purpose) {
            // Store withdrawal data
            pendingWithdrawal = { amount, purpose };
            
            // Get purpose display name
            const purposeNames = {
                'personal_expense': 'Personal Expense',
                'bills_payment': 'Bills Payment',
                'emergency': 'Emergency',
                'business': 'Business',
                'other': 'Other',
                '': 'Not specified'
            };
            
            // Update modal content
            document.getElementById('confirmPurpose').textContent = purposeNames[purpose] || 'Not specified';
            document.getElementById('confirmAmount').textContent = '₱' + amount.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            
            // Show modal
            document.getElementById('confirmationModal').classList.add('show');
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').classList.remove('show');
            pendingWithdrawal = null;
        }

        function confirmWithdrawal() {
            if (!pendingWithdrawal) return;
            
            const form = document.getElementById('withdrawalForm');
            
            // Close modal
            closeConfirmationModal();
            
            // Submit the form
            form.submit();
        }

        // Close modal when clicking overlay
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('confirmation-modal-overlay')) {
                closeConfirmationModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeConfirmationModal();
            }
        });
    </script>
</body>
</html>