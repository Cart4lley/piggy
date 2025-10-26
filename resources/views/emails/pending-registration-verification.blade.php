<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your PIGGY Bank Registration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .email-header {
            background: linear-gradient(135deg, #FF9898, #FF7B7B);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .brand-title {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 2px;
        }
        
        .brand-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: -5px;
        }
        
        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-subtitle {
            font-size: 16px;
            opacity: 0.95;
        }
        
        .email-body {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #FF7B7B;
            margin-bottom: 20px;
        }
        
        .message-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 25px;
            line-height: 1.7;
        }
        
        .verification-section {
            background: #FFE6E6;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
            border-left: 4px solid #FF9898;
        }
        
        .verification-icon {
            font-size: 48px;
            color: #FF7B7B;
            margin-bottom: 20px;
        }
        
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #FF9898, #FF7B7B);
            color: white !important;
            text-decoration: none;
            padding: 18px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 5px 20px rgba(255, 152, 152, 0.3);
            transition: all 0.3s ease;
        }
        
        .verify-button:hover {
            background: linear-gradient(135deg, #FF7B7B, #FF5E5E);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 152, 152, 0.4);
        }

        .registration-details {
            background: #F8F9FA;
            border: 1px solid #E9ECEF;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }

        .details-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            font-size: 14px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .detail-label {
            font-weight: 600;
            color: #6C757D;
            font-size: 12px;
            text-transform: uppercase;
        }

        .detail-value {
            color: #495057;
            font-weight: 500;
        }
        
        .security-note {
            background: #F8F9FA;
            border: 1px solid #E9ECEF;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }
        
        .security-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .security-text {
            font-size: 14px;
            color: #6C757D;
            line-height: 1.6;
        }
        
        .alternative-link {
            background: #F8F9FA;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            border: 1px solid #E9ECEF;
        }
        
        .alternative-text {
            font-size: 14px;
            color: #6C757D;
            margin-bottom: 10px;
        }
        
        .copy-link {
            word-break: break-all;
            background: white;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #DEE2E6;
            font-family: monospace;
            font-size: 12px;
            color: #495057;
        }

        .expiry-warning {
            background: #FFF3CD;
            border: 1px solid #FFEAA7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .email-footer {
            background: #F8F9FA;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #E9ECEF;
        }
        
        .footer-text {
            font-size: 14px;
            color: #6C757D;
            margin-bottom: 15px;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .footer-link {
            color: #FF7B7B;
            text-decoration: none;
            font-size: 14px;
        }
        
        .footer-link:hover {
            text-decoration: underline;
        }
        
        .company-info {
            font-size: 12px;
            color: #ADB5BD;
            margin-top: 15px;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .email-header {
                padding: 30px 20px;
            }
            
            .email-body {
                padding: 30px 20px;
            }
            
            .verification-section {
                padding: 20px;
            }
            
            .verify-button {
                padding: 16px 30px;
                font-size: 15px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <div class="logo-section">
                <div class="logo-icon">🐷</div>
                <div>
                    <div class="brand-title">PIGGY</div>
                    <div class="brand-subtitle">we find ways</div>
                </div>
            </div>
            
            <div class="welcome-title">Almost There!</div>
            <div class="welcome-subtitle">Complete your PIGGY Bank registration</div>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <div class="greeting">
                Hello {{ $pendingRegistration->first_name }}!
            </div>
            
            <div class="message-text">
                Thank you for choosing PIGGY Bank! We received your registration request and we're excited to help you start your financial journey with us.
            </div>
            
            <div class="message-text">
                To complete your registration and create your PIGGY Bank account, please verify your email address by clicking the button below:
            </div>

            <!-- Verification Section -->
            <div class="verification-section">
                <div class="verification-icon">📧</div>
                <a href="{{ $verificationUrl }}" class="verify-button">
                    Complete Registration
                </a>
            </div>

            <!-- Registration Details -->
            <div class="registration-details">
                <div class="details-title">
                    📋 Your Registration Details
                </div>
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">Full Name</div>
                        <div class="detail-value">{{ $pendingRegistration->first_name }} {{ $pendingRegistration->last_name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ $pendingRegistration->email }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Phone Number</div>
                        <div class="detail-value">{{ $pendingRegistration->phone }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Initial Deposit</div>
                        <div class="detail-value">₱{{ number_format($pendingRegistration->initial_deposit, 2) }}</div>
                    </div>
                </div>
            </div>

            <!-- Expiry Warning -->
            <div class="expiry-warning">
                <i>⏰</i>
                <span>This verification link will expire in 24 hours. Please complete your registration soon!</span>
            </div>

            <div class="message-text">
                Once you verify your email, we will:
            </div>

            <ul style="margin: 20px 0; padding-left: 20px; color: #555;">
                <li style="margin-bottom: 8px;">Create your secure PIGGY Bank account</li>
                <li style="margin-bottom: 8px;">Set up your savings account with your initial deposit</li>
                <li style="margin-bottom: 8px;">Give you access to all our digital banking features</li>
                <li style="margin-bottom: 8px;">Send you your account details and welcome package</li>
            </ul>

            <!-- Security Note -->
            <div class="security-note">
                <div class="security-title">
                    🔒 Security & Privacy
                </div>
                <div class="security-text">
                    Your personal information is encrypted and secure. We will never share your details with third parties without your consent. This verification ensures the security of your future PIGGY Bank account.
                </div>
            </div>

            <!-- Alternative Link -->
            <div class="alternative-link">
                <div class="alternative-text">
                    If the button doesn't work, copy and paste this link into your browser:
                </div>
                <div class="copy-link">
                    {{ $verificationUrl }}
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <div class="footer-text">
                Need help? Our support team is ready to assist you with your registration.
            </div>
            
            <div class="footer-links">
                <a href="#" class="footer-link">Help Center</a>
                <a href="#" class="footer-link">Contact Support</a>
                <a href="#" class="footer-link">Privacy Policy</a>
            </div>
            
            <div class="company-info">
                © 2025 PIGGY Bank. All rights reserved.<br>
                This registration request was made for {{ $pendingRegistration->email }}
            </div>
        </div>
    </div>
</body>
</html>