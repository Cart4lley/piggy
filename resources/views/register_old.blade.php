<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Account - PIGGY Bank</title>

  <!-- Modern fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ---- Reset & Base Styles ---- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23FF9A9A" stop-opacity="0.1"/><stop offset="100%" stop-color="%23FF9A9A" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="200" fill="url(%23a)"/><circle cx="400" cy="700" r="100" fill="url(%23a)"/><circle cx="900" cy="800" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
      background-size: cover;
      pointer-events: none;
    }

    /* ---- Main Container ---- */
    .container {
      width: 100%;
      max-width: 1200px;
      position: relative;
      z-index: 1;
    }

    /* ---- Registration Layout ---- */
    .registration-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      min-height: 90vh;
    }

    /* ---- Left Side - Brand & Info ---- */
    .brand-side {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 40px;
      color: white;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 40px;
    }

    .brand-logo i {
      font-size: 48px;
      color: #FF9A9A;
    }

    .brand-text h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 48px;
      font-weight: 800;
      margin: 0;
      background: linear-gradient(135deg, #FF9A9A 0%, #FFB6B6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .brand-text p {
      font-size: 18px;
      font-weight: 300;
      opacity: 0.9;
      margin: 8px 0 0 0;
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
      background: linear-gradient(135deg, #FF9A9A 0%, #FFB6B6 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 18px;
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

    /* ---- Right Side - Registration Form ---- */
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
    }

    .register-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #FF9A9A 100%);
    }

    /* ---- Form Header ---- */
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

    /* ---- Progress Indicator ---- */
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
      background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
      border-radius: 3px;
      transition: width 0.3s ease;
      width: 0%;
    }

    .progress-text {
      text-align: center;
      font-size: 14px;
      color: #64748b;
      font-weight: 500;
    }

    /* ---- Form Sections ---- */
    .form-section {
      margin-bottom: 40px;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.5s ease;
    }

    .form-section.active {
      opacity: 1;
      transform: translateY(0);
    }

    .form-section:last-child {
      margin-bottom: 0;
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
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
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

    /* ---- Form Controls ---- */
    .form-group {
      margin-bottom: 24px;
      position: relative;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      font-size: 14px;
      color: #374151;
      font-family: 'Inter', sans-serif;
    }

    .required {
      color: #ef4444;
      margin-left: 2px;
    }

    .input-group {
      position: relative;
    }

    .form-input {
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

    .form-input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
      transform: translateY(-2px);
    }

    .form-input::placeholder {
      color: #9ca3af;
      font-weight: 400;
    }

    .form-input.error {
      border-color: #ef4444;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-select {
      width: 100%;
      padding: 16px 20px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 16px;
      font-family: 'Inter', sans-serif;
      background: #ffffff;
      color: #111827;
      cursor: pointer;
      transition: all 0.3s ease;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 12px center;
      background-repeat: no-repeat;
      background-size: 16px;
    }

    .form-select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    /* ---- Form Layout ---- */
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-row-three {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 16px;
    }

    /* ---- Input Icons ---- */
    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 16px;
    }

    .form-input.has-icon {
      padding-left: 48px;
    }

    /* ---- Error Styling ---- */
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

    /* ---- Password Container ---- */
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
      border-color: #667eea;
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
      color: #667eea;
      background: rgba(102, 126, 234, 0.1);
    }

    /* ---- Password Strength ---- */
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

    .strength-weak-text { color: #ef4444; }
    .strength-fair-text { color: #f97316; }
    .strength-good-text { color: #eab308; }
    .strength-strong-text { color: #22c55e; }

    /* ---- Checkbox Styling ---- */
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
      border-color: #667eea;
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
      background: #667eea;
      border-color: #667eea;
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
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }

    .checkbox-text a:hover {
      color: #5a67d8;
      text-decoration: underline;
    }

    /* Enhanced error styling */
    .error-message {
      display: none;
      color: #dc2626;
      font-size: 12px;
      margin-top: 4px;
      font-weight: 500;
      font-family: 'Inter', sans-serif;
    }

    input.invalid, select.invalid {
      border-color: #dc2626 !important;
      box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
      background-color: #fef2f2 !important;
    }

    input.valid, select.valid {
      border-color: #10b981 !important;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
    }

    /* Improved alert styling */
    .alert {
      padding: 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      line-height: 1.5;
    }

    .alert-success {
      background-color: #f0fdf4;
      color: #166534;
      border: 1px solid #bbf7d0;
    }

    .alert-error {
      background-color: #fef2f2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    .alert ul {
      margin: 8px 0 0 0;
      padding-left: 16px;
    }

    .alert li {
      margin-bottom: 4px;
    }

    .alert i {
      margin-right: 8px;
    }

    /* Required field indicator */
    .required {
      color: #dc2626;
      font-weight: bold;
    }

    /* Form completion progress */
    .form-progress {
      position: sticky;
      top: 20px;
      background: rgba(255, 255, 255, 0.95);
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      border: 1px solid #f1f5f9;
    }

    .progress-text {
      font-size: 12px;
      color: #64748B;
      font-weight: 500;
      text-align: center;
    }

    .progress-bar {
      height: 4px;
      background: #f1f5f9;
      border-radius: 2px;
      margin-top: 8px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: #FF9898;
      width: 0%;
      transition: width 0.3s ease;
    }

    /* ---- Submit Button ---- */
    .submit-button {
      width: 100%;
      padding: 18px 24px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    .submit-button:disabled {
      background: #9ca3af;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }

    .submit-button i {
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

    /* ---- Footer Links ---- */
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
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .login-link a:hover {
      color: #5a67d8;
    }

    /* ---- Alert Messages ---- */
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
      background: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
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

    /* ---- Back Button ---- */
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
      color: #667eea;
      transform: translateX(-4px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

    /* ---- Responsive Design ---- */
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

      .form-row,
      .form-row-three {
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

      .form-input,
      .form-select,
      .password-input {
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
  <!-- Back button -->
  <a href="{{ url('/') }}" class="back-button" title="Back to Home">
    <i class="fas fa-arrow-left"></i>
  </a>

  <div class="container">
    <div class="registration-layout">
      <!-- Left Side - Brand Information -->
      <div class="brand-side">
        <div class="brand-logo">
          <i class="fas fa-piggy-bank"></i>
          <div class="brand-text">
            <h1>PIGGY</h1>
            <p>Smart Banking</p>
          </div>
        </div>
        
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
            <div class="progress-text" id="progressText">Step 1 of 4: Personal Information</div>
          </div>
        
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
        
          <form id="register-form" method="POST" action="{{ route('register') }}">
            @csrf
          
            <!-- Step 1: Personal Information -->
            <div class="form-section active" data-step="1">
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
            <div class="section-title">
              Contact Information
            </div>

            <label for="email">Email Address <span class="required">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="juan.delacruz@gmail.com" required>
            <div class="error-message" id="email-error"></div>

            <label for="phone">Phone Number <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+63 912 345 6789" required>
            <div class="error-message" id="phone-error"></div>

            <label for="address">Home Address <span class="required">*</span></label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="123 Rizal Street, Barangay San Antonio" required>
            <div class="error-message" id="address-error"></div>

            <label for="city">City <span class="required">*</span></label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="Makati City" required>
            <div class="error-message" id="city-error"></div>

            <label for="zip_code">ZIP Code <span class="required">*</span></label>
            <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" placeholder="1200" required>
            <div class="error-message" id="zip_code-error"></div>
          </div>

          <!-- Employment & Financial Information -->
          <div class="form-section">
            <div class="section-title">
              Employment & Financial Information
            </div>

            <label for="occupation">Occupation <span class="required">*</span></label>
            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Software Engineer, Teacher, etc." required>
            <div class="error-message" id="occupation-error"></div>
          </div>

          <!-- Account Security -->
          <div class="form-section">
            <div class="section-title">
              Account Security
            </div>

            <label for="username">Username <span class="required">*</span></label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="jdelacruz123" required>
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
                  <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>Employed</option>
                  <option value="self-employed" {{ old('employment_status') == 'self-employed' ? 'selected' : '' }}>Self-Employed</option>
                  <option value="student" {{ old('employment_status') == 'student' ? 'selected' : '' }}>Student</option>
                  <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                  <option value="retired" {{ old('employment_status') == 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
              </div>
              <div class="form-group">
                <label for="monthly-income">Monthly Income (PHP)</label>
                <input type="number" id="monthly-income" name="monthly_income" value="{{ old('monthly_income') }}" min="0" max="10000000" step="0.01" placeholder="25000.00">
              </div>
            </div>

            <label for="employer-name">Employer/Company Name</label>
            <input type="text" id="employer-name" name="employer_name" value="{{ old('employer_name') }}" placeholder="Ayala Corporation">
          </div>

          <!-- Terms and Conditions -->
          <div class="form-section">
            <div class="checkbox-container">
              <input type="checkbox" id="terms-agreement" name="terms_agreement" {{ old('terms_agreement') ? 'checked' : '' }} required>
              <div class="checkbox-text">
                I agree to the <a href="#" target="_blank">Terms & Conditions</a> and <a href="#" target="_blank">Privacy Policy</a>. I understand that this is a demo banking system for educational purposes. <span class="required">*</span>
              </div>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="marketing-consent" name="marketing_consent" {{ old('marketing_consent') ? 'checked' : '' }}>
              <div class="checkbox-text">
                I consent to receive marketing communications and promotional offers from Piggy Banking.
              </div>
            </div>

            <div class="checkbox-container">
              <input type="checkbox" id="age-verification" name="age_verification" {{ old('age_verification') ? 'checked' : '' }} required>
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

    // Display Laravel validation errors on page load
    document.addEventListener('DOMContentLoaded', function() {
      @if($errors->any())
        // Show specific field errors
        @foreach($errors->keys() as $field)
          const fieldElement = document.querySelector('[name="{{ $field }}"]');
          const errorElement = document.getElementById('{{ $field }}-error');
          
          if (fieldElement) {
            fieldElement.classList.add('invalid');
            fieldElement.style.borderColor = '#dc2626';
          }
          
          if (errorElement) {
            errorElement.textContent = '{{ $errors->first($field) }}';
            errorElement.style.display = 'block';
            errorElement.style.color = '#dc2626';
            errorElement.style.fontSize = '12px';
            errorElement.style.marginTop = '4px';
          }
        @endforeach

        // Scroll to first error field
        const firstErrorField = document.querySelector('.invalid');
        if (firstErrorField) {
          firstErrorField.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
          });
          firstErrorField.focus();
        }
      @endif

      // Clear error styling on input focus and update progress
      const inputs = document.querySelectorAll('input, select');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.classList.remove('invalid');
          this.style.borderColor = '#FF9898';
          
          const fieldName = this.getAttribute('name');
          const errorElement = document.getElementById(fieldName + '-error');
          if (errorElement) {
            errorElement.style.display = 'none';
          }
        });

        input.addEventListener('input', updateFormProgress);
        input.addEventListener('change', updateFormProgress);
      });

      // Form progress tracking
      function updateFormProgress() {
        const requiredFields = document.querySelectorAll('input[required], select[required]');
        const checkboxes = document.querySelectorAll('input[type="checkbox"][required]');
        
        let completedFields = 0;
        const totalFields = requiredFields.length;

        // Check regular required fields
        requiredFields.forEach(field => {
          if (field.type === 'checkbox') {
            if (field.checked) completedFields++;
          } else if (field.value.trim() !== '') {
            completedFields++;
          }
        });

        const percentage = Math.round((completedFields / totalFields) * 100);
        document.getElementById('completion-percentage').textContent = percentage + '%';
        document.getElementById('progress-fill').style.width = percentage + '%';

        // Change progress bar color based on completion
        const progressFill = document.getElementById('progress-fill');
        if (percentage < 50) {
          progressFill.style.background = '#ef4444';
        } else if (percentage < 80) {
          progressFill.style.background = '#f59e0b';
        } else {
          progressFill.style.background = '#10b981';
        }
      }

      // Initial progress calculation
      updateFormProgress();
    });
  </script>
</body>
</html>