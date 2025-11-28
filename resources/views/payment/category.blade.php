<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $category['name'] }} - PIGGY Payments</title>
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
        }

        .category-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            margin: 0 auto 20px;
            background: var(--category-color);
        }

        .category-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .category-description {
            font-size: 16px;
            color: #6b7280;
            line-height: 1.6;
        }

        .companies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
        }

        .company-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: block;
        }

        .company-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .company-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .company-logo {
            font-size: 24px;
            width: 50px;
            text-align: center;
        }

        .company-info h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .company-info p {
            font-size: 14px;
            color: #6b7280;
        }

        .payment-fields {
            margin-bottom: 24px;
        }

        .fields-label {
            font-size: 12px;
            font-weight: 600;
            color: #9ca3af;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fields-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .field-tag {
            background: rgba(255, 153, 153, 0.1);
            color: #ff6b6b;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        .pay-button {
            width: 100%;
            background: linear-gradient(135deg, var(--category-color) 0%, var(--category-color) 100%);
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header,
            .category-header {
                padding: 24px;
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
    <div class="container">
        <a href="{{ route('payment.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Payments
        </a>

        <div class="header">
            <h1>
                <i class="{{ $category['icon'] }}"></i>
                {{ $category['name'] }}
            </h1>
            <p>{{ $category['description'] }}</p>
        </div>

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