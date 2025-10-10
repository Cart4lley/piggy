<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Piggy</title>
  <link href="https://fonts.googleapis.com/css2?family=Lalezar&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      height: 100vh;
      background: #ff9999;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    /* Top Header Section */
    .top_header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 20px;
      background: #ff9999;
    }

    .brand_section {
      flex: 1;
      padding-left: 40px;
    }

    .nav_section {
      flex: 1;
      text-align: right;
    }

    /* Main Content Section */
    .main_content {
      display: flex;
      flex: 1;
      background: #ff9999;
    }

    .content_left {
      width: fit;
      padding-left: 60px;
      display: flex;
      flex-direction: column;
      
    }

    .content_right {
      width: 60%;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: visible;
    }

    .footer {
      width: 100%;
      height: auto;
      overflow: hidden;
      line-height: 0;
    }

    .footer svg {
      width: 100%;
      height: auto;
      display: block;
      background: transparent;
    }

    /* Typography Styles */
    .title {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 77px;
      font-weight: normal;
      color: white;
      margin: 0;
      margin-bottom: -50px;
    }

    .subtitle {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 25px;
      font-weight: normal;
      color: #FFD3D3;
      margin: 0;
      margin-top: -15px;
      margin-left: 5px;
    }

    .header {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 20px;
      font-weight: normal;
      color: white;
      display: flex;
      justify-content: space-evenly;
      
      align-items: center;
    }

    .header a {
      color: white;
      text-decoration: none;
    }

    .header a:hover {
      text-decoration: underline;
    }

    .description_title {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 70px;
      font-weight: normal;
      color: #413131;
      margin: 80px 0 -40px 0;
    }

    .description {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 33px;
      font-weight: normal;
      color: #5F5151;
      line-height: 1.5;
      margin: 10px 0 20px 0;
    }

    .button {
      font-family: 'Lalezar', Arial, sans-serif;
      font-size: 20px;
      font-weight: normal;
      color: #FF9898;
      background: white;
      padding: 5px 10px;
      padding-top: 10px;
      display: inline-flex;
      align-items: center;
      cursor: pointer;
      border: none;
      text-decoration: none;
      gap: 15px;
      width: fit-content;
    }

    .button-text {
      text-decoration: underline;
    }

    .button-icon {
      width: 20px;
      height: 20px;
      border: 2px solid #ff7b7b;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: transparent;
      text-decoration: none;
    }

    .button-icon i {
      color: #ff7b7b;
      font-size: 14px;
    }

    .title_line1 {
      border: none;
      height: 2px;
      background-color: white;
      margin: 10px 0;
      width: 100%;
    }

    .title_line2 {
      border: none;
      height: 2px;
      background-color: white;
      margin: 0px 0;
      width: 65%;
    }

    .piggy_image {
      width: 600px;
      height: auto;
      object-fit: contain;
      position: absolute;
      top: 300px;
      left: 1000px;
      transform: translate(-50%, -50%);
      z-index: 10;
    }

    .signin_button {
      background: white;
      color: #ff9999 !important;
      padding: 6px 20px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: normal;
      font-size: 16px;
      display: inline-block;
    }

    .signin_button:hover {
      background: #f0f0f0;
      text-decoration: none;
      color: #ff9999 !important;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Top Header Section -->
    <div class="top_header">
      <div class="brand_section">
        <div class="title">PIGGY</div>
        <div class="subtitle">we find pays</div>
      </div>
      <div class="nav_section">
        <div class="header">
          <a href="#home">HOME</a>
          <a href="#services">SERVICES</a>
          <a href="#about">ABOUT US</a>
          <a href="{{ url('/signin') }}" class="signin_button">SIGN IN</a>
        </div>
      </div>
    </div>

    <!-- Main Content Section -->
    <div class="main_content">
      <div class="content_left">
        <div class="description_title">ONLINE BANKING</div>
        <hr class="title_line1">
        <hr class="title_line2">
        <div class="description">
          More than just a piggy bank.<br>
          Turn your cents into sense.
        </div>
        <div class="button">
          <span class="button-text">JOIN US NOW</span>
          <span class="button-icon">
            <i class="fas fa-arrow-right"></i>
          </span>
        </div>
      </div>

      <div class="content_right">
        <div class="main_image">
          <img src="{{ asset('images/piggy-bank.png') }}" alt="Piggy Bank" class="piggy_image">
        </div>
      </div>
    </div>

    <div class="footer">
      <svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 230" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <path style="transform:translate(0, 0px); opacity:1" fill="white" d="M0,92L80,84.3C160,77,320,61,480,80.5C640,100,800,153,960,145.7C1120,138,1280,69,1440,38.3C1600,8,1760,15,1920,15.3C2080,15,2240,8,2400,19.2C2560,31,2720,61,2880,92C3040,123,3200,153,3360,138C3520,123,3680,61,3840,57.5C4000,54,4160,107,4320,130.3C4480,153,4640,146,4800,145.7C4960,146,5120,153,5280,134.2C5440,115,5600,69,5760,76.7C5920,84,6080,146,6240,176.3C6400,207,6560,207,6720,191.7C6880,176,7040,146,7200,111.2C7360,77,7520,38,7680,49.8C7840,61,8000,123,8160,157.2C8320,192,8480,199,8640,172.5C8800,146,8960,84,9120,80.5C9280,77,9440,130,9600,149.5C9760,169,9920,153,10080,141.8C10240,130,10400,123,10560,118.8C10720,115,10880,115,11040,118.8C11200,123,11360,130,11440,134.2L11520,138L11520,230L11440,230C11360,230,11200,230,11040,230C10880,230,10720,230,10560,230C10400,230,10240,230,10080,230C9920,230,9760,230,9600,230C9440,230,9280,230,9120,230C8960,230,8800,230,8640,230C8480,230,8320,230,8160,230C8000,230,7840,230,7680,230C7520,230,7360,230,7200,230C7040,230,6880,230,6720,230C6560,230,6400,230,6240,230C6080,230,5920,230,5760,230C5600,230,5440,230,5280,230C5120,230,4960,230,4800,230C4640,230,4480,230,4320,230C4160,230,4000,230,3840,230C3680,230,3520,230,3360,230C3200,230,3040,230,2880,230C2720,230,2560,230,2400,230C2240,230,2080,230,1920,230C1760,230,1600,230,1440,230C1280,230,1120,230,960,230C800,230,640,230,480,230C320,230,160,230,80,230L0,230Z"></path>
      </svg>
    </div>
  </div>
</body>
</html>
