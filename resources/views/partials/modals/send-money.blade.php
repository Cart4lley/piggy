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
        
        <div class="modal-body">
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
                               required>
                        <div class="account-validation" id="accountValidation">
                            <i class="fas fa-spinner fa-spin validation-icon" style="display: none;"></i>
                        </div>
                    </div>
                    <div class="account-info" id="accountInfo" style="display: none;"></div>
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
</div>

<script>
// Send Money Form Functions
function setupSendMoneyForm() {
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
        const recipientAccount = document.getElementById('recipient_account').value;
        const amount = parseFloat(document.getElementById('send_amount').value);
        const accountInfo = document.getElementById('accountInfo');
        
        // Check if account is validated successfully
        const validationIcon = document.getElementById('accountValidation').querySelector('.validation-icon');
        if (!validationIcon.classList.contains('validation-success')) {
            e.preventDefault();
            alert('Please wait for account validation or enter a valid account number.');
            return;
        }
        
        // Check if amount is valid
        if (!amount || amount <= 0) {
            e.preventDefault();
            alert('Please enter a valid amount.');
            return;
        }
        
        // Check if sufficient balance
        const currentBalance = {{ $account->balance }};
        if (amount > currentBalance) {
            e.preventDefault();
            alert('Insufficient balance for this transfer.');
            return;
        }
        
        // Extract recipient name from accountInfo and add to form
        const recipientNameMatch = accountInfo.innerHTML.match(/<strong>([^<]+)<\/strong>/);
        const recipientName = recipientNameMatch ? recipientNameMatch[1] : 'Unknown';
        
        const recipientNameInput = document.createElement('input');
        recipientNameInput.type = 'hidden';
        recipientNameInput.name = 'recipient_name';
        recipientNameInput.value = recipientName;
        sendForm.appendChild(recipientNameInput);
        
        // Form will submit normally
    });
}

function validateAccount(accountNumber) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                    document.querySelector('input[name="_token"]')?.value;
                    
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

function resetSendMoneyForm() {
    document.getElementById('recipient_account').value = '';
    document.getElementById('send_amount').value = '';
    document.getElementById('send_description').value = '';
    document.getElementById('transferSummary').style.display = 'none';
    
    // Reset validation states
    hideAccountValidation();
}
</script>
