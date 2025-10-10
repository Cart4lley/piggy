<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In</title>

  <!-- Lalezar font -->
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ---- Page background ---- */
    body {
      margin: 0;
      font-family: 'Lalezar', cursive;
      background: linear-gradient(to left, #FFB6C1, #FF9898);
      height: 100vh;
      display: flex;
      align-items: center;
      padding: 0;
      overflow: hidden;
    }

    /* ---- Main container ---- */
    .container {
      display: flex;
      width: 100%;
      height: 100vh;
      position: relative;
    }

    /* ---- Left section for sign-in ---- */
    .left-section {
      width: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      z-index: 2;
    }

    /* ---- Right section for piggy bank ---- */
    .right-section {
      width: 50%;
      display: flex;
      justify-content: flex-end;
      align-items: flex-end;
      position: relative;
      z-index: 1;
    }

    /* ---- Sign-in panel ---- */
    .signin-box {
      background: #FFDBDB;
      border-radius: 20px;
      padding: 40px 35px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
      backdrop-filter: blur(10px);
    }

    .signin-box h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: bold;
      color: #605E5E;
    }

    /* Labels: Email / Username & Password */
    .signin-box label {
      display: block;
      margin: 10px 0 5px;
      font-weight: normal;
      font-family: 'Lalezar', cursive;
      font-size: 15px;           /* requested size */
      color: #605E5E;           /* requested color */
    }

    .signin-box input[type="text"],
    .signin-box input[type="password"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 10px;
      margin-bottom: 15px;
      outline: none;
      color: #0F0F0F;
      background: #fff;
      font-family: 'Lalezar', cursive;
      box-sizing: border-box;
    }

    /* ---- Checkbox styling ---- */
    .checkbox-input {
      border: none !important;
      outline: none;
      width: 13px;
      height: 13px;
      transform: scale(1.2);
    }

    /* ---- Remember + Forgot ---- */
    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-family: 'Lalezar', cursive;
      font-size: 15px;
      color: #605E5E;
      font-weight: normal;
    }
    
    .options label {
      font-family: 'Lalezar', cursive;
      font-size: 15px;           /* requested size */
      color: #605E5E;           /* requested color */
      font-weight: normal;
    }
    .options a {
      text-decoration: none;
      color: #6C63FF;
      font-weight: bold;
    }

    /* ---- Social buttons ---- */
    .social-icons {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      margin-bottom: 20px;
      gap: 0;
    }
    .social-icons button {
      background: #FFFFFF;
      border: none;
      border-radius: 12px;
      width: 50px;
      height: 50px;
      cursor: pointer;
      font-size: 20px;
      font-family: 'Lalezar', cursive;
      color: #605E5E;           /* requested color */
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
      transition: transform 0.2s;
      flex: 1;
      max-width: 50px;
      margin: 0 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .social-icons button:hover {
      transform: scale(1.05);
    }

    /* ---- Sign in button ---- */
    .signin-btn {
      width: 100%;
      padding: 12px;
      background: #FFFFFF;
      color: #FF9898;
      font-weight: bold;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      font-size: 16px;
      font-family: 'Lalezar', cursive;
    }
    .signin-btn i {
      margin-left: 6px;
    }

    /* ---- Piggy bank in right section ---- */
    .piggy {
      width: 85%;
      height: 85%;
    }
    .piggy img {
      width: 100%;
      height: 100%;
      display: block;
      pointer-events: none;
      object-fit: cover;
    }

    /* ---- Password input with toggle inside ---- */
    .password-container {
      position: relative;
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    #password {
      flex: 1;
      border: none;
      border-radius: 10px;
      padding: 10px 40px 10px 10px;
      outline: none;
      color: #0F0F0F;
      background: transparent;
      font-family: 'Lalezar', cursive;
      box-sizing: border-box;
      margin-bottom: 0;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      background: none;
      border: none;
      cursor: pointer;
      color: #605E5E;
      font-size: 14px;
      padding: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .password-toggle:hover {
      color: #FF9898;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left section with sign-in form -->
    <div class="left-section">
      <div class="signin-box">
        <h2 id="signin-title" class="form-title">SIGN IN</h2>
        <form id="signin-form" class="signin-form">
          <label for="email-username" class="input-label">Email / Username</label>
          <input type="text" id="email-username" class="form-input" placeholder="john@example.com or username" required>

          <label for="password" class="input-label">Password</label>
          <div class="password-container">
            <input type="password" id="password" class="form-input" placeholder="••••••••••••" required>
            <button type="button" class="password-toggle" onclick="togglePassword()">
              <i class="fas fa-eye" id="toggle-icon"></i>
            </button>
          </div>

          <div class="options form-options">
            <label for="remember-me" class="checkbox-label">
              <input type="checkbox" id="remember-me" class="checkbox-input"> Remember Me
            </label>
            <a href="#" id="forgot-password" class="forgot-link">Forgot Password ?</a>
          </div>

          <div class="social-icons">
            <button type="button" id="google-btn" class="social-btn google-btn">
              <i class="fab fa-google"></i>
            </button>
            <button type="button" id="email-btn" class="social-btn email-btn">
              <i class="fas fa-envelope"></i>
            </button>
            <button type="button" id="facebook-btn" class="social-btn facebook-btn">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" id="qr-btn" class="social-btn qr-btn">
              <i class="fas fa-qrcode"></i>
            </button>
          </div>

          <button type="submit" id="signin-submit" class="signin-btn submit-btn">
            SIGN IN <i class="fas fa-arrow-right"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Right section with piggy bank image -->
    <div class="right-section">
      <div class="piggy">
        <img src="{{ asset('images/pigbank.png') }}" alt="Piggy Bank">
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggle-icon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>