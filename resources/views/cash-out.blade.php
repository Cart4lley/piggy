<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Withdrawal - Piggy</title>

  <!-- Lalezar font -->
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/confirmation-modal.css') }}">

  <style>
    /* ---- Global Reset ---- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Lalezar', cursive;
      background: #FFE6E6;
      min-height: 100vh;
      display: flex;
    }

    /* ---- Sidebar ---- */
    .sidebar {
      width: 250px;
      background: #FFFFFF;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      z-index: 100;
    }

    .sidebar-header {
      padding: 20px;
      border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .brand-section {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .brand-icon {
      width: 45px;
      height: 45px;
    }

    .brand-title {
      font-size: 24px;
      font-weight: bold;
      color: #FF9898;
      letter-spacing: 1px;
    }

    .brand-subtitle {
      font-size: 10px;
      color: #FF9898;
      margin-top: -12px;
      letter-spacing: 0.5px;
    }

    .sidebar-nav {
      flex: 1;
      padding: 20px 0;
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid rgba(0,0,0,0.1);
    }

    /* ---- Navigation ---- */
    .nav-list {
      list-style: none;
      padding: 0 15px;
      margin: 0;
    }

    .nav-item {
      margin-bottom: 5px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px;
      color: #666;
      text-decoration: none;
      border-radius: 10px;
      transition: all 0.3s ease;
      font-size: 16px;
    }

    .nav-link:hover {
      background: #FFE6E6;
      color: #FF9898;
    }

    .nav-link.active {
      background: #FF9898;
      color: white;
    }

    .nav-icon {
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    .logout-btn {
      display: block;
      width: 100%;
      padding: 12px 20px;
      background: none;
      border: none;
      color: #FF9898;
      font-family: 'Lalezar', cursive;
      font-size: 16px;
      cursor: pointer;
      border-radius: 10px;
      transition: all 0.3s ease;
      text-align: center;
    }

    .logout-btn:hover {
      background: #FFE6E6;
    }

    /* ---- Withdrawal Form Styles ---- */
    .withdrawal-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .withdrawal-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .withdrawal-header h2 {
      color: #2d3748;
      margin-bottom: 8px;
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }

    .withdrawal-header p {
      color: #64748b;
      font-size: 1rem;
    }

    .balance-display {
      background: linear-gradient(135deg, #4f46e5, #7c3aed);
      color: white;
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      margin-bottom: 30px;
    }

    .balance-label {
      font-size: 0.9rem;
      opacity: 0.9;
      margin-bottom: 8px;
    }

    .balance-amount {
      font-size: 2rem;
      font-weight: 700;
      font-family: 'Courier New', monospace;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }

    .form-group label.required::after {
      content: ' *';
      color: #ef4444;
    }

    .form-group input, 
    .form-group select {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #ff9999;
      box-shadow: 0 0 0 3px rgba(255, 153, 153, 0.1);
    }

    .amount-input-wrapper {
      position: relative;
    }

    .currency-symbol {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #6b7280;
      font-weight: 600;
      pointer-events: none;
      z-index: 1;
    }

    .amount-input-wrapper input {
      padding-left: 40px;
      font-family: 'Courier New', monospace;
      text-align: right;
    }

    .invalid-feedback {
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 4px;
      display: none;
    }

    .form-help {
      color: #6b7280;
      font-size: 0.875rem;
      margin-top: 4px;
    }

    .quick-amounts {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      align-items: center;
      margin-bottom: 24px;
      padding: 16px;
      background: #f8fafc;
      border-radius: 8px;
    }

    .quick-label {
      font-weight: 600;
      color: #374151;
      margin-right: 8px;
    }

    .quick-btn {
      background: #ffffff;
      border: 2px solid #d1d5db;
      border-radius: 6px;
      padding: 8px 16px;
      font-size: 0.875rem;
      font-weight: 600;
      color: #374151;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .quick-btn:hover {
      border-color: #ff9999;
      background: #fff5f5;
      color: #ff9999;
    }

    .fee-info {
      background: #f0f9ff;
      border: 1px solid #0ea5e9;
      border-radius: 8px;
      padding: 16px;
      margin-bottom: 24px;
    }

    .fee-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
      font-size: 0.95rem;
    }

    .fee-row:last-child {
      margin-bottom: 0;
    }

    .fee-row.total {
      border-top: 1px solid #0ea5e9;
      padding-top: 12px;
      margin-top: 12px;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .fee-label {
      color: #0369a1;
    }

    .fee-amount {
      color: #0c4a6e;
      font-weight: 600;
      font-family: 'Courier New', monospace;
    }

    .form-actions {
      margin-top: 32px;
    }

    .withdraw-btn {
      width: 100%;
      background: linear-gradient(135deg, #ef4444, #dc2626);
      color: white;
      border: none;
      padding: 16px 24px;
      border-radius: 8px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .withdraw-btn:hover {
      background: linear-gradient(135deg, #dc2626, #b91c1c);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }

    .withdraw-btn:active {
      transform: translateY(0);
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .quick-amounts {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
      }

      .quick-btn {
        width: 100%;
        text-align: center;
      }

      .balance-amount {
        font-size: 1.5rem;
      }
    }

    /* ---- Main Content ---- */
    .main-content {
      flex: 1;
      background: #FFE6E6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .main-header {
      background: #FFE6E6;
      padding: 20px 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .main-body {
      flex: 1;
      padding: 30px;
    }

    .page-title {
      font-size: 28px;
      font-weight: bold;
      color: #333;
    }

    .card {
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border: 1px solid rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="brand-section">
        <img src="{{ asset('images/piggy-icon.png') }}" alt="Piggy Icon" class="brand-icon">
        <div class="brand-text">
          <div class="brand-title">PIGGY</div>
          <div class="brand-subtitle">we find ways</div>
        </div>
      </div>
    </div>
    
    <div class="sidebar-nav">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaction" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            Transaction
          </a>
        </li>
        <li class="nav-item">
          <a href="/withdrawal" class="nav-link active">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            Withdrawal
          </a>
        </li>
        <li class="nav-item">
          <a href="/payment" class="nav-link">
            <i class="nav-icon fas fa-credit-card"></i>
            Payment
          </a>
        </li>
        <li class="nav-item">
          <a href="/history" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            History
          </a>
        </li>
      </ul>
    </div>
    
    <div class="sidebar-footer">
      <button class="logout-btn">
        Log Out
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="main-header">
      <h1 class="page-title">Withdrawal</h1>
    </div>
    
    <div class="main-body">
      <div class="card">
        <div class="withdrawal-container">
          <div class="withdrawal-header">
            <h2><i class="fas fa-money-bill-wave"></i> Cash Withdrawal</h2>
            <p>Withdraw cash from your PIGGY account</p>
          </div>

          <form id="withdrawalForm" class="withdrawal-form" action="{{ route('withdrawal.process') }}" method="POST">
            @csrf
            
            <!-- Account Balance Display -->
            <div class="balance-display">
              <div class="balance-label">Available Balance</div>
              <div class="balance-amount">₱{{ number_format(auth()->user()->balance ?? 50000, 2) }}</div>
            </div>

            <!-- Withdrawal Method -->
            <div class="form-group">
              <label for="withdrawal_method" class="required">Withdrawal Method</label>
              <select id="withdrawal_method" name="withdrawal_method" required>
                <option value="">Select withdrawal method</option>
                <option value="atm">ATM Withdrawal</option>
                <option value="bank_counter">Bank Counter</option>
                <option value="partner_outlet">Partner Outlet</option>
              </select>
              <div class="invalid-feedback">Please select a withdrawal method</div>
            </div>

            <!-- Amount -->
            <div class="form-group">
              <label for="amount" class="required">Withdrawal Amount</label>
              <div class="amount-input-wrapper">
                <span class="currency-symbol">₱</span>
                <input type="number" id="amount" name="amount" 
                       placeholder="0.00" 
                       min="100" 
                       max="{{ auth()->user()->balance ?? 50000 }}" 
                       step="0.01" 
                       required
                       data-validate="required|min:100|max:{{ auth()->user()->balance ?? 50000 }}">
              </div>
              <div class="invalid-feedback">Please enter a valid withdrawal amount (₱100 minimum)</div>
              <div class="form-help">Minimum withdrawal: ₱100.00</div>
            </div>

            <!-- Quick Amount Buttons -->
            <div class="quick-amounts">
              <span class="quick-label">Quick amounts:</span>
              <button type="button" class="quick-btn" data-amount="500">₱500</button>
              <button type="button" class="quick-btn" data-amount="1000">₱1,000</button>
              <button type="button" class="quick-btn" data-amount="2000">₱2,000</button>
              <button type="button" class="quick-btn" data-amount="5000">₱5,000</button>
            </div>

            <!-- Purpose/Reason -->
            <div class="form-group">
              <label for="purpose">Purpose (Optional)</label>
              <select id="purpose" name="purpose">
                <option value="">Select purpose</option>
                <option value="personal_expense">Personal Expense</option>
                <option value="bills_payment">Bills Payment</option>
                <option value="emergency">Emergency</option>
                <option value="business">Business</option>
                <option value="other">Other</option>
              </select>
            </div>

            <!-- Fees Information -->
            <div class="fee-info">
              <div class="fee-row">
                <span class="fee-label">Transaction Fee:</span>
                <span class="fee-amount" id="transactionFee">₱15.00</span>
              </div>
              <div class="fee-row total">
                <span class="fee-label">Total Deduction:</span>
                <span class="fee-amount" id="totalDeduction">₱0.00</span>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
              <button type="submit" class="withdraw-btn">
                <i class="fas fa-money-bill-wave"></i>
                Proceed with Withdrawal
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="{{ asset('js/confirmation-modal.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('withdrawalForm');
      const amountInput = document.getElementById('amount');
      const methodSelect = document.getElementById('withdrawal_method');
      const totalDeductionElement = document.getElementById('totalDeduction');
      const quickBtns = document.querySelectorAll('.quick-btn');
      
      let transactionFee = 15; // Base fee
      
      // Quick amount buttons
      quickBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const amount = this.getAttribute('data-amount');
          amountInput.value = amount;
          updateFeeCalculation();
        });
      });
      
      // Amount input formatting and calculation
      amountInput.addEventListener('input', function() {
        updateFeeCalculation();
      });
      
      // Method selection affects fees
      methodSelect.addEventListener('change', function() {
        const method = this.value;
        switch (method) {
          case 'atm':
            transactionFee = 15;
            break;
          case 'bank_counter':
            transactionFee = 25;
            break;
          case 'partner_outlet':
            transactionFee = 20;
            break;
          default:
            transactionFee = 15;
        }
        document.getElementById('transactionFee').textContent = '₱' + transactionFee.toFixed(2);
        updateFeeCalculation();
      });
      
      function updateFeeCalculation() {
        const amount = parseFloat(amountInput.value) || 0;
        const total = amount + transactionFee;
        totalDeductionElement.textContent = '₱' + total.toLocaleString('en-PH', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        });
      }
      
      // Form submission with confirmation modal
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const amount = parseFloat(amountInput.value);
        const method = methodSelect.value;
        
        if (!amount || amount < 100) {
          showError(amountInput, 'Please enter a valid withdrawal amount (minimum ₱100)');
          return;
        }
        
        if (!method) {
          showError(methodSelect, 'Please select a withdrawal method');
          return;
        }
        
        // Get method display name
        const methodNames = {
          'atm': 'ATM Withdrawal',
          'bank_counter': 'Bank Counter Withdrawal',
          'partner_outlet': 'Partner Outlet Withdrawal'
        };
        
        // Show confirmation modal
        PIGGYTransactionConfirm.cashOut({
          amount: amount,
          fee: transactionFee,
          method: methodNames[method]
        }, function(pin) {
          return new Promise((resolve, reject) => {
            // Simulate PIN validation (replace with actual validation)
            if (pin && pin.length === 6) {
              // Add PIN to form data
              const pinInput = document.createElement('input');
              pinInput.type = 'hidden';
              pinInput.name = 'transaction_pin';
              pinInput.value = pin;
              form.appendChild(pinInput);
              
              // Submit the form
              setTimeout(() => {
                // Simulate processing delay
                console.log('Processing withdrawal...', {
                  amount: amount,
                  method: method,
                  fee: transactionFee,
                  pin: pin
                });
                
                // For demo - show success message
                showSuccessMessage();
                resolve();
              }, 2000);
            } else {
              reject(new Error('Invalid PIN'));
            }
          });
        });
      });
      
      function showError(element, message) {
        const feedback = element.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
          feedback.textContent = message;
          feedback.style.display = 'block';
          element.style.borderColor = '#ef4444';
        }
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
          if (feedback) {
            feedback.style.display = 'none';
            element.style.borderColor = '#d1d5db';
          }
        }, 3000);
      }
      
      function showSuccessMessage() {
        // Create success notification
        const successDiv = document.createElement('div');
        successDiv.style.cssText = `
          position: fixed;
          top: 20px;
          right: 20px;
          background: #10b981;
          color: white;
          padding: 16px 24px;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
          z-index: 10000;
          font-weight: 600;
        `;
        successDiv.innerHTML = '<i class="fas fa-check-circle"></i> Withdrawal request submitted successfully!';
        document.body.appendChild(successDiv);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
          document.body.removeChild(successDiv);
          // Reset form
          form.reset();
          updateFeeCalculation();
        }, 5000);
      }
      
      // Initialize fee calculation
      updateFeeCalculation();
    });
  </script>
</body>
</html>