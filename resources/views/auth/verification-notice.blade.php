<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Status - PIGGY Bank</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .logo h1 {
            color: #4a5568;
            font-size: 28px;
            font-weight: 700;
        }

        .status-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .status-icon.pending {
            color: #f6ad55;
        }

        .status-icon.verified {
            color: #48bb78;
        }

        .status-icon.expired {
            color: #f56565;
        }

        h2 {
            color: #2d3748;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .email-display {
            background: #f7fafc;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
            font-size: 16px;
            color: #4a5568;
            border-left: 4px solid #4299e1;
        }

        .status-message {
            color: #718096;
            font-size: 16px;
            line-height: 1.6;
            margin: 20px 0;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .primary-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .secondary-btn {
            background: #edf2f7;
            color: #4a5568;
        }

        .secondary-btn:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        .instructions {
            background: #f7fafc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            text-align: left;
        }

        .instructions-title {
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .instructions ul {
            color: #718096;
            line-height: 1.8;
        }

        .instructions li {
            margin-bottom: 8px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
                margin: 10px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .logo h1 {
                font-size: 24px;
            }

            .status-icon {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/piggy-bank.png') }}" alt="PIGGY Bank">
            <h1>PIGGY</h1>
        </div>

        @if($hasPending)
            <!-- Pending Verification Status -->
            <div class="status-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            
            <h2>Email Verification Pending</h2>
            
            @if($email)
                <div class="email-display">
                    <i class="fas fa-envelope"></i>
                    {{ $email }}
                </div>
            @endif
            
            <div class="status-message">
                Your registration is almost complete! We've sent a verification email to your registered address. 
                Please check your inbox and click the verification link to activate your PIGGY Bank account.
            </div>

            <div class="action-buttons">
                <a href="{{ route('register') }}" class="primary-btn">
                    <i class="fas fa-paper-plane"></i>
                    Resend Email
                </a>
                
                <a href="{{ route('signin') }}" class="secondary-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Go to Sign In
                </a>
            </div>

            <div class="instructions">
                <div class="instructions-title">
                    <i class="fas fa-info-circle"></i>
                    What to do next:
                </div>
                <ul>
                    <li>Check your email inbox for a message from PIGGY Bank</li>
                    <li>Don't forget to check your spam/junk folder</li>
                    <li>Click the verification link in the email</li>
                    <li>Complete your registration within 24 hours</li>
                    <li>Contact support if you need help</li>
                </ul>
            </div>

        @else
            <!-- No Pending Registrations -->
            <div class="status-icon verified">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2>No Pending Verifications</h2>
            
            <div class="status-message">
                There are no pending email verifications for your account. 
                If you've already verified your email, you can sign in to access your PIGGY Bank account.
            </div>

            <div class="action-buttons">
                <a href="{{ route('signin') }}" class="primary-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </a>
                
                <a href="{{ route('register') }}" class="secondary-btn">
                    <i class="fas fa-user-plus"></i>
                    Create New Account
                </a>
            </div>
        @endif
    </div>
</body>
</html>