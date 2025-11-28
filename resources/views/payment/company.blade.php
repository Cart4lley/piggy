<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $company['name'] }} Payment - PIGGY</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
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

        .breadcrumb {
            margin-bottom: 32px;
        }

        .breadcrumb-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
        }

        .breadcrumb-link:hover {
            color: #FF7B7B;
        }

        .breadcrumb-separator {
            margin: 0 8px;
            color: #d1d5db;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            color: #6b7280;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 32px;
        }

        .back-button:hover {
            background: white;
            color: #374151;
            transform: translateX(-4px);
        }

        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .company-header {
            background: var(--category-color);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .company-logo-large {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .company-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .company-subtitle {
            opacity: 0.9;
            font-size: 16px;
        }

        .payment-form {
            padding: 40px;
        }

        .balance-info {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 32px;
            text-align: center;
        }

        .balance-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .balance-amount {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.2s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--category-color);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }

        .amount-input {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
        }

        .payment-summary {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .summary-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .summary-row.total {
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
            margin-top: 12px;
            font-weight: 600;
            font-size: 16px;
        }

        .pay-button {
            width: 100%;
            background: var(--category-color);
            color: white;
            border: none;
            padding: 20px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
        }

        .pay-button:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        .security-note {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 16px;
        }

        /* Loading and Success States */
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading i {
            font-size: 32px;
            margin-bottom: 12px;
            animation: spin 1s linear infinite;
            color: var(--category-color);
        }

        .success-message {
            display: none;
            text-align: center;
            padding: 40px;
            color: #059669;
        }

        .success-message i {
            font-size: 64px;
            margin-bottom: 16px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .company-header {
                padding: 24px;
            }

            .payment-form {
                padding: 24px;
            }
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            display: none;
        }
        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .company-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .company-logo-large {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .company-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .company-subtitle {
            color: #6b7280;
            font-size: 16px;
        }

        .balance-info {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .balance-label {
            font-size: 14px;
            color: #166534;
            margin-bottom: 8px;
        }

        .balance-amount {
            font-size: 24px;
            font-weight: 700;
            color: #166534;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: #FAFBFC;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--category-color);
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(255, 153, 153, 0.1);
        }

        .payment-summary {
            background: #F8FAFC;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row.total {
            font-weight: 600;
            font-size: 16px;
            border-top: 1px solid #E5E7EB;
            padding-top: 12px;
            margin-top: 12px;
        }

        .pay-button {
            width: 100%;
            background: linear-gradient(135deg, var(--category-color) 0%, var(--category-color) 100%);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .security-note {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .loading, .success-message {
            text-align: center;
            padding: 60px 20px;
            display: none;
        }

        .loading i {
            font-size: 48px;
            margin-bottom: 16px;
            color: #6b7280;
            animation: spin 2s linear infinite;
        }

        .success-message i {
            font-size: 48px;
            margin-bottom: 16px;
            color: #10b981;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            display: none;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .payment-container {
                padding: 24px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('payment.category', $category['slug']) }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to {{ $category['name'] }}
        </a>

        <div class="payment-container" style="--category-color: {{ $category['color'] }}">
            <div class="company-header">
                <div class="company-logo-large">{{ $company['logo'] }}</div>
                <h1 class="company-title">{{ $company['name'] }}</h1>
                <p class="company-subtitle">{{ $company['description'] }}</p>
            </div>

            <div class="payment-form">
                <div class="balance-info">
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount" id="currentBalance">₱{{ number_format($account->balance, 2) }}</div>
                </div>

                <div class="error-message" id="errorMessage"></div>

                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="category_slug" value="{{ $category['slug'] }}">
                    <input type="hidden" name="company_slug" value="{{ $company['slug'] }}">

                    <div class="form-grid">
                        @foreach($company['fields'] as $index => $field)
                        <div class="form-group {{ $index === 0 ? 'full-width' : '' }}">
                            <label class="form-label" for="field_{{ $index }}">
                                {{ $field }} <span style="color: #dc2626;">*</span>
                            </label>
                            <input type="text" 
                                   id="field_{{ $index }}" 
                                   name="field_{{ $index }}" 
                                   class="form-input" 
                                   placeholder="Enter {{ strtolower($field) }}"
                                   required>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="customer_name">
                            Customer Name <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="text" 
                               id="customer_name" 
                               name="customer_name" 
                               class="form-input" 
                               placeholder="Enter customer name"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="account_number">
                            Account/Reference Number <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="text" 
                               id="account_number" 
                               name="account_number" 
                               class="form-input" 
                               placeholder="Enter account or reference number"
                               required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="amount">
                            Payment Amount <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="number" 
                               id="amount" 
                               name="amount" 
                               class="form-input amount-input" 
                               placeholder="0.00" 
                               min="1" 
                               step="0.01"
                               required>
                    </div>

                    <div class="payment-summary" id="paymentSummary" style="display: none;">
                        <div class="summary-title">Payment Summary</div>
                        <div class="summary-row">
                            <span>Payment to:</span>
                            <span>{{ $company['name'] }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Customer:</span>
                            <span id="summaryCustomer">-</span>
                        </div>
                        <div class="summary-row">
                            <span>Account:</span>
                            <span id="summaryAccount">-</span>
                        </div>
                        <div class="summary-row">
                            <span>Amount:</span>
                            <span id="summaryAmount">₱0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Processing Fee:</span>
                            <span>FREE</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total Amount:</span>
                            <span id="summaryTotal">₱0.00</span>
                        </div>
                    </div>

                    <button type="submit" class="pay-button" id="payButton">
                        <i class="fas fa-credit-card"></i>
                        Pay {{ $company['name'] }}
                    </button>

                    <div class="security-note">
                        <i class="fas fa-shield-alt"></i>
                        Your payment is secured with bank-grade encryption
                    </div>
                </form>

                <div class="loading" id="loadingState">
                    <i class="fas fa-spinner"></i>
                    <div>Processing your payment...</div>
                    <div style="font-size: 12px; color: #9ca3af; margin-top: 8px;">Please do not close this window</div>
                </div>

                <div class="success-message" id="successState">
                    <i class="fas fa-check-circle"></i>
                    <h3>Payment Successful!</h3>
                    <p>Your payment to {{ $company['name'] }} has been processed successfully.</p>
                    <button onclick="window.location.href='{{ route('dashboard') }}'" 
                            style="margin-top: 16px; padding: 12px 24px; background: var(--category-color); color: white; border: none; border-radius: 8px; cursor: pointer;">
                        Back to Dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('paymentForm');
            const amountInput = document.getElementById('amount');
            const customerNameInput = document.getElementById('customer_name');
            const accountNumberInput = document.getElementById('account_number');
            const paymentSummary = document.getElementById('paymentSummary');
            const currentBalance = {{ $account->balance }};

            // Update summary when inputs change
            function updateSummary() {
                const amount = parseFloat(amountInput.value) || 0;
                const customerName = customerNameInput.value.trim();
                const accountNumber = accountNumberInput.value.trim();

                if (amount > 0 && customerName && accountNumber) {
                    document.getElementById('summaryCustomer').textContent = customerName;
                    document.getElementById('summaryAccount').textContent = accountNumber;
                    document.getElementById('summaryAmount').textContent = '₱' + amount.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    document.getElementById('summaryTotal').textContent = '₱' + amount.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    paymentSummary.style.display = 'block';
                } else {
                    paymentSummary.style.display = 'none';
                }
            }

            amountInput.addEventListener('input', updateSummary);
            customerNameInput.addEventListener('input', updateSummary);
            accountNumberInput.addEventListener('input', updateSummary);

            // Handle form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const amount = parseFloat(amountInput.value) || 0;
                
                // Validate amount
                if (amount <= 0) {
                    PIGGYToast.error('Invalid Amount', 'Please enter a valid payment amount.');
                    return;
                }
                
                if (amount > currentBalance) {
                    PIGGYToast.error('Insufficient Balance', 'You don\'t have enough balance for this payment.');
                    return;
                }

                // Show loading toast
                const loadingToast = PIGGYToast.loading('Processing Payment', 'Please wait while we process your payment...');

                // Prepare form data
                const formData = new FormData(form);

                // Submit payment
                fetch('{{ route("payment.process") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Hide loading toast
                    PIGGYToast.hide(loadingToast);
                    
                    if (data.success) {
                        PIGGYToast.success('Payment Successful!', `₱${amount.toFixed(2)} has been paid to ${data.company_name || '{{ $company["name"] }}'}.`);
                        
                        // Update balance display
                        document.getElementById('currentBalance').textContent = '₱' + data.new_balance.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        
                        // Show success state after a short delay
                        setTimeout(() => {
                            document.querySelector('.payment-form').style.display = 'none';
                            document.getElementById('successState').style.display = 'block';
                        }, 1000);
                    } else {
                        PIGGYToast.error('Payment Failed', data.message || 'Unable to process payment. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Payment error:', error);
                    PIGGYToast.hide(loadingToast);
                    PIGGYToast.error('Network Error', 'Unable to connect to server. Please check your internet connection.');
                });
            });
        });
    </script>
    <script src="{{ asset('js/toast.js') }}"></script>
</body>
</html>