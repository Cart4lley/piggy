<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check Your Email - PIGGY Bank</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #FFE6E6, #FFDBDB, #FFE6E6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .success-container {
      max-width: 600px;
      width: 100%;
    }

    .success-card {
      background: #FFFFFF;
      border-radius: 20px;
      padding: 50px 40px;
      box-shadow: 0 15px 50px rgba(0,0,0,0.1);
      text-align: center;
      border: 1px solid #FFE6E6;
      position: relative;
      overflow: hidden;
    }

    .success-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #FF9898, #FF7B7B, #FFB6C1);
    }

    .success-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 30px;
      position: relative;
      animation: successPulse 2s ease-in-out infinite;
    }

    @keyframes successPulse {
      0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 152, 152, 0.7); }
      50% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(255, 152, 152, 0); }
    }

    .success-icon i {
      font-size: 50px;
      color: white;
    }

    .success-title {
      font-family: 'Lalezar', cursive;
      font-size: 32px;
      color: #FF7B7B;
      margin-bottom: 20px;
      letter-spacing: 1px;
    }

    .success-subtitle {
      font-size: 20px;
      color: #333;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .success-message {
      font-size: 16px;
      color: #666;
      line-height: 1.7;
      margin-bottom: 35px;
    }

    .email-info {
      background: #FFE6E6;
      border-radius: 15px;
      padding: 25px;
      margin: 30px 0;
      border-left: 5px solid #FF9898;
    }

    .email-address {
      font-size: 18px;
      font-weight: 600;
      color: #FF7B7B;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      word-break: break-all;
    }

    .email-status {
      font-size: 14px;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 35px;
    }

    .primary-btn {
      padding: 18px 35px;
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      text-decoration: none;
    }

    .primary-btn:hover {
      background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 152, 152, 0.4);
    }

    .secondary-btn {
      padding: 15px 30px;
      background: #F8F9FA;
      color: #666;
      border: 2px solid #E9ECEF;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .secondary-btn:hover {
      background: #E9ECEF;
      border-color: #DEE2E6;
      color: #495057;
      transform: translateY(-1px);
    }

    .instructions {
      background: #F8F9FA;
      border-radius: 15px;
      padding: 25px;
      margin-top: 35px;
      text-align: left;
      border: 1px solid #E9ECEF;
    }

    .instructions-title {
      font-weight: 700;
      color: #FF7B7B;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 16px;
    }

    .instructions-list {
      list-style: none;
      padding: 0;
    }

    .instructions-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 12px;
      color: #555;
      line-height: 1.6;
    }

    .instructions-list li i {
      color: #FF9898;
      margin-top: 2px;
      width: 16px;
    }

    .help-section {
      margin-top: 30px;
      padding-top: 25px;
      border-top: 2px solid #FFE6E6;
    }

    .help-text {
      font-size: 14px;
      color: #666;
      margin-bottom: 15px;
    }

    .help-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .help-link {
      color: #FF7B7B;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      padding: 8px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .help-link:hover {
      background: #FFE6E6;
      transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 600px) {
      .success-card {
        padding: 40px 25px;
        margin: 10px;
      }
      
      .success-title {
        font-size: 28px;
      }
      
      .success-icon {
        width: 80px;
        height: 80px;
      }
      
      .success-icon i {
        font-size: 40px;
      }
      
      .email-address {
        font-size: 16px;
        flex-direction: column;
        gap: 5px;
      }
      
      .help-links {
        flex-direction: column;
        align-items: center;
      }
    }

    /* Floating elements animation */
    .floating-elements {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      pointer-events: none;
    }

    .floating-element {
      position: absolute;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(10deg); }
    }
  </style>
</head>
<body>
  <div class="success-container">
    <div class="success-card">
      <!-- Floating Background Elements -->
      <div class="floating-elements">
        <i class="floating-element fas fa-envelope fa-2x"></i>
        <i class="floating-element fas fa-check-circle fa-2x"></i>
        <i class="floating-element fas fa-shield-alt fa-2x"></i>
      </div>

      <!-- Success Icon -->
      <div class="success-icon">
        <i class="fas fa-check"></i>
      </div>

      <!-- Main Content -->
      <h1 class="success-title">Registration Received!</h1>
      <h2 class="success-subtitle">Almost there! 🐷</h2>
      
      <p class="success-message">
        We've received your registration request. To complete your account creation and activate your PIGGY Bank account, please verify your email address.
      </p>

      <!-- Email Information -->
      <div class="email-info">
        <div class="email-address">
          <i class="fas fa-envelope"></i>
          {{ session('user_email', 'your registered email') }}
        </div>
        <div class="email-status">
          <i class="fas fa-clock"></i>
          Verification email sent • Complete registration within 24 hours
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="action-buttons">
        <a href="{{ route('registration.status') }}" class="primary-btn">
          <i class="fas fa-envelope-open"></i>
          Check Email Status
        </a>
        
        <a href="{{ route('signin') }}" class="secondary-btn">
          <i class="fas fa-sign-in-alt"></i>
          Go to Sign In
        </a>
      </div>

      <!-- Instructions -->
      <div class="instructions">
        <div class="instructions-title">
          <i class="fas fa-list-check"></i>
          What happens next?
        </div>
        <ul class="instructions-list">
          <li>
            <i class="fas fa-envelope"></i>
            <span>Check your email inbox for our verification message</span>
          </li>
          <li>
            <i class="fas fa-search"></i>
            <span>Don't forget to check your spam or junk mail folder</span>
          </li>
          <li>
            <i class="fas fa-mouse-pointer"></i>
            <span>Click the "Complete Registration" button in the email</span>
          </li>
          <li>
            <i class="fas fa-user-plus"></i>
            <span>Your PIGGY Bank account will be created automatically</span>
          </li>
          <li>
            <i class="fas fa-shield-check"></i>
            <span>Then you can sign in and start banking!</span>
          </li>
        </ul>
      </div>

      <!-- Help Section -->
      <div class="help-section">
        <p class="help-text">Need help or didn't receive the email?</p>
        <div class="help-links">
          <a href="{{ route('verification.notice') }}" class="help-link">
            <i class="fas fa-redo"></i> Resend Email
          </a>
          <a href="#" class="help-link">
            <i class="fas fa-question-circle"></i> Get Help
          </a>
          <a href="{{ route('register') }}" class="help-link">
            <i class="fas fa-edit"></i> Edit Registration
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Auto-redirect after a certain time (optional)
    setTimeout(function() {
      // Uncomment if you want auto-redirect after 30 seconds
      // window.location.href = '{{ route("verification.notice") }}';
    }, 30000);

    // Add some interactive elements
    document.addEventListener('DOMContentLoaded', function() {
      // Animate the success icon after page load
      setTimeout(function() {
        const successIcon = document.querySelector('.success-icon');
        successIcon.style.transform = 'scale(1.1)';
        setTimeout(function() {
          successIcon.style.transform = 'scale(1)';
        }, 200);
      }, 500);
    });
  </script>
</body>
</html>