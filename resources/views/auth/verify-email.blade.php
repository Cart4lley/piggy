<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification - PIGGY Bank</title>
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
    }

    .verification-container {
      max-width: 500px;
      margin: 20px;
      padding: 40px;
      background: #FFFFFF;
      border-radius: 20px;
      box-shadow: 0 15px 50px rgba(0,0,0,0.1);
      text-align: center;
      border: 1px solid #FFE6E6;
    }

    .verification-icon {
      font-size: 80px;
      color: #FF9898;
      margin-bottom: 20px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }

    .verification-title {
      font-family: 'Lalezar', cursive;
      font-size: 28px;
      color: #FF7B7B;
      margin-bottom: 15px;
    }

    .verification-message {
      font-size: 16px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .verification-email {
      background: #FFE6E6;
      padding: 15px;
      border-radius: 10px;
      font-weight: 600;
      color: #FF7B7B;
      margin-bottom: 30px;
      word-break: break-word;
    }

    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .resend-btn {
      padding: 15px 30px;
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
      gap: 10px;
    }

    .resend-btn:hover {
      background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 152, 152, 0.4);
    }

    .resend-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .back-btn {
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

    .back-btn:hover {
      background: #E9ECEF;
      border-color: #DEE2E6;
      color: #495057;
    }

    .instructions {
      background: #F8F9FA;
      border-left: 4px solid #FF9898;
      padding: 20px;
      margin-top: 30px;
      border-radius: 0 10px 10px 0;
      text-align: left;
    }

    .instructions h4 {
      color: #FF7B7B;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .instructions ul {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
      padding-left: 20px;
    }

    .instructions li {
      margin-bottom: 5px;
    }

    .alert {
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .alert-success {
      background: #D4EDDA;
      color: #155724;
      border: 1px solid #C3E6CB;
    }

    .alert-warning {
      background: #FFF3CD;
      color: #856404;
      border: 1px solid #FFEAA7;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .verification-container {
        padding: 30px 20px;
        margin: 10px;
      }
      
      .verification-title {
        font-size: 24px;
      }
      
      .verification-icon {
        font-size: 60px;
      }
    }
  </style>
</head>
<body>
  <div class="verification-container">
    <!-- Success/Warning Messages -->
    @if(session('message'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('message') }}
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    @if(session('warning'))
      <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
      </div>
    @endif

    <!-- Verification Icon -->
    <div class="verification-icon">
      <i class="fas fa-envelope-circle-check"></i>
    </div>

    <!-- Title -->
    <h1 class="verification-title">Verify Your Email Address</h1>

    <!-- Message -->
    <p class="verification-message">
      Thanks for signing up with PIGGY Bank! Before getting started, please verify your email address by clicking on the link we just emailed to you.
    </p>

    <!-- Email Display -->
    <div class="verification-email">
      <i class="fas fa-envelope"></i> 
      @if(auth()->check())
        {{ auth()->user()->email }}
      @else
        Please sign in to view your email
      @endif
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
      <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="resend-btn">
          <i class="fas fa-paper-plane"></i>
          Resend Verification Email
        </button>
      </form>

      <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        Back to Home
      </a>
    </div>

    <!-- Instructions -->
    <div class="instructions">
      <h4><i class="fas fa-info-circle"></i> What to do next:</h4>
      <ul>
        <li>Check your email inbox for the verification message</li>
        <li>Don't forget to check your spam/junk folder</li>
        <li>Click the verification link in the email</li>
        <li>If you don't receive the email, click "Resend" above</li>
        <li>Contact support if you continue having issues</li>
      </ul>
    </div>
  </div>

  <script>
    // Auto-disable resend button temporarily after clicking
    const resendBtn = document.querySelector('.resend-btn');
    if (resendBtn) {
      resendBtn.addEventListener('click', function() {
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        
        setTimeout(() => {
          this.disabled = false;
          this.innerHTML = '<i class="fas fa-paper-plane"></i> Resend Verification Email';
        }, 5000);
      });
    }
  </script>
</body>
</html>