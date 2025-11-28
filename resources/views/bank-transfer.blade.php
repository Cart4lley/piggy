<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cash In - PIGGY Bank</title>
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

        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
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
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .input-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        /* Payment Method Tabs */
        .payment-methods {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            border-bottom: 2px solid #e5e7eb;
        }

        .method-tab {
            padding: 12px 20px;
            background: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            color: #6b7280;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: -2px;
        }

        .method-tab:hover {
            color: #10b981;
        }

        .method-tab.active {
            color: #10b981;
            border-bottom-color: #10b981;
            font-weight: 600;
        }

        .method-content {
            display: none;
        }

        .method-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            color: white;
            border: none;
            padding: 18px 32px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 16px rgba(255, 152, 152, 0.3);
            margin-top: 32px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 152, 152, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fdf4;
            border: 2px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border: 2px solid #fecaca;
            color: #dc2626;
        }

        .alert i {
            font-size: 20px;
        }

        .error-text {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            color: #2d3748;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
        }

        .form-select:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Balance Display */
        .balance-display {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(5, 150, 105, 0.08));
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 32px;
            text-align: center;
        }

        .balance-value {
            font-size: 32px;
            font-weight: 700;
            color: #065f46;
        }

        /* Quick Amount Buttons */
        .quick-amounts {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0 32px;
        }

        .quick-btn {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: 600;
            color: #047857;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quick-btn:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: #10b981;
            transform: translateY(-2px);
        }

        /* Deposit Summary */
        .deposit-summary {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #374151;
            font-size: 14px;
        }

        .summary-item.total {
            border-top: 2px solid rgba(16, 185, 129, 0.2);
            margin-top: 12px;
            padding-top: 16px;
            font-weight: 600;
            font-size: 16px;
            color: #047857;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .logo-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .brand-name {
                font-size: 20px;
            }

            .back-btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .main-container {
                padding: 24px 16px;
            }

            .page-title {
                font-size: 24px;
            }

            .form-card {
                padding: 24px 20px;
            }

            .quick-amounts {
                gap: 8px;
            }

            .quick-btn {
                padding: 10px 16px;
                font-size: 14px;
            }
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
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-coins"></i>
                Cash In
            </h1>
            <p class="page-subtitle">Add money to your PIGGY account</p>
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

        <!-- Deposit Form -->
        <div class="form-card">
            <!-- Payment Method Tabs -->
            <div class="payment-methods">
                <button type="button" class="method-tab active" onclick="switchMethod('bank')">
                    <i class="fas fa-university"></i>
                    Bank Transfer
                </button>
                <button type="button" class="method-tab" onclick="switchMethod('card')">
                    <i class="fas fa-credit-card"></i>
                    Debit/Credit Card
                </button>
            </div>

            <!-- Bank Transfer Method -->
            <div id="bankMethod" class="method-content active">
                <form id="bankTransferForm" method="POST" action="{{ route('bank-transfer.deposit') }}">
                    @csrf
                    <input type="hidden" name="payment_method" value="bank">
                    
                    <div class="form-group">
                        <label for="sender_name" class="form-label">
                            <i class="fas fa-user"></i>
                            Sender Name
                        </label>
                        <input type="text" id="sender_name" name="sender_name" class="form-input" 
                               placeholder="Enter sender's full name" 
                               value="{{ old('sender_name') }}"
                               required>
                        <small class="input-hint">Name as it appears on your bank account</small>
                        @error('sender_name')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sender_account_number" class="form-label">
                            <i class="fas fa-credit-card"></i>
                            Account Number
                        </label>
                        <input type="text" id="sender_account_number" name="sender_account_number" class="form-input" 
                               placeholder="Enter account number" 
                               value="{{ old('sender_account_number') }}"
                               required>
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sender_bank" class="form-label">
                            <i class="fas fa-building"></i>
                            Sender Bank
                        </label>
                        <select id="sender_bank" name="sender_bank" class="form-input" required>
                            <option value="">Select your bank</option>
                            <option value="BDO" {{ old('sender_bank') == 'BDO' ? 'selected' : '' }}>BDO Unibank</option>
                            <option value="BPI" {{ old('sender_bank') == 'BPI' ? 'selected' : '' }}>Bank of the Philippine Islands</option>
                            <option value="Metrobank" {{ old('sender_bank') == 'Metrobank' ? 'selected' : '' }}>Metrobank</option>
                            <option value="UnionBank" {{ old('sender_bank') == 'UnionBank' ? 'selected' : '' }}>UnionBank</option>
                            <option value="Landbank" {{ old('sender_bank') == 'Landbank' ? 'selected' : '' }}>Land Bank of the Philippines</option>
                            <option value="PNB" {{ old('sender_bank') == 'PNB' ? 'selected' : '' }}>Philippine National Bank</option>
                            <option value="Security Bank" {{ old('sender_bank') == 'Security Bank' ? 'selected' : '' }}>Security Bank</option>
                            <option value="RCBC" {{ old('sender_bank') == 'RCBC' ? 'selected' : '' }}>RCBC</option>
                            <option value="Chinabank" {{ old('sender_bank') == 'Chinabank' ? 'selected' : '' }}>China Banking Corporation</option>
                            <option value="EastWest" {{ old('sender_bank') == 'EastWest' ? 'selected' : '' }}>EastWest Bank</option>
                        </select>
                        @error('sender_bank')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="bank_amount" class="form-label">
                            <i class="fas fa-money-bill-wave"></i>
                            Amount
                        </label>
                        <input type="number" id="bank_amount" name="amount" class="form-input" 
                               placeholder="0.00" step="0.01" min="1" max="50000"
                               value="{{ old('amount') }}"
                               oninput="updateDepositSummary('bank')"
                               required>
                        <small class="input-hint">Minimum: ₱1.00 | Maximum: ₱50,000.00</small>
                        @error('amount')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div class="quick-amounts">
                        <button type="button" class="quick-btn" onclick="setAmount('bank', 500)">₱500</button>
                        <button type="button" class="quick-btn" onclick="setAmount('bank', 1000)">₱1,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('bank', 2000)">₱2,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('bank', 5000)">₱5,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('bank', 10000)">₱10,000</button>
                    </div>

                    <div class="form-group">
                        <label for="reference_note" class="form-label">
                            <i class="fas fa-sticky-note"></i>
                            Reference Note (Optional)
                        </label>
                        <textarea id="reference_note" name="reference_note" class="form-input" 
                                  placeholder="Add a note for your reference" rows="3">{{ old('reference_note') }}</textarea>
                    </div>

                    <!-- Deposit Summary -->
                    <div class="deposit-summary" id="bankSummary" style="display: none;">
                        <h3 style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 12px;">Deposit Summary</h3>
                        <div class="summary-item">
                            <span>Current Balance:</span>
                            <span>₱{{ number_format($account->balance, 2) }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Deposit Amount:</span>
                            <span id="bankDepositAmount">₱0.00</span>
                        </div>
                        <div class="summary-item" style="border-top: 2px solid #e5e7eb; padding-top: 12px; font-weight: 600; color: #10b981;">
                            <span>New Balance:</span>
                            <span id="bankNewBalance">₱{{ number_format($account->balance, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-arrow-down"></i>
                        Deposit to PIGGY
                    </button>
                </form>
            </div>

            <!-- Card Payment Method -->
            <div id="cardMethod" class="method-content">
                <form id="cardPaymentForm" method="POST" action="{{ route('bank-transfer.card-deposit') }}">
                    @csrf
                    <input type="hidden" name="payment_method" value="card">
                    
                    <div class="form-group">
                        <label for="cardholder_name" class="form-label">
                            <i class="fas fa-user"></i>
                            Cardholder Name
                        </label>
                        <input type="text" id="cardholder_name" name="cardholder_name" class="form-input" 
                               placeholder="Name as it appears on card" 
                               value="{{ old('cardholder_name') }}"
                               required>
                        @error('cardholder_name')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="card_number" class="form-label">
                            <i class="fas fa-credit-card"></i>
                            Card Number
                        </label>
                        <input type="text" id="card_number" name="card_number" class="form-input" 
                               placeholder="1234 5678 9012 3456" 
                               maxlength="19"
                               value="{{ old('card_number') }}"
                               required>
                        <small class="input-hint">Enter 13-19 digit card number</small>
                        @error('card_number')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="card_expiry" class="form-label">
                                <i class="fas fa-calendar"></i>
                                Expiry Date
                            </label>
                            <input type="text" id="card_expiry" name="card_expiry" class="form-input" 
                                   placeholder="MM/YY" 
                                   maxlength="5"
                                   value="{{ old('card_expiry') }}"
                                   required>
                            @error('card_expiry')
                                <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="card_cvv" class="form-label">
                                <i class="fas fa-lock"></i>
                                CVV
                            </label>
                            <input type="text" id="card_cvv" name="card_cvv" class="form-input" 
                                   placeholder="123" 
                                   maxlength="4"
                                   value="{{ old('card_cvv') }}"
                                   required>
                            @error('card_cvv')
                                <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="card_amount" class="form-label">
                            <i class="fas fa-money-bill-wave"></i>
                            Amount
                        </label>
                        <input type="number" id="card_amount" name="amount" class="form-input" 
                               placeholder="0.00" step="0.01" min="1" max="50000"
                               value="{{ old('amount') }}"
                               oninput="updateDepositSummary('card')"
                               required>
                        <small class="input-hint">Minimum: ₱1.00 | Maximum: ₱50,000.00</small>
                        @error('amount')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div class="quick-amounts">
                        <button type="button" class="quick-btn" onclick="setAmount('card', 500)">₱500</button>
                        <button type="button" class="quick-btn" onclick="setAmount('card', 1000)">₱1,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('card', 2000)">₱2,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('card', 5000)">₱5,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount('card', 10000)">₱10,000</button>
                    </div>

                    <!-- Deposit Summary -->
                    <div class="deposit-summary" id="cardSummary" style="display: none;">
                        <h3 style="font-size: 0.9rem; font-weight: 600; color: #6b7280; margin-bottom: 12px;">Deposit Summary</h3>
                        <div class="summary-item">
                            <span>Current Balance:</span>
                            <span>₱{{ number_format($account->balance, 2) }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Deposit Amount:</span>
                            <span id="cardDepositAmount">₱0.00</span>
                        </div>
                        <div class="summary-item" style="border-top: 2px solid #e5e7eb; padding-top: 12px; font-weight: 600; color: #10b981;">
                            <span>New Balance:</span>
                            <span id="cardNewBalance">₱{{ number_format($account->balance, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-lock"></i>
                        Pay Securely
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        const currentBalance = {{ $account->balance }};

        // Switch between payment methods
        function switchMethod(method) {
            // Update tabs
            document.querySelectorAll('.method-tab').forEach(tab => tab.classList.remove('active'));
            event.target.closest('.method-tab').classList.add('active');

            // Update content
            document.querySelectorAll('.method-content').forEach(content => content.classList.remove('active'));
            if (method === 'bank') {
                document.getElementById('bankMethod').classList.add('active');
            } else {
                document.getElementById('cardMethod').classList.add('active');
            }
        }

        // Set quick amount
        function setAmount(method, amount) {
            const input = method === 'bank' ? 
                document.getElementById('bank_amount') : 
                document.getElementById('card_amount');
            input.value = amount;
            updateDepositSummary(method);
        }

        // Update deposit summary
        function updateDepositSummary(method) {
            const input = method === 'bank' ? 
                document.getElementById('bank_amount') : 
                document.getElementById('card_amount');
            const summary = method === 'bank' ? 
                document.getElementById('bankSummary') : 
                document.getElementById('cardSummary');
            const depositAmountSpan = method === 'bank' ? 
                document.getElementById('bankDepositAmount') : 
                document.getElementById('cardDepositAmount');
            const newBalanceSpan = method === 'bank' ? 
                document.getElementById('bankNewBalance') : 
                document.getElementById('cardNewBalance');

            const amount = parseFloat(input.value) || 0;

            if (amount > 0) {
                summary.style.display = 'block';
                depositAmountSpan.textContent = '₱' + amount.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                const newBalance = currentBalance + amount;
                newBalanceSpan.textContent = '₱' + newBalance.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            } else {
                summary.style.display = 'none';
            }
        }

        // Format card number input
        document.getElementById('card_number')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });

        // Format card expiry input
        document.getElementById('card_expiry')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // Format CVV input (numbers only)
        document.getElementById('card_cvv')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
