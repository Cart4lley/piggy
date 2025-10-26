<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In - PIGGY Bank</title>

  <!-- Modern fonts -->
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
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
    }

    /* Animated background elements */
    .background-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .shape {
      position: absolute;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .shape:nth-child(2) { top: 20%; right: 10%; animation-delay: 2s; }
    .shape:nth-child(3) { bottom: 20%; left: 20%; animation-delay: 4s; }
    .shape:nth-child(4) { bottom: 10%; right: 20%; animation-delay: 1s; }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    .main-container {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      width: 100%;
      position: relative;
      z-index: 1;
      padding-left: 5%;
    }

    /* Sign in card */
    .signin-section {
      width: 100%;
      max-width: 480px;
    }

    .signin-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 48px 40px;
      box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.1),
        0 8px 25px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Header section */
    .signin-header {
      text-align: center;
      margin-bottom: 32px;
    }

    .logo-section {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      margin-bottom: 20px;
    }

    .logo-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: white;
    }

    .brand-name {
      font-family: 'Poppins', sans-serif;
      font-size: 28px;
      font-weight: 700;
      color: #2d3748;
      letter-spacing: -0.5px;
    }

    .signin-title {
      font-size: 24px;
      font-weight: 600;
      color: #2d3748;
      margin-bottom: 8px;
    }

    .signin-subtitle {
      color: #718096;
      font-size: 16px;
      font-weight: 400;
    }

    /* Form styling */
    .form-group {
      margin-bottom: 24px;
    }

    .form-label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-input {
      width: 100%;
      padding: 16px 20px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 16px;
      color: #2d3748;
      background: #ffffff;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    .form-input:focus {
      outline: none;
      border-color: #FF9898;
      box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
      transform: translateY(-1px);
    }

    .form-input::placeholder {
      color: #a0aec0;
    }

    /* Password field container */
    .password-field {
      position: relative;
    }

    .password-input {
      padding-right: 52px;
    }

    .password-toggle-btn {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #a0aec0;
      cursor: pointer;
      padding: 4px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .password-toggle-btn:hover {
      color: #FF9898;
      background: rgba(255, 152, 152, 0.1);
    }

    /* Form options */
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
    }

    .checkbox-container {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .checkbox-input {
      width: 18px;
      height: 18px;
      border: 2px solid #e2e8f0;
      border-radius: 4px;
      cursor: pointer;
      position: relative;
      appearance: none;
      background: white;
      transition: all 0.3s ease;
    }

    .checkbox-input:checked {
      background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
      border-color: #FF9898;
    }

    .checkbox-input:checked::after {
      content: '✓';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 12px;
      font-weight: bold;
    }

    .checkbox-label {
      color: #4a5568;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      user-select: none;
    }

    .forgot-link {
      color: #FF9898;
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      transition: color 0.3s ease;
    }

    .forgot-link:hover {
      color: #FF7B7B;
      text-decoration: underline;
    }


    /* Sign in button */
    .signin-button {
      width: 100%;
      padding: 16px 24px;
      background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
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
      gap: 8px;
      font-family: inherit;
      margin-bottom: 24px;
    }

    .signin-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(255, 152, 152, 0.3);
    }

    .signin-button:active {
      transform: translateY(0);
    }

    .signin-button:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    /* Back button */
    .back-button {
      position: absolute;
      top: 24px;
      left: 24px;
      background: rgba(255, 255, 255, 0.9);
      border: none;
      border-radius: 12px;
      width: 48px;
      height: 48px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      color: #4a5568;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      z-index: 10;
      backdrop-filter: blur(10px);
    }
    
    .back-button:hover {
      background: rgba(255, 255, 255, 1);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      color: #2d3748;
    }

    /* Corner Illustration - Absolutely positioned */
    .illustration-section {
      position: fixed;
      bottom: 0;
      right: 0;
      width: 600px;
      height: 600px;
      pointer-events: none;
      z-index: 0;
      overflow: hidden;
    }

    .illustration-container {
      position: absolute;
      bottom: -50px;
      right: -50px;
      width: 650px;
      height: 650px;
      display: flex;
      align-items: flex-end;
      justify-content: flex-end;
    }

    .piggy-image {
      width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: bottom right;
      opacity: 0.9;
      filter: drop-shadow(0 10px 30px rgba(255, 152, 152, 0.2));
    }

    /* Decorative elements */
    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
    }

    .floating-dollar {
      position: absolute;
      color: rgba(255, 255, 255, 0.8);
      font-size: 2rem;
      font-weight: bold;
      animation: floatUpDown 4s ease-in-out infinite;
    }

    .floating-dollar:nth-child(1) {
      top: 5%;
      right: 20%;
      animation-delay: 0s;
      font-size: 1.8rem;
    }

    .floating-dollar:nth-child(2) {
      top: 15%;
      right: 35%;
      animation-delay: 1s;
      font-size: 2.2rem;
    }

    .floating-dollar:nth-child(3) {
      top: 30%;
      right: 10%;
      animation-delay: 2s;
      font-size: 1.5rem;
    }

    .floating-dollar:nth-child(4) {
      top: 25%;
      right: 50%;
      animation-delay: 0.5s;
      font-size: 1.3rem;
    }

    .floating-dollar:nth-child(5) {
      top: 45%;
      right: 25%;
      animation-delay: 1.5s;
      font-size: 1.7rem;
    }

    @keyframes floatUpDown {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-15px); }
    }

    /* Register link */
    .register-section {
      text-align: center;
      padding-top: 24px;
      border-top: 1px solid #e2e8f0;
    }

    .register-text {
      color: #718096;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .register-link {
      color: #FF9898;
      text-decoration: none;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
      display: inline-block;
    }

    .register-link:hover {
      background: rgba(255, 152, 152, 0.1);
      color: #FF7B7B;
      transform: translateY(-1px);
    }

    /* Alert messages */
    .alert {
      padding: 16px 20px;
      border-radius: 12px;
      margin-bottom: 24px;
      font-size: 14px;
      line-height: 1.5;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .alert-error {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fecaca;
    }

    .alert-warning {
      background: #fffbeb;
      color: #d97706;
      border: 1px solid #fed7aa;
    }

    .alert-success {
      background: #f0fdf4;
      color: #16a34a;
      border: 1px solid #bbf7d0;
    }

    /* Responsive design */
    @media (max-width: 1024px) {
      .main-container {
        justify-content: center;
        padding-left: 0;
      }

      .illustration-section {
        width: 400px;
        height: 400px;
        opacity: 0.4;
      }

      .illustration-container {
        bottom: -30px;
        right: -30px;
        width: 450px;
        height: 450px;
      }

      .signin-section {
        z-index: 2;
        position: relative;
      }

      .signin-card {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(15px);
      }
    }

    @media (max-width: 640px) {
      body {
        padding: 16px;
      }

      .signin-card {
        padding: 32px 24px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
      }

      .back-button {
        top: 16px;
        left: 16px;
        z-index: 10;
      }

      .illustration-section {
        width: 250px;
        height: 250px;
        opacity: 0.25;
      }

      .illustration-container {
        bottom: -20px;
        right: -20px;
        width: 280px;
        height: 280px;
      }

      .brand-name {
        font-size: 24px;
      }

      .signin-title {
        font-size: 20px;
      }

      .floating-dollar {
        font-size: 1rem !important;
      }
    }
  </style>
</head>
<body>
  <!-- Animated background shapes -->
  <div class="background-shapes">
    <div class="shape">🐷</div>
    <div class="shape">💰</div>
    <div class="shape">🏦</div>
    <div class="shape">💳</div>
  </div>

  <!-- Back button -->
  <a href="{{ url('/') }}" class="back-button" title="Back to Home">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="main-container">
    <!-- Sign in card section -->
    <div class="signin-section">
      <div class="signin-card">
        <!-- Header -->
        <div class="signin-header">
          <div class="logo-section">
            <div class="logo-icon">
              🐷
            </div>
            <div class="brand-name">PIGGY</div>
          </div>
          <h1 class="signin-title">Welcome Back!</h1>
          <p class="signin-subtitle">Sign in to your PIGGY Bank account</p>
        </div>
        
        <!-- Error Messages -->
        @if($errors->any())
          <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>
              @foreach($errors->all() as $error)
                {{ $error }}
              @endforeach
            </span>
          </div>
        @endif

        @if(session('warning'))
          <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ session('warning') }}</span>
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif
        
        <!-- Sign in form -->
        <form method="POST" action="{{ route('signin.submit') }}">
          @csrf
          
          <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" id="email" name="email" class="form-input" 
                   value="{{ old('email') }}" 
                   placeholder="Enter your email" required>
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-field">
              <input type="password" id="password" name="password" 
                     class="form-input password-input" 
                     placeholder="Enter your password" required>
              <button type="button" class="password-toggle-btn" onclick="togglePassword()">
                <i class="fas fa-eye" id="toggle-icon"></i>
              </button>
            </div>
          </div>

          <div class="form-options">
            <div class="checkbox-container">
              <input type="checkbox" id="remember-me" name="remember" class="checkbox-input">
              <label for="remember-me" class="checkbox-label">Remember me</label>
            </div>
            <a href="#" class="forgot-link">Forgot password?</a>
          </div>

          <button type="submit" class="signin-button">
            <span>Sign In</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </form>

        <!-- Register section -->
        <div class="register-section">
          <p class="register-text">Don't have an account?</p>
          <a href="{{ url('/register') }}" class="register-link">Create Account</a>
        </div>
      </div>
    </div>

    <!-- Illustration section -->
    <div class="illustration-section">
      <div class="illustration-container">
        <img src="{{ asset('images/pigbank.png') }}" alt="PIGGY Bank" class="piggy-image">
        <div class="floating-elements">
          <div class="floating-dollar">$</div>
          <div class="floating-dollar">$</div>
          <div class="floating-dollar">$</div>
          <div class="floating-dollar">$</div>
          <div class="floating-dollar">$</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggle-icon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>