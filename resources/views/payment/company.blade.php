<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $company['name'] }} Payment - PIGGY</title>
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
            max-width: 900px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
        }

        .company-logo-large {
            font-size: 56px;
            margin-bottom: 16px;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .company-subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            line-height: 1.5;
        }

        /* Form Card */
        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .balance-info {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08), rgba(5, 150, 105, 0.08));
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: center;
        }

        .balance-label {
            font-size: 14px;
            color: #047857;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .balance-amount {
            font-size: 32px;
            font-weight: 700;
            color: #065f46;
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
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
            font-family: 'Inter', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #FF9898;
            box-shadow: 0 0 0 4px rgba(255, 152, 152, 0.1);
            background: white;
        }

        .amount-input {
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            color: #2d3748;
        }

        .payment-summary {
            background: linear-gradient(135deg, rgba(255, 152, 152, 0.06), rgba(255, 123, 123, 0.06));
            border: 1px solid rgba(255, 152, 152, 0.15);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
        }

        .summary-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
            font-size: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
            color: #64748b;
        }

        .summary-row span:last-child {
            color: #2d3748;
            font-weight: 500;
        }

        .summary-row.total {
            border-top: 2px solid rgba(255, 152, 152, 0.2);
            padding-top: 16px;
            margin-top: 16px;
            font-weight: 600;
            font-size: 18px;
            color: #2d3748;
        }

        .pay-button {
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
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 152, 152, 0.4);
        }

        .pay-button:active {
            transform: translateY(0);
        }

        .pay-button:disabled {
            background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .security-note {
            text-align: center;
            font-size: 13px;
            color: #64748b;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 500;
        }

        .security-note i {
            color: #10b981;
        }

        /* Loading and Success States */
        .loading {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }

        .loading i {
            font-size: 56px;
            margin-bottom: 20px;
            color: #FF9898;
            animation: spin 1.5s linear infinite;
        }

        .loading h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .loading p {
            color: #64748b;
            font-size: 14px;
        }

        .success-message {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }

        .success-message i {
            font-size: 72px;
            margin-bottom: 24px;
            color: #10b981;
        }

        .success-message h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            color: #2d3748;
            margin-bottom: 12px;
        }

        .success-message p {
            color: #64748b;
            font-size: 15px;
            margin-bottom: 24px;
        }

        .success-message button {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
        }

        .success-message button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error-message {
            background: #fef2f2;
            border: 2px solid #fecaca;
            color: #dc2626;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
            font-weight: 500;
            align-items: center;
            gap: 10px;
        }

        .error-message i {
            font-size: 18px;
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

            .page-header {
                padding: 32px 24px;
            }

            .company-logo-large {
                font-size: 48px;
            }

            .page-title {
                font-size: 26px;
            }

            .payment-container {
                padding: 28px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .amount-input {
                font-size: 24px;
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
            <a href="{{ route('payment.category', $category['slug']) }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to {{ $category['name'] }}
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="company-logo-large">{{ $company['logo'] }}</div>
            <h1 class="page-title">{{ $company['name'] }}</h1>
            <p class="company-subtitle">{{ $company['description'] }}</p>
        </div>

        <!-- Payment Form -->
        <div class="payment-container" style="--category-color: {{ $category['color'] }}">
            <div class="balance-info">
                <div class="balance-label">Available Balance</div>
                <div class="balance-amount" id="currentBalance">₱{{ number_format($account->balance, 2) }}</div>
            </div>

            <div class="error-message" id="errorMessage">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorText"></span>
            </div>

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
                <h3>Processing Payment</h3>
                <p>Please do not close this window</p>
            </div>

            <div class="success-message" id="successState">
                <i class="fas fa-check-circle"></i>
                <h3>Payment Successful!</h3>
                <p>Your payment to {{ $company['name'] }} has been processed successfully.</p>
                <button onclick="window.location.href='{{ route('dashboard') }}'">
                    Back to Dashboard
                </button>
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
                const errorMessage = document.getElementById('errorMessage');
                
                // Clear previous errors
                errorMessage.style.display = 'none';
                
                // Validate amount
                if (amount <= 0) {
                    document.getElementById('errorText').textContent = 'Please enter a valid payment amount.';
                    errorMessage.style.display = 'flex';
                    return;
                }
                
                if (amount > currentBalance) {
                    document.getElementById('errorText').textContent = 'Insufficient balance for this payment.';
                    errorMessage.style.display = 'flex';
                    return;
                }

                // Show loading state
                form.style.display = 'none';
                document.getElementById('loadingState').style.display = 'block';

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
                    document.getElementById('loadingState').style.display = 'none';
                    
                    if (data.success) {
                        document.getElementById('successState').style.display = 'block';
                        // Update balance display
                        document.getElementById('currentBalance').textContent = '₱' + data.new_balance.toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    } else {
                        form.style.display = 'block';
                        document.getElementById('errorText').textContent = data.message || 'Payment failed. Please try again.';
                        errorMessage.style.display = 'flex';
                    }
                })
                .catch(error => {
                    console.error('Payment error:', error);
                    document.getElementById('loadingState').style.display = 'none';
                    form.style.display = 'block';
                    document.getElementById('errorText').textContent = 'Network error. Please check your connection and try again.';
                    errorMessage.style.display = 'flex';
                });
            });
        });
    </script>
</body>
</html>