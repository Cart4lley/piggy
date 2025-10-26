<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIGGY - Test Account Creation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #FF7B7B;
            margin-bottom: 30px;
        }
        .test-section {
            margin: 20px 0;
            padding: 20px;
            border: 2px solid #FF9898;
            border-radius: 10px;
            background: #fff5f5;
        }
        .test-button {
            background: #FF7B7B;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }
        .test-button:hover {
            background: #FF6B6B;
        }
        .result {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 14px;
        }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .info { background: #d1ecf1; color: #0c5460; }
        .nav-links {
            text-align: center;
            margin-top: 30px;
        }
        .nav-links a {
            margin: 0 10px;
            padding: 10px 20px;
            background: #FF7B7B;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐷 PIGGY Account Testing</h1>

        <div class="test-section">
            <h3>1. Test Registration Flow</h3>
            <p>This will create a pending registration and show the verification email content.</p>
            <form action="{{ route('register.submit') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="first_name" value="Juan">
                <input type="hidden" name="last_name" value="Dela Cruz">
                <input type="hidden" name="email" value="juan@testaccount.com">
                <input type="hidden" name="phone" value="+639171234567">
                <input type="hidden" name="date_of_birth" value="1990-01-01">
                <input type="hidden" name="gender" value="male">
                <input type="hidden" name="address" value="123 Test St., Makati City">
                <input type="hidden" name="password" value="password123">
                <input type="hidden" name="password_confirmation" value="password123">
                <button type="submit" class="test-button">📧 Test Registration</button>
            </form>
        </div>

        <div class="test-section">
            <h3>2. Direct Account Creation</h3>
            <p>This will directly create a user account with initial deposit (bypassing email verification).</p>
            <a href="{{ url('/test-direct-account') }}" class="test-button">👤 Create Test Account</a>
        </div>

        <div class="test-section">
            <h3>3. Test Transactions</h3>
            <p>Test deposit and withdrawal functions on existing accounts.</p>
            <a href="{{ url('/test-transactions') }}" class="test-button">💰 Test Transactions</a>
        </div>

        <div class="test-section">
            <h3>4. System Status</h3>
            <p>View current system statistics and recent activity.</p>
            <a href="{{ url('/status') }}" class="test-button">📊 View Status</a>
        </div>

        @if(session('success') || session('error') || session('info'))
        <div class="test-section">
            <h3>Last Test Result:</h3>
            @if(session('success'))
                <div class="result success">✅ SUCCESS: {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="result error">❌ ERROR: {{ session('error') }}</div>
            @endif
            @if(session('info'))
                <div class="result info">ℹ️ INFO: {{ session('info') }}</div>
            @endif
        </div>
        @endif

        <div class="nav-links">
            <a href="{{ url('/') }}">🏠 Home</a>
            <a href="{{ url('/simple-test') }}">📝 Registration Form</a>
            <a href="{{ url('/admin/pending-registrations') }}">🔧 Admin Panel</a>
        </div>
    </div>
</body>
</html>