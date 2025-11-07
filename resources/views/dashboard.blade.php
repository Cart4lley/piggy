<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Piggy</title>

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

    .header-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .page-indicator {
      color: #666;
      font-size: 16px;
    }

    .header-right {
      display: flex;
      align-items: center;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 12px;
      background: white;
      padding: 8px 24px;
      border-radius: 15px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      min-width: 140px;
    }

    .user-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #FF9898;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 14px;
    }

    .user-name {
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }

    .main-body {
      flex: 1;
      padding: 30px;
    }

    /* ---- Content Grid ---- */
    .dashboard-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
      height: 100%;
    }

    .left-section {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .right-section {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* ---- Card Base Style ---- */
    .card {
      background: white;
      border-radius: 15px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      border: 1px solid rgba(0,0,0,0.05);
    }

    /* ---- Typography ---- */
    .page-title {
      font-size: 28px;
      font-weight: bold;
      color: #333;
    }

    .section-title {
      font-size: 20px;
      font-weight: bold;
      color: #333;
      margin-bottom: 15px;
    }

    /* ---- Header Info ---- */
    .header-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #FF9898;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
      font-size: 16px;
    }

    .user-details {
      display: flex;
      flex-direction: column;
    }

    .user-name {
      font-size: 16px;
      font-weight: bold;
      color: #333;
      line-height: 1;
    }

    .user-role {
      font-size: 12px;
      color: #666;
      line-height: 1;
    }

    .header-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .notification-btn {
      width: 40px;
      height: 40px;
      border: none;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .notification-btn:hover {
      background: #FFE6E6;
      color: #FF9898;
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
          <a href="/dashboard" class="nav-link active">
            <i class="nav-icon fas fa-chart-line"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('bank-transfer.index') }}" class="nav-link">
            <i class="nav-icon fas fa-university"></i>
            Bank Transfer
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
      <div class="header-left">
        <h1 class="page-title">Dashboard</h1>
        <span class="page-indicator">1 → ∞</span>
      </div>
      
      <div class="header-right">
        <div class="user-profile">
          <div class="user-avatar">YS</div>
          <span class="user-name">Yu Shuxin</span>
        </div>
      </div>
    </div>
    
    <div class="main-body">
      <div class="dashboard-grid">
        <div class="left-section">
          <!-- Balance card, Quick actions, Recent activities will go here -->
        </div>
        
        <div class="right-section">
          <!-- Transaction graph, Auto pay will go here -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>