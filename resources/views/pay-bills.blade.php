<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pay Bills - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ff9999 0%, #ffb3b3 50%, #ffc9c9 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header/Navigation */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
        }

        .back-btn {
            background: #FF9898;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: #FF7B7B;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 152, 152, 0.3);
        }

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Balance Card */
        .balance-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .balance-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .balance-amount {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .category-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 28px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--category-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 16px;
            background: linear-gradient(135deg, var(--category-color) 0%, var(--category-color) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .category-description {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 16px;
            flex-grow: 1;
        }

        .company-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #9ca3af;
            font-weight: 500;
        }

        .company-count i {
            font-size: 11px;
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
                font-size: 24px;
            }

            .balance-card {
                padding: 20px;
            }

            .balance-amount {
                font-size: 28px;
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
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">🐷</div>
                <div class="brand-name">PIGGY</div>
            </div>
            
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-credit-card"></i>
                Pay Bills & Services
            </h1>
            <p class="page-subtitle">Pay your bills, buy products, and manage services from top companies in the Philippines</p>
        </div>

        <!-- Balance Card -->
        <div class="balance-card">
            <div class="balance-label">Available Balance</div>
            <div class="balance-amount">₱{{ number_format($account->balance, 2) }}</div>
        </div>

        <!-- Categories Grid -->
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
    </main>
</body>
</html>
