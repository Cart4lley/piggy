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
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 24px;
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
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="breadcrumb">
            <a href="{{ route('payment.index') }}" class="breadcrumb-link">
                <i class="fas fa-credit-card"></i> Payments
            </a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('payment.category', $category['slug']) }}" class="breadcrumb-link">
                {{ $category['name'] }}
            </a>
            <span class="breadcrumb-separator">/</span>
            <span>{{ $company['name'] }}</span>
        </div>

        <a href="{{ route('payment.category', $category['slug']) }}" class="back-button">
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
                const errorMessage = document.getElementById('errorMessage');
                
                // Clear previous errors
                errorMessage.style.display = 'none';
                
                // Validate amount
                if (amount <= 0) {
                    errorMessage.textContent = 'Please enter a valid payment amount.';
                    errorMessage.style.display = 'block';
                    return;
                }
                
                if (amount > currentBalance) {
                    errorMessage.textContent = 'Insufficient balance for this payment.';
                    errorMessage.style.display = 'block';
                    return;
                }

                // Show loading state
                document.querySelector('.payment-form').style.display = 'none';
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
                        document.querySelector('.payment-form').style.display = 'block';
                        errorMessage.textContent = data.message || 'Payment failed. Please try again.';
                        errorMessage.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Payment error:', error);
                    document.getElementById('loadingState').style.display = 'none';
                    document.querySelector('.payment-form').style.display = 'block';
                    errorMessage.textContent = 'Network error. Please check your connection and try again.';
                    errorMessage.style.display = 'block';
                });
            });
        });
    </script>
</body>
</html>