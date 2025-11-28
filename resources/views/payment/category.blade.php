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

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 48px 40px;
            margin-bottom: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .breadcrumb a:hover {
            color: white;
        }

        .breadcrumb i {
            font-size: 12px;
        }

        .page-title-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .category-icon-large {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            flex-shrink: 0;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .category-info {
            flex: 1;
        }

        .page-title {
            font-family: 'Poppins', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .category-description {
            color: rgba(255, 255, 255, 0.95);
            font-size: 16px;
            line-height: 1.5;
            font-weight: 400;
        }

        /* Companies Grid */
        .companies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }

        .company-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .company-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .company-header {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .company-logo {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, rgba(255, 152, 152, 0.15), rgba(255, 123, 123, 0.15));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #FF9898;
            flex-shrink: 0;
            border: 1px solid rgba(255, 152, 152, 0.2);
        }

        .company-info {
            flex: 1;
            min-width: 0;
        }

        .company-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 18px;
            color: #2d3748;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .company-description {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .payment-fields {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .field-tag {
            background: rgba(255, 152, 152, 0.12);
            color: #FF7B7B;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid rgba(255, 152, 152, 0.2);
        }

        .pay-button {
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(255, 152, 152, 0.25);
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(255, 152, 152, 0.4);
        }

        .pay-button:active {
            transform: translateY(0);
        }

        /* Category-specific colors */
        .category-phone .category-icon-large { color: #007bff; background: rgba(0, 123, 255, 0.15); border-color: rgba(0, 123, 255, 0.3); }
        .category-phone .company-logo { background: rgba(0, 123, 255, 0.12); color: #007bff; border-color: rgba(0, 123, 255, 0.2); }
        .category-phone .field-tag { background: rgba(0, 123, 255, 0.12); color: #007bff; border-color: rgba(0, 123, 255, 0.2); }
        .category-phone .pay-button { background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25); }
        
        .category-utilities .category-icon-large { color: #ff9800; background: rgba(255, 152, 0, 0.15); border-color: rgba(255, 152, 0, 0.3); }
        .category-utilities .company-logo { background: rgba(255, 152, 0, 0.12); color: #ff9800; border-color: rgba(255, 152, 0, 0.2); }
        .category-utilities .field-tag { background: rgba(255, 152, 0, 0.12); color: #ff9800; border-color: rgba(255, 152, 0, 0.2); }
        .category-utilities .pay-button { background: linear-gradient(135deg, #ff9800 0%, #e68900 100%); box-shadow: 0 4px 12px rgba(255, 152, 0, 0.25); }
        
        .category-internet .category-icon-large { color: #9c27b0; background: rgba(156, 39, 176, 0.15); border-color: rgba(156, 39, 176, 0.3); }
        .category-internet .company-logo { background: rgba(156, 39, 176, 0.12); color: #9c27b0; border-color: rgba(156, 39, 176, 0.2); }
        .category-internet .field-tag { background: rgba(156, 39, 176, 0.12); color: #9c27b0; border-color: rgba(156, 39, 176, 0.2); }
        .category-internet .pay-button { background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%); box-shadow: 0 4px 12px rgba(156, 39, 176, 0.25); }
        
        .category-government .category-icon-large { color: #f44336; background: rgba(244, 67, 54, 0.15); border-color: rgba(244, 67, 54, 0.3); }
        .category-government .company-logo { background: rgba(244, 67, 54, 0.12); color: #f44336; border-color: rgba(244, 67, 54, 0.2); }
        .category-government .field-tag { background: rgba(244, 67, 54, 0.12); color: #f44336; border-color: rgba(244, 67, 54, 0.2); }
        .category-government .pay-button { background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%); box-shadow: 0 4px 12px rgba(244, 67, 54, 0.25); }
        
        .category-insurance .category-icon-large { color: #4caf50; background: rgba(76, 175, 80, 0.15); border-color: rgba(76, 175, 80, 0.3); }
        .category-insurance .company-logo { background: rgba(76, 175, 80, 0.12); color: #4caf50; border-color: rgba(76, 175, 80, 0.2); }
        .category-insurance .field-tag { background: rgba(76, 175, 80, 0.12); color: #4caf50; border-color: rgba(76, 175, 80, 0.2); }
        .category-insurance .pay-button { background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%); box-shadow: 0 4px 12px rgba(76, 175, 80, 0.25); }

        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .logo-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .brand-name {
                font-size: 20px;
            }

            .back-btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .main-container {
                padding: 24px 16px;
            }

            .page-header {
                padding: 32px 24px;
            }

            .page-title-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .category-icon-large {
                width: 52px;
                height: 52px;
                font-size: 24px;
            }

            .page-title {
                font-size: 28px;
            }

            .category-description {
                font-size: 14px;
            }

            .companies-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .company-card {
                padding: 24px;
            }

            .company-logo {
                width: 50px;
                height: 50px;
                font-size: 22px;
            }

            .company-name {
                font-size: 16px;
            }

            .pay-button {
                padding: 12px 24px;
                font-size: 14px;
            }
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

    </style>
</head>
<body class="category-{{ $category['slug'] }}">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <span class="brand-name">PIGGY</span>
            </div>
            <a href="{{ route('payment.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Payments
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="breadcrumb">
                <a href="{{ route('payment.index') }}">Payments</a>
                <i class="fas fa-chevron-right"></i>
                <span>{{ $category['name'] }}</span>
            </div>
            <div class="page-title-section">
                <div class="category-icon-large">
                    <i class="{{ $category['icon'] }}"></i>
                </div>
                <div class="category-info">
                    <h1 class="page-title">{{ $category['name'] }}</h1>
                    <p class="category-description">{{ $category['description'] }}</p>
                </div>
            </div>
        </div>

        <!-- Companies Grid -->
        <div class="companies-grid">
            @foreach($category['companies'] as $company)
            <div class="company-card">
                <div class="company-header">
                    <div class="company-logo">{{ $company['logo'] }}</div>
                    <div class="company-info">
                        <h3 class="company-name">{{ $company['name'] }}</h3>
                        <p class="company-description">{{ $company['description'] }}</p>
                    </div>
                </div>
                
                <div class="payment-fields">
                    @foreach($company['fields'] as $field)
                    <span class="field-tag">{{ $field }}</span>
                    @endforeach
                </div>
                
                <a href="{{ route('payment.company', [$category['slug'], $company['slug']]) }}" class="pay-button">
                    Pay Now
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>