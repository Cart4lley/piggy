<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIGGY - Login Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
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
        .login-form {
            margin: 20px 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #FF7B7B;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #FF7B7B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #FF6B6B;
        }
        .test-accounts {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .test-accounts h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .account-info {
            font-family: monospace;
            font-size: 14px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
            border: 1px solid #ddd;
        }
        .nav-links {
            text-align: center;
            margin-top: 20px;
        }
        .nav-links a {
            margin: 0 10px;
            padding: 10px 20px;
            background: #FF7B7B;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .alert.success { background: #d4edda; color: #155724; }
        .alert.error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐷 PIGGY Login Test</h1>

        @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
        <div class="alert error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="test-accounts">
            <h3>Available Test Accounts:</h3>
            <p>Use these credentials to test the login system:</p>
            
            @if($testAccounts->count() > 0)
                @foreach($testAccounts as $user)
                <div class="account-info">
                    <strong>{{ $user->name }}</strong><br>
                    Email: {{ $user->email }}<br>
                    Password: password123<br>
                    Account: {{ $user->account ? $user->account->account_number : 'No account' }}<br>
                    Balance: {{ $user->account ? $user->account->formatted_balance : 'N/A' }}
                </div>
                @endforeach
            @else
                <div class="account-info">
                    No test accounts found. Create some accounts first using the test page.
                </div>
            @endif
        </div>

        <form action="{{ route('signin') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $testAccounts->first()?->email ?? 'maria@directtest.com') }}" 
                       required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       value="password123" 
                       required>
            </div>

            <button type="submit">🔑 Sign In</button>
        </form>

        <div class="nav-links">
            <a href="{{ url('/test-accounts') }}">🧪 Test Accounts</a>
            <a href="{{ url('/status') }}">📊 System Status</a>
            <a href="{{ url('/') }}">🏠 Home</a>
        </div>
    </div>
</body>
</html>