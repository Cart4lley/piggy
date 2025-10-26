<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Piggy Banking</title>
    <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Lalezar', cursive;
            background: #FFE6E6;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #FFFFFF;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            display: flex;
            justify-content: center;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
        }

        .brand-text h2 {
            margin: 0;
            font-size: 20px;
            color: #FF9898;
        }

        .brand-text p {
            margin: -12px 0 0 0;
            font-size: 12px;
            color: #FF9898;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
        }

        .sidebar-nav ul {
            list-style: none;
            margin: 0;
            padding: 0 15px;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            text-decoration: none;
            color: #666;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .sidebar-nav a:hover {
            background: #FFE6E6;
            color: #FF9898;
        }

        .sidebar-nav a.active {
            background: #FF9898;
            color: white;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: none;
            border: none;
            color: #FF9898;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            font-family: 'Lalezar', cursive;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #FFE6E6;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            background: #FFE6E6;
            display: flex;
            flex-direction: column;
        }

        .main-header {
            background: #FFE6E6;
            padding: 20px 30px;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px 24px;
            border-radius: 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            min-width: 140px;
        }

        .user-profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .user-info h4 {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .user-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            display: flex;
            gap: 30px;
        }

        .content-left {
            flex: 2;
        }

        .content-right {
            flex: 1;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .content-card h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 18px;
        }

        .report-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .report-item:last-child {
            border-bottom: none;
        }

        .report-info h4 {
            margin: 0 0 5px 0;
            color: #333;
            font-size: 16px;
        }

        .report-info p {
            margin: 0;
            color: #666;
            font-size: 12px;
        }

        .generate-btn {
            background: #FF9898;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Lalezar', cursive;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .generate-btn:hover {
            background: #FF7B7B;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="brand-section">
                <img src="{{ asset('images/piggy-icon.png') }}" alt="Piggy" class="brand-icon">
                <div class="brand-text">
                    <h2>PIGGY</h2>
                    <p>we find ways</p>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <li><a href="{{ url('/dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
                <li><a href="{{ url('/transaction') }}"><i class="fas fa-cog"></i> Transaction</a></li>
                <li><a href="{{ url('/withdrawal') }}"><i class="fas fa-money-bill-wave"></i> Withdrawal</a></li>
                <li><a href="{{ url('/payment') }}"><i class="fas fa-credit-card"></i> Payment</a></li>
                <li><a href="{{ url('/history') }}"><i class="fas fa-history"></i> History</a></li>
                <li><a href="{{ url('/reports') }}" class="active"><i class="fas fa-file-alt"></i> Reports</a></li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <button class="logout-btn">Log Out</button>
        </div>
    </div>

    <div class="main-content">
        <div class="main-header">
            <div class="header-left">
                <h1>Reports</h1>
            </div>
            <div class="user-profile">
                <img src="https://via.placeholder.com/35/FF9898/FFFFFF?text=JD" alt="Profile">
                <div class="user-info">
                    <h4>John Doe</h4>
                    <p>Premium Account</p>
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="content-left">
                <div class="content-card">
                    <h3><i class="fas fa-file-alt"></i> Report Generation Module</h3>
                    
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Account Statement</h4>
                            <p>Monthly account activity and balance summary</p>
                        </div>
                        <button class="generate-btn">Generate</button>
                    </div>
                    
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Transaction Report</h4>
                            <p>Detailed transaction history with filters</p>
                        </div>
                        <button class="generate-btn">Generate</button>
                    </div>
                    
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Annual Summary</h4>
                            <p>Yearly financial overview and statistics</p>
                        </div>
                        <button class="generate-btn">Generate</button>
                    </div>
                    
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Tax Report</h4>
                            <p>Tax-related transactions and documentation</p>
                        </div>
                        <button class="generate-btn">Generate</button>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <div class="content-card">
                    <h3><i class="fas fa-download"></i> Recent Downloads</h3>
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Statement_Oct_2025.pdf</h4>
                            <p>Downloaded 2 days ago</p>
                        </div>
                        <i class="fas fa-file-pdf" style="color: #FF9898;"></i>
                    </div>
                    
                    <div class="report-item">
                        <div class="report-info">
                            <h4>Transactions_Sep_2025.xlsx</h4>
                            <p>Downloaded 1 week ago</p>
                        </div>
                        <i class="fas fa-file-excel" style="color: #FF9898;"></i>
                    </div>
                </div>

                <div class="content-card">
                    <h3><i class="fas fa-info-circle"></i> Report Information</h3>
                    <p style="color: #666; font-size: 14px; line-height: 1.5;">
                        Generate comprehensive reports for your banking activities. 
                        All reports are available in PDF and Excel formats for easy sharing and analysis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>