<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Out Success - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="200" fill="url(%23a)"/><circle cx="400" cy="700" r="100" fill="url(%23a)"/><circle cx="900" cy="800" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
            background-size: cover;
            pointer-events: none;
        }

        .success-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10B981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
            animation: checkmark 0.6s ease-in-out 0.9s both;
        }

        .success-icon i {
            font-size: 48px;
            color: white;
            animation: bounceIn 0.8s ease-out 1.2s both;
        }

        .success-title {
            font-family: 'Lalezar', sans-serif;
            font-size: 36px;
            color: #047857;
            margin-bottom: 16px;
            font-weight: normal;
        }

        .success-subtitle {
            font-size: 18px;
            color: #6B7280;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .transaction-details {
            background: #F9FAFB;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 40px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #E5E7EB;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
        }

        .detail-value {
            color: #1F2937;
            font-weight: 500;
        }

        .amount-highlight {
            font-size: 24px;
            font-weight: 800;
            color: #10B981;
        }

        .reference-box {
            background: linear-gradient(135deg, #EFF6FF, #DBEAFE);
            border: 2px dashed #3B82F6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .reference-title {
            font-weight: 600;
            color: #1E40AF;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reference-code {
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 18px;
            font-weight: 700;
            color: #1E40AF;
            background: #FFFFFF;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #93C5FD;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 30px;
        }

        .btn {
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-secondary {
            background: white;
            color: #6B7280;
            border: 2px solid #E5E7EB;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .info-notice {
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            padding: 20px;
            margin-top: 30px;
            text-align: left;
        }

        .info-notice h4 {
            color: #92400E;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-notice p {
            color: #A16207;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .info-notice p:last-child {
            margin-bottom: 0;
        }

        @keyframes checkmark {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.2) rotate(180deg);
                opacity: 1;
            }
            100% {
                transform: scale(1) rotate(360deg);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            60% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }

        /* Enhanced Responsive Design - Mobile First Approach */
        
        /* Small Mobile (320px - 479px) */
        @media (max-width: 479px) {
            .success-container {
                padding: 25px 16px;
                margin: 8px;
                border-radius: 16px;
            }

            .success-icon {
                width: 70px;
                height: 70px;
                margin-bottom: 20px;
            }
            
            .success-icon i {
                font-size: 32px;
            }

            .success-title {
                font-size: 24px;
                margin-bottom: 12px;
            }
            
            .success-subtitle {
                font-size: 15px;
                margin-bottom: 30px;
                line-height: 1.5;
            }

            .reference-box {
                padding: 16px;
                margin-bottom: 25px;
                border-radius: 8px;
            }
            
            .reference-title {
                font-size: 13px;
                margin-bottom: 6px;
            }
            
            .reference-code {
                font-size: 12px;
                padding: 8px 12px;
                border-radius: 6px;
                word-break: break-all;
            }

            .transaction-details {
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 25px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
                padding: 8px 0;
            }
            
            .detail-label {
                font-size: 12px;
            }
            
            .detail-value {
                font-size: 13px;
            }
            
            .amount-highlight {
                font-size: 18px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 12px;
                margin-top: 20px;
            }
            
            .btn {
                padding: 12px 20px;
                font-size: 14px;
                border-radius: 8px;
            }
            
            .info-notice {
                padding: 16px;
                margin-top: 20px;
                border-radius: 8px;
            }
            
            .info-notice h4 {
                font-size: 14px;
                margin-bottom: 8px;
            }
            
            .info-notice p {
                font-size: 12px;
                line-height: 1.4;
                margin-bottom: 6px;
            }
        }

        /* Mobile (480px - 599px) */
        @media (min-width: 480px) and (max-width: 599px) {
            .success-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .success-title {
                font-size: 26px;
            }
            
            .success-subtitle {
                font-size: 16px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
                gap: 14px;
            }
            
            .reference-code {
                font-size: 14px;
            }
        }
        
        /* Large Mobile/Small Tablet (600px - 767px) */
        @media (min-width: 600px) and (max-width: 767px) {
            .success-container {
                padding: 35px 25px;
                margin: 12px;
            }

            .success-title {
                font-size: 28px;
            }

            .action-buttons {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            
            .detail-row {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }
        }

        /* Tablet (768px - 1023px) */
        @media (min-width: 768px) and (max-width: 1023px) {
            .success-container {
                padding: 40px 30px;
                margin: 15px;
                max-width: 650px;
            }

            .success-title {
                font-size: 32px;
            }
            
            .success-subtitle {
                font-size: 17px;
            }

            .success-icon {
                width: 90px;
                height: 90px;
            }
            
            .success-icon i {
                font-size: 42px;
            }

            .action-buttons {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }
            
            .detail-row {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        /* Desktop (1024px+) */
        @media (min-width: 1024px) {
            .success-container {
                padding: 50px 40px;
                margin: 20px auto;
                max-width: 700px;
            }

            .success-title {
                font-size: 36px;
            }
            
            .success-subtitle {
                font-size: 18px;
            }

            .success-icon {
                width: 100px;
                height: 100px;
            }
            
            .success-icon i {
                font-size: 48px;
            }

            .action-buttons {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .reference-code {
                font-size: 18px;
            }
            
            .amount-highlight {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <h1 class="success-title">Cash Out Successful!</h1>
        <p class="success-subtitle">Your cash out request has been submitted and is being processed. You will receive confirmation once the transfer is complete.</p>

        @if(isset($cashout))
        <div class="reference-box">
            <div class="reference-title">
                <i class="fas fa-receipt"></i>
                Transaction Reference
            </div>
            <div class="reference-code">{{ $cashout->reference_number }}</div>
        </div>

        <div class="transaction-details">
            <div class="detail-row">
                <span class="detail-label">Amount</span>
                <span class="detail-value amount-highlight">₱{{ number_format($cashout->amount, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Recipient</span>
                <span class="detail-value">{{ $cashout->recipient_name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Bank</span>
                <span class="detail-value">{{ $cashout->recipient_bank }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Account Number</span>
                <span class="detail-value">{{ substr($cashout->recipient_account_number, 0, 4) }}****{{ substr($cashout->recipient_account_number, -4) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value">
                    <span style="background: #FEF3C7; color: #92400E; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                        {{ ucfirst($cashout->status) }}
                    </span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Submitted</span>
                <span class="detail-value">{{ $cashout->created_at->format('M d, Y g:i A') }}</span>
            </div>
        </div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                <i class="fas fa-home"></i>
                Back to Dashboard
            </a>
            <a href="{{ route('cashout.history') }}" class="btn btn-secondary">
                <i class="fas fa-history"></i>
                View History
            </a>
        </div>

        <div class="info-notice">
            <h4><i class="fas fa-info-circle"></i> What happens next?</h4>
            <p><strong>Processing:</strong> Your request will be reviewed and processed within 24 hours during business days.</p>
            <p><strong>Notification:</strong> You'll receive an SMS and email confirmation once the transfer is completed.</p>
            <p><strong>Support:</strong> If you have any questions, please contact our customer support at support@piggybank.ph</p>
        </div>
    </div>
</body>
</html>