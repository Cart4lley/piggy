/**
 * PIGGY Bank - Confirmation Modal System
 * Handles transaction confirmation modals with validation and security features
 */

class PIGGYConfirmationModal {
    constructor() {
        this.modal = null;
        this.overlay = null;
        this.currentConfig = null;
        this.onConfirm = null;
        this.onCancel = null;
        this.isProcessing = false;
        
        this.init();
    }

    init() {
        // Create modal structure if it doesn't exist
        if (!document.querySelector('.modal-overlay')) {
            this.createModal();
        }
        
        this.modal = document.querySelector('.modal');
        this.overlay = document.querySelector('.modal-overlay');
        
        // Bind events
        this.bindEvents();
    }

    createModal() {
        const modalHTML = `
            <div class="modal-overlay" id="confirmationModal">
                <div class="modal">
                    <div class="modal-header">
                        <h3>
                            <span class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            <span class="title">Confirm Transaction</span>
                        </h3>
                        <button class="modal-close" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-warning">
                            <i class="fas fa-info-circle icon"></i>
                            <div class="text">
                                Please review your transaction details carefully before proceeding.
                            </div>
                        </div>
                        
                        <div class="transaction-details">
                            <!-- Transaction details will be inserted here -->
                        </div>
                        
                        <div class="pin-input-section" style="display: none;">
                            <h4>Enter your transaction PIN</h4>
                            <input type="password" class="pin-input" placeholder="Enter 6-digit PIN" maxlength="6">
                            <div class="pin-error">Invalid PIN. Please try again.</div>
                        </div>
                        
                        <div class="security-notice">
                            <i class="fas fa-shield-alt icon"></i>
                            <div class="text">
                                Your transaction is secured with bank-level encryption.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-btn modal-btn-secondary cancel-btn" type="button">
                            Cancel
                        </button>
                        <button class="modal-btn modal-btn-primary confirm-btn" type="button">
                            Confirm Transaction
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    bindEvents() {
        // Close button
        const closeBtn = this.modal.querySelector('.modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.hide());
        }
        
        // Cancel button
        const cancelBtn = this.modal.querySelector('.cancel-btn');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => this.hide());
        }
        
        // Confirm button
        const confirmBtn = this.modal.querySelector('.confirm-btn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => this.handleConfirm());
        }
        
        // Overlay click to close
        this.overlay.addEventListener('click', (e) => {
            if (e.target === this.overlay) {
                this.hide();
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.isVisible()) return;
            
            switch(e.key) {
                case 'Escape':
                    this.hide();
                    break;
                case 'Home':
                    if (e.ctrlKey) {
                        e.preventDefault();
                        this.scrollToTop();
                    }
                    break;
                case 'End':
                    if (e.ctrlKey) {
                        e.preventDefault();
                        this.scrollToBottom();
                    }
                    break;
                case 'PageUp':
                    e.preventDefault();
                    const modalBody = this.modal.querySelector('.modal-body');
                    if (modalBody) {
                        modalBody.scrollBy({ top: -modalBody.clientHeight * 0.8, behavior: 'smooth' });
                    }
                    break;
                case 'PageDown':
                    e.preventDefault();
                    const modalBodyDown = this.modal.querySelector('.modal-body');
                    if (modalBodyDown) {
                        modalBodyDown.scrollBy({ top: modalBodyDown.clientHeight * 0.8, behavior: 'smooth' });
                    }
                    break;
            }
        });
        
        // PIN input validation
        const pinInput = this.modal.querySelector('.pin-input');
        if (pinInput) {
            pinInput.addEventListener('input', (e) => {
                // Only allow digits
                e.target.value = e.target.value.replace(/\D/g, '');
                
                // Clear error state when typing
                this.clearPinError();
            });
            
            pinInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.handleConfirm();
                }
            });
        }
        
        // Modal body scroll detection
        const modalBody = this.modal.querySelector('.modal-body');
        if (modalBody) {
            modalBody.addEventListener('scroll', () => {
                this.handleScroll();
            });
        }
    }

    /**
     * Show confirmation modal
     * @param {Object} config - Configuration object
     */
    show(config) {
        this.currentConfig = {
            type: 'warning', // 'warning', 'info', 'success'
            title: 'Confirm Transaction',
            message: 'Please review your transaction details carefully.',
            details: {},
            requirePin: false,
            confirmText: 'Confirm Transaction',
            cancelText: 'Cancel',
            onConfirm: null,
            onCancel: null,
            ...config
        };

        this.updateModalContent();
        
        // Check if modal content is long and add appropriate class
        this.checkContentHeight();
        
        this.overlay.classList.add('show');
        
        // Focus PIN input if required
        if (this.currentConfig.requirePin) {
            setTimeout(() => {
                const pinInput = this.modal.querySelector('.pin-input');
                if (pinInput) {
                    pinInput.focus();
                }
            }, 300);
        }
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    hide() {
        if (this.isProcessing) return;
        
        this.overlay.classList.remove('show');
        document.body.style.overflow = '';
        
        // Clear PIN input
        const pinInput = this.modal.querySelector('.pin-input');
        if (pinInput) {
            pinInput.value = '';
            this.clearPinError();
        }
        
        // Call onCancel callback
        if (this.currentConfig && this.currentConfig.onCancel) {
            this.currentConfig.onCancel();
        }
        
        this.currentConfig = null;
        this.isProcessing = false;
    }

    updateModalContent() {
        const config = this.currentConfig;
        
        // Update header
        const titleElement = this.modal.querySelector('.title');
        if (titleElement) {
            titleElement.textContent = config.title;
        }
        
        const iconElement = this.modal.querySelector('.modal-header .icon');
        if (iconElement) {
            iconElement.className = `icon ${config.type}`;
            
            let iconClass = 'fas fa-exclamation-triangle';
            if (config.type === 'info') iconClass = 'fas fa-info-circle';
            if (config.type === 'success') iconClass = 'fas fa-check-circle';
            
            iconElement.querySelector('i').className = iconClass;
        }
        
        // Update warning message
        const warningText = this.modal.querySelector('.modal-warning .text');
        if (warningText) {
            warningText.textContent = config.message;
        }
        
        // Update transaction details
        this.updateTransactionDetails(config.details);
        
        // Show/hide PIN section
        const pinSection = this.modal.querySelector('.pin-input-section');
        if (pinSection) {
            pinSection.style.display = config.requirePin ? 'block' : 'none';
        }
        
        // Update button texts
        const confirmBtn = this.modal.querySelector('.confirm-btn');
        const cancelBtn = this.modal.querySelector('.cancel-btn');
        
        if (confirmBtn) {
            confirmBtn.textContent = config.confirmText;
        }
        
        if (cancelBtn) {
            cancelBtn.textContent = config.cancelText;
        }
    }

    updateTransactionDetails(details) {
        const container = this.modal.querySelector('.transaction-details');
        if (!container) return;
        
        let html = '';
        
        Object.entries(details).forEach(([key, value]) => {
            const label = this.formatLabel(key);
            const formattedValue = this.formatValue(key, value);
            const valueClass = this.getValueClass(key);
            
            html += `
                <div class="detail-row">
                    <span class="detail-label">${label}</span>
                    <span class="detail-value ${valueClass}">${formattedValue}</span>
                </div>
            `;
        });
        
        container.innerHTML = html;
    }

    formatLabel(key) {
        const labelMap = {
            amount: 'Amount',
            fee: 'Transaction Fee',
            total: 'Total Amount',
            recipient: 'Recipient',
            account: 'Account Number',
            bank: 'Bank',
            reference: 'Reference Number',
            description: 'Description',
            method: 'Payment Method',
            biller: 'Biller',
            accountNumber: 'Account Number',
            customerName: 'Customer Name'
        };
        
        return labelMap[key] || key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
    }

    formatValue(key, value) {
        if (key.toLowerCase().includes('amount') || key === 'fee' || key === 'total') {
            return this.formatCurrency(value);
        }
        
        if (key.toLowerCase().includes('account') && typeof value === 'string') {
            return this.maskAccountNumber(value);
        }
        
        return value;
    }

    getValueClass(key) {
        if (key.toLowerCase().includes('amount')) return 'amount';
        if (key === 'fee') return 'fee';
        if (key === 'total') return 'total';
        if (key === 'bank') return 'bank-name';
        if (key === 'recipient') return 'recipient-name';
        if (key === 'account') return 'account-number';
        return '';
    }

    formatCurrency(amount) {
        const num = parseFloat(amount) || 0;
        return `₱${num.toLocaleString('en-PH', { 
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2 
        })}`;
    }

    maskAccountNumber(account) {
        if (account.length <= 4) return account;
        const masked = '*'.repeat(account.length - 4) + account.slice(-4);
        return masked;
    }

    handleConfirm() {
        if (this.isProcessing) return;
        
        const config = this.currentConfig;
        
        // Validate PIN if required
        if (config.requirePin) {
            const pinInput = this.modal.querySelector('.pin-input');
            const pin = pinInput ? pinInput.value.trim() : '';
            
            if (pin.length !== 6) {
                this.showPinError('Please enter a 6-digit PIN');
                return;
            }
        }
        
        // Set processing state
        this.setProcessing(true);
        
        // Call confirmation callback
        if (config.onConfirm) {
            const pinInput = this.modal.querySelector('.pin-input');
            const pin = pinInput ? pinInput.value : null;
            
            const result = config.onConfirm(pin);
            
            // If callback returns a promise, handle it
            if (result && typeof result.then === 'function') {
                result
                    .then(() => {
                        this.hide();
                    })
                    .catch((error) => {
                        this.setProcessing(false);
                        this.handleError(error);
                    });
            } else {
                // If callback returns false, don't close modal
                if (result !== false) {
                    this.hide();
                } else {
                    this.setProcessing(false);
                }
            }
        } else {
            this.hide();
        }
    }

    setProcessing(processing) {
        this.isProcessing = processing;
        
        const confirmBtn = this.modal.querySelector('.confirm-btn');
        const cancelBtn = this.modal.querySelector('.cancel-btn');
        const closeBtn = this.modal.querySelector('.modal-close');
        
        if (processing) {
            confirmBtn.classList.add('processing');
            confirmBtn.disabled = true;
            cancelBtn.disabled = true;
            closeBtn.style.display = 'none';
        } else {
            confirmBtn.classList.remove('processing');
            confirmBtn.disabled = false;
            cancelBtn.disabled = false;
            closeBtn.style.display = 'flex';
        }
    }

    showPinError(message) {
        const pinInput = this.modal.querySelector('.pin-input');
        const pinError = this.modal.querySelector('.pin-error');
        
        if (pinInput) {
            pinInput.classList.add('error');
        }
        
        if (pinError) {
            pinError.textContent = message;
            pinError.classList.add('show');
        }
        
        // Auto-hide error after 3 seconds
        setTimeout(() => {
            this.clearPinError();
        }, 3000);
    }

    clearPinError() {
        const pinInput = this.modal.querySelector('.pin-input');
        const pinError = this.modal.querySelector('.pin-error');
        
        if (pinInput) {
            pinInput.classList.remove('error');
        }
        
        if (pinError) {
            pinError.classList.remove('show');
        }
    }

    handleError(error) {
        console.error('Transaction error:', error);
        
        // Show error message (you can customize this based on error type)
        if (error.message && error.message.includes('PIN')) {
            this.showPinError('Invalid PIN. Please try again.');
        } else {
            alert('An error occurred while processing your transaction. Please try again.');
        }
    }

    isVisible() {
        return this.overlay && this.overlay.classList.contains('show');
    }

    checkContentHeight() {
        const modalBody = this.modal.querySelector('.modal-body');
        if (modalBody) {
            // Reset scroll position to top
            modalBody.scrollTop = 0;
            
            // Check if content height exceeds viewport threshold
            const viewportHeight = window.innerHeight;
            const modalHeight = this.modal.offsetHeight;
            
            if (modalHeight > viewportHeight * 0.8) {
                this.modal.classList.add('long-content');
            } else {
                this.modal.classList.remove('long-content');
            }
        }
    }

    scrollToTop() {
        const modalBody = this.modal.querySelector('.modal-body');
        if (modalBody) {
            modalBody.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    scrollToBottom() {
        const modalBody = this.modal.querySelector('.modal-body');
        if (modalBody) {
            modalBody.scrollTo({ top: modalBody.scrollHeight, behavior: 'smooth' });
        }
    }

    handleScroll() {
        const modalBody = this.modal.querySelector('.modal-body');
        if (modalBody) {
            const isAtBottom = modalBody.scrollTop + modalBody.clientHeight >= modalBody.scrollHeight - 5;
            
            if (isAtBottom) {
                this.modal.classList.add('scrolled-bottom');
            } else {
                this.modal.classList.remove('scrolled-bottom');
            }
        }
    }
}

// Transaction confirmation helpers
const PIGGYTransactionConfirm = {
    modal: null,
    
    init() {
        if (!this.modal) {
            this.modal = new PIGGYConfirmationModal();
        }
        return this.modal;
    },
    
    // Bank Transfer Confirmation
    bankTransfer(transferData, onConfirm) {
        this.init();
        
        this.modal.show({
            type: 'warning',
            title: 'Confirm Bank Transfer',
            message: 'Please verify the transfer details below. This action cannot be undone.',
            details: {
                recipient: transferData.recipientName,
                bank: transferData.bankName,
                account: transferData.accountNumber,
                amount: transferData.amount,
                fee: transferData.fee || 25,
                total: (parseFloat(transferData.amount) + (transferData.fee || 25)).toFixed(2),
                reference: transferData.reference || 'N/A'
            },
            requirePin: true,
            confirmText: 'Transfer Now',
            onConfirm: onConfirm
        });
        
        // Add bank transfer specific class for styling
        setTimeout(() => {
            if (this.modal.modal) {
                this.modal.modal.classList.add('bank-transfer-modal');
            }
        }, 100);
    },
    
    // Cash Out Confirmation
    cashOut(withdrawalData, onConfirm) {
        this.init();
        
        this.modal.show({
            type: 'warning',
            title: 'Confirm Cash Withdrawal',
            message: 'Please confirm your cash withdrawal details.',
            details: {
                amount: withdrawalData.amount,
                fee: withdrawalData.fee || 15,
                total: (parseFloat(withdrawalData.amount) + (withdrawalData.fee || 15)).toFixed(2),
                method: withdrawalData.method || 'ATM Withdrawal'
            },
            requirePin: true,
            confirmText: 'Withdraw Cash',
            onConfirm: onConfirm
        });
    },
    
    // Bill Payment Confirmation
    billPayment(paymentData, onConfirm) {
        this.init();
        
        this.modal.show({
            type: 'info',
            title: 'Confirm Bill Payment',
            message: 'Please verify your payment details before proceeding.',
            details: {
                biller: paymentData.billerName,
                accountNumber: paymentData.accountNumber,
                customerName: paymentData.customerName || 'N/A',
                amount: paymentData.amount,
                fee: paymentData.fee || 10,
                total: (parseFloat(paymentData.amount) + (paymentData.fee || 10)).toFixed(2),
                description: paymentData.description || 'Bill Payment'
            },
            requirePin: true,
            confirmText: 'Pay Bill',
            onConfirm: onConfirm
        });
    },
    
    // Generic transaction confirmation
    transaction(config, onConfirm) {
        this.init();
        
        this.modal.show({
            ...config,
            onConfirm: onConfirm
        });
    }
};

// Auto-initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    PIGGYTransactionConfirm.init();
});

// Export for use in other scripts
window.PIGGYConfirmationModal = PIGGYConfirmationModal;
window.PIGGYTransactionConfirm = PIGGYTransactionConfirm;