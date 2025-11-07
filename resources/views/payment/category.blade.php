<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $category['name'] }} - PIGGY Payments</title>
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
            background: linear-gradient(135deg, #FFB6C1 0%, #FF9898 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header */
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

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .breadcrumb {
            margin-bottom: 32px;
        }

        .breadcrumb-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
        }

        .breadcrumb-link:hover {
            color: #FF7B7B;
        }

        .breadcrumb-separator {
            margin: 0 8px;
            color: #d1d5db;
        }

        .category-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--category-color);
        }

        .category-icon-large {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin: 0 auto 24px;
            background: var(--category-color);
        }

        .category-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .category-description {
            font-size: 16px;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        .companies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .company-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 32px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 2px solid transparent;
        }

        .company-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
            border-color: var(--category-color);
        }

        .company-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .company-logo {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            background: rgba(0, 0, 0, 0.05);
        }

        .company-info h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .company-info p {
            font-size: 14px;
            color: #6b7280;
        }

        .payment-fields {
            margin-bottom: 20px;
        }

        .fields-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fields-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .field-tag {
            background: rgba(0, 0, 0, 0.05);
            color: #4b5563;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
        }

        .pay-button {
            width: 100%;
            background: var(--category-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            color: #6b7280;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 32px;
        }

        .back-button:hover {
            background: white;
            color: #374151;
            transform: translateX(-4px);
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

            .category-header {
                padding: 24px;
            }

            .category-title {
                font-size: 24px;
            }

            .companies-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .company-card {
                padding: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <span class="brand-name">PIGGY</span>
            </div>

            <div class="user-section">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $user->first_name ?? $user->name }} {{ $user->last_name ?? '' }}</h3>
                        <p>Balance: ₱{{ number_format($account->balance, 2) }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer; color: #6b7280;">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="breadcrumb">
            <a href="{{ route('payment.index') }}" class="breadcrumb-link">
                <i class="fas fa-credit-card"></i> Payments
            </a>
            <span class="breadcrumb-separator">/</span>
            <span>{{ $category['name'] }}</span>
        </div>

        <a href="{{ route('payment.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Back to Categories
        </a>

        <div class="category-header" style="--category-color: {{ $category['color'] }}">
            <div class="category-icon-large">
                <i class="{{ $category['icon'] }}"></i>
            </div>
            <h1 class="category-title">{{ $category['name'] }}</h1>
            <p class="category-description">{{ $category['description'] }}</p>
        </div>

        <div class="companies-grid">
            @foreach($category['companies'] as $company)
            <a href="{{ route('payment.company', [$category['slug'], $company['slug']]) }}" 
               class="company-card" 
               style="--category-color: {{ $category['color'] }}">
                <div class="company-header">
                    <div class="company-logo">{{ $company['logo'] }}</div>
                    <div class="company-info">
                        <h3>{{ $company['name'] }}</h3>
                        <p>{{ $company['description'] }}</p>
                    </div>
                </div>
                
                <div class="payment-fields">
                    <div class="fields-label">Required Information</div>
                    <div class="fields-list">
                        @foreach($company['fields'] as $field)
                        <span class="field-tag">{{ $field }}</span>
                        @endforeach
                    </div>
                </div>
                
                <button class="pay-button">
                    <i class="fas fa-credit-card"></i> Pay Now
                </button>
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>