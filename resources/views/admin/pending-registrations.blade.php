<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pending Registrations - PIGGY Bank Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background: #f5f5f5;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .title {
      color: #FF7B7B;
      text-align: center;
      margin-bottom: 30px;
    }
    .stats {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }
    .stat-card {
      flex: 1;
      background: #FFE6E6;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      border-left: 4px solid #FF9898;
    }
    .stat-number {
      font-size: 24px;
      font-weight: bold;
      color: #FF7B7B;
    }
    .stat-label {
      font-size: 14px;
      color: #666;
      margin-top: 5px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #FF9898;
      color: white;
      font-weight: bold;
    }
    .status {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: bold;
    }
    .status-pending {
      background: #FFF3CD;
      color: #856404;
    }
    .status-verified {
      background: #D4EDDA;
      color: #155724;
    }
    .status-expired {
      background: #F8D7DA;
      color: #721C24;
    }
    .btn {
      background: #FF9898;
      color: white;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      font-size: 12px;
    }
    .btn:hover {
      background: #FF7B7B;
    }
    .no-data {
      text-align: center;
      color: #666;
      font-style: italic;
      padding: 40px;
    }
    .actions {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="title">🐷 Pending Registrations Admin</h1>
    
    <div class="stats">
      <div class="stat-card">
        <div class="stat-number">{{ $pendingRegistrations->where('verified_at', null)->where('expires_at', '>', now())->count() }}</div>
        <div class="stat-label">Pending Verifications</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">{{ $pendingRegistrations->where('verified_at', '!=', null)->count() }}</div>
        <div class="stat-label">Verified (Ready)</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">{{ $pendingRegistrations->where('expires_at', '<', now())->where('verified_at', null)->count() }}</div>
        <div class="stat-label">Expired</div>
      </div>
      <div class="stat-card">
        <div class="stat-number">{{ $pendingRegistrations->count() }}</div>
        <div class="stat-label">Total Requests</div>
      </div>
    </div>

    <div class="actions">
      <a href="{{ route('test.registration') }}" class="btn">📝 Test Registration</a>
      <a href="{{ route('register') }}" class="btn">🔗 Registration Page</a>
      <a href="/" class="btn">🏠 Home</a>
    </div>

    @if($pendingRegistrations->count() > 0)
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Initial Deposit</th>
            <th>Status</th>
            <th>Created</th>
            <th>Expires</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendingRegistrations as $pending)
            <tr>
              <td>{{ $pending->first_name }} {{ $pending->last_name }}</td>
              <td>{{ $pending->email }}</td>
              <td>{{ $pending->phone }}</td>
              <td>₱{{ number_format($pending->initial_deposit, 2) }}</td>
              <td>
                @if($pending->verified_at)
                  <span class="status status-verified">Verified</span>
                @elseif($pending->expires_at < now())
                  <span class="status status-expired">Expired</span>
                @else
                  <span class="status status-pending">Pending</span>
                @endif
              </td>
              <td>{{ $pending->created_at->format('M d, Y H:i') }}</td>
              <td>{{ $pending->expires_at->format('M d, Y H:i') }}</td>
              <td>
                @if(!$pending->verified_at && $pending->expires_at > now())
                  <a href="{{ $pending->getVerificationUrl() }}" class="btn" target="_blank">
                    ✉️ Verify Link
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="no-data">
        No pending registrations found. <br>
        <a href="{{ route('test.registration') }}">Create a test registration</a>
      </div>
    @endif
  </div>
</body>
</html>