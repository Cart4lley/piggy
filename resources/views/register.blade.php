<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - PIGGY Bank</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #ff9999 0%, #ffb3b3 50%, #ffc9c9 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23FFD3D3" stop-opacity="0.15"/><stop offset="100%" stop-color="%23FFD3D3" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="200" fill="url(%23a)"/><circle cx="400" cy="700" r="100" fill="url(%23a)"/><circle cx="900" cy="800" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
      background-size: cover;
      pointer-events: none;
    }

    .container {
      width: 100%;
      max-width: 1200px;
      position: relative;
      z-index: 1;
    }

    .registration-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      min-height: 90vh;
    }

    /* Brand Side */
    .brand-side {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px;
      color: white;
    }



    .brand-text h1 {
      font-family: 'Lalezar', sans-serif;
      font-size: 48px;
      font-weight: normal;
      margin: 0;
      color: white;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .brand-text p {
      font-family: 'Lalezar', sans-serif;
      font-size: 16px;
      font-weight: normal;
      color: #FFD3D3;
      margin: -8px 0 0 0;
      letter-spacing: 2px;
    }

    .brand-features {
      margin-top: 60px;
    }

    .brand-features h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 30px;
      font-family: 'Poppins', sans-serif;
    }

    .feature-list {
      list-style: none;
      padding: 0;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
      padding: 16px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      backdrop-filter: blur(10px);
    }

    .feature-item i {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #ff9999 0%, #ff7a7a 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 18px;
      box-shadow: 0 4px 12px rgba(255, 153, 153, 0.3);
    }

    .feature-text h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .feature-text p {
      font-size: 14px;
      opacity: 0.8;
      margin: 0;
    }

    /* Form Side */
    .form-side {
      padding: 20px;
    }

    .register-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 48px 40px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.2);
      position: relative;
      overflow: hidden;
      max-height: 85vh;
      overflow-y: auto;
    }

    .register-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #ff9999 0%, #ff7a7a 50%, #FFD3D3 100%);
    }

    .form-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .form-header h2 {
      font-family: 'Poppins', sans-serif;
      font-size: 32px;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 8px;
    }

    .form-header p {
      color: #718096;
      font-size: 16px;
      font-weight: 400;
    }

    .progress-container {
      margin-bottom: 40px;
    }

    .progress-bar {
      width: 100%;
      height: 6px;
      background: #e2e8f0;
      border-radius: 3px;
      overflow: hidden;
      margin-bottom: 16px;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, #ff9999 0%, #ff7a7a 100%);
      border-radius: 3px;
      transition: width 0.3s ease;
      width: 25%;
    }

    .progress-text {
      text-align: center;
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
    }

    /* Form Sections */
    .form-section {
      margin-bottom: 40px;
    }

    .section-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 24px;
      padding-bottom: 12px;
      border-bottom: 2px solid #e2e8f0;
    }

    .section-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #ff9999 0%, #ff7a7a 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
      box-shadow: 0 4px 12px rgba(255, 153, 153, 0.3);
    }

    .section-title {
      font-size: 20px;
      color: #1a202c;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }

    .section-subtitle {
      font-size: 14px;
      color: #718096;
      margin: 4px 0 0 0;
    }

    /* Form Controls */
    .form-group {
      margin-bottom: 24px;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      font-size: 14px;
      color: #374151;
    }

    .required {
      color: #ef4444;
      margin-left: 2px;
    }

    .input-group {
      position: relative;
    }

    .form-input, .form-select {
      width: 100%;
      padding: 16px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 16px;
      font-family: 'Inter', sans-serif;
      background: #ffffff;
      color: #111827;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    .form-input.has-icon {
      padding-left: 48px;
    }

    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 16px;
    }

    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: #ff9999;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      transform: translateY(-2px);
    }

    .form-input::placeholder {
      color: #9ca3af;
      font-weight: 400;
    }

    .form-select {
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 12px center;
      background-repeat: no-repeat;
      background-size: 16px;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    /* Password Container */
    .password-container {
      position: relative;
    }

    .password-input {
      width: 100%;
      padding: 16px 50px 16px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 16px;
      font-family: 'Inter', sans-serif;
      background: #ffffff;
      color: #111827;
      transition: all 0.3s ease;
    }

    .password-input:focus {
      outline: none;
      border-color: #ff9999;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      transform: translateY(-2px);
    }

    .password-toggle {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #9ca3af;
      cursor: pointer;
      font-size: 18px;
      padding: 8px;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .password-toggle:hover {
      color: #ff9999;
      background: rgba(102, 126, 234, 0.1);
    }

    .password-strength {
      margin-top: 8px;
      height: 4px;
      background: #e5e7eb;
      border-radius: 2px;
      overflow: hidden;
    }

    .strength-bar {
      height: 100%;
      border-radius: 2px;
      transition: all 0.3s ease;
      width: 0%;
    }

    .strength-weak { background: #ef4444; width: 25%; }
    .strength-fair { background: #f97316; width: 50%; }
    .strength-good { background: #eab308; width: 75%; }
    .strength-strong { background: #22c55e; width: 100%; }

    .password-strength-text {
      margin-top: 8px;
      font-size: 12px;
      font-weight: 500;
      text-align: center;
    }

    /* Checkbox Styling */
    .checkbox-group {
      margin-bottom: 24px;
    }

    .checkbox-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 16px;
      padding: 16px;
      background: #f8fafc;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .checkbox-item:hover {
      background: #f1f5f9;
      border-color: #cbd5e1;
    }

    .checkbox-item.checked {
      background: rgba(102, 126, 234, 0.05);
      border-color: #ff9999;
    }

    .custom-checkbox {
      position: relative;
      width: 20px;
      height: 20px;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .custom-checkbox input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background: #ffffff;
      border: 2px solid #d1d5db;
      border-radius: 6px;
      transition: all 0.2s ease;
    }

    .custom-checkbox input:checked ~ .checkmark {
      background: #ff9999;
      border-color: #ff9999;
    }

    .checkmark::after {
      content: "";
      position: absolute;
      display: none;
      left: 6px;
      top: 2px;
      width: 6px;
      height: 10px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    .custom-checkbox input:checked ~ .checkmark::after {
      display: block;
    }

    .checkbox-text {
      color: #374151;
      font-size: 14px;
      line-height: 1.5;
      font-weight: 400;
    }

    .checkbox-text a {
      color: #ff9999;
      text-decoration: none;
      font-weight: 500;
    }

    .checkbox-text a:hover {
      color: #5a67d8;
      text-decoration: underline;
    }

    /* Submit Button */
    .submit-button {
      width: 100%;
      padding: 18px 24px;
      background: linear-gradient(135deg, #ff9999 0%, #ff7a7a 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
      overflow: hidden;
    }

    .submit-button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.6s ease;
    }

    .submit-button:hover::before {
      left: 100%;
    }

    .submit-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    }

    .submit-button:active {
      transform: translateY(-1px);
    }

    .submit-button i {
      margin-left: 8px;
    }

    /* Footer */
    .form-footer {
      text-align: center;
      margin-top: 32px;
      padding-top: 24px;
      border-top: 1px solid #e5e7eb;
    }

    .login-link {
      color: #6b7280;
      font-size: 15px;
      font-weight: 400;
    }

    .login-link a {
      color: #ff9999;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .login-link a:hover {
      color: #5a67d8;
    }

    /* Alert Messages */
    .alert {
      padding: 16px 20px;
      border-radius: 12px;
      margin-bottom: 24px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      font-size: 14px;
      font-weight: 500;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #bbf7d0;
    }

    .alert-error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    .alert ul {
      margin: 0;
      padding-left: 16px;
    }

    .alert li {
      margin-bottom: 4px;
    }

    /* Back Button */
    .back-button {
      position: fixed;
      top: 24px;
      left: 24px;
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      color: #374151;
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;
      transition: all 0.3s ease;
      z-index: 100;
    }

    .back-button:hover {
      background: white;
      color: #ff9999;
      transform: translateX(-4px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Error Messages */
    .error-message {
      display: none;
      margin-top: 8px;
      padding: 8px 12px;
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 8px;
      color: #dc2626;
      font-size: 14px;
      font-weight: 500;
    }

    .error-message.show {
      display: block;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .registration-layout {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .brand-side {
        order: 2;
        padding: 20px;
        text-align: center;
      }

      .form-side {
        order: 1;
      }

      .brand-features {
        margin-top: 40px;
      }

      .feature-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
      }
    }

    @media (max-width: 768px) {
      body {
        padding: 10px;
      }

      .container {
        max-width: 100%;
      }

      .registration-layout {
        gap: 20px;
      }

      .brand-side {
        padding: 20px 10px;
      }

      .brand-text h1 {
        font-size: 36px;
      }

      .brand-features h2 {
        font-size: 24px;
      }

      .register-card {
        padding: 32px 24px;
      }

      .form-header h2 {
        font-size: 24px;
      }

      .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .feature-list {
        grid-template-columns: 1fr;
      }

      .back-button {
        top: 16px;
        left: 16px;
        padding: 8px 12px;
        font-size: 12px;
      }
    }

    @media (max-width: 480px) {
      .register-card {
        padding: 24px 16px;
        border-radius: 16px;
      }

      .form-header h2 {
        font-size: 20px;
      }

      .brand-text h1 {
        font-size: 28px;
      }

      .section-title {
        font-size: 16px;
      }

      .form-input, .form-select, .password-input {
        padding: 14px 16px;
        font-size: 14px;
      }

      .submit-button {
        padding: 16px 20px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <!-- Back Button -->
  <a href="{{ url('/') }}" class="back-button">
    <i class="fas fa-arrow-left"></i>
    Back to Home
  </a>

  <div class="container">
    <div class="registration-layout">
      <!-- Left Side - Brand Information -->
      <div class="brand-side">        
        <div class="brand-features">
          <h2>Join thousands of satisfied customers</h2>
          <ul class="feature-list">
            <li class="feature-item">
              <i class="fas fa-shield-alt"></i>
              <div class="feature-text">
                <h3>Bank-Level Security</h3>
                <p>Your data is protected with 256-bit encryption</p>
              </div>
            </li>
            <li class="feature-item">
              <i class="fas fa-mobile-alt"></i>
              <div class="feature-text">
                <h3>Mobile Banking</h3>
                <p>Access your account anywhere, anytime</p>
              </div>
            </li>
            <li class="feature-item">
              <i class="fas fa-chart-line"></i>
              <div class="feature-text">
                <h3>Smart Analytics</h3>
                <p>Track your spending with detailed insights</p>
              </div>
            </li>
            <li class="feature-item">
              <i class="fas fa-headset"></i>
              <div class="feature-text">
                <h3>24/7 Support</h3>
                <p>Get help whenever you need it</p>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <!-- Right Side - Registration Form -->
      <div class="form-side">
        <div class="register-card">
          <div class="form-header">
            <h2>Create Your Account</h2>
            <p>Join PIGGY Bank today and start your financial journey</p>
          </div>

          <!-- Progress Indicator -->
          <div class="progress-container">
            <div class="progress-bar">
              <div class="progress-fill" id="progressFill"></div>
            </div>
            <div class="progress-text" id="progressText">Complete the form below</div>
          </div>

          <!-- Success/Error Messages -->
          @if(session('success'))
            <div class="alert alert-success">
              <i class="fas fa-check-circle"></i>
              {{ session('success') }}
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-error">
              <i class="fas fa-exclamation-circle"></i>
              {{ session('error') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-error">
              <i class="fas fa-exclamation-triangle"></i>
              <strong>Please fix the following errors:</strong>
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Personal Information -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="fas fa-user"></i>
                </div>
                <div>
                  <div class="section-title">Personal Information</div>
                  <div class="section-subtitle">Tell us about yourself</div>
                </div>
              </div>
              
              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="first_name">First Name <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-user"></i>
                    <input type="text" class="form-input has-icon" id="first_name" name="first_name" 
                           value="{{ old('first_name') }}" placeholder="Juan" required>
                  </div>
                  <div class="error-message" id="first-name-error"></div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="last_name">Last Name <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-user"></i>
                    <input type="text" class="form-input has-icon" id="last_name" name="last_name" 
                           value="{{ old('last_name') }}" placeholder="Dela Cruz" required>
                  </div>
                  <div class="error-message" id="last-name-error"></div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="date_of_birth">Date of Birth <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-calendar"></i>
                    <input type="date" class="form-input has-icon" id="date_of_birth" name="date_of_birth" 
                           value="{{ old('date_of_birth') }}" required>
                  </div>
                  <div class="error-message" id="dob-error"></div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="gender">Gender</label>
                  <select class="form-select" id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    <option value="prefer-not-to-say" {{ old('gender') == 'prefer-not-to-say' ? 'selected' : '' }}>Prefer not to say</option>
                  </select>
                  <div class="error-message" id="gender-error"></div>
                </div>
              </div>
            </div>

            <!-- Contact Information -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="fas fa-envelope"></i>
                </div>
                <div>
                  <div class="section-title">Contact Information</div>
                  <div class="section-subtitle">How can we reach you?</div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="email">Email Address <span class="required">*</span></label>
                <div class="input-group">
                  <i class="input-icon fas fa-envelope"></i>
                  <input type="email" class="form-input has-icon" id="email" name="email" 
                         value="{{ old('email') }}" placeholder="juan.delacruz@gmail.com" required>
                </div>
                <div class="error-message" id="email-error"></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="phone">Phone Number <span class="required">*</span></label>
                <div class="input-group">
                  <i class="input-icon fas fa-phone"></i>
                  <input type="tel" class="form-input has-icon" id="phone" name="phone" 
                         value="{{ old('phone') }}" placeholder="+63 912 345 6789" required>
                </div>
                <div class="error-message" id="phone-error"></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="address">Home Address <span class="required">*</span></label>
                <div class="input-group">
                  <i class="input-icon fas fa-map-marker-alt"></i>
                  <input type="text" class="form-input has-icon" id="address" name="address" 
                         value="{{ old('address') }}" placeholder="123 Rizal Street, Barangay San Antonio" required>
                </div>
                <div class="error-message" id="address-error"></div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="city">City <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-city"></i>
                    <input type="text" class="form-input has-icon" id="city" name="city" 
                           value="{{ old('city') }}" placeholder="Makati City" required>
                  </div>
                  <div class="error-message" id="city-error"></div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="zip_code">ZIP Code <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-mail-bulk"></i>
                    <input type="text" class="form-input has-icon" id="zip_code" name="zip_code" 
                           value="{{ old('zip_code') }}" placeholder="1200" required>
                  </div>
                  <div class="error-message" id="zip-error"></div>
                </div>
              </div>
            </div>

            <!-- Employment Information -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="fas fa-briefcase"></i>
                </div>
                <div>
                  <div class="section-title">Employment Information</div>
                  <div class="section-subtitle">Tell us about your work</div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="occupation">Occupation <span class="required">*</span></label>
                <div class="input-group">
                  <i class="input-icon fas fa-user-tie"></i>
                  <input type="text" class="form-input has-icon" id="occupation" name="occupation" 
                         value="{{ old('occupation') }}" placeholder="Software Engineer, Teacher, etc." required>
                </div>
                <div class="error-message" id="occupation-error"></div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label class="form-label" for="employment_status">Employment Status <span class="required">*</span></label>
                  <select class="form-select" id="employment_status" name="employment_status" required>
                    <option value="">Select Status</option>
                    <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>Employed</option>
                    <option value="self-employed" {{ old('employment_status') == 'self-employed' ? 'selected' : '' }}>Self-Employed</option>
                    <option value="student" {{ old('employment_status') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                    <option value="retired" {{ old('employment_status') == 'retired' ? 'selected' : '' }}>Retired</option>
                  </select>
                  <div class="error-message" id="employment-error"></div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="monthly_income">Monthly Income (PHP) <span class="required">*</span></label>
                  <div class="input-group">
                    <i class="input-icon fas fa-peso-sign"></i>
                    <input type="number" class="form-input has-icon" id="monthly_income" name="monthly_income" 
                           value="{{ old('monthly_income') }}" min="0" max="10000000" step="0.01" placeholder="25000.00" required>
                  </div>
                  <div class="error-message" id="income-error"></div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="employer_name">Employer/Company Name</label>
                <div class="input-group">
                  <i class="input-icon fas fa-building"></i>
                  <input type="text" class="form-input has-icon" id="employer_name" name="employer_name" 
                         value="{{ old('employer_name') }}" placeholder="Ayala Corporation">
                </div>
              </div>
            </div>

            <!-- Account Security -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="fas fa-lock"></i>
                </div>
                <div>
                  <div class="section-title">Account Security</div>
                  <div class="section-subtitle">Create your login credentials</div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label" for="username">Username <span class="required">*</span></label>
                <div class="input-group">
                  <i class="input-icon fas fa-at"></i>
                  <input type="text" class="form-input has-icon" id="username" name="username" 
                         value="{{ old('username') }}" placeholder="jdelacruz123" required>
                </div>
                <div class="error-message" id="username-error"></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="password">Password <span class="required">*</span></label>
                <div class="password-container">
                  <input type="password" class="password-input" id="password" name="password" 
                         placeholder="Create a strong password" required>
                  <button type="button" class="password-toggle" onclick="togglePassword('password')">
                    <i class="fas fa-eye" id="password-toggle-icon"></i>
                  </button>
                </div>
                <div class="password-strength">
                  <div class="strength-bar" id="strength-bar"></div>
                </div>
                <div class="password-strength-text" id="strength-text"></div>
                <div class="error-message" id="password-error"></div>
              </div>

              <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password <span class="required">*</span></label>
                <div class="password-container">
                  <input type="password" class="password-input" id="password_confirmation" name="password_confirmation" 
                         placeholder="Confirm your password" required>
                  <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye" id="password_confirmation-toggle-icon"></i>
                  </button>
                </div>
                <div class="error-message" id="confirm-password-error"></div>
              </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="fas fa-file-contract"></i>
                </div>
                <div>
                  <div class="section-title">Terms & Conditions</div>
                  <div class="section-subtitle">Please review and accept</div>
                </div>
              </div>

              <div class="checkbox-group">
                <div class="checkbox-item">
                  <div class="custom-checkbox">
                    <input type="checkbox" id="terms_agreement" name="terms_agreement" {{ old('terms_agreement') ? 'checked' : '' }} required>
                    <span class="checkmark"></span>
                  </div>
                  <div class="checkbox-text">
                    I agree to the <a href="#" target="_blank">Terms & Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>. I understand that this is a demo banking system for educational purposes. <span class="required">*</span>
                  </div>
                </div>

                <div class="checkbox-item">
                  <div class="custom-checkbox">
                    <input type="checkbox" id="marketing_consent" name="marketing_consent" {{ old('marketing_consent') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                  </div>
                  <div class="checkbox-text">
                    I consent to receive marketing communications and promotional offers from PIGGY Banking.
                  </div>
                </div>

                <div class="checkbox-item">
                  <div class="custom-checkbox">
                    <input type="checkbox" id="age_verification" name="age_verification" {{ old('age_verification') ? 'checked' : '' }} required>
                    <span class="checkmark"></span>
                  </div>
                  <div class="checkbox-text">
                    I confirm that I am at least 18 years old and legally eligible to open a bank account. <span class="required">*</span>
                  </div>
                </div>
              </div>
            </div>

            <button type="submit" class="submit-button">
              Create Account <i class="fas fa-arrow-right"></i>
            </button>
          </form>

          <div class="form-footer">
            <div class="login-link">
              Already have an account? <a href="{{ route('signin') }}">Sign In Here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Password visibility toggle
    function togglePassword(fieldId) {
      const passwordInput = document.getElementById(fieldId);
      const toggleIcon = document.getElementById(fieldId + '-toggle-icon');
      
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

    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
      const password = this.value;
      const strengthBar = document.getElementById('strength-bar');
      const strengthText = document.getElementById('strength-text');
      
      let strength = 0;
      let strengthLevel = '';
      
      // Check password criteria
      if (password.length >= 8) strength += 25;
      if (/[A-Z]/.test(password)) strength += 25;
      if (/[a-z]/.test(password)) strength += 25;
      if (/\d/.test(password)) strength += 25;
      
      // Update strength bar and text
      strengthBar.className = 'strength-bar';
      strengthText.className = 'password-strength-text';
      
      if (strength === 0) {
        strengthLevel = '';
      } else if (strength <= 25) {
        strengthBar.classList.add('strength-weak');
        strengthText.classList.add('strength-weak-text');
        strengthLevel = 'Weak';
      } else if (strength <= 50) {
        strengthBar.classList.add('strength-fair');
        strengthText.classList.add('strength-fair-text');
        strengthLevel = 'Fair';
      } else if (strength <= 75) {
        strengthBar.classList.add('strength-good');
        strengthText.classList.add('strength-good-text');
        strengthLevel = 'Good';
      } else {
        strengthBar.classList.add('strength-strong');
        strengthText.classList.add('strength-strong-text');
        strengthLevel = 'Strong';
      }
      
      strengthText.textContent = strengthLevel;
    });

    // Checkbox interactions
    document.querySelectorAll('.checkbox-item').forEach(item => {
      item.addEventListener('click', function(e) {
        if (e.target.type !== 'checkbox' && e.target.tagName !== 'A') {
          const checkbox = this.querySelector('input[type="checkbox"]');
          checkbox.checked = !checkbox.checked;
          updateCheckboxState(checkbox);
        }
      });
    });

    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        updateCheckboxState(this);
      });
    });

    function updateCheckboxState(checkbox) {
      const checkboxItem = checkbox.closest('.checkbox-item');
      if (checkbox.checked) {
        checkboxItem.classList.add('checked');
      } else {
        checkboxItem.classList.remove('checked');
      }
      updateProgress();
    }

    // Form progress tracking
    function updateProgress() {
      const form = document.getElementById('register-form');
      const inputs = form.querySelectorAll('input[required], select[required]');
      const checkboxes = form.querySelectorAll('input[type="checkbox"][required]');
      
      let filled = 0;
      let total = inputs.length;
      
      inputs.forEach(input => {
        if (input.type === 'checkbox') {
          if (input.checked) filled++;
        } else if (input.value.trim() !== '') {
          filled++;
        }
      });
      
      const percentage = Math.round((filled / total) * 100);
      document.getElementById('progressFill').style.width = percentage + '%';
      document.getElementById('progressText').textContent = `${percentage}% Complete`;
    }

    // Add event listeners for progress tracking
    document.querySelectorAll('input, select').forEach(element => {
      element.addEventListener('input', updateProgress);
      element.addEventListener('change', updateProgress);
    });

    // Age validation
    document.getElementById('date_of_birth').addEventListener('change', function() {
      const dob = new Date(this.value);
      const today = new Date();
      let age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }
      
      const errorElement = document.getElementById('dob-error');
      if (age < 18) {
        this.setCustomValidity('You must be at least 18 years old');
        errorElement.textContent = 'You must be at least 18 years old';
        errorElement.classList.add('show');
      } else {
        this.setCustomValidity('');
        errorElement.classList.remove('show');
      }
    });

    // Form submission validation
    document.getElementById('register-form').addEventListener('submit', function(e) {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('password_confirmation').value;
      
      if (password !== confirmPassword) {
        e.preventDefault();
        const errorElement = document.getElementById('confirm-password-error');
        errorElement.textContent = 'Passwords do not match';
        errorElement.classList.add('show');
        return false;
      }
    });

    // Initialize progress
    updateProgress();
  </script>
</body>
</html>
