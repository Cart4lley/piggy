<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Registration - PIGGY Bank</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background: #f5f5f5;
    }
    .container {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #FF7B7B;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border: 2px solid #FFE6E6;
      border-radius: 5px;
      font-size: 14px;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #FF9898;
    }
    .form-row {
      display: flex;
      gap: 15px;
    }
    .form-row .form-group {
      flex: 1;
    }
    .btn {
      background: linear-gradient(135deg, #FF9898, #FF7B7B);
      color: white;
      padding: 15px 30px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
    }
    .btn:hover {
      background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
    }
    .title {
      color: #FF7B7B;
      text-align: center;
      margin-bottom: 30px;
    }
    .note {
      background: #FFE6E6;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      border-left: 4px solid #FF9898;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="title">🐷 Test PIGGY Bank Registration</h1>
    
    <div class="note">
      <strong>Development Testing:</strong> This form will test the complete registration and email verification flow. 
      Make sure to use a real email address to test the verification email.
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf
      
      <div class="form-row">
        <div class="form-group">
          <label for="first_name">First Name *</label>
          <input type="text" name="first_name" value="Juan" required>
        </div>
        <div class="form-group">
          <label for="last_name">Last Name *</label>
          <input type="text" name="last_name" value="Dela Cruz" required>
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email Address *</label>
        <input type="email" name="email" placeholder="your-email@gmail.com" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number *</label>
        <input type="tel" name="phone" value="+63 912 345 6789" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="date_of_birth">Date of Birth *</label>
          <input type="date" name="date_of_birth" value="1995-01-15" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="address">Address *</label>
        <input type="text" name="address" value="123 Rizal Street, Makati City, Metro Manila" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="city">City *</label>
          <input type="text" name="city" value="Makati" required>
        </div>
        <div class="form-group">
          <label for="zip_code">ZIP Code *</label>
          <input type="text" name="zip_code" value="1200" required>
        </div>
      </div>

      <div class="form-group">
        <label for="occupation">Occupation *</label>
        <input type="text" name="occupation" value="Software Developer" required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="monthly_income">Monthly Income (₱) *</label>
          <input type="number" name="monthly_income" value="50000" step="0.01" min="0" required>
        </div>
        <div class="form-group">
          <label for="initial_deposit">Initial Deposit (₱) *</label>
          <input type="number" name="initial_deposit" value="5000" step="0.01" min="500" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" name="password" value="TestPassword123!" required>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password *</label>
          <input type="password" name="password_confirmation" value="TestPassword123!" required>
        </div>
      </div>

      <button type="submit" class="btn">
        🚀 Test Registration Flow
      </button>
    </form>

    <div style="margin-top: 30px; text-align: center;">
      <a href="{{ route('signin') }}" style="color: #FF7B7B;">← Back to Sign In</a> | 
      <a href="/" style="color: #FF7B7B;">Home</a>
    </div>
  </div>
</body>
</html>