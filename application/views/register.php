<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SahajJobs | Registration</title>
<link rel="canonical" href="https://www.sahajjobs.com/register" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Nunito', Arial, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: #f7f8fa;
      color: #222;
    }

    .spinner {
      border: 3px solid #f3f3f3;
      border-top: 3px solid #555;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      animation: spin 1s linear infinite;
      display: inline-block;
      margin-left: 8px;
      vertical-align: middle;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    .header {
      width: 100%;
      background: #fff;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
      padding: 10px 0;
      position: relative;
      z-index: 100;
    }

    .header-content {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      position: relative;
    }

    .logo img {
      width: auto;
      height: 60px;
      display: block;
    }

    .login-link {
      font-size: 14px;
      color: #666;
      white-space: nowrap;
    }

    .login-link a {
      color: #7b7a6e;
      text-decoration: none;
      font-weight: 900;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: flex-start;
      margin: 30px auto;
      padding: 0 20px;
      gap: 30px;
      max-width: 1300px;
      position: relative;
    }

    .left-card {
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
      padding: 30px 25px;
      width: 100%;
      max-width: 320px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: sticky;
      top: 100px;
      height: fit-content;
      max-height: calc(100vh - 120px);
      overflow-y: auto;
    }

    .left-card img {
      width: 180px;
      height: auto;
      margin-bottom: 16px;
    }

    .left-card h3 {
      font-size: 20px;
      font-weight: 600;
      text-align: left;
      width: 100%;
      margin-bottom: 18px;
    }

    .left-card ul {
      list-style: none;
      padding: 0;
      margin: 0;
      width: 100%;
    }

    .left-card ul li {
      font-size: 16px;
      margin-bottom: 14px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
      color: #222;
      line-height: 1.4;
    }

    .left-card ul li .green-dot {
      min-width: 16px;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: #38b200;
      display: inline-block;
      margin-right: 4px;
      position: relative;
      flex-shrink: 0;
      margin-top: 3px;
    }

    .left-card ul li .green-dot::before {
      content: '✔';
      color: #fff;
      position: absolute;
      left: 2px;
      top: -1px;
      font-size: 13px;
      font-weight: bold;
    }

    .form-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 900px;
      padding: 30px;
      position: relative;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .form-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 6px;
    }

    .form-subtitle {
      font-size: 14px;
      color: #666;
      margin-bottom: 28px;
    }

    .form-row {
      display: flex;
      gap: 24px;
      align-items: flex-start;
      position: relative;
    }

    .form-fields {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
      position: relative;
    }

    .form-group label {
      font-size: 15px;
      font-weight: 500;
      color: #1b212b;
      margin-bottom: 1px;
    }

    .form-group input {
      padding: 13px 18px;
      font-size: 16px;
      border: 1px solid #808080;
      border-radius: 8px;
      outline: none;
      background: #fff;
      transition: border 0.2s;
    }

    .form-group input:focus {
      border: 1px solid #808080;
      background: #fff;
    }

    .form-group .input-hint {
      font-size: 13px;
      color: #8a95ad;
      margin-top: 2px;
    }

    .form-group input[type="checkbox"] {
      width: 18px;
      height: 18px;
      margin-right: 6px;
    }

    .work-status-group {
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }

    .work-status-card {
      border: 1.5px solid #d7dbe3;
      border-radius: 12px;
      padding: 9px 20px;
      background: #f7f8fa;
      cursor: pointer;
      flex: 1;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: border 0.2s, box-shadow 0.2s;
      font-size: 15px;
      position: relative;
      min-width: 180px;
    }

    .work-status-card.selected {
      border: 2px solid #FFF44F;
      background: #eef4ff;
      box-shadow: 0 2px 8px rgba(29, 78, 216, 0.08);
    }

    .work-status-card .icon {
      width: 28px;
      height: 28px;
      background: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      border: 1.5px solid #e1e6ef;
      flex-shrink: 0;
    }

    .work-status-card .info {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .work-status-card .info .title {
      font-weight: 600;
      color: #222;
      font-size: 15px;
    }

    .work-status-card .info .desc {
      font-size: 13px;
      color: #8a95ad;
    }

    .checkbox-row {
      margin-top: 16px;
      display: flex;
      align-items: flex-start;
      gap: 4px;
    }

    .checkbox-row label {
      font-size: 15px;
      color: #222;
      font-weight: 400;
      margin-left: 3px;
      cursor: pointer;
      line-height: 1.4;
    }

    .terms-row {
      font-size: 13px;
      color: #8a95ad;
      margin-top: 5px;
      line-height: 1.5;
    }

    .terms-row a {
      color: #1d4ed8;
      text-decoration: none;
      margin: 0 2px;
    }

    .register-btn {
      margin-top: 30px;
      margin-bottom: 24px;
      margin-left: 120px;
      background: #FFF44F;
      color: #29374d;
      font-weight: 600;
      font-size: 16px;
      border-radius: 30px;
      border: none;
      padding: 14px 0;
      width: 170px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(29, 78, 216, 0.04);
      transition: background 0.2s;
    }

    .register-btn:hover {
      background: #d3c830ff;
    }

    /* Fixed Google section styles */
    .google-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      width: 200px;
      position: relative;
      padding-left: 24px;
      margin-left: 24px;
    }

    .or-text {
      font-size: 14px;
      color: #666;
      margin-bottom: 12px;
      font-weight: 500;
    }

    .continue-text {
      font-size: 15px;
      color: #222;
      font-weight: 500;
      margin-bottom: 0px;
    }

    .google-btn {
      border: 1px solid #3078E7;
      border-radius: 8px;
      background: white;
      color: #3078E7;
      font-weight: 500;
      font-size: 25px;
      padding: 10px 38px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: background 0.2s;
      width: 100%;
      justify-content: center;
    }

    .google-btn:hover {
      background: #f8f9fa;
    }

    .google-btn img {
      width: 40px;
      height: 40px;
    }

    .toggle-password-eye {
      position: absolute;
      top: 35px;
      right: 16px;
      cursor: pointer;
      z-index: 2;
      display: flex;
      align-items: center;
      height: 38px;
    }


    .error-msg {
      color: red;
      font-size: 0.85em;
      display: none;
    }

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

    .modal-error .modal-title {
      color: #721c24;
    }

    .modal-error {
      border-left: 4px solid #dc3545;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
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

    .modal-message {
      font-size: 14px;
      line-height: 1.5;
    }

    .modal-success {
      border-left: 4px solid #28a745;
    }


    /* Responsive styles */
    @media (max-width: 1100px) {
      .container {
        flex-direction: column;
        align-items: center;
      }

      .left-card {
        max-width: 100%;
        position: static;
        margin-bottom: 20px;
        top: 0;
        height: auto;
      }

      .form-card {
        max-width: 100%;
      }

      .google-section {
        width: 100%;
        margin-left: 0;
        padding-left: 0;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #e8e8e8;
        border-left: none;
      }
    }

    @media (max-width: 768px) {
      .header-content {
        flex-direction: column;
        gap: 10px;
        text-align: center;
      }

      .logo {
        justify-content: center;
      }

      .form-card {
        padding: 20px;
      }

      .form-row {
        flex-direction: column;
        gap: 0;
      }

      .work-status-group {
        flex-direction: column;
      }

      .work-status-card {
        width: 100%;
      }

      .google-section {
        margin-top: 20px;
      }


      .register-btn {
        margin-left: auto;
        margin-right: auto;
        display: block;
      }


      .google-btn {
        border: 1px solid #3078E7;
        border-radius: 8px;
        background: white;
        color: #3078E7;
        font-weight: 500;
        font-size: 25px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 480px) {
      .header {
        padding: 8px 0;
      }

      .logo img {
        height: 50px;
      }

      .login-link {
        font-size: 13px;
      }

      .container {
        margin-top: 20px;
        padding: 0 15px;
        gap: 20px;
      }

      .left-card {
        padding: 20px;
      }

      .left-card h3 {
        font-size: 18px;
      }

      .left-card ul li {
        font-size: 14px;
      }

      .form-card {
        padding: 15px;
      }

      .form-title {
        font-size: 20px;
      }

      .form-group input {
        padding: 10px 38px 10px 15px;
        font-size: 15px;
      }

      .toggle-password-eye {
        right: 10px;
        top: 32px;
        height: 34px;
      }

      .work-status-card {
        padding: 15px;
      }

      .register-btn {
        width: 100%;
        max-width: 200px;
      }
    }

    @media (min-width: 481px) {
      .form-group input[type="password"] {
        padding-right: 42px;
      }
    }




    .phone-wrapper {
      display: flex;
      align-items: center;
    }

    .country-code {
      width: 120px;
      padding: 13px 10px;
      border: 1px solid #808080;
      border-right: none;
      border-radius: 8px 0 0 8px;
      background: #fff;
      font-size: 15px;
    }

    #mobile {
      flex: 1;
      border-radius: 0 8px 8px 0;
    }



    /* ===== Header row with google ===== */
    .form-header-row {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 16px;
      flex-wrap: nowrap;
      margin-bottom: 15px;
    }

    .form-title-box {
      display: flex;
      align-items: center;
      gap: 80px;
      white-space: nowrap;
    }

    .google-header-box {
      display: flex;
      align-items: center;
      gap: 10px;
      white-space: nowrap;
      margin-left: 17px;
    }

    /* ===== two column grid ===== */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 22px;
    }

    /* ===== responsive ===== */
    @media (max-width: 768px) {
      .form-grid {
        grid-template-columns: 1fr;
      }

      .google-header {
        width: 100%;
        text-align: left;
        margin-top: 10px;
      }

      .google-header-box {
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
        margin-left: 0px;
      }

      .form-header-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .form-title-box {
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
      }

    }

    /* ===== captcha side-by-side ===== */
    .captcha-row {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }

    .captcha-image-box {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 0px;
      border-radius: 8px;
    }

    .captcha-refresh {
      font-size: 18px;
      color: #555;
      text-decoration: none;
    }

    .captcha-input-box {
      flex: 1;
      min-width: 200px;
    }

    /* mobile */
    @media (max-width: 576px) {
      .captcha-row {
        flex-direction: column;
        align-items: stretch;
      }

      .captcha-input-box {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="header">
    <div class="header-content">
      <div class="logo">
        <a href="<?= base_url(); ?>">
          <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png'); ?>" alt="SahajJOB2">
        </a>
      </div>
      <div class="login-link">
        Already Registered? <a href="<?= base_url(); ?>?showLogin=true">Login</a> here
      </div>
    </div>
  </div>
  <div class="container">
    <div class="left-card">
      <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png'); ?>" alt="SahajJOB2">
      <h3>On registering, you can</h3>
      <ul>
        <li><span class="green-dot"></span>Build your profile and let recruiters find you</li>
        <li><span class="green-dot"></span>Get job postings delivered right to your email</li>
        <li><span class="green-dot"></span>Find a job and grow your career</li>
      </ul>
    </div>
    <div class="form-card">

      <div class="form-header-row">
        <div class="form-title-box">
          <div class="form-title">Create your Sahaj Jobs profile</div>
          <div class="form-header-divider">Or</div>
        </div>



        <div class="google-header-box">
          <button id="googleSignInBtn" class="google-btn">
            <img src="<?= base_url('./ALL_UPLOADS/images/google.png'); ?>" alt="google">
            Continue with Google
          </button>
        </div>
      </div>

      <form id="registration-form" action="<?= base_url('register/submit'); ?>" method="post">
          <input type="hidden" name="cv_id" value="<?= $this->input->get('cv_id'); ?>">
        <input type="hidden" name="template" value="<?= $this->input->get('template'); ?>">
        
        <div class="form-row">
          <div class="form-fields">
            <div class="form-grid">
              <div class="form-group">
                <label for="fullname">Full name<span style="color:#e42e2e;">*</span></label>
                <input type="text" name="fullname" id="fullname" value="<?= isset($prefill_fullname) ? $prefill_fullname : '' ?>" placeholder="Enter your name">
                <span class="error-msg"></span>
              </div>

              <div class="form-group">
                <label for="email">Email ID<span style="color:#e42e2e;">*</span></label>
                <input type="email" name="email" id="email" value="<?= isset($prefill_email) ? $prefill_email : '' ?>" placeholder="Enter your email">
                <span class="error-msg"></span>
              </div>
            </div>

            <div class="form-grid">
              <div class="form-group" style="position:relative;">
                <label for="password">Password<span style="color:#e42e2e;">*</span></label>
                <input type="password" name="password" id="password"
                  placeholder="Set your password (Minimum 6 characters)">
                <span id="toggle-password" class="toggle-password-eye">
                  <i class="far fa-eye-slash"></i>
                </span>
                <span class="error-msg"></span>
              </div>

              <div class="form-group">
                <label>Work status<span style="color:#e42e2e;">*</span></label>
                <div class="work-status-group">
                  <div class="work-status-card selected" id="experienced" onclick="selectStatus('experienced')">
                    <span class="icon">💼</span>
                    <div class="info">
                      <span class="title">I'm experienced</span>
                    </div>
                    <span class="error-msg" style="color:red; font-size:0.85em; display:none;"></span>
                  </div>
                  <div class="work-status-card" id="fresher" onclick="selectStatus('fresher')">
                    <span class="icon">🎓</span>
                    <div class="info">
                      <span class="title">I'm a fresher</span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="workStatus" id="workStatus" value="experienced">
              </div>
            </div>


            <!-- CAPTCHA SECTION -->

            <div class="form-grid">
              <div class="form-group">
                <label for="captcha">Enter CAPTCHA<span style="color:#e42e2e;">*</span></label>

                <div class="captcha-row">
                  <div class="captcha-image-box">
                    <?= $captcha_image; ?>

                    <a href="javascript:void(0);" onclick="location.reload();" title="Refresh CAPTCHA"
                      class="captcha-refresh">
                      <i class="fas fa-sync-alt"></i>
                    </a>
                  </div>

                  <div class="captcha-input-box">
                    <input type="text" name="captcha" id="captcha" placeholder="Enter captcha text">
                    <span class="error-msg"></span>
                  </div>
                </div>
              </div>

              <div class="register-btn-wrapper">
                <button type="submit" class="register-btn">Register now</button>
              </div>
            </div>

            <div class="terms-row">
              By clicking Register, you agree to the
              <a href="<?= base_url('terms-and-conditions'); ?>">Terms and Conditions</a> &
              <a href="<?= base_url('privacy-policy'); ?>">Privacy Policy</a> of SahajJobs.com
            </div>
          </div>
        </div>
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
  <?php $this->load->view('includes/footer'); ?>
  <script>
    function selectStatus(status) {
      document.getElementById('experienced').classList.remove('selected');
      document.getElementById('fresher').classList.remove('selected');
      document.getElementById(status).classList.add('selected');
      document.getElementById('workStatus').value = status;
    }
  </script>
  <script>
    document.getElementById('googleSignInBtn').addEventListener('click', function () {
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider)
        .then(function (result) {
          var user = result.user;

          // Send user info to CodeIgniter backend
          fetch('<?= base_url('register/google_callback') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
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
                window.location.href = '<?= base_url('profile') ?>';
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
    document.addEventListener('DOMContentLoaded', function () {
      const countryPhoneRules = {
        "Afghanistan": { code: "+93", min: 9, max: 9 },
        "Albania": { code: "+355", min: 9, max: 9 },
        "Algeria": { code: "+213", min: 9, max: 9 },
        "Andorra": { code: "+376", min: 6, max: 9 },
        "Angola": { code: "+244", min: 9, max: 9 },
        "Argentina": { code: "+54", min: 10, max: 10 },
        "Armenia": { code: "+374", min: 8, max: 8 },
        "Australia": { code: "+61", min: 9, max: 9 },
        "Austria": { code: "+43", min: 10, max: 11 },
        "Azerbaijan": { code: "+994", min: 9, max: 9 },
        "Bahamas": { code: "+1", min: 10, max: 10 },
        "Bahrain": { code: "+973", min: 8, max: 8 },
        "Bangladesh": { code: "+880", min: 10, max: 10 },
        "Belgium": { code: "+32", min: 9, max: 9 },
        "Brazil": { code: "+55", min: 10, max: 11 },
        "Bulgaria": { code: "+359", min: 8, max: 9 },
        "Cambodia": { code: "+855", min: 8, max: 9 },
        "Canada": { code: "+1", min: 10, max: 10 },
        "Chile": { code: "+56", min: 9, max: 9 },
        "China": { code: "+86", min: 11, max: 11 },
        "Colombia": { code: "+57", min: 10, max: 10 },
        "Croatia": { code: "+385", min: 9, max: 9 },
        "Denmark": { code: "+45", min: 8, max: 8 },
        "Egypt": { code: "+20", min: 10, max: 10 },
        "Finland": { code: "+358", min: 9, max: 10 },
        "France": { code: "+33", min: 9, max: 9 },
        "Germany": { code: "+49", min: 10, max: 11 },
        "Greece": { code: "+30", min: 10, max: 10 },
        "Hong Kong": { code: "+852", min: 8, max: 8 },
        "Hungary": { code: "+36", min: 9, max: 9 },
        "Iceland": { code: "+354", min: 7, max: 7 },
        "India": { code: "+91", min: 10, max: 10 },
        "Indonesia": { code: "+62", min: 9, max: 11 },
        "Iran": { code: "+98", min: 10, max: 10 },
        "Iraq": { code: "+964", min: 10, max: 10 },
        "Ireland": { code: "+353", min: 9, max: 9 },
        "Israel": { code: "+972", min: 9, max: 9 },
        "Italy": { code: "+39", min: 9, max: 10 },
        "Japan": { code: "+81", min: 10, max: 10 },
        "Kenya": { code: "+254", min: 9, max: 9 },
        "Kuwait": { code: "+965", min: 8, max: 8 },
        "Malaysia": { code: "+60", min: 9, max: 10 },
        "Mexico": { code: "+52", min: 10, max: 10 },
        "Netherlands": { code: "+31", min: 9, max: 9 },
        "New Zealand": { code: "+64", min: 8, max: 9 },
        "Nigeria": { code: "+234", min: 10, max: 11 },
        "Norway": { code: "+47", min: 8, max: 8 },
        "Oman": { code: "+968", min: 8, max: 8 },
        "Pakistan": { code: "+92", min: 10, max: 10 },
        "Philippines": { code: "+63", min: 10, max: 10 },
        "Poland": { code: "+48", min: 9, max: 9 },
        "Portugal": { code: "+351", min: 9, max: 9 },
        "Qatar": { code: "+974", min: 8, max: 8 },
        "Romania": { code: "+40", min: 9, max: 9 },
        "Russia": { code: "+7", min: 10, max: 10 },
        "Saudi Arabia": { code: "+966", min: 9, max: 9 },
        "Singapore": { code: "+65", min: 8, max: 8 },
        "South Africa": { code: "+27", min: 9, max: 9 },
        "South Korea": { code: "+82", min: 9, max: 10 },
        "Spain": { code: "+34", min: 9, max: 9 },
        "Sri Lanka": { code: "+94", min: 9, max: 9 },
        "Sweden": { code: "+46", min: 9, max: 9 },
        "Switzerland": { code: "+41", min: 9, max: 9 },
        "Thailand": { code: "+66", min: 9, max: 9 },
        "Turkey": { code: "+90", min: 10, max: 10 },
        "UAE": { code: "+971", min: 9, max: 9 },
        "UK": { code: "+44", min: 10, max: 11 },
        "USA": { code: "+1", min: 10, max: 10 },
        "Vietnam": { code: "+84", min: 9, max: 10 },
        "Zimbabwe": { code: "+263", min: 9, max: 9 }
      };

      const countryCodeSelect = document.getElementById('countryCode');
      const mobileInput = document.getElementById('mobile');

      // Populate dropdown with all countries
      Object.keys(countryPhoneRules).forEach(country => {
        const option = document.createElement('option');
        option.value = country;
        option.textContent = `${country} (${countryPhoneRules[country].code})`;
        countryCodeSelect.appendChild(option);
      });

      // Default country
      countryCodeSelect.value = "India";
      updateMobilePlaceholder();

      // Update placeholder based on selected country
      countryCodeSelect.addEventListener('change', updateMobilePlaceholder);

      function updateMobilePlaceholder() {
        const selected = countryPhoneRules[countryCodeSelect.value];
        if (selected) {
          mobileInput.placeholder = `Enter ${selected.max} digits mobile number`;
          mobileInput.value = ''; // optional: reset input when changing country
        }
      }

      // Allow only digits and enforce max length
      mobileInput.addEventListener('input', function () {
        const selected = countryPhoneRules[countryCodeSelect.value];
        let digitsOnly = this.value.replace(/\D/g, '');

        if (selected && digitsOnly.length > selected.max) {
          digitsOnly = digitsOnly.slice(0, selected.max);
        }

        this.value = digitsOnly;
      });

      // Optional: add country code before form submit
      const form = document.getElementById('registration-form');
      form.addEventListener('submit', function (e) {
        const selected = countryPhoneRules[countryCodeSelect.value];
        if (selected) {
          const fullNumberInput = document.createElement('input');
          fullNumberInput.type = 'hidden';
          fullNumberInput.name = 'full_mobile';
          fullNumberInput.value = `${selected.code}${mobileInput.value}`;
          form.appendChild(fullNumberInput);
        }
      });
    });
  </script>




  <script>

    document.addEventListener('DOMContentLoaded', function () {
      // Form validation and handling as before...
      const form = document.getElementById('registration-form');
      const fields = [
        { id: 'fullname', name: 'Full name' },
        { id: 'email', name: 'Email ID' },
        { id: 'password', name: 'Password' },
        { id: 'mobile', name: 'Mobile number' },
      ];

      function validateField(field, value) {
        if (!value) {
          return `${field.name} is required.`;
        } else {
          // if (field.id === 'email') {
          //   if (!(value.includes('.') && value.includes('com'))) {
          //     return 'Email must contain .com';
          //   }
          // }
          if (field.id === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
            if (!emailRegex.test(value)) {
              return 'Please enter a valid email address';
            }
          }
          if (field.id === 'password') {
            if (value.length < 6) {
              return 'Password must be at least 6 characters.';
            }
          }
          if (field.id === 'mobile') {
            const digitsOnly = value.replace(/\D/g, '');
            const countrySelect = document.getElementById('countryCode'); // your dropdown
            const selectedCountry = countrySelect.value;

            if (selectedCountry && countryPhoneRules[selectedCountry]) {
              const { min, max } = countryPhoneRules[selectedCountry];
              if (digitsOnly.length < min || digitsOnly.length > max) {
                return `Enter a valid mobile number (${min}–${max} digits) for ${selectedCountry}.`;
              }
            } else {
              if (digitsOnly.length < 6 || digitsOnly.length > 15) {
                return 'Enter a valid mobile number (6–15 digits).';
              }
            }
          }

        }
        return '';
      }

      form.addEventListener('submit', function (e) {
        let isValid = true;

        fields.forEach(field => {
          const input = document.getElementById(field.id);
          const errorSpan = input.parentElement.querySelector('.error-msg');
          const value = input.value.trim();
          const message = validateField(field, value);

          input.style.borderColor = '#808080';
          errorSpan.style.display = 'none';
          errorSpan.textContent = '';

          if (message) {
            isValid = false;
            input.style.borderColor = 'red';
            errorSpan.style.display = 'block';
            errorSpan.textContent = message;
          }
        });
      });

      fields.forEach(field => {
        const input = document.getElementById(field.id);
        const errorSpan = input.parentElement.querySelector('.error-msg');
        input.addEventListener('input', function () {
          const value = input.value.trim();
          const message = validateField(field, value);
          if (message) {
            input.style.borderColor = 'red';
            errorSpan.style.display = 'block';
            errorSpan.textContent = message;
          } else {
            input.style.borderColor = '#808080';
            errorSpan.style.display = 'none';
            errorSpan.textContent = '';
          }
        });
      });
    });

    // Password toggle handler remains unchanged
    document.getElementById('toggle-password').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
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
</body>

</html>