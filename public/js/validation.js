/**
 * PIGGY Bank - Client-side Validation Library
 * Provides real-time form validation and user feedback
 */

class PIGGYValidator {
    constructor() {
        this.rules = {
            // Philippine phone number validation
            philippinePhone: {
                pattern: /^(\+639|639|09)[0-9]{9}$/,
                message: 'Please enter a valid Philippine phone number (e.g., +63 912 345 6789)'
            },
            
            // Account number validation
            accountNumber: {
                pattern: /^[0-9]{8,20}$/,
                message: 'Account number must be 8-20 digits'
            },
            
            // Strong password validation
            strongPassword: {
                pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                message: 'Password must contain at least 8 characters with uppercase, lowercase, number, and special character'
            },
            
            // Philippine name validation
            philippineName: {
                pattern: /^[a-zA-Z\s\-\.]+$/,
                message: 'Name can only contain letters, spaces, hyphens, and periods'
            },
            
            // Amount validation
            amount: {
                min: 1,
                max: 1000000,
                message: 'Amount must be between ₱1.00 and ₱1,000,000.00'
            },
            
            // ZIP code validation (Philippine)
            philippineZip: {
                pattern: /^[0-9]{4,10}$/,
                message: 'ZIP code must be 4-10 digits'
            },
            
            // Email validation
            email: {
                pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                message: 'Please enter a valid email address'
            },
            
            // Username validation
            username: {
                pattern: /^[a-zA-Z0-9._-]{3,50}$/,
                message: 'Username must be 3-50 characters and contain only letters, numbers, periods, underscores, and hyphens'
            },
            
            // Credit card validation
            creditCard: {
                pattern: /^[0-9]{13,19}$/,
                message: 'Credit card number must be 13-19 digits'
            },
            
            // CVV validation
            cvv: {
                pattern: /^[0-9]{3,4}$/,
                message: 'CVV must be 3 or 4 digits'
            },
            
            // Expiry date validation (MM/YY)
            expiry: {
                pattern: /^(0[1-9]|1[0-2])\/([0-9]{2})$/,
                message: 'Expiry date must be in MM/YY format'
            }
        };
        
        this.init();
    }
    
    init() {
        // Initialize validation on page load
        this.setupFormValidation();
        this.setupRealTimeValidation();
        this.setupPasswordStrength();
        this.setupAmountFormatting();
        this.setupPhoneFormatting();
    }
    
    /**
     * Setup form validation for all forms with validation attributes
     */
    setupFormValidation() {
        const forms = document.querySelectorAll('form[data-validate="true"]');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                if (!this.validateForm(form)) {
                    e.preventDefault();
                    this.showFormErrors(form);
                }
            });
        });
    }
    
    /**
     * Setup real-time validation as user types
     */
    setupRealTimeValidation() {
        // Validate on input events
        document.addEventListener('input', (e) => {
            if (e.target.hasAttribute('data-validate')) {
                this.validateField(e.target);
            }
        });
        
        // Validate on blur events
        document.addEventListener('blur', (e) => {
            if (e.target.hasAttribute('data-validate')) {
                this.validateField(e.target);
            }
        }, true);
    }
    
    /**
     * Validate a single form field
     */
    validateField(field) {
        const validationType = field.getAttribute('data-validate');
        const value = field.value.trim();
        
        // Clear previous validation state
        this.clearFieldError(field);
        
        // Skip validation if field is empty and not required
        if (!value && !field.hasAttribute('required')) {
            return true;
        }
        
        // Check required fields
        if (field.hasAttribute('required') && !value) {
            this.showFieldError(field, 'This field is required');
            return false;
        }
        
        // Apply specific validation rules
        switch (validationType) {
            case 'philippine-phone':
                return this.validatePhilippinePhone(field, value);
            case 'account-number':
                return this.validateAccountNumber(field, value);
            case 'password':
                return this.validatePassword(field, value);
            case 'name':
                return this.validateName(field, value);
            case 'amount':
                return this.validateAmount(field, value);
            case 'zip':
                return this.validateZip(field, value);
            case 'email':
                return this.validateEmail(field, value);
            case 'username':
                return this.validateUsername(field, value);
            case 'credit-card':
                return this.validateCreditCard(field, value);
            case 'cvv':
                return this.validateCVV(field, value);
            case 'expiry':
                return this.validateExpiry(field, value);
            default:
                return true;
        }
    }
    
    /**
     * Validate Philippine phone number
     */
    validatePhilippinePhone(field, value) {
        // Clean the phone number
        const cleaned = value.replace(/[\s\-\(\)]/g, '');
        
        // Check various formats
        const patterns = [
            /^\+639[0-9]{9}$/,     // +639123456789
            /^639[0-9]{9}$/,       // 639123456789
            /^09[0-9]{9}$/,        // 09123456789
            /^9[0-9]{9}$/          // 9123456789
        ];
        
        const isValid = patterns.some(pattern => pattern.test(cleaned));
        
        if (!isValid) {
            this.showFieldError(field, this.rules.philippinePhone.message);
            return false;
        }
        
        // Format the phone number
        if (cleaned.startsWith('09')) {
            field.value = '+63 ' + cleaned.substring(1, 4) + ' ' + cleaned.substring(4, 7) + ' ' + cleaned.substring(7);
        }
        
        return true;
    }
    
    /**
     * Validate account number
     */
    validateAccountNumber(field, value) {
        const cleaned = value.replace(/[\s\-]/g, '');
        
        if (!this.rules.accountNumber.pattern.test(cleaned)) {
            this.showFieldError(field, this.rules.accountNumber.message);
            return false;
        }
        
        // Check for obvious invalid patterns
        if (/^(\d)\1+$/.test(cleaned) || this.isSequentialNumber(cleaned)) {
            this.showFieldError(field, 'Please enter a valid account number');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate password strength
     */
    validatePassword(field, value) {
        if (!this.rules.strongPassword.pattern.test(value)) {
            this.showFieldError(field, this.rules.strongPassword.message);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate names
     */
    validateName(field, value) {
        if (!this.rules.philippineName.pattern.test(value)) {
            this.showFieldError(field, this.rules.philippineName.message);
            return false;
        }
        
        if (value.length < 2) {
            this.showFieldError(field, 'Name must be at least 2 characters');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate amounts
     */
    validateAmount(field, value) {
        const amount = parseFloat(value.replace(/[₱,\s]/g, ''));
        
        if (isNaN(amount)) {
            this.showFieldError(field, 'Please enter a valid amount');
            return false;
        }
        
        const min = field.getAttribute('data-min') ? parseFloat(field.getAttribute('data-min')) : this.rules.amount.min;
        const max = field.getAttribute('data-max') ? parseFloat(field.getAttribute('data-max')) : this.rules.amount.max;
        
        if (amount < min || amount > max) {
            this.showFieldError(field, `Amount must be between ₱${min.toLocaleString()} and ₱${max.toLocaleString()}`);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate ZIP code
     */
    validateZip(field, value) {
        if (!this.rules.philippineZip.pattern.test(value)) {
            this.showFieldError(field, this.rules.philippineZip.message);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate email
     */
    validateEmail(field, value) {
        if (!this.rules.email.pattern.test(value)) {
            this.showFieldError(field, this.rules.email.message);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate username
     */
    validateUsername(field, value) {
        if (!this.rules.username.pattern.test(value)) {
            this.showFieldError(field, this.rules.username.message);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate credit card number
     */
    validateCreditCard(field, value) {
        const cleaned = value.replace(/[\s\-]/g, '');
        
        if (!this.rules.creditCard.pattern.test(cleaned)) {
            this.showFieldError(field, this.rules.creditCard.message);
            return false;
        }
        
        // Luhn algorithm check
        if (!this.luhnCheck(cleaned)) {
            this.showFieldError(field, 'Invalid credit card number');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate CVV
     */
    validateCVV(field, value) {
        if (!this.rules.cvv.pattern.test(value)) {
            this.showFieldError(field, this.rules.cvv.message);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate expiry date
     */
    validateExpiry(field, value) {
        if (!this.rules.expiry.pattern.test(value)) {
            this.showFieldError(field, this.rules.expiry.message);
            return false;
        }
        
        // Check if date is in the future
        const [month, year] = value.split('/');
        const expiry = new Date(2000 + parseInt(year), parseInt(month) - 1);
        const now = new Date();
        
        if (expiry < now) {
            this.showFieldError(field, 'Card has expired');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate entire form
     */
    validateForm(form) {
        const fields = form.querySelectorAll('[data-validate]');
        let isValid = true;
        
        fields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });
        
        // Check password confirmation
        const password = form.querySelector('input[name="password"]');
        const confirmPassword = form.querySelector('input[name="password_confirmation"]');
        
        if (password && confirmPassword && password.value !== confirmPassword.value) {
            this.showFieldError(confirmPassword, 'Passwords do not match');
            isValid = false;
        }
        
        return isValid;
    }
    
    /**
     * Show error for a specific field
     */
    showFieldError(field, message) {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');
        
        // Find or create error element
        let errorElement = field.parentNode.querySelector('.invalid-feedback');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback';
            field.parentNode.appendChild(errorElement);
        }
        
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    /**
     * Clear error for a specific field
     */
    clearFieldError(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        
        const errorElement = field.parentNode.querySelector('.invalid-feedback');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }
    
    /**
     * Setup password strength indicator
     */
    setupPasswordStrength() {
        const passwordFields = document.querySelectorAll('input[type="password"][data-validate="password"]');
        
        passwordFields.forEach(field => {
            const strengthIndicator = document.createElement('div');
            strengthIndicator.className = 'password-strength';
            field.parentNode.appendChild(strengthIndicator);
            
            field.addEventListener('input', () => {
                this.updatePasswordStrength(field, strengthIndicator);
            });
        });
    }
    
    /**
     * Update password strength indicator
     */
    updatePasswordStrength(field, indicator) {
        const password = field.value;
        let strength = 0;
        let feedback = '';
        
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[@$!%*?&]/.test(password)) strength++;
        
        switch (strength) {
            case 0:
            case 1:
                feedback = 'Very Weak';
                indicator.className = 'password-strength very-weak';
                break;
            case 2:
                feedback = 'Weak';
                indicator.className = 'password-strength weak';
                break;
            case 3:
                feedback = 'Fair';
                indicator.className = 'password-strength fair';
                break;
            case 4:
                feedback = 'Good';
                indicator.className = 'password-strength good';
                break;
            case 5:
                feedback = 'Strong';
                indicator.className = 'password-strength strong';
                break;
        }
        
        indicator.textContent = password ? `Password Strength: ${feedback}` : '';
    }
    
    /**
     * Setup amount formatting
     */
    setupAmountFormatting() {
        const amountFields = document.querySelectorAll('input[data-validate="amount"]');
        
        amountFields.forEach(field => {
            field.addEventListener('input', (e) => {
                let value = e.target.value.replace(/[₱,\s]/g, '');
                if (!isNaN(value) && value !== '') {
                    value = parseFloat(value);
                    e.target.value = value.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            });
        });
    }
    
    /**
     * Setup phone number formatting
     */
    setupPhoneFormatting() {
        const phoneFields = document.querySelectorAll('input[data-validate="philippine-phone"]');
        
        phoneFields.forEach(field => {
            field.addEventListener('input', (e) => {
                let value = e.target.value.replace(/[\s\-\(\)]/g, '');
                
                // Auto-format as user types
                if (value.startsWith('09') && value.length === 11) {
                    e.target.value = '+63 ' + value.substring(1, 4) + ' ' + value.substring(4, 7) + ' ' + value.substring(7);
                }
            });
        });
    }
    
    /**
     * Utility: Check if number is sequential
     */
    isSequentialNumber(number) {
        let ascending = true;
        let descending = true;
        
        for (let i = 1; i < number.length; i++) {
            if (parseInt(number[i]) !== (parseInt(number[i-1]) + 1) % 10) {
                ascending = false;
            }
            if (parseInt(number[i]) !== (parseInt(number[i-1]) - 1 + 10) % 10) {
                descending = false;
            }
        }
        
        return ascending || descending;
    }
    
    /**
     * Utility: Luhn algorithm for credit card validation
     */
    luhnCheck(cardNumber) {
        let sum = 0;
        let alternate = false;
        
        for (let i = cardNumber.length - 1; i >= 0; i--) {
            let digit = parseInt(cardNumber.charAt(i));
            
            if (alternate) {
                digit *= 2;
                if (digit > 9) {
                    digit = (digit % 10) + 1;
                }
            }
            
            sum += digit;
            alternate = !alternate;
        }
        
        return (sum % 10) === 0;
    }
    
    /**
     * Show form-level errors
     */
    showFormErrors(form) {
        const firstError = form.querySelector('.is-invalid');
        if (firstError) {
            firstError.focus();
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Initialize validation when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PIGGYValidator();
});

// Export for manual initialization
window.PIGGYValidator = PIGGYValidator;