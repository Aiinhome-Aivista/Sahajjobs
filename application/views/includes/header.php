<?php
$seo_title = (!empty($seo) && !empty($seo->title))
  ? $seo->title
  : 'Recruitment and Jobs Online in India, UAE and entire world | SahajJobs';

$seo_description = (!empty($seo) && !empty($seo->description))
  ? $seo->description
  : 'Find jobs in India and international markets. Free job posting, best job portal for freshers.';

$seo_keywords = (!empty($seo) && !empty($seo->keywords))
  ? $seo->keywords
  : 'jobs, recruitment, job search, SahajJobs';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= htmlspecialchars($seo_title, ENT_QUOTES, 'UTF-8'); ?>
  </title>
<meta name="google-site-verification" content="t2NMOZLKW4Y4C7HdDX6LBDAM3hcIAn8YTGhYBGfGqes" />
<link rel="canonical" href="<?= base_url(uri_string()); ?>" />
<meta name="description" content="<?= htmlspecialchars($seo_description, ENT_QUOTES, 'UTF-8'); ?>">

  <meta name="keywords" content="<?= htmlspecialchars($seo_keywords, ENT_QUOTES, 'UTF-8'); ?>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

  <!-- Firebase SDK (compat version for v8 style) -->
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>
  <script>
    // Your Firebase config
    const firebaseConfig = {
      apiKey: "AIzaSyArPK3Lb2xtZXeBXWXCq4_g4BopsjpNrN0",
      authDomain: "jobnest-1353e.firebaseapp.com",
      projectId: "jobnest-1353e",
      storageBucket: "jobnest-1353e.firebasestorage.app",
      messagingSenderId: "649093243578",
      appId: "1:649093243578:web:8f9745abeacc310a229883",
      measurementId: "G-SXWKWBFB8P"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
  </script>


  <script async src="https://www.googletagmanager.com/gtag/js?id=G-W9MKX8D2Z7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-W9MKX8D2Z7');
  </script>


  <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
  <script>
    window.OneSignalDeferred = window.OneSignalDeferred || [];
    OneSignalDeferred.push(async function (OneSignal) {
      await OneSignal.init({
        appId: "4e747ccb-be5a-4bae-8a6b-567f316f3a66",
      });
    });
  </script>

  <!-- =======================
  INTERNAL STYLES
======================= -->
  <!-- Login Popup HTML and CSS -->
   <style>
    /* Alert styles */
    .alert {
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
    }

    .alert-danger {
      background: #f8d7da;
      color: #721c24;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 13000 !important;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 15% auto;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .modal-close {
      position: absolute;
      right: 15px;
      top: 10px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
      color: #666;
    }

    .modal-close:hover {
      color: #000;
    }

    .modal-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .modal-success .modal-title {
      color: #155724;
    }

    .modal-error .modal-title {
      color: #721c24;
    }

    .modal-error {
      border-left: 4px solid #dc3545;
    }

    .modal-message {
      font-size: 14px;
      line-height: 1.5;
    }

    .modal-success {
      border-left: 4px solid #28a745;
    }

    .login-popup-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(40, 50, 80, 0.15);
      display: none;
      justify-content: flex-end;
      z-index: 9999;
      transition: background 0.3s;
    }

    .glass-card {
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      background: rgba(255, 255, 255, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.35);
      z-index: 0;
    }


    .login-popup {
      width: 520px;
      box-shadow: 0 8px 40px rgba(30, 41, 60, 0.20);
      border-radius: 24px 0 0 24px;
      padding: 36px 38px 28px 38px;
      margin-top: 1px;
      margin-bottom: 3px;
      display: flex;
      flex-direction: column;
      position: relative;
      min-height: 540px;
      animation: slideInRight 0.28s cubic-bezier(.2, .75, .35, 1.1);
    }

    @keyframes slideInRight {
      from {
        transform: translateX(460px);
        opacity: 0.2;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .login-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 30px;
      color: #29374d;
    }

    .register-for-free {
      position: absolute;
      right: 45px;
      top: 45px;
      font-weight: 500;
      font-size: 15px;
      text-decoration: none;
      background: #FFF44F;
      color: #29374d;
      border-radius: 24px;
      padding: 12px 24px;
      transition: all 0.3s ease;
      border: none;
    }

    .login-form label {
      margin: 11px 0 6px 0;
      font-size: 15px;
      color: #1b212b;
      font-weight: 500;
      letter-spacing: 0.02em;
    }

    .login-form input[type="text"],
    .login-form input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #808080;
      border-radius: 12px;
      font-size: 16px;
      margin-bottom: 5px;
      outline: none;
      background: #fff !important;
      color: #27365c;
      transition: border 0.22s;
    }

    .login-form input[type="text"]:focus,
    .login-form input[type="password"]:focus {
      border-color: #808080;
    }

    .input-error {
      border: 1px solid red !important;
    }

    .search-box-error {
      border: 1.5px solid #d32f2f !important;
      /* Red border */
      box-shadow: 0px 1px 4px rgba(211, 47, 47, 0.08);
      /* Optional for subtle shadow */
      border-radius: 28px;
      /* Matching naukri style */
      transition: border 0.2s;
    }

    .text-danger {
      color: red;
    }

    .login-form input[type="submit"] {
      width: 100%;
      padding: 10px;
      background: #FFF44F;
      color: #29374d;
      border: none;
      border-radius: 24px;
      font-size: 17px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 8px;
      letter-spacing: .04em;
      transition: background 0.2s;
    }

    .login-form input[type="submit"]:hover {
      background: #d3c830ff;
    }

    .login-actions {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-bottom: 6px;
      margin-top: 10px;
    }

    .login-link {
      color: #1b212b;
      font-size: 13px;
      text-decoration: none;
      font-weight: 500;
      margin-left: auto;
    }

    .login-divider {
      text-align: center;
      margin-top: 22px;
      margin-bottom: 12px;
      color: #a3afd6;
      font-size: 14px;
      position: relative;
    }

    .login-divider::before,
    .login-divider::after {
      content: "";
      display: inline-block;
      width: 46px;
      height: 1px;
      background: #e6eafd;
      vertical-align: middle;
      margin: 0 10px;
    }

    .login-google {
      display: block;
      width: 100%;
      text-align: center;
      background: #fff;
      border: 1px solid #FFF44F;
      border-radius: 100px;
      padding: 7px 0;
      color: #3078e7;
      font-weight: 700;
      margin-top: 12px;
      */ font-size: 16px;
      cursor: pointer;
      transition: background 0.15s, color 0.15s;
    }

    .login-google:hover {
      background: #f4faff;
      border-color: #FFF44F;
      color: #3078e7;
    }

    @media (max-width: 700px) {
      .login-popup-bg {
        justify-content: center;
      }

      .login-popup {
        width: 100vw;
        border-radius: 0;
        padding: 22px 12px;
        margin: 18px 0;
      }
    }

    .login-close {
      position: absolute;
      top: 2px;
      right: 22px;
      font-size: 35px;
      color: #575b67ff;
      cursor: pointer;
      line-height: 1;
      font-weight: 700;
      transition: color 0.15s;
    }

    .login-close:hover {
      color: #b6bed7;
    }

    /* Search bar styles */
    .search-bar-top {
      background: #fff;
      border-radius: 999px;
      padding: 13px 25px;
      box-shadow: 0 8px 32px rgba(44, 62, 80, 0.08);
      display: flex;
      align-items: center;
      margin-bottom: 25px;
      margin-left: 9rem;
      border: none;
      width: 1000px;
    }

    .search-bar-top .input-group-text {
      background-color: transparent;
      border: none;
      color: #8893b3;
      font-size: 1.3rem;
      padding-right: 12px;
      padding-left: 0;
      display: flex;
      align-items: center;
    }

    .search-input-field-top {
      display: flex;
      align-items: center;
      flex-grow: 1;
      margin-right: 0;
      position: relative;
    }

    .search-bar-top .form-control {
      background: transparent;
      border: none;
      box-shadow: none;
      padding-left: 0;
      padding-right: 15px;
      font-size: 1.1rem;
      color: #222;
      font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
      font-weight: 400;
      transition: color 0.2s;
    }

    .search-bar-top .form-control::placeholder {
      color: #8893b3;
      opacity: 1;
      font-weight: 400;
    }

    .search-bar-top .form-control:focus {
      outline: none;
      color: #222;
    }

    .search-bar-top .btn-primary {
      background-color: #FFF44F;
      border: none;
      padding: 10px 30px;
      border-radius: 999px;
      font-size: 1rem;
      font-weight: 560;
      color: #29374d;
      margin-left: 15px;
      box-shadow: none;
      transition: background 0.2s;
    }

    .search-bar-top .btn-primary:hover {
      background-color: #d3c830ff;
    }

    .search-input-divider-top {
      content: '';
      display: block;
      width: 1px;
      height: 60%;
      background: #e3e7f0;
      margin: 0 15px;
      align-self: center;
    }

    @media (max-width: 992px) {
      .search-bar-top {
        flex-direction: column;
        padding: 15px;
        border-radius: 24px;
      }

      .search-input-field-top {
        width: 100%;
        margin-right: 0;
        margin-bottom: 15px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 15px;
      }

      .search-input-divider-top {
        display: none !important;
      }

      .search-bar-top .btn-primary {
        width: 100%;
        margin-left: 0;
        margin-top: 8px;
      }
    }

    .menu-item-underline:hover .menu-underline {
      display: block !important;
    }

    .menu-link {
      position: relative;
      z-index: 2;
    }

    /* Enhanced button hover effects */
    .login-button:hover {
      background-color: #ebf2ff !important;
      box-shadow: 0 2px 4px rgba(48, 120, 231, 0.2);
    }

    .register-button:hover {
      background-color: #d3c830ff !important;
      box-shadow: 0 2px 4px rgba(252, 90, 54, 0.3);
    }

    .cvmaker-button:hover {
      background-color: #04D9FF !important;
      color: white !important;
    }

    .login-button {
      cursor: pointer;
    }

    .employer-dropdown {
      position: relative;
      display: inline-block;
    }

    .employer-link {
      color: #27365c;
      font-size: 18px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      padding-bottom: 0px;
      cursor: pointer;
    }

    .caret {
      border: solid #27365c;
      border-width: 0 2px 2px 0;
      display: inline-block;
      padding: 3px;
      transform: rotate(45deg);
      margin-top: 2px;
      transition: transform 0.3s ease;
    }

    .employer-underline {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 3px;
      background: #FFF44F;
      border-radius: 2px;
      transform: scaleX(0);
      transform-origin: center;
      transition: transform 0.3s ease;
    }

    /* Active state underline */
    .employer-dropdown.active .employer-underline {
      transform: scaleX(1);
    }

    .employer-menu {
      display: none;
      position: absolute;
      top: 46px;
      left: 50%;
      transform: translateX(-50%);
      min-width: 180px;
      background: #fff;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      border-radius: 12px;
      padding: 12px 0;
      z-index: 100;
    }

    .employer-menu a {
      display: block;
      padding: 10px 20px;
      color: #27365c;
      font-size: 16px;
      text-decoration: none;
      transition: background 0.2s;
    }

    .employer-menu a:hover {
      background: #f7f8fa;
    }

    /* Active state shows menu */
    .employer-dropdown.active .employer-menu {
      display: block;
    }

    /* Active state flips caret */
    .employer-dropdown.active .caret {
      transform: rotate(-135deg);
    }

    .menu-underline {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 3px;
      background: #FFF44F;
      border-radius: 2px;
      transform: scaleX(0);
      transform-origin: center;
      transition: transform 0.3s ease;
      pointer-events: none;
    }

    .menu-link:hover .menu-underline {
      transform: scaleX(1);
    }

    .menu-modal {
      margin-top: 10px !important;
    }

    .siteLogo {
      height: 50px;
      width: auto;
      display: block;
      position: absolute;
      top: -27px;
      left: -45px;
    }

    /* Responsive Menu */
    @media (max-width: 1024px) {
      header>div {
        padding: 0 24px !important;
      }

      #menuToggle {
        display: block !important;
      }

      #mainNav {
        display: none !important;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 99;
      }

      #mainNav.active {
        display: flex !important;
      }

      #mainNav>div {
        flex-direction: column !important;
        gap: 16px !important;
      }

      .employer-menu {
        position: static !important;
        transform: none !important;
        box-shadow: none !important;
      }

      .siteLogo {
        height: 50px;
        width: auto;
        display: block;
        position: absolute;
        top: -27px;
        left: -9px;
      }
    }

    @media (max-width: 768px) {
      #menuToggle {
        display: block !important;
      }

      #mainNav {
        display: none !important;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 99;
      }

      #mainNav.active {
        display: flex !important;
      }

      #mainNav>div {
        flex-direction: column !important;
        gap: 16px !important;
      }

      .employer-menu {
        position: static !important;
        transform: none !important;
        box-shadow: none !important;
      }
    }


    .google-ad-top {
      width: 100%;
      background: #f8f9fa;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 8px 0;
      position: relative;
      z-index: 10001;
    }

    .ad-placeholder {
      width: 100%;
      max-width: 970px;
      height: 90px;
      background: #e0e0e0;
      color: #555;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
    }

    /* Responsive ad size for mobile */
    @media (max-width: 768px) {
      .ad-placeholder {
        height: 60px;
        max-width: 320px;
      }
    }


    /* NEW: login header layout */
    .login-header-actions {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 5px;
    }

    /* Google button in header */
    .header-google-btn {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      margin-top: 0 !important;
      padding: 10px 14px;
      font-size: 15px;
    }

    /* Register button adjustment */
    .header-register-btn {
      position: static !important;
      white-space: nowrap;
      margin-top: 12px;
    }

    /* Neon glow links */
    .hero-neon {
      text-decoration: none;
      font-size: 1.1rem;
      font-weight: 500;
      color: #000000ff !important;
      text-shadow:
        0 0 5px #FFF44F,
        0 0 10px #FFF44F,
        0 0 20px #FFF44F,
        0 0 40px #FFF44F;
      animation: heroGlow 1.5s infinite alternate;
    }

    /* Glow animation */
    @keyframes heroGlow {
      from {
        text-shadow:
          0 0 5px #ffee00,
          0 0 10px #ffee00,
          0 0 20px #ffee00,
          0 0 40px #ffee00;
      }

      to {
        text-shadow:
          0 0 10px #fcf192,
          0 0 20px #fcf192,
          0 0 40px #fcf192,
          0 0 80px #fcf192;
      }
    }

    

    @media (max-width: 768px) {
      .siteLogo {
        height: 50px;
        width: auto;
        display: block;
        position: absolute;
        top: -27px;
        left: 0px;
      }
    }
  </style>
      <!--SCHEMA MARKUP START -->

    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "SahajJobs",
      "url": "https://www.sahajjobs.com",
      "logo": "https://www.sahajjobs.com/ALL_UPLOADS/images/SahajJOB2.png",
      "sameAs": [
        "https://www.linkedin.com/company/sahajjobs",
        "https://www.instagram.com/sahajjobs",
        "https://www.facebook.com/sahajjobs"
      ]
    }
    </script>
    
    <!-- WebSite Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "SahajJobs",
      "url": "https://www.sahajjobs.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://www.sahajjobs.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

   <!-- SCHEMA MARKUP END -->
