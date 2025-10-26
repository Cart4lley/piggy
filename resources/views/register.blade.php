<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - Piggy Banking</title>

  <!-- Modern fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ---- Page background ---- */
    body {
      margin: 0;
      font-family: 'Inter', 'Lalezar', sans-serif;
      background: linear-gradient(135deg, #FFB6C1 0%, #FF9898 50%, #FF7B7B 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
      overflow-x: hidden;
    }

    /* ---- Main container ---- */
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      max-width: 1200px;
      position: relative;
    }

    /* ---- Registration section centered ---- */
    .registration-section {
      width: 100%;
      max-width: 600px;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 2;
    }

    /* ---- Registration panel ---- */
    .register-box {
      background: #FFFFFF;
      border-radius: 20px;
      padding: 40px 35px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      border: 1px solid #F1F5F9;
      max-height: 85vh;
      overflow-y: auto;
      position: relative;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 32px;
      font-weight: 600;
      color: #1F2937;
      font-size: 24px;
      font-family: 'Inter', sans-serif;
    }

    /* Form sections */
    .form-section {
      margin-bottom: 28px;
    }

    .form-section:last-child {
      margin-bottom: 0;
    }

    .section-title {
      font-size: 14px;
      color: #64748B;
      margin-bottom: 16px;
      font-weight: 500;
      font-family: 'Inter', sans-serif;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Input styling */
    .register-box label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 500;
      font-family: 'Inter', sans-serif;
      font-size: 13px;
      color: #475569;
    }

    .register-box input[type="text"],
    .register-box input[type="email"],
    .register-box input[type="tel"],
    .register-box input[type="date"],
    .register-box select {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #E2E8F0;
      border-radius: 10px;
      margin-bottom: 16px;
      outline: none;
      color: #1E293B;
      background: #FAFBFC;
      font-family: 'Inter', sans-serif;
      box-sizing: border-box;
      font-size: 14px;
      font-weight: 400;
      transition: all 0.2s ease;
    }

    /* Password inputs should NOT have the regular input styling */
    .password-container input[type="password"] {
      /* This overrides the regular input styling for password fields in containers */
      padding: 14px 50px 14px 18px !important;
      margin-bottom: 0 !important;
      background: transparent !important;
      border: none !important;
      border-radius: 12px !important;
    }

    .register-box input:focus,
    .register-box select:focus {
      border-color: #FF9898;
      background: #FFFFFF;
      box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.1);
    }

    /* Override focus styles for password inputs */
    .password-container input[type="password"]:focus {
      border: none !important;
      box-shadow: none !important;
      background: transparent !important;
    }

    .register-box input::placeholder {
      color: #94A3B8;
      font-weight: 400;
    }

    .register-box select {
      cursor: pointer;
    }

    /* Two-column layout for smaller fields */
    .form-row {
      display: flex;
      gap: 15px;
    }

    .form-row .form-group {
      flex: 1;
    }

    .form-group {
      margin-bottom: 0;
    }

    /* Password container */
    .password-container {
      position: relative;
      display: flex;
      align-items: center;
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      margin-bottom: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .password-container:focus-within {
      border-color: #FF9898;
      background: #FFFFFF;
      box-shadow: 0 0 0 3px rgba(255, 152, 152, 0.12), 0 2px 6px rgba(0, 0, 0, 0.08);
      transform: translateY(-1px);
    }

    .password-container input {
      flex: 1;
      border: none;
      border-radius: 12px;
      padding: 14px 50px 14px 18px;
      outline: none;
      color: #1E293B;
      background: transparent;
      font-family: 'Inter', sans-serif;
      box-sizing: border-box;
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 400;
    }

    .password-container input::placeholder {
      color: #94A3B8;
      font-weight: 400;
    }

    .password-toggle {
      position: absolute;
      right: 14px;
      background: rgba(148, 163, 184, 0.1);
      border: none;
      border-radius: 8px;
      cursor: pointer;
      color: #64748B;
      font-size: 16px;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .password-toggle:hover {
      background: rgba(255, 152, 152, 0.15);
      color: #FF9898;
      transform: scale(1.05);
    }

    .password-toggle:active {
      transform: scale(0.98);
    }

    /* Checkbox styling */
    .checkbox-container {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin: 16px 0;
      font-size: 13px;
      line-height: 1.5;
    }

    .checkbox-container input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin: 0;
      accent-color: #FF9898;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .checkbox-text {
      color: #64748B;
      font-family: 'Inter', sans-serif;
      font-weight: 400;
    }

    .checkbox-text a {
      color: #FF7B7B;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .checkbox-text a:hover {
      color: #FF6B6B;
      text-decoration: underline;
    }

    /* Register button */
    .register-btn {
      width: 100%;
      padding: 14px 20px;
      background: #FF9898;
      color: white;
      font-weight: 500;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 15px;
      font-family: 'Inter', sans-serif;
      margin-top: 20px;
      transition: all 0.2s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .register-btn:hover {
      background: #FF7B7B;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(255, 152, 152, 0.3);
    }

    .register-btn:active {
      transform: translateY(0);
    }

    .register-btn i {
      margin-left: 8px;
    }

    /* Back button */
    .back-button {
      position: fixed;
      top: 40px;
      left: 40px;
      background: rgba(255, 255, 255, 0.95);
      border: none;
      border-radius: 16px;
      width: 56px;
      height: 56px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: #FF7B7B;
      text-decoration: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 
                  0 4px 12px rgba(0, 0, 0, 0.05);
      backdrop-filter: blur(20px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 100;
    }

    .back-button:hover {
      background: rgba(255, 152, 152, 0.15);
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15), 
                  0 6px 20px rgba(255, 152, 152, 0.3);
      color: #FF6B6B;
    }

    /* Piggy bank styling */
    .piggy {
      width: 85%;
      height: 85%;
    }

    .piggy img {
      width: 100%;
      height: 100%;
      display: block;
      pointer-events: none;
      object-fit: cover;
    }

    /* Login link */
    .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
      color: #64748B;
    }

    .login-link a {
      color: #FF9898;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .login-link a:hover {
      color: #FF7B7B;
      text-decoration: underline;
    }

    /* Required field indicator */
    .required {
      color: #EF4444;
      font-weight: bold;
    }

    /* Input validation styles */
    .invalid {
      border-color: #EF4444 !important;
      background: #FEF2F2 !important;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    }

    .valid {
      border-color: #10B981 !important;
      background: #F0FDF4 !important;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
    }

    /* Error messages */
    .error-message {
      color: #EF4444;
      font-size: 12px;
      margin-top: -12px;
      margin-bottom: 12px;
      display: none;
      font-weight: 500;
    }

    /* Password strength indicator */
    .password-strength {
      height: 4px;
      background: #F1F5F9;
      border-radius: 6px;
      margin-top: -8px;
      margin-bottom: 12px;
      overflow: hidden;
      position: relative;
    }

    .strength-bar {
      height: 100%;
      width: 0%;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 6px;
      position: relative;
    }

    .strength-bar::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }

    .strength-weak { 
      background: linear-gradient(90deg, #EF4444, #F87171);
      box-shadow: 0 0 8px rgba(239, 68, 68, 0.3);
    }
    .strength-medium { 
      background: linear-gradient(90deg, #F59E0B, #FBBF24);
      box-shadow: 0 0 8px rgba(245, 158, 11, 0.3);
    }
    .strength-strong { 
      background: linear-gradient(90deg, #10B981, #34D399);
      box-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
    }

    /* Password strength text */
    .password-strength-text {
      font-size: 11px;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      margin-bottom: 12px;
      transition: all 0.3s ease;
      opacity: 0;
    }

    .password-strength-text.show {
      opacity: 1;
    }

    .strength-text-weak { color: #EF4444; }
    .strength-text-medium { color: #F59E0B; }
    .strength-text-strong { color: #10B981; }

    /* Alert Messages */
    .alert {
      padding: 15px 20px;
      border-radius: 12px;
      margin-bottom: 25px;
      font-size: 14px;
      line-height: 1.5;
      border: 2px solid;
    }

    .alert-success {
      background: #D4EDDA;
      color: #155724;
      border-color: #C3E6CB;
    }

    .alert-error {
      background: #F8D7DA;
      color: #721C24;
      border-color: #F5C6CB;
    }

    .alert i {
      margin-right: 8px;
    }

    .alert ul {
      margin-top: 10px;
      margin-bottom: 0;
      padding-left: 20px;
    }

    .alert li {
      margin-bottom: 5px;
    }

    /* Form spacing improvements */
    .form-group label {
      margin-top: 0;
    }

    .form-row .form-group:first-child {
      margin-right: 8px;
    }

    .form-row .form-group:last-child {
      margin-left: 8px;
    }
  </style>
</head>
<body>
  <!-- Back button -->
  <a href="{{ url('/') }}" class="back-button" title="Back to Home">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="container">
    <!-- Centered registration form -->
    <div class="registration-section">
      <div class="register-box">
        <h2>Create Your Account</h2>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif

        @if(session('error'))
          <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
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
        
        <form id="register-form" class="register-form" method="POST" action="{{ route('register') }}">
          @csrf
          <!-- Personal Information -->
          <div class="form-section">
            <div class="section-title">
              Personal Information
            </div>
            
            <div class="form-row">
              <div class="form-group">
                <label for="first-name">First Name <span class="required">*</span></label>
                <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" placeholder="Juan" required>
                <div class="error-message" id="first-name-error"></div>
              </div>
              <div class="form-group">
                <label for="last-name">Last Name <span class="required">*</span></label>
                <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" placeholder="Dela Cruz" required>
                <div class="error-message" id="last-name-error"></div>
              </div>
            </div>

            <label for="date-of-birth">Date of Birth <span class="required">*</span></label>
            <input type="date" id="date-of-birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
            <div class="error-message" id="dob-error"></div>

            <label for="gender">Gender</label>
            <select id="gender" name="gender">
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
              <option value="prefer-not-to-say">Prefer not to say</option>
            </select>
          </div>

          <!-- Contact Information -->
          <div class="form-section">
            <div class="section-title">
              Contact Information
            </div>

            <label for="email">Email Address <span class="required">*</span></label>
            <input type="email" id="email" name="email" placeholder="juan.delacruz@gmail.com" required>
            <div class="error-message" id="email-error"></div>

            <label for="phone">Phone Number <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" placeholder="+63 912 345 6789" required>
            <div class="error-message" id="phone-error"></div>

            <label for="address">Home Address <span class="required">*</span></label>
            <input type="text" id="address" name="address" placeholder="123 Rizal Street, Barangay San Antonio" required>
            <div class="error-message" id="address-error"></div>

            <label for="city">City <span class="required">*</span></label>
            <input type="text" id="city" name="city" placeholder="Makati City" required>
            <div class="error-message" id="city-error"></div>

            <label for="zip_code">ZIP Code <span class="required">*</span></label>
            <input type="text" id="zip_code" name="zip_code" placeholder="1200" required>
            <div class="error-message" id="zip_code-error"></div>
          </div>

          <!-- Employment & Financial Information -->
          <div class="form-section">
            <div class="section-title">
              Employment & Financial Information
            </div>

            <label for="occupation">Occupation <span class="required">*</span></label>
            <input type="text" id="occupation" name="occupation" placeholder="Software Engineer, Teacher, etc." required>
            <div class="error-message" id="occupation-error"></div>

            <label for="initial_deposit">Initial Deposit Amount <span class="required">*</span></label>
            <input type="number" id="initial_deposit" name="initial_deposit" min="500" max="1000000" step="0.01" placeholder="5000.00" required>
            <div class="error-message" id="initial_deposit-error"></div>
          </div>

          <!-- Account Security -->
          <div class="form-section">
            <div class="section-title">
              Account Security
            </div>

            <label for="username">Username <span class="required">*</span></label>
            <input type="text" id="username" name="username" placeholder="jdelacruz123" required>
            <div class="error-message" id="username-error"></div>

            <label for="password">Password <span class="required">*</span></label>
            <div class="password-container">
              <input type="password" id="password" name="password" placeholder="Create a strong password" required>
              <button type="button" class="password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye" id="password-toggle-icon"></i>
              </button>
            </div>
            <div class="password-strength">
              <div class="strength-bar" id="strength-bar"></div>
            </div>
            <div class="password-strength-text" id="strength-text"></div>
            <div class="error-message" id="password-error"></div>

            <label for="confirm-password">Confirm Password <span class="required">*</span></label>
            <div class="password-container">
              <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm your password" required>
              <button type="button" class="password-toggle" onclick="togglePassword('confirm-password')">
                <i class="fas fa-eye" id="confirm-password-toggle-icon"></i>
              </button>
            </div>
            <div class="error-message" id="confirm-password-error"></div>
          </div>

          <!-- Employment Information -->
          <div class="form-section">
            <div class="section-title">
              Employment Information
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="employment-status">Employment Status <span class="required">*</span></label>
                <select id="employment-status" name="employment_status" required>
                  <option value="">Select Status</option>
                  <option value="employed">Employed</option>
                  <option value="self-employed">Self-Employed</option>
                  <option value="student">Student</option>
                  <option value="unemployed">Unemployed</option>
                  <option value="retired">Retired</option>
                </select>
              </div>
              <div class="form-group">
                <label for="monthly-income">Monthly Income (PHP)</label>
                <input type="number" id="monthly-income" name="monthly_income" min="0" max="10000000" step="0.01" placeholder="25000.00">
              </div>
            </div>

            <label for="employer-name">Employer/Company Name</label>
            <input type="text" id="employer-name" name="employer_name" placeholder="Ayala Corporation">
          </div>

          <!-- Terms and Conditions -->
          <div class="form-section">
            <div class="checkbox-container">
              <input type="checkbox" id="terms-agreement" name="terms_agreement" required>
              <div class="checkbox-text">
                I agree to the <a href="#" target="_blank">Terms & Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>. I understand that this is a demo banking system for educational purposes. <span class="required">*</span>
              </div>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="marketing-consent" name="marketing_consent">
              <div class="checkbox-text">
                I consent to receive marketing communications and promotional offers from Piggy Banking.
              </div>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="age-verification" name="age_verification" required>
              <div class="checkbox-text">
                I confirm that I am at least 18 years old and legally eligible to open a bank account. <span class="required">*</span>
              </div>
            </div>
          </div>

          <button type="submit" id="register-submit" class="register-btn">
            CREATE ACCOUNT <i class="fas fa-user-plus"></i>
          </button>
        </form>

        <div class="login-link">
          Already have an account? <a href="{{ url('/signin') }}">Sign In Here</a>
        </div>
      </div>
    </div>
  </div>

  <script>
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
      if (/[0-9]/.test(password)) strength += 25;
      
      // Update strength bar
      strengthBar.style.width = strength + '%';
      strengthBar.className = 'strength-bar';
      
      // Update strength text and styling
      strengthText.className = 'password-strength-text';
      
      if (password.length === 0) {
        strengthText.classList.remove('show');
        strengthText.textContent = '';
      } else if (strength <= 25) {
        strengthBar.classList.add('strength-weak');
        strengthText.classList.add('strength-text-weak', 'show');
        strengthText.textContent = 'Weak - Add uppercase, numbers, and more characters';
      } else if (strength <= 75) {
        strengthBar.classList.add('strength-medium');
        strengthText.classList.add('strength-text-medium', 'show');
        strengthText.textContent = 'Good - Almost there, add more character types';
      } else {
        strengthBar.classList.add('strength-strong');
        strengthText.classList.add('strength-text-strong', 'show');
        strengthText.textContent = 'Strong - Great password!';
      }
    });

    // Form validation
    document.getElementById('register-form').addEventListener('submit', function(e) {
      // Basic validation
      let isValid = true;
      
      // Check required fields
      const requiredFields = ['first-name', 'last-name', 'date-of-birth', 'email', 'phone', 'address', 'username', 'password', 'confirm-password', 'employment-status'];
      
      requiredFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (!field.value.trim()) {
          field.classList.add('invalid');
          isValid = false;
        } else {
          field.classList.remove('invalid');
          field.classList.add('valid');
        }
      });
      
      // Check password match
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      
      if (password !== confirmPassword) {
        document.getElementById('confirm-password').classList.add('invalid');
        document.getElementById('confirm-password-error').textContent = 'Passwords do not match';
        document.getElementById('confirm-password-error').style.display = 'block';
        isValid = false;
      }
      
      // Check age verification and terms
      const termsAgreement = document.getElementById('terms-agreement').checked;
      const ageVerification = document.getElementById('age-verification').checked;
      
      if (!termsAgreement || !ageVerification) {
        alert('Please accept the terms and conditions and verify your age.');
        isValid = false;
      }
      
      // If validation fails, prevent submission
      if (!isValid) {
        e.preventDefault();
        return false;
      }
      
      // If valid, allow form to submit normally to Laravel backend
      // The form will submit to {{ route('register') }} which goes to AuthController
    });

    // Age validation
    document.getElementById('date-of-birth').addEventListener('change', function() {
      const dob = new Date(this.value);
      const today = new Date();
      const age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }
      
      if (age < 18) {
        this.classList.add('invalid');
        document.getElementById('dob-error').textContent = 'You must be at least 18 years old';
        document.getElementById('dob-error').style.display = 'block';
      } else {
        this.classList.remove('invalid');
        this.classList.add('valid');
        document.getElementById('dob-error').style.display = 'none';
      }
    });
  </script>
</body>
</html>