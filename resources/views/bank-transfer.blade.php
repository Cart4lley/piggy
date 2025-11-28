<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transaction - Piggy</title>

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

    /* ---- Transfer Form Styles ---- */
    .transfer-container {
      max-width: 700px;
      margin: 0 auto;
    }

    .transfer-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .transfer-header h2 {
      color: #2d3748;
      margin-bottom: 8px;
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }

    .transfer-header p {
      color: #64748b;
      font-size: 1rem;
    }

    .balance-display {
      background: linear-gradient(135deg, #10b981, #059669);
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

    .fee-info {
      background: #ecfdf5;
      border: 1px solid #10b981;
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
      border-top: 1px solid #10b981;
      padding-top: 12px;
      margin-top: 12px;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .fee-label {
      color: #065f46;
    }

    .fee-amount {
      color: #047857;
      font-weight: 600;
      font-family: 'Courier New', monospace;
    }

    .form-actions {
      margin-top: 32px;
    }

    .transfer-btn {
      width: 100%;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
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

    .transfer-btn:hover {
      background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .transfer-btn:active {
      transform: translateY(0);
    }

    /* Account number formatting */
    #account_number {
      font-family: 'Courier New', monospace;
      letter-spacing: 1px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .balance-amount {
        font-size: 1.5rem;
      }

      .transfer-container {
        padding: 0 16px;
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
          <a href="/transaction" class="nav-link active">
            <i class="nav-icon fas fa-cog"></i>
            Transaction
          </a>
        </li>
        <li class="nav-item">
          <a href="/withdrawal" class="nav-link">
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
      <h1 class="page-title">Transaction</h1>
    </div>
    
    <div class="main-body">
      <div class="card">
        <div class="transfer-container">
          <div class="transfer-header">
            <h2><i class="fas fa-exchange-alt"></i> Bank Transfer</h2>
            <p>Transfer money to another bank account</p>
          </div>

          <form id="transferForm" class="transfer-form" action="{{ route('transfer.process') }}" method="POST">
            @csrf
            
            <!-- Account Balance Display -->
            <div class="balance-display">
              <div class="balance-label">Available Balance</div>
              <div class="balance-amount">₱{{ number_format(auth()->user()->balance ?? 50000, 2) }}</div>
            </div>

            <!-- Transfer Type -->
            <div class="form-group">
              <label for="transfer_type" class="required">Transfer Type</label>
              <select id="transfer_type" name="transfer_type" required>
                <option value="">Select transfer type</option>
                <option value="instapay">InstaPay (Fast Transfer)</option>
                <option value="pesonet">PESONet (Regular Transfer)</option>
                <option value="internal">PIGGY to PIGGY</option>
              </select>
              <div class="invalid-feedback">Please select a transfer type</div>
            </div>

            <!-- Recipient Bank -->
            <div class="form-group" id="bankGroup">
              <label for="recipient_bank" class="required">Recipient Bank</label>
              <select id="recipient_bank" name="recipient_bank" required>
                <option value="">Select bank</option>
                <option value="bdo">BDO Unibank</option>
                <option value="bpi">Bank of the Philippine Islands (BPI)</option>
                <option value="metrobank">Metrobank</option>
                <option value="security_bank">Security Bank</option>
                <option value="landbank">Land Bank of the Philippines</option>
                <option value="pnb">Philippine National Bank</option>
                <option value="unionbank">Union Bank</option>
                <option value="rcbc">Rizal Commercial Banking Corporation</option>
                <option value="eastwest">EastWest Bank</option>
                <option value="chinabank">China Banking Corporation</option>
              </select>
              <div class="invalid-feedback">Please select the recipient's bank</div>
            </div>

            <!-- Recipient Account Number -->
            <div class="form-group">
              <label for="account_number" class="required">Recipient Account Number</label>
              <input type="text" id="account_number" name="account_number" 
                     placeholder="Enter account number" 
                     required
                     data-validate="required|min:10|max:20|account_number">
              <div class="invalid-feedback">Please enter a valid account number</div>
            </div>

            <!-- Recipient Name -->
            <div class="form-group">
              <label for="recipient_name" class="required">Recipient Name</label>
              <input type="text" id="recipient_name" name="recipient_name" 
                     placeholder="Enter recipient's full name" 
                     required
                     data-validate="required|min:2|max:100|alpha_spaces">
              <div class="invalid-feedback">Please enter the recipient's name</div>
            </div>

            <!-- Transfer Amount -->
            <div class="form-group">
              <label for="amount" class="required">Transfer Amount</label>
              <div class="amount-input-wrapper">
                <span class="currency-symbol">₱</span>
                <input type="number" id="amount" name="amount" 
                       placeholder="0.00" 
                       min="1" 
                       max="{{ auth()->user()->balance ?? 50000 }}" 
                       step="0.01" 
                       required
                       data-validate="required|min:1|max:{{ auth()->user()->balance ?? 50000 }}">
              </div>
              <div class="invalid-feedback">Please enter a valid transfer amount</div>
              <div class="form-help">Minimum transfer: ₱1.00</div>
            </div>

            <!-- Reference Number (Optional) -->
            <div class="form-group">
              <label for="reference">Reference Number (Optional)</label>
              <input type="text" id="reference" name="reference" 
                     placeholder="Enter reference number or leave blank"
                     maxlength="20">
              <div class="form-help">For your tracking purposes</div>
            </div>

            <!-- Purpose -->
            <div class="form-group">
              <label for="purpose">Purpose</label>
              <select id="purpose" name="purpose">
                <option value="">Select purpose</option>
                <option value="family_support">Family Support</option>
                <option value="salary">Salary</option>
                <option value="business">Business Payment</option>
                <option value="bills">Bills Payment</option>
                <option value="investment">Investment</option>
                <option value="loan_payment">Loan Payment</option>
                <option value="personal">Personal</option>
                <option value="other">Other</option>
              </select>
            </div>

            <!-- Transfer Schedule -->
            <div class="form-group">
              <label for="schedule_type">Transfer Schedule</label>
              <select id="schedule_type" name="schedule_type">
                <option value="now">Send Now</option>
                <option value="scheduled">Schedule for Later</option>
              </select>
            </div>

            <!-- Scheduled Date (Hidden by default) -->
            <div class="form-group" id="scheduledDateGroup" style="display: none;">
              <label for="scheduled_date" class="required">Scheduled Date</label>
              <input type="datetime-local" id="scheduled_date" name="scheduled_date" 
                     min="{{ date('Y-m-d\TH:i') }}">
              <div class="invalid-feedback">Please select a valid future date</div>
            </div>

            <!-- Fees Information -->
            <div class="fee-info">
              <div class="fee-row">
                <span class="fee-label">Transfer Fee:</span>
                <span class="fee-amount" id="transferFee">₱0.00</span>
              </div>
              <div class="fee-row total">
                <span class="fee-label">Total Deduction:</span>
                <span class="fee-amount" id="totalDeduction">₱0.00</span>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
              <button type="submit" class="transfer-btn">
                <i class="fas fa-paper-plane"></i>
                Send Transfer
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
      const form = document.getElementById('transferForm');
      const transferTypeSelect = document.getElementById('transfer_type');
      const bankGroup = document.getElementById('bankGroup');
      const recipientBankSelect = document.getElementById('recipient_bank');
      const amountInput = document.getElementById('amount');
      const scheduleTypeSelect = document.getElementById('schedule_type');
      const scheduledDateGroup = document.getElementById('scheduledDateGroup');
      const transferFeeElement = document.getElementById('transferFee');
      const totalDeductionElement = document.getElementById('totalDeduction');
      
      let baseFee = 0;
      
      // Transfer type change handler
      transferTypeSelect.addEventListener('change', function() {
        const transferType = this.value;
        
        if (transferType === 'internal') {
          // PIGGY to PIGGY transfers don't need bank selection
          bankGroup.style.display = 'none';
          recipientBankSelect.required = false;
          baseFee = 0;
        } else {
          bankGroup.style.display = 'block';
          recipientBankSelect.required = true;
          
          // Set fees based on transfer type
          switch (transferType) {
            case 'instapay':
              baseFee = 25;
              break;
            case 'pesonet':
              baseFee = 15;
              break;
            default:
              baseFee = 0;
          }
        }
        
        updateFeeCalculation();
      });
      
      // Schedule type change handler
      scheduleTypeSelect.addEventListener('change', function() {
        if (this.value === 'scheduled') {
          scheduledDateGroup.style.display = 'block';
          document.getElementById('scheduled_date').required = true;
        } else {
          scheduledDateGroup.style.display = 'none';
          document.getElementById('scheduled_date').required = false;
        }
      });
      
      // Amount input handler
      amountInput.addEventListener('input', function() {
        updateFeeCalculation();
      });
      
      // Account number formatting
      document.getElementById('account_number').addEventListener('input', function(e) {
        // Remove any non-numeric characters
        let value = e.target.value.replace(/\D/g, '');
        
        // Limit to 20 digits
        if (value.length > 20) {
          value = value.substring(0, 20);
        }
        
        e.target.value = value;
      });
      
      function updateFeeCalculation() {
        const amount = parseFloat(amountInput.value) || 0;
        let totalFee = baseFee;
        
        // Add percentage fee for larger amounts
        if (amount > 50000) {
          totalFee += Math.ceil(amount * 0.001); // 0.1% for amounts over 50k
        }
        
        const total = amount + totalFee;
        
        transferFeeElement.textContent = '₱' + totalFee.toLocaleString('en-PH', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        });
        
        totalDeductionElement.textContent = '₱' + total.toLocaleString('en-PH', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        });
      }
      
      // Form submission with confirmation modal
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form values
        const transferType = transferTypeSelect.value;
        const recipientBank = recipientBankSelect.value;
        const accountNumber = document.getElementById('account_number').value;
        const recipientName = document.getElementById('recipient_name').value;
        const amount = parseFloat(amountInput.value);
        const reference = document.getElementById('reference').value;
        
        // Basic validation
        if (!transferType) {
          showError(transferTypeSelect, 'Please select a transfer type');
          return;
        }
        
        if (transferType !== 'internal' && !recipientBank) {
          showError(recipientBankSelect, 'Please select the recipient bank');
          return;
        }
        
        if (!accountNumber || accountNumber.length < 10) {
          showError(document.getElementById('account_number'), 'Please enter a valid account number');
          return;
        }
        
        if (!recipientName) {
          showError(document.getElementById('recipient_name'), 'Please enter the recipient name');
          return;
        }
        
        if (!amount || amount < 1) {
          showError(amountInput, 'Please enter a valid transfer amount');
          return;
        }
        
        // Get bank name for display
        const bankNames = {
          'bdo': 'BDO Unibank',
          'bpi': 'Bank of the Philippine Islands',
          'metrobank': 'Metrobank',
          'security_bank': 'Security Bank',
          'landbank': 'Land Bank of the Philippines',
          'pnb': 'Philippine National Bank',
          'unionbank': 'Union Bank',
          'rcbc': 'Rizal Commercial Banking Corporation',
          'eastwest': 'EastWest Bank',
          'chinabank': 'China Banking Corporation',
          'internal': 'PIGGY Bank'
        };
        
        const bankName = transferType === 'internal' ? 'PIGGY Bank' : bankNames[recipientBank];
        
        // Calculate final fee
        let finalFee = baseFee;
        if (amount > 50000) {
          finalFee += Math.ceil(amount * 0.001);
        }
        
        // Show confirmation modal
        PIGGYTransactionConfirm.bankTransfer({
          recipientName: recipientName,
          bankName: bankName,
          accountNumber: accountNumber,
          amount: amount,
          fee: finalFee,
          reference: reference || 'Auto-generated'
        }, function(pin) {
          return new Promise((resolve, reject) => {
            // Simulate PIN validation
            if (pin && pin.length === 6) {
              // Add PIN to form data
              const pinInput = document.createElement('input');
              pinInput.type = 'hidden';
              pinInput.name = 'transaction_pin';
              pinInput.value = pin;
              form.appendChild(pinInput);
              
              // Simulate processing
              setTimeout(() => {
                console.log('Processing transfer...', {
                  transferType,
                  recipientBank,
                  accountNumber,
                  recipientName,
                  amount,
                  fee: finalFee,
                  reference,
                  pin
                });
                
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
        successDiv.innerHTML = '<i class="fas fa-check-circle"></i> Transfer submitted successfully!';
        document.body.appendChild(successDiv);
        
        setTimeout(() => {
          document.body.removeChild(successDiv);
          form.reset();
          updateFeeCalculation();
          
          // Reset conditional fields
          bankGroup.style.display = 'block';
          scheduledDateGroup.style.display = 'none';
        }, 5000);
      }
      
      // Initialize
      updateFeeCalculation();
    });
  </script>
</body>
</html>