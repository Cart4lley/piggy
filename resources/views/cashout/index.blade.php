<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Out - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            max-width: 800px;
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
            color: #ff9999;
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
            color: #ff7a7a;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            color: #FF6B6B;
            transform: translateX(-3px);
        }

        .cashout-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ff9999;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .required {
            color: #EF4444;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: #FAFBFC;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #ff9999;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(255, 153, 153, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .amount-input {
            position: relative;
        }

        .currency-symbol {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-weight: 600;
            pointer-events: none;
        }

        .amount-input input {
            padding-left: 40px;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .info-box {
            background: #FEF3C7;
            border: 1px solid #F59E0B;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .info-box h3 {
            color: #92400E;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-box p {
            color: #B45309;
            font-size: 14px;
            line-height: 1.6;
        }

        .account-info {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .account-info h3 {
            color: #166534;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .account-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .account-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .account-label {
            color: #15803D;
            font-weight: 500;
        }

        .account-value {
            color: #166534;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #D1FAE5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        .error-list {
            margin: 0;
            padding-left: 20px;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header,
            .cashout-form {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
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
                <i class="fas fa-money-bill-wave"></i>
                Cash Out from PIGGY
            </h1>
            <p>Withdraw money from your PIGGY Bank account to any Philippine bank. Transfers are processed instantly and securely.</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Account Information -->
        <div class="account-info">
            <h3><i class="fas fa-piggy-bank"></i> Your PIGGY Account Details</h3>
            <div class="account-details">
                <div class="account-item">
                    <span class="account-label">Account Number:</span>
                    <span class="account-value">{{ $account->account_number }}</span>
                </div>
                <div class="account-item">
                    <span class="account-label">Available Balance:</span>
                    <span class="account-value">₱{{ number_format($account->balance, 2) }}</span>
                </div>
                <div class="account-item">
                    <span class="account-label">Account Holder:</span>
                    <span class="account-value">{{ $account->user->first_name }} {{ $account->user->last_name }}</span>
                </div>
            </div>
        </div>

        <!-- Cash Out Form -->
        <div class="cashout-form">
            <form method="POST" action="{{ route('cash-out.withdraw') }}">
                @csrf

                <!-- Recipient Information -->
                <div class="form-section">
                    <div class="section-title">Recipient Information</div>
                    
                    <div class="form-group">
                        <label for="recipient_name">Full Name <span class="required">*</span></label>
                        <input type="text" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}" 
                               placeholder="Juan Dela Cruz" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="recipient_account_number">Account Number <span class="required">*</span></label>
                            <input type="text" id="recipient_account_number" name="recipient_account_number" 
                                   value="{{ old('recipient_account_number') }}" placeholder="1234567890123456" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient_bank">Recipient Bank <span class="required">*</span></label>
                            <select id="recipient_bank" name="recipient_bank" required>
                                <option value="">Select Bank</option>
                                <option value="BDO Unibank" {{ old('recipient_bank') == 'BDO Unibank' ? 'selected' : '' }}>BDO Unibank</option>
                                <option value="BPI" {{ old('recipient_bank') == 'BPI' ? 'selected' : '' }}>Bank of the Philippine Islands (BPI)</option>
                                <option value="Metrobank" {{ old('recipient_bank') == 'Metrobank' ? 'selected' : '' }}>Metrobank</option>
                                <option value="Landbank" {{ old('recipient_bank') == 'Landbank' ? 'selected' : '' }}>Landbank of the Philippines</option>
                                <option value="PNB" {{ old('recipient_bank') == 'PNB' ? 'selected' : '' }}>Philippine National Bank (PNB)</option>
                                <option value="UnionBank" {{ old('recipient_bank') == 'UnionBank' ? 'selected' : '' }}>UnionBank</option>
                                <option value="Security Bank" {{ old('recipient_bank') == 'Security Bank' ? 'selected' : '' }}>Security Bank</option>
                                <option value="RCBC" {{ old('recipient_bank') == 'RCBC' ? 'selected' : '' }}>Rizal Commercial Banking Corp. (RCBC)</option>
                                <option value="Chinabank" {{ old('recipient_bank') == 'Chinabank' ? 'selected' : '' }}>China Banking Corporation</option>
                                <option value="EastWest Bank" {{ old('recipient_bank') == 'EastWest Bank' ? 'selected' : '' }}>EastWest Bank</option>
                                <option value="PSBank" {{ old('recipient_bank') == 'PSBank' ? 'selected' : '' }}>Philippine Savings Bank</option>
                                <option value="Other" {{ old('recipient_bank') == 'Other' ? 'selected' : '' }}>Other Bank</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Cash Out Details -->
                <div class="form-section">
                    <div class="section-title">Cash Out Details</div>
                    
                    <div class="form-group">
                        <label for="amount">Withdrawal Amount <span class="required">*</span></label>
                        <div class="amount-input">
                            <span class="currency-symbol">₱</span>
                            <input type="number" id="amount" name="amount" value="{{ old('amount') }}" 
                                   min="1" max="{{ $account->balance }}" step="0.01" placeholder="1,000.00" required>
                        </div>
                        <small style="color: #6B7280; margin-top: 5px; display: block;">
                            Maximum withdrawal: ₱{{ number_format($account->balance, 2) }}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="reference_note">Reference Note (Optional)</label>
                        <textarea id="reference_note" name="reference_note" 
                                  placeholder="Purpose of withdrawal (e.g., Emergency funds, Bill payment, etc.)">{{ old('reference_note') }}</textarea>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="info-box">
                    <h3><i class="fas fa-exclamation-circle"></i> Important Information</h3>
                    <p><strong>Processing Time:</strong> Withdrawals are processed instantly for demo purposes.<br>
                    <strong>Withdrawal Limits:</strong> Minimum ₱1.00, Maximum ₱{{ number_format($account->balance, 2) }}<br>
                    <strong>Security:</strong> All withdrawals are secured and tracked with unique reference numbers.</p>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-money-bill-wave"></i>
                    Process Cash Out
                </button>
            </form>
        </div>
    </div>

    <script>
        // Format amount input with commas
        document.getElementById('amount').addEventListener('input', function(e) {
            let value = e.target.value.replace(/,/g, '');
            if (!isNaN(value) && value !== '') {
                e.target.value = parseFloat(value).toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 2});
            }
        });

        // Format account number input
        document.getElementById('recipient_account_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Auto-select bank option
        document.getElementById('recipient_bank').addEventListener('change', function(e) {
            if (e.target.value === 'Other') {
                let customBank = prompt('Please enter the name of the bank:');
                if (customBank) {
                    let option = new Option(customBank, customBank, true, true);
                    e.target.add(option);
                }
            }
        });
    </script>
</body>
</html>
