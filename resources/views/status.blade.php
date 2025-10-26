<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIGGY Registration Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
            color: #FF7B7B;
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 2px solid #FF9898;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #FF7B7B;
        }
        .stat-label {
            color: #666;
            margin-top: 5px;
        }
        .nav-links {
            text-align: center;
            margin-top: 20px;
        }
        .nav-links a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #FF7B7B;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .nav-links a:hover {
            background-color: #FF6B6B;
        }
        .recent-list {
            margin-top: 30px;
        }
        .registration-item {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border-left: 4px solid #FF7B7B;
        }
        .registration-name {
            font-weight: bold;
            color: #333;
        }
        .registration-email {
            color: #666;
            font-size: 0.9em;
        }
        .registration-time {
            color: #999;
            font-size: 0.8em;
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐷 PIGGY Registration System Status</h1>
        
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">{{ $totalPending }}</div>
                <div class="stat-label">Pending Registrations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $totalUsers }}</div>
                <div class="stat-label">Registered Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $todayRegistrations }}</div>
                <div class="stat-label">Today's Registrations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $expiredPending }}</div>
                <div class="stat-label">Expired Pending</div>
            </div>
        </div>

        @if($recentPending->count() > 0)
        <div class="recent-list">
            <h3>Recent Pending Registrations:</h3>
            @foreach($recentPending as $pending)
            <div class="registration-item">
                <div class="registration-time">{{ $pending->created_at->diffForHumans() }}</div>
                <div class="registration-name">{{ $pending->first_name }} {{ $pending->last_name }}</div>
                <div class="registration-email">{{ $pending->email }}</div>
                <div style="clear: both; margin-top: 5px;">
                    <small>Status: 
                        @if($pending->expires_at < now())
                            <span style="color: red;">Expired</span>
                        @elseif($pending->verified_at)
                            <span style="color: green;">Verified</span>
                        @else
                            <span style="color: orange;">Pending</span>
                        @endif
                    </small>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($recentUsers->count() > 0)
        <div class="recent-list">
            <h3>Recent Registered Users:</h3>
            @foreach($recentUsers as $user)
            <div class="registration-item">
                <div class="registration-time">{{ $user->created_at->diffForHumans() }}</div>
                <div class="registration-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                <div class="registration-email">{{ $user->email }}</div>
                <div style="clear: both; margin-top: 5px;">
                    <small>Account ID: {{ $user->account->account_number ?? 'N/A' }}</small>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="nav-links">
            <a href="{{ url('/simple-test') }}">Test Registration</a>
            <a href="{{ url('/test-registration') }}">Complex Test</a>
            <a href="{{ url('/admin/pending-registrations') }}">Admin Panel</a>
            <a href="{{ url('/') }}">Home</a>
        </div>
    </div>
</body>
</html>