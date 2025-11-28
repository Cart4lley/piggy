<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Send Money - PIGGY Bank</title>
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

        .form-input {
            width: 100%;
            padding: 14px 16px;
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

        .input-hint {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        .form-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
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
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        /* Account Input Enhancement */
        .account-input-container {
            position: relative;
        }

        .account-validation {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .validation-icon {
            font-size: 16px;
        }

        .validation-success {
            color: #22c55e;
        }

        .validation-error {
            color: #ef4444;
        }

        .account-info {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(34, 197, 94, 0.05));
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 8px;
            padding: 12px;
            margin-top: 8px;
        }

        .account-info.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border-color: rgba(239, 68, 68, 0.3);
        }

        .account-info h6 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: #22c55e;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .account-info.error h6 {
            color: #ef4444;
        }

        .account-info p {
            margin: 0;
            font-size: 13px;
            color: #6b7280;
        }

        /* Transfer Summary */
        .transfer-summary {
            background: rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
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
            padding: 10px 0;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        }

        .summary-item:last-child {
            border-bottom: none;
            font-weight: 600;
            color: #1e40af;
            padding-top: 15px;
            margin-top: 5px;
            border-top: 2px solid rgba(59, 130, 246, 0.2);
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
            border-top: 2px solid #3b82f6;
            background: rgba(59, 130, 246, 0.05);
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
            color: #3b82f6;
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
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-confirm:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
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
                <i class="fas fa-paper-plane"></i>
                Send Money
            </h1>
            <p class="page-subtitle">Transfer money to another PIGGY account instantly</p>
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

        <!-- Send Money Form -->
        <div class="form-card">
            <form id="sendMoneyForm" method="POST" action="{{ route('account.send-money') }}">
                @csrf
                <input type="hidden" name="transaction_type" value="transfer">
                <input type="hidden" name="transfer_type" value="internal">
                
                <div class="form-group">
                    <label for="recipient_account" class="form-label">
                        <i class="fas fa-user"></i>
                        Recipient Account Number
                    </label>
                    <div class="account-input-container">
                        <input type="text" id="recipient_account" name="recipient_account" class="form-input" 
                               placeholder="Enter account number (e.g., PIGGY123456)" 
                               pattern="PIGGY[0-9]{6}" 
                               title="Account number must be in format PIGGY123456"
                               autocomplete="off"
                               value="{{ old('recipient_account') }}"
                               required>
                        <div class="account-validation" id="accountValidation">
                            <i class="fas fa-spinner fa-spin validation-icon" style="display: none;"></i>
                        </div>
                    </div>
                    <div class="account-info" id="accountInfo" style="display: none;"></div>
                    <small class="input-hint">Enter the recipient's PIGGY account number</small>
                    @error('recipient_account')
                        <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="send_amount" class="form-label">
                        <i class="fas fa-peso-sign"></i>
                        Amount
                    </label>
                    <input type="number" id="send_amount" name="amount" class="form-input" 
                           placeholder="0.00" min="1" max="{{ $account->balance }}" step="0.01" 
                           value="{{ old('amount') }}"
                           required>
                    <small class="input-hint">Available balance: ₱{{ number_format($account->balance, 2) }}</small>
                    @error('amount')
                        <small class="input-hint" style="color: #dc2626;">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="send_description" class="form-label">
                        <i class="fas fa-comment"></i>
                        Message (Optional)
                    </label>
                    <input type="text" id="send_description" name="description" class="form-input" 
                           placeholder="What's this transfer for?" maxlength="100"
                           value="{{ old('description') }}">
                    <small class="input-hint">Add a message for the recipient</small>
                </div>

                <div class="transfer-summary" id="transferSummary" style="display: none;">
                    <h4><i class="fas fa-receipt"></i> Transfer Summary</h4>
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
                    Send Money Now
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
                <h3>Confirm Transfer</h3>
            </div>
            <div class="confirmation-modal-body">
                <p>You are about to send money to:</p>
                <div class="confirmation-details">
                    <div class="detail-row">
                        <span class="detail-label">Recipient:</span>
                        <span class="detail-value" id="confirmRecipientName">-</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Account:</span>
                        <span class="detail-value" id="confirmRecipientAccount">-</span>
                    </div>
                    <div class="detail-row highlight">
                        <span class="detail-label">Amount:</span>
                        <span class="detail-value" id="confirmAmount">₱0.00</span>
                    </div>
                </div>
                <p class="confirmation-question">Do you want to proceed with this transfer?</p>
            </div>
            <div class="confirmation-modal-footer">
                <button type="button" class="btn-cancel" onclick="closeConfirmationModal()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="button" class="btn-confirm" onclick="confirmTransfer()">
                    <i class="fas fa-check"></i>
                    Confirm Transfer
                </button>
            </div>
        </div>
    </div>

    <script>
        // Account validation and form setup
        document.addEventListener('DOMContentLoaded', function() {
            const recipientInput = document.getElementById('recipient_account');
            const amountInput = document.getElementById('send_amount');
            const summaryDiv = document.getElementById('transferSummary');
            let validationTimeout;
            
            // Add event listeners for real-time updates
            recipientInput.addEventListener('input', function(e) {
                // Format account number input
                let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                if (value.length > 6 && !value.startsWith('PIGGY')) {
                    value = 'PIGGY' + value.substring(5, 11);
                }
                e.target.value = value;
                
                // Clear previous validation timeout
                clearTimeout(validationTimeout);
                
                // Validate account after delay
                if (value.length >= 11) { // PIGGY + 6 digits
                    showValidationSpinner();
                    validationTimeout = setTimeout(() => validateAccount(value), 500);
                } else {
                    hideAccountValidation();
                }
                
                updateTransferSummary();
            });
            
            amountInput.addEventListener('input', updateTransferSummary);
            
            // Setup form submission validation
            const sendForm = document.getElementById('sendMoneyForm');
            sendForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const recipientAccount = document.getElementById('recipient_account').value;
                const amount = parseFloat(document.getElementById('send_amount').value);
                const accountInfo = document.getElementById('accountInfo');
                
                // Check if account is validated successfully
                const validationIcon = document.getElementById('accountValidation').querySelector('.validation-icon');
                if (!validationIcon.classList.contains('validation-success')) {
                    alert('Please wait for account validation or enter a valid account number.');
                    return;
                }
                
                // Check if amount is valid
                if (!amount || amount <= 0) {
                    alert('Please enter a valid amount.');
                    return;
                }
                
                // Check if sufficient balance
                const currentBalance = {{ $account->balance }};
                if (amount > currentBalance) {
                    alert('Insufficient balance for this transfer.');
                    return;
                }
                
                // Extract recipient name from accountInfo
                const recipientNameMatch = accountInfo.innerHTML.match(/<strong>([^<]+)<\/strong>/);
                const recipientName = recipientNameMatch ? recipientNameMatch[1] : 'Unknown';
                
                // Show custom confirmation modal
                showConfirmationModal(recipientName, recipientAccount, amount);
            });
        });

        // Confirmation Modal Functions
        let pendingTransfer = null;

        function showConfirmationModal(recipientName, recipientAccount, amount) {
            // Store transfer data
            pendingTransfer = { recipientName, recipientAccount, amount };
            
            // Update modal content
            document.getElementById('confirmRecipientName').textContent = recipientName;
            document.getElementById('confirmRecipientAccount').textContent = recipientAccount;
            document.getElementById('confirmAmount').textContent = '₱' + amount.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            
            // Show modal
            document.getElementById('confirmationModal').classList.add('show');
        }

        function closeConfirmationModal() {
            document.getElementById('confirmationModal').classList.remove('show');
            pendingTransfer = null;
        }

        function confirmTransfer() {
            if (!pendingTransfer) return;
            
            const sendForm = document.getElementById('sendMoneyForm');
            
            // Add recipient name to form data
            const recipientNameInput = document.createElement('input');
            recipientNameInput.type = 'hidden';
            recipientNameInput.name = 'recipient_name';
            recipientNameInput.value = pendingTransfer.recipientName;
            sendForm.appendChild(recipientNameInput);
            
            // Close modal
            closeConfirmationModal();
            
            // Submit the form
            sendForm.submit();
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

        function validateAccount(accountNumber) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                            
            fetch('/api/account/lookup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ account_number: accountNumber })
            })
            .then(response => response.json())
            .then(data => {
                const accountInfo = document.getElementById('accountInfo');
                const validationIcon = document.getElementById('accountValidation').querySelector('.validation-icon');
                
                hideValidationSpinner();
                
                if (data.success) {
                    // Show success
                    validationIcon.className = 'fas fa-check-circle validation-icon validation-success';
                    validationIcon.style.display = 'block';
                    
                    // Show account info
                    accountInfo.innerHTML = `
                        <h6><i class="fas fa-user-check"></i> Account Found</h6>
                        <p><strong>${data.account.account_holder}</strong> • ${data.account.account_type} Account</p>
                    `;
                    accountInfo.className = 'account-info';
                    accountInfo.style.display = 'block';
                } else {
                    // Show error
                    validationIcon.className = 'fas fa-exclamation-circle validation-icon validation-error';
                    validationIcon.style.display = 'block';
                    
                    // Show error info
                    const errorMessages = {
                        'not_found': 'Account not found in our system',
                        'inactive': 'This account is inactive and cannot receive transfers',
                        'self_transfer': 'Cannot send money to your own account'
                    };
                    
                    accountInfo.innerHTML = `
                        <h6><i class="fas fa-exclamation-triangle"></i> ${data.error_type === 'not_found' ? 'Account Not Found' : 'Transfer Not Allowed'}</h6>
                        <p>${errorMessages[data.error_type] || data.message}</p>
                    `;
                    accountInfo.className = 'account-info error';
                    accountInfo.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Account validation error:', error);
                hideValidationSpinner();
                showValidationError('Unable to validate account. Please try again.');
            });
        }

        function showValidationSpinner() {
            const validationIcon = document.getElementById('accountValidation').querySelector('.validation-icon');
            validationIcon.className = 'fas fa-spinner fa-spin validation-icon';
            validationIcon.style.display = 'block';
            document.getElementById('accountInfo').style.display = 'none';
        }

        function hideValidationSpinner() {
            const validationIcon = document.getElementById('accountValidation').querySelector('.validation-icon');
            validationIcon.style.display = 'none';
        }

        function hideAccountValidation() {
            document.getElementById('accountValidation').querySelector('.validation-icon').style.display = 'none';
            document.getElementById('accountInfo').style.display = 'none';
        }

        function showValidationError(message) {
            const accountInfo = document.getElementById('accountInfo');
            accountInfo.innerHTML = `
                <h6><i class="fas fa-exclamation-triangle"></i> Validation Error</h6>
                <p>${message}</p>
            `;
            accountInfo.className = 'account-info error';
            accountInfo.style.display = 'block';
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
    </script>
</body>
</html>
