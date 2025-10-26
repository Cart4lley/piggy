<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment - Piggy</title>

  <!-- Lalezar font -->
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

    /* ---- Payment Container ---- */
    .payment-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .payment-card {
      background: #FFFFFF;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.08);
      border: 1px solid #FFE6E6;
    }

    .card-header {
      text-align: center;
      margin-bottom: 40px;
      padding-bottom: 20px;
      border-bottom: 2px solid #FFE6E6;
    }

    .card-header h2 {
      color: #FF7B7B;
      margin-bottom: 10px;
      font-family: 'Lalezar', cursive;
      font-size: 28px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }

    .card-header p {
      color: #666;
      font-size: 16px;
      margin: 0;
    }

    /* ---- Payment Methods ---- */
    .payment-type-section {
      margin-bottom: 35px;
    }

    .payment-type-section h3 {
      color: #FF7B7B;
      font-family: 'Lalezar', cursive;
      font-size: 20px;
      margin-bottom: 20px;
    }

    .payment-methods {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .payment-method {
      flex: 1;
      min-width: 150px;
      padding: 20px;
      background: #F8F9FA;
      border: 2px solid #E9ECEF;
      border-radius: 12px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .payment-method:hover {
      background: #FFE6E6;
      border-color: #FFB6C1;
      transform: translateY(-2px);
    }

    .payment-method.active {
      background: #FF9898;
      border-color: #FF7B7B;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 152, 152, 0.3);
    }

    .payment-method i {
      font-size: 24px;
      color: inherit;
    }

    .payment-method span {
      font-weight: 600;
      font-size: 14px;
    }

    /* ---- Form Sections ---- */
    .card-payment-section,
    .bank-payment-section,
    .ewallet-payment-section,
    .amount-section {
      margin-bottom: 35px;
      padding: 25px;
      background: #FAFAFA;
      border-radius: 15px;
      border-left: 4px solid #FF9898;
    }

    .card-payment-section h3,
    .bank-payment-section h3,
    .ewallet-payment-section h3,
    .amount-section h3 {
      color: #FF7B7B;
      font-family: 'Lalezar', cursive;
      font-size: 18px;
      margin-bottom: 20px;
    }

    /* ---- Form Groups and Inputs ---- */
    .form-group {
      margin-bottom: 25px;
    }

    .form-row {
      display: flex;
      gap: 20px;
    }

    .form-row .form-group {
      flex: 1;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: 600;
      font-size: 14px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #E9ECEF;
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: #FFFFFF;
      box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #FF9898;
      box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
    }

    /* ---- Card Input Container ---- */
    .card-input-container {
      position: relative;
    }

    .card-input-container input {
      padding-right: 120px;
    }

    .card-icons {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      gap: 8px;
    }

    .card-icons i {
      font-size: 24px;
      opacity: 0.6;
    }

    .card-icons .fab.fa-cc-visa { color: #1a1f71; }
    .card-icons .fab.fa-cc-mastercard { color: #eb001b; }
    .card-icons .fab.fa-cc-amex { color: #006fcf; }

    /* ---- Amount Input Container ---- */
    .amount-input-container {
      position: relative;
    }

    .currency-symbol {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #FF7B7B;
      font-weight: bold;
      font-size: 18px;
    }

    .amount-input-container input {
      padding-left: 50px;
    }

    /* ---- E-Wallet Options ---- */
    .ewallet-options {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .ewallet-option {
      flex: 1;
    }

    .ewallet-option input[type="radio"] {
      display: none;
    }

    .ewallet-option label {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 15px 20px;
      border: 2px solid #E9ECEF;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: #FFFFFF;
    }

    .ewallet-option label:hover {
      border-color: #FFB6C1;
      background: #FFE6E6;
    }

    .ewallet-option input[type="radio"]:checked + label {
      border-color: #FF7B7B;
      background: #FF9898;
      color: white;
    }

    .ewallet-option img {
      width: 24px;
      height: 24px;
    }

    /* ---- Payment Summary ---- */
    .payment-summary {
      background: #F8F9FA;
      padding: 25px;
      border-radius: 15px;
      margin-bottom: 30px;
      border: 2px solid #E9ECEF;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 16px;
    }

    .summary-row.total {
      font-weight: bold;
      font-size: 18px;
      color: #FF7B7B;
    }

    .payment-summary hr {
      border: none;
      border-top: 2px solid #E9ECEF;
      margin: 15px 0;
    }

    /* ---- Pay Button ---- */
    .pay-btn {
      width: 100%;
      padding: 18px 30px;
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      border: none;
      border-radius: 15px;
      font-size: 18px;
      font-weight: bold;
      font-family: 'Lalezar', cursive;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      box-shadow: 0 5px 20px rgba(255, 152, 152, 0.3);
    }

    .pay-btn:hover {
      background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 152, 152, 0.4);
    }

    .pay-btn:active {
      transform: translateY(0);
      box-shadow: 0 3px 15px rgba(255, 152, 152, 0.3);
    }

    /* ---- Security Note ---- */
    .security-note {
      text-align: center;
      margin-top: 20px;
      color: #666;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .security-note i {
      color: #28a745;
    }

    /* ---- Responsive Design ---- */
    @media (max-width: 768px) {
      .payment-card {
        padding: 25px;
        margin: 10px;
      }
      
      .payment-methods {
        flex-direction: column;
      }
      
      .form-row {
        flex-direction: column;
        gap: 0;
      }
      
      .ewallet-options {
        flex-direction: column;
      }
    }
  </style>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Payment method switching
      const paymentMethods = document.querySelectorAll('.payment-method');
      const cardSection = document.getElementById('card-section');
      const bankSection = document.getElementById('bank-section');
      const ewalletSection = document.getElementById('ewallet-section');

      paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
          // Remove active class from all methods
          paymentMethods.forEach(m => m.classList.remove('active'));
          // Add active class to clicked method
          this.classList.add('active');

          // Hide all sections
          cardSection.style.display = 'none';
          bankSection.style.display = 'none';
          ewalletSection.style.display = 'none';

          // Show selected section
          const methodType = this.dataset.method;
          if (methodType === 'card') {
            cardSection.style.display = 'block';
          } else if (methodType === 'bank') {
            bankSection.style.display = 'block';
          } else if (methodType === 'ewallet') {
            ewalletSection.style.display = 'block';
          }
        });
      });

      // Card number formatting
      const cardNumberInput = document.getElementById('card-number');
      if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function() {
          let value = this.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
          let formattedInputValue = value.match(/.{1,4}/g)?.join(' ') || '';
          this.value = formattedInputValue;
        });
      }

      // Expiry date formatting
      const expiryInput = document.getElementById('expiry-date');
      if (expiryInput) {
        expiryInput.addEventListener('input', function() {
          let value = this.value.replace(/\D/g, '');
          if (value.length >= 2) {
            value = value.substring(0, 2) + '/' + value.substring(2, 4);
          }
          this.value = value;
        });
      }

      // CVV input validation
      const cvvInput = document.getElementById('cvv');
      if (cvvInput) {
        cvvInput.addEventListener('input', function() {
          this.value = this.value.replace(/[^0-9]/g, '');
        });
      }

      // Amount calculation
      const amountInput = document.getElementById('amount');
      const summaryAmount = document.getElementById('summary-amount');
      const processingFee = document.getElementById('processing-fee');
      const totalAmount = document.getElementById('total-amount');

      if (amountInput && summaryAmount && totalAmount) {
        amountInput.addEventListener('input', function() {
          const amount = parseFloat(this.value) || 0;
          const fee = 15.00;
          const total = amount + fee;

          summaryAmount.textContent = '₱' + amount.toFixed(2);
          totalAmount.textContent = '₱' + total.toFixed(2);
        });
      }

      // Mobile number formatting
      const mobileInput = document.getElementById('mobile-number');
      if (mobileInput) {
        mobileInput.addEventListener('input', function() {
          let value = this.value.replace(/[^0-9+]/g, '');
          if (value.startsWith('0')) {
            value = '+63' + value.substring(1);
          } else if (!value.startsWith('+63') && value.length > 0 && !value.startsWith('+')) {
            value = '+63' + value;
          }
          this.value = value;
        });
      }

      // Form validation
      const paymentForm = document.querySelector('.payment-form');
      if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const activeMethod = document.querySelector('.payment-method.active').dataset.method;
          const amount = parseFloat(document.getElementById('amount').value);
          
          if (!amount || amount <= 0) {
            alert('Please enter a valid amount');
            return;
          }

          if (activeMethod === 'card') {
            const cardNumber = document.getElementById('card-number').value;
            const expiry = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;
            const cardholderName = document.getElementById('cardholder-name').value;

            if (!cardNumber || !expiry || !cvv || !cardholderName) {
              alert('Please fill in all card details');
              return;
            }
          }

          // Show success message (you can replace this with actual form submission)
          alert('Payment processing... This is a demo.');
        });
      }
    });
  </script>
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
          <a href="/withdrawal" class="nav-link">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            Withdrawal
          </a>
        </li>
        <li class="nav-item">
          <a href="/payment" class="nav-link active">
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
      <h1 class="page-title">Payment</h1>
    </div>
    
    <div class="main-body">
      <div class="payment-container">
        <div class="payment-card">
          <div class="card-header">
            <h2><i class="fas fa-credit-card"></i> Make a Payment</h2>
            <p>Enter your payment details below</p>
          </div>
          
          <form class="payment-form" method="POST" action="#">
            @csrf
            
            <!-- Payment Type Selection -->
            <div class="payment-type-section">
              <h3>Payment Method</h3>
              <div class="payment-methods">
                <div class="payment-method active" data-method="card">
                  <i class="fas fa-credit-card"></i>
                  <span>Credit/Debit Card</span>
                </div>
                <div class="payment-method" data-method="bank">
                  <i class="fas fa-university"></i>
                  <span>Bank Transfer</span>
                </div>
                <div class="payment-method" data-method="ewallet">
                  <i class="fas fa-mobile-alt"></i>
                  <span>E-Wallet</span>
                </div>
              </div>
            </div>

            <!-- Card Payment Form -->
            <div class="card-payment-section" id="card-section">
              <h3>Card Information</h3>
              
              <div class="form-group">
                <label>Card Number</label>
                <div class="card-input-container">
                  <input type="text" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
                  <div class="card-icons">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label>Expiry Date</label>
                  <input type="text" id="expiry-date" placeholder="MM/YY" maxlength="5">
                </div>
                <div class="form-group">
                  <label>CVV</label>
                  <input type="text" id="cvv" placeholder="123" maxlength="4">
                </div>
              </div>

              <div class="form-group">
                <label>Cardholder Name</label>
                <input type="text" id="cardholder-name" placeholder="John Dela Cruz">
              </div>
            </div>

            <!-- Bank Transfer Section -->
            <div class="bank-payment-section" id="bank-section" style="display: none;">
              <h3>Bank Transfer Details</h3>
              <div class="form-group">
                <label>Select Bank</label>
                <select id="bank-select">
                  <option value="">Choose your bank</option>
                  <option value="bdo">BDO Unibank</option>
                  <option value="bpi">Bank of the Philippine Islands</option>
                  <option value="metrobank">Metrobank</option>
                  <option value="pnb">Philippine National Bank</option>
                  <option value="unionbank">UnionBank</option>
                </select>
              </div>
              <div class="form-group">
                <label>Account Number</label>
                <input type="text" id="account-number" placeholder="Enter your account number">
              </div>
            </div>

            <!-- E-Wallet Section -->
            <div class="ewallet-payment-section" id="ewallet-section" style="display: none;">
              <h3>E-Wallet Payment</h3>
              <div class="ewallet-options">
                <div class="ewallet-option">
                  <input type="radio" id="gcash" name="ewallet" value="gcash">
                  <label for="gcash">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwN0NGRiIvPgo8dGV4dCB4PSIxMiIgeT0iMTUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSI4IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+R0Nhc2g8L3RleHQ+Cjwvc3ZnPgo=" alt="GCash">
                    GCash
                  </label>
                </div>
                <div class="ewallet-option">
                  <input type="radio" id="paymaya" name="ewallet" value="paymaya">
                  <label for="paymaya">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiByeD0iNCIgZmlsbD0iIzAwRkY4NyIvPgo8dGV4dCB4PSIxMiIgeT0iMTUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSI3IiBmaWxsPSJ3aGl0ZSIgdGV4dC1hbmNob3I9Im1pZGRsZSI+UGF5TWF5YTwvdGV4dD4KPHN2Zz4K" alt="PayMaya">
                    PayMaya
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" id="mobile-number" placeholder="+63 912 345 6789">
              </div>
            </div>

            <!-- Payment Amount -->
            <div class="amount-section">
              <h3>Payment Amount</h3>
              <div class="form-group">
                <label>Amount (PHP)</label>
                <div class="amount-input-container">
                  <span class="currency-symbol">₱</span>
                  <input type="number" id="amount" placeholder="0.00" step="0.01" min="1">
                </div>
              </div>
              <div class="form-group">
                <label>Payment Description</label>
                <input type="text" id="description" placeholder="What is this payment for?">
              </div>
            </div>

            <!-- Payment Summary -->
            <div class="payment-summary">
              <div class="summary-row">
                <span>Amount:</span>
                <span id="summary-amount">₱0.00</span>
              </div>
              <div class="summary-row">
                <span>Processing Fee:</span>
                <span id="processing-fee">₱15.00</span>
              </div>
              <hr>
              <div class="summary-row total">
                <span>Total:</span>
                <span id="total-amount">₱15.00</span>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="pay-btn">
              <i class="fas fa-lock"></i>
              Complete Payment
            </button>

            <div class="security-note">
              <i class="fas fa-shield-alt"></i>
              Your payment information is encrypted and secure
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>