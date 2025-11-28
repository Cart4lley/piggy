<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pay Bills - PIGGY Bank</title>
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
            background: linear-gradient(135deg, #ff9999 0%, #ffb3b3 50%, #ffc9c9 100%);
            min-height: 100vh;
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
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ff7a7a;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            color: #FF6B6B;
            transform: translateX(-3px);
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .header h1 {
            color: #ff9999;
            font-family: 'Lalezar', sans-serif;
            font-size: 32px;
            font-weight: normal;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header p {
            color: #6B7280;
            font-size: 16px;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .balance-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 40px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .balance-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .balance-amount {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .category-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--category-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border-color: var(--category-color);
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            background: var(--category-color);
        }

        .category-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .category-description {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .company-count {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #6b7280;
            background: rgba(107, 114, 128, 0.1);
            padding: 4px 8px;
            border-radius: 6px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .main-container {
                padding: 20px 16px;
            }

            .page-title {
                font-size: 28px;
            }

            .categories-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .category-card {
                padding: 24px;
            }

            .nav-section {
                display: none;
            }
        }

        /* Loading State */
        .loading {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .loading i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .category-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 20px;
            background: var(--category-color);
            background: linear-gradient(135deg, var(--category-color) 0%, var(--category-color) 100%);
        }

        .category-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .category-description {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .company-count {
            font-size: 12px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header,
            .balance-card {
                padding: 20px;
            }

            .categories-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .category-card {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>

        <div class="header">
            <h1>
                <i class="fas fa-credit-card"></i>
                Pay Bills & Services
            </h1>
            <p>Pay your bills, buy products, and manage services from top companies in the Philippines. Secure, fast, and convenient payments at your fingertips.</p>
        </div>

        <div class="balance-card">
            <div class="balance-label">Available Balance</div>
            <div class="balance-amount">₱{{ number_format($account->balance, 2) }}</div>
        </div>

        <div class="categories-grid">
            @foreach($categories as $category)
            <a href="{{ route('payment.category', $category['slug']) }}" 
               class="category-card" 
               style="--category-color: {{ $category['color'] }}">
                <div class="category-icon">
                    <i class="{{ $category['icon'] }}"></i>
                </div>
                <h3 class="category-title">{{ $category['name'] }}</h3>
                <p class="category-description">{{ $category['description'] }}</p>
                <span class="company-count">
                    <i class="fas fa-building"></i>
                    {{ count($category['companies']) }} Companies Available
                </span>
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>