</head>

<body>

  <!-- =======================
        HEADER
======================= -->
  <header style="background:#fff; border-bottom:1px solid #f2f2f2; position:sticky; top:0; left:0; width:100%; z-index:10000;">
    <div
      style="display:flex; align-items:center; justify-content:space-between; padding:0 150px; height:70px; position:relative;">

      <div style="position:relative;">
        <a href="<?= base_url(); ?>">
          <img class="siteLogo" src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png'); ?>" alt="SahajJOB2"
            style="">
        </a>
      </div>

      <!-- Mobile Toggle Button -->
      <button id="menuToggle" class="menu-toggle"
        style="display:none; font-size:26px; background:none; border:none; cursor:pointer; color:#27365c;">
        ☰
      </button>

      <!-- Menu Section -->
      <nav id="mainNav" style="display:flex; align-items:center; gap:24px;">
        
        <div class="employer-dropdown" id="employerDropdown">
            <a href="#" class="employer-link" id="employerToggle">
              For employers
              <span class="caret"></span>
            </a>
            <span class="employer-underline"></span>
            <div class="employer-menu">
              <a href="<?= base_url('employer_register'); ?>">Employer Register</a>
              <a href="<?= base_url('employer_login'); ?>">Employer Login</a>
            </div>
        </div>
          
        <!-- Action Buttons -->
        <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
          <a class="login-button" id="showLoginPopup"
            style="border:2px solid #FFF44F; border-radius:24px; padding:8px 24px; color:#050203; font-size:16px; text-decoration:none; transition: all 0.3s ease;">
            Login
          </a>
          <a href="<?= base_url('register'); ?>" class="register-button"
            style="background:#FFF44F; color:#29374d; border-radius:24px; padding:8px 24px; font-size:16px; text-decoration:none; transition: all 0.3s ease;">
            Register
          </a>
          
          <a href="<?= base_url('blogs'); ?>" class="hero-neon">
            Knowledge base
          </a>

          <a href="<?= base_url('cv-maker'); ?>" class="cvmaker-button"
            style="background:#ffd900; color:#29374d; border-radius:24px; padding:8px 24px; font-size:16px; text-decoration:none; transition: all 0.3s ease;">
            Free CV Maker
          </a>
        </div>
      </nav>
    </div>

    <!-- Jobs Modal -->
    <div id="jobsModal" class="menu-modal"
      style="display:none; position:absolute; top:70px; left:50%; transform:translateX(-50%); background:#fff; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:9; width: 700px; border-radius:12px;">
      <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
        <?php foreach ($menu['Jobs'] as $sub): ?>
          <div>
            <h4 style="margin:8px 0; font-size:15px; color:#333; font-weight:bold;"><?= $sub['sub_type'] ?></h4>
            <ul style="list-style:none; margin:0; padding:0 0 12px 0;">
              <?php foreach ($sub['children'] as $child): ?>
                <li>
                  <a href="#" style="text-decoration:none; font-size:14px; color:#555; display:block; padding:4px 0;">
                    <?= $child['name'] ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Companies Modal -->
    <div id="companiesModal" class="menu-modal"
      style="display:none; position:absolute; top:70px; left:50%; transform:translateX(-50%); background:#fff; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:9; width: 700px; border-radius:12px;">
      <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
        <?php foreach ($menu['Companies'] as $sub): ?>
          <div>
            <h4 style="margin:8px 0; font-size:15px; color:#333; font-weight:bold;"><?= $sub['sub_type'] ?></h4>
            <ul style="list-style:none; margin:0; padding:0 0 12px 0;">
              <?php foreach ($sub['children'] as $child): ?>
                <li>
                  <a href="#" style="text-decoration:none; font-size:14px; color:#555; display:block; padding:4px 0;">
                    <?= $child['name'] ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Services Modal -->
    <div id="servicesModal" class="menu-modal"
      style="display:none; position:absolute; top:70px; left:50%; transform:translateX(-50%); background:#fff; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,0.1); z-index:9; width: 700px; border-radius:12px;">
      <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
        <?php foreach ($menu['Services'] as $sub): ?>
          <div>
            <h4 style="margin:8px 0; font-size:15px; color:#333; font-weight:bold;"><?= $sub['sub_type'] ?></h4>
            <ul style="list-style:none; margin:0; padding:0 0 12px 0;">
              <?php foreach ($sub['children'] as $child): ?>
                <li>
                  <a href="#" style="text-decoration:none; font-size:14px; color:#555; display:block; padding:4px 0;">
                    <?= $child['name'] ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="login-popup-bg" id="loginPopupBg">
      <div class="login-popup glass-card">
        <span class="login-close" id="closeLoginPopup">&times;</span>
       <div class="login-header-actions">
          <button id="googleSignInBtn" class="login-google">
            <img style="height:30px; width:30px;" src="<?= base_url('./ALL_UPLOADS/images/google.png'); ?>"
              alt="google" />
            Sign in with Google
          </button>

          <button class="register-for-free header-register-btn"
            onclick="window.location.href='<?= base_url('register'); ?>'">
            Register for free
          </button>
        </div>

        <center>Or</center>
        <hr>
        
        <form class="login-form" method="post" action="<?= base_url('login/process'); ?>" autocomplete="off" novalidate>


          <input type="hidden" name="redirect_url" id="redirect_url">

          <label for="login-username">Email ID / Username<span style="color:#e42e2e;">*</span></label>
          <input type="text" id="login-username" name="username" placeholder="Enter your active Email ID / Username"
            required>
          <small id="email-error" class="text-danger" style="display:none; font-size: 0.85em;">Please enter a valid
            email
            address</small>

          <div style="position:relative;">
            <label for="login-password">Password<span style="color:#e42e2e;">*</span></label>
            <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
            <span id="toggle-password" style="position:absolute; top:57px; right:15px; cursor:pointer;">
              <i class="far fa-eye-slash"></i>
            </span>
          </div>
          <small id="password-error" class="text-danger" style="display:none; font-size: 0.85em;">Please enter
            your password</small>


          <div class="login-actions">
            <a href="<?= base_url('login/forgot'); ?>" class="login-link">Forgot Password?</a>
          </div>

          <!-- CAPTCHA SECTION -->
          <div class="form-group">
            <label for="captcha">Enter CAPTCHA<span style="color:#e42e2e;">*</span></label>

            <div style="display:flex;align-items:center;gap:15px;margin-bottom:8px;">
              <?= $captcha_image; ?>

              <a href="javascript:void(0);" onclick="location.reload();" title="Refresh CAPTCHA"
                style="font-size:18px;color:#555;text-decoration:none;">
                <i class="fas fa-sync-alt"></i>
              </a>
            </div>
            <input type="text" name="captcha" id="captcha" placeholder="Enter captcha text">
            <span class="error-msg"></span>
          </div>
          <input type="submit" value="Login">
        </form>
      </div>
    </div>
    <!-- Flash Message Modal -->
    <div id="flashModal" class="modal">
      <div class="modal-content" id="modalContent">
        <span class="modal-close" id="modalClose">&times;</span>
        <div class="modal-title" id="modalTitle"></div>
        <div class="modal-message" id="modalMessage"></div>
      </div>
    </div>

  </header>

  <script>
    document.getElementById('googleSignInBtn').addEventListener('click', function () {
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider)
        .then(function (result) {
          var user = result.user;

          // Send user info to CodeIgniter backend
          fetch('<?= base_url('login/google_callback') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              uid: user.uid,
              full_name: user.displayName,
              email: user.email,
              picture: user.photoURL,
              provider: 'google'
            })
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                window.location.href = '<?= base_url('candidate_job_search') ?>';
                const redirectInput = document.getElementById('redirect_url');
                if (redirectInput && redirectInput.value) {
                  window.location.href = '<?= base_url() ?>' + redirectInput.value;
                } else {
                  window.location.href = '<?= base_url('candidate_job_search') ?>';
                }
              } else {
                showFlashModal('error', 'Login failed: ' + data.message);
              }
            });
        })
        .catch(function (error) {
          showFlashModal('error', error.message);
        });
    });

  </script>

  <script>
    const emailInput = document.getElementById('login-username');
    const passwordInput = document.getElementById('login-password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    document.querySelector('.login-form').addEventListener('submit', function (event) {
      let isValid = true;

      // Reset errors
      emailError.style.display = 'none';
      passwordError.style.display = 'none';
      emailInput.classList.remove('input-error');
      passwordInput.classList.remove('input-error');

      const emailVal = emailInput.value.trim();
      const pwdVal = passwordInput.value.trim();

      // Email validation

      if (!emailVal || !emailRegex.test(emailVal)) {
        emailError.style.display = 'block';
        emailError.textContent = 'Please enter a valid email address';
        emailInput.classList.add('input-error');
        isValid = false;
      }


      // Password validation
      if (!pwdVal) {
        passwordError.style.display = 'block';
        passwordError.textContent = 'Please enter your password';
        passwordInput.classList.add('input-error');
        isValid = false;
      } else if (pwdVal.length < 6) {
        passwordError.style.display = 'block';
        passwordError.textContent = 'Password must be at least 6 characters';
        passwordInput.classList.add('input-error');
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault();
      }
    });

    // Dynamic (live) email validation
    emailInput.addEventListener('input', function () {
      const val = emailInput.value.trim();

      if (emailRegex.test(val)) {
        emailError.style.display = 'none';
        emailInput.classList.remove('input-error');
      } else {
        emailError.style.display = 'block';
        emailError.textContent = 'Please enter a valid email address';
        emailInput.classList.add('input-error');
      }

    });

    // Dynamic (live) password validation
    passwordInput.addEventListener('input', function () {
      const val = passwordInput.value.trim();
      if (val.length >= 6) {
        passwordError.style.display = 'none';
        passwordInput.classList.remove('input-error');
      }
      else {
        passwordError.style.display = 'block';
        passwordError.textContent = 'Password must be at least 6 characters';
        passwordInput.classList.add('input-error');
      }
    });

    // Password toggle code remains the same
    document.getElementById('toggle-password').addEventListener('click', function () {
      const pwd = passwordInput;
      const icon = this.querySelector('i');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });

  </script>

  <script>
    // Show flash messages in modal
    document.addEventListener('DOMContentLoaded', function () {
      <?php if ($this->session->flashdata('success')): ?>
        showFlashModal('success', '<?= $this->session->flashdata('success') ?>');
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
        showFlashModal('error', '<?= $this->session->flashdata('error') ?>');
      <?php endif; ?>

      function showFlashModal(type, message) {
        const modal = document.getElementById('flashModal');
        const modalContent = document.getElementById('modalContent');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');

        // Set modal content based on type
        if (type === 'success') {
          modalTitle.textContent = 'Success';
          modalContent.classList.add('modal-success');
        } else {
          modalTitle.textContent = 'Error';
          modalContent.classList.add('modal-error');
        }

        modalMessage.textContent = message;
        modal.style.display = 'block';

        // Auto close after 5 seconds
        setTimeout(() => {
          modal.style.display = 'none';
        }, 15000);
      }

      // Close modal when clicking close button
      document.getElementById('modalClose').addEventListener('click', function () {
        document.getElementById('flashModal').style.display = 'none';
      });

      // Close modal when clicking outside
      window.addEventListener('click', function (event) {
        const modal = document.getElementById('flashModal');
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const toggle = document.getElementById("employerToggle");
      const dropdown = document.getElementById("employerDropdown");

      // Toggle on click
      toggle.addEventListener("click", (e) => {
        e.preventDefault();
        dropdown.classList.toggle("active");
      });

      // Close when clicking outside
      document.addEventListener("click", (e) => {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove("active");
        }
      });

      // Mobile menu toggle
      const menuToggle = document.getElementById("menuToggle");
      const mainNav = document.getElementById("mainNav");
      menuToggle.addEventListener("click", () => {
        mainNav.classList.toggle("active");
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Modal logic - improved with better hover handling
      const menuLinks = document.querySelectorAll('.menu-link');
      const modals = document.querySelectorAll('.menu-modal');

      // Add a small gap between menu and modal with a pseudo-element
      const style = document.createElement('style');
      style.textContent = `
      .menu-link::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 15px;
        background: transparent;
        z-index: 8;
      }
    `;
      document.head.appendChild(style);

      let activeModal = null;
      let closeTimeout = null;

      menuLinks.forEach(link => {
        const targetModalId = link.getAttribute('data-modal-target');
        const targetModal = document.getElementById(targetModalId);

        link.addEventListener('mouseenter', function () {
          // Clear any pending close timeouts
          clearTimeout(closeTimeout);

          // Hide all other modals
          modals.forEach(modal => {
            if (modal.id !== targetModalId) {
              modal.style.display = 'none';
            }
          });

          // Show this modal
          targetModal.style.display = 'block';
          activeModal = targetModal;
        });

        link.addEventListener('mouseleave', function () {
          // Set a timeout to close the modal only if not hovering over modal
          closeTimeout = setTimeout(() => {
            if (activeModal && !activeModal.matches(':hover')) {
              activeModal.style.display = 'none';
              activeModal = null;
            }
          }, 300); // Increased delay for better usability
        });

        targetModal.addEventListener('mouseenter', function () {
          // Clear timeout when mouse enters modal
          clearTimeout(closeTimeout);
        });

        targetModal.addEventListener('mouseleave', function () {
          // Close modal after mouse leaves
          closeTimeout = setTimeout(() => {
            targetModal.style.display = 'none';
            activeModal = null;
          }, 300);
        });
      });

      // Close modal when clicking outside
      document.addEventListener('click', function (event) {
        if (!event.target.closest('.menu-link') && !event.target.closest('.menu-modal')) {
          modals.forEach(modal => {
            modal.style.display = 'none';
          });
          activeModal = null;
        }
      });

      // Login popup logic
      var loginBtn = document.getElementById('showLoginPopup');
      var popupBg = document.getElementById('loginPopupBg');
      var closeBtn = document.getElementById('closeLoginPopup');
      if (loginBtn && popupBg) {
        loginBtn.onclick = function () {
          popupBg.style.display = 'flex';
        };
        closeBtn.onclick = function () {
          popupBg.style.display = 'none';
        };
        popupBg.onclick = function (e) {
          if (e.target === popupBg) popupBg.style.display = 'none';
        };
      }

      // Check if URL has showLogin parameter and open login modal
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('showLogin') === 'true') {
        if (popupBg) {
          popupBg.style.display = 'flex';
        }
        
        const redirectParam = urlParams.get('redirect');
        if (redirectParam) {
          const redirectInput = document.getElementById('redirect_url');
          if (redirectInput) {
            redirectInput.value = redirectParam;
          }
        }

        // Clean up the URL without reloading the page
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
      }
    });
  </script>

  <?php if (!empty($showLoginPopup)): ?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const popupBg = document.getElementById('loginPopupBg');
        if (popupBg) {
          popupBg.style.display = 'flex';
        }
      });
    </script>
  <?php endif; ?>
</body>

</html>