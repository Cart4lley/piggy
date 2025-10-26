<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Withdrawal - Piggy</title>

  <!-- Lalezar font -->
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ---- Global Reset ---- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Lalezar', cursive;
      background: #FFE6E6;
      min-height: 100vh;
      display: flex;
    }

    /* ---- Sidebar ---- */
    .sidebar {
      width: 250px;
      background: #FFFFFF;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      z-index: 100;
    }

    .sidebar-header {
      padding: 20px;
      border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .brand-section {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .brand-icon {
      width: 45px;
      height: 45px;
    }

    .brand-title {
      font-size: 24px;
      font-weight: bold;
      color: #FF9898;
      letter-spacing: 1px;
    }

    .brand-subtitle {
      font-size: 10px;
      color: #FF9898;
      margin-top: -12px;
      letter-spacing: 0.5px;
    }

    .sidebar-nav {
      flex: 1;
      padding: 20px 0;
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid rgba(0,0,0,0.1);
    }

    /* ---- Navigation ---- */
    .nav-list {
      list-style: none;
      padding: 0 15px;
      margin: 0;
    }

    .nav-item {
      margin-bottom: 5px;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px;
      color: #666;
      text-decoration: none;
      border-radius: 10px;
      transition: all 0.3s ease;
      font-size: 16px;
    }

    .nav-link:hover {
      background: #FFE6E6;
      color: #FF9898;
    }

    .nav-link.active {
      background: #FF9898;
      color: white;
    }

    .nav-icon {
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    .logout-btn {
      display: block;
      width: 100%;
      padding: 12px 20px;
      background: none;
      border: none;
      color: #FF9898;
      font-family: 'Lalezar', cursive;
      font-size: 16px;
      cursor: pointer;
      border-radius: 10px;
      transition: all 0.3s ease;
      text-align: center;
    }

    .logout-btn:hover {
      background: #FFE6E6;
    }

    /* ---- Main Content ---- */
    .main-content {
      flex: 1;
      background: #FFE6E6;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .main-header {
      background: #FFE6E6;
      padding: 20px 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .main-body {
      flex: 1;
      padding: 30px;
    }

    .page-title {
      font-size: 28px;
      font-weight: bold;
      color: #333;
    }

    .card {
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border: 1px solid rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="brand-section">
        <img src="{{ asset('images/piggy-icon.png') }}" alt="Piggy Icon" class="brand-icon">
        <div class="brand-text">
          <div class="brand-title">PIGGY</div>
          <div class="brand-subtitle">we find ways</div>
        </div>
      </div>
    </div>
    
    <div class="sidebar-nav">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="/transaction" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            Transaction
          </a>
        </li>
        <li class="nav-item">
          <a href="/withdrawal" class="nav-link active">
            <i class="nav-icon fas fa-money-bill-wave"></i>
            Withdrawal
          </a>
        </li>
        <li class="nav-item">
          <a href="/payment" class="nav-link">
            <i class="nav-icon fas fa-credit-card"></i>
            Payment
          </a>
        </li>
        <li class="nav-item">
          <a href="/history" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            History
          </a>
        </li>
      </ul>
    </div>
    
    <div class="sidebar-footer">
      <button class="logout-btn">
        Log Out
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="main-header">
      <h1 class="page-title">Withdrawal</h1>
    </div>
    
    <div class="main-body">
      <div class="card">
        <h2>Withdrawal Management</h2>
        <p>Withdrawal page content will be implemented here.</p>
      </div>
    </div>
  </div>
</body>
</html>