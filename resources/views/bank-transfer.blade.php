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
            color: #4a5568;
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
            color: #4a5568;
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
            color: #4a5568;
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
            color: #4a5568;
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
            color: #9ca3af;
            font-style: italic;
        }

        /* Form Layout */
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
            color: #4a5568;
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
            color: #4a5568;
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
            <!-- Card Payment Method -->
            <div id="cardMethod" class="method-content active">
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
                               oninput="updateDepositSummary()"
                               required>
                        <small class="input-hint">Minimum: ₱1.00 | Maximum: ₱50,000.00</small>
                        @error('amount')
                            <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div class="quick-amounts">
                        <button type="button" class="quick-btn" onclick="setAmount(500)">₱500</button>
                        <button type="button" class="quick-btn" onclick="setAmount(1000)">₱1,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount(2000)">₱2,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount(5000)">₱5,000</button>
                        <button type="button" class="quick-btn" onclick="setAmount(10000)">₱10,000</button>
                    </div>

                    <!-- Deposit Summary -->
                    <div class="deposit-summary" id="cardSummary" style="display: none;">
                        <h3 style="font-size: 0.9rem; font-weight: 600; color: #9ca3af; margin-bottom: 12px;">Deposit Summary</h3>
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

        // Set quick amount
        function setAmount(amount) {
            const input = document.getElementById('card_amount');
            input.value = amount;
            updateDepositSummary();
        }

        // Update deposit summary
        function updateDepositSummary() {
            const input = document.getElementById('card_amount');
            const summary = document.getElementById('cardSummary');
            const depositAmountSpan = document.getElementById('cardDepositAmount');
            const newBalanceSpan = document.getElementById('cardNewBalance');

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
