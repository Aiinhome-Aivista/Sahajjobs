<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SahajJobs | Profile</title>

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Nunito', Arial, sans-serif;
    }

    body {
      margin: 0;
      background: #f3f2ef;
    }

    /* ===== HERO BACKGROUND ===== */
    .profile-hero {
      width: 100%;
      height: 260px;
      background: url("<?= base_url('./ALL_UPLOADS/images/SahajProfile2.jpeg'); ?>") center/cover no-repeat;
      position: relative;
    }

    /* ===== CONTENT OVER IMAGE ===== */
    .profile-content {
      max-width: 1200px;
      margin: -90px auto 40px auto;
      padding: 0 20px;
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      gap: 22px;
      /* spacing between glass cards */
    }

    /* ===== GLASS CARD ===== */
    .glass-card {
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      background: rgba(255, 255, 255, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.35);
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
      z-index: 0;
    }

    .profile-top {
      display: flex;
      align-items: flex-end;
      gap: 25px;
      flex-wrap: wrap;
      position: relative;
    }

    /* Avatar */
    .profile-avatar {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      border: 4px solid #fff;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      background: #eef4ff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 42px;
      font-weight: 700;
      color: #1d4ed8;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }

    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .upload-icon-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.45);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 22px;
      opacity: 0;
      transition: 0.25s;
      z-index: 2;
    }

    .profile-avatar:hover .upload-icon-overlay {
      opacity: 1;
    }

    /* Info Section */
    .profile-info {
      flex: 1;
      min-width: 260px;
    }

    .profile-info h1 {
      margin: 0 0 8px;
      font-size: 28px;
      font-weight: 700;
      color: #000;
    }

    .profile-row {
      display: flex;
      align-items: center;
      gap: 25px;
      flex-wrap: wrap;
    }

    .profile-row p {
      margin: 0;
      font-size: 15px;
      color: #555;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .profile-row a {
      color: inherit;
      text-decoration: none;
    }

    .profile-row a:hover {
      color: #a39905;
    }

    /* Resume Section inline */
    .resume-inline {
      position: absolute;
      top: 0;
      right: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 35px;
    }

    .resume-box {
      background: #fff;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ddd;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
    }

    .resume-box img {
      width: 28px;
      height: 28px;
    }

    .resume-actions {
      position: relative;
    }

    .options-dropdown {
      display: none;
      position: absolute;
      right: -2px;
      top: -110px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
      min-width: 180px;
      z-index: 5;
    }

    .options-dropdown a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      font-size: 14px;
      color: #333;
      text-decoration: none;
    }

    .options-dropdown a:hover {
      background: #f5f5f5;
      color: #0a66c2;
    }

    .file-input {
      display: none;
    }

    .upload-btn {
      background: #FFF44F;
      border: none;
      padding: 14px 60px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
    }

    /* ===== SECOND GLASS CARD (NEW) ===== */
    .improve-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
      margin-top: 10px;
    }

    .improve-card {
      background: rgba(255, 255, 255, 0.65);
      border: 1px solid rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(10px);
      border-radius: 14px;
      padding: 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: .2s ease;
    }

    .improve-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(0, 0, 0, .12);
    }

    .improve-card h4 {
      margin: 0;
      font-size: 16px;
    }

    .improve-card p {
      margin: 4px 0 0;
      font-size: 13px;
      color: #666;
    }

    .arrow-link {
      font-size: 26px;
      text-decoration: none;
      color: #333;
      margin-bottom: 4px;
      margin-left: 5px;
    }

    @media (max-width: 992px) {

      .profile-top {
        flex-direction: column;
        align-items: flex-start;
      }

      .profile-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .resume-inline {
        position: static;
        /* REMOVE absolute positioning */
        width: 100%;
        align-items: flex-start;
        margin-top: 15px;
      }

      .resume-box {
        width: 100%;
      }

      .resume-actions {
        align-self: flex-end;
      }

    }

    @media (max-width: 600px) {
      .profile-hero {
        height: 200px;
      }

      .profile-avatar {
        width: 100px;
        height: 100px;
        font-size: 34px;
      }

      .profile-info h1 {
        font-size: 22px;
      }

      .profile-row {
        gap: 15px;
      }
    }


    .resume-or {
      font-size: 13px;
      font-weight: 700;
      color: #888;
      text-align: center;
    }

    .cv-maker-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      width: 100%;
    }

    .cv-helper-text {
      font-size: 13px;
      color: #666;
      margin: 0;
      flex: 1;
    }

    .cv-maker-card {
      padding: 5px 23px;
      white-space: nowrap;
      border-color: #FFF44F;
    }

    .cv-maker-link {
      text-decoration: none;
    }

    @media (max-width: 768px) {

      .cv-maker-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .cv-helper-text {
        white-space: normal;
      }

      .cv-maker-card {
        width: 100%;
        justify-content: space-between;
      }



      .improve-grid {
        grid-template-columns: 1fr;
      }

      .improve-card {
        width: 100%;
        padding: 18px;
      }

      .improve-card h4 {
        font-size: 15px;
      }

      .improve-card p {
        font-size: 13px;
      }

      .resume-actions {
        flex-shrink: 0;
        margin-bottom: 11px;
      }

    }


    .resume-row {
      display: flex;
      align-items: center;
      gap: 12px;
      width: 100%;
    }

    .resume-link {
      flex: 1;
      text-decoration: none;
      color: inherit;
      min-width: 0;
    }

    .resume-box {
      display: flex;
      align-items: center;
      gap: 10px;
      background: #fff;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ddd;
      overflow: hidden;
    }

    .resume-box span {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .resume-actions {
      flex-shrink: 0;
    }

    .profile-details {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .profile-details p {
      margin: 0;
      font-size: 15px;
      color: #555;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .profile-details a {
      color: inherit;
      text-decoration: none;
    }

    .profile-details a:hover {
      color: #a39905;
    }
    
    .improve-card {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>

<body>

  <div class="profile-hero"></div>

  <div class="profile-content">

    <!-- ===== TOP GLASS CARD (UNCHANGED) ===== -->
    <div class="glass-card">
      <div class="profile-top">

        <form id="profilePhotoForm" action="<?= base_url('profile/upload_photo'); ?>" method="post"
          enctype="multipart/form-data">
          <label for="profilePhotoInput" class="profile-avatar">
            <?php if (!empty($profile_photo)): ?>
              <img src="<?= base_url($profile_photo); ?>" alt="Profile Photo">
              <div class="upload-icon-overlay"><i class="fas fa-camera"></i></div>
            <?php else: ?>
              <?= isset($user['full_name']) ? substr($user['full_name'], 0, 1) : '?' ?>
              <div class="upload-icon-overlay"><i class="fas fa-camera"></i></div>
            <?php endif; ?>
            <input type="file" name="profile_photo" id="profilePhotoInput" class="file-input" accept="image/*">
          </label>
        </form>

        <div class="profile-info">
          <h1><?= htmlspecialchars($user['full_name'] ?? 'User Name'); ?></h1>


          <div class="profile-details">

            <p>
              <i class="fas fa-envelope"></i>
              <?= htmlspecialchars($user['email'] ?? 'user@example.com'); ?>
            </p>

            <p>
              <i class="fas fa-phone"></i>
              +91 <?= htmlspecialchars($user['mobile_number'] ?? 'N/A'); ?>
              <a href="<?= base_url('profile/edit_contact'); ?>"><i class="fas fa-chevron-right"></i></a>
            </p>

            <div class="resume-inline">

              <?php if (!empty($resume)): ?>

                <?php
                $extension = strtolower(pathinfo($resume['file_name'], PATHINFO_EXTENSION));
                $icon = 'file.png';
                if ($extension === 'pdf')
                  $icon = 'pdf.png';
                elseif ($extension === 'doc' || $extension === 'docx')
                  $icon = 'docx.jpg';
                ?>

                <div class="resume-row">
                  <a href="<?= base_url('profile/view_resume/' . $resume['doc_id']); ?>" target="_blank"
                    style="text-decoration:none; color:inherit;">
                    <div class="resume-box">
                      <img src="<?= base_url('./ALL_UPLOADS/images/' . $icon); ?>">
                      <span><?= htmlspecialchars($resume['file_name']); ?></span>
                    </div>
                  </a>

                  <div class="resume-actions">
                    <i class="fas fa-ellipsis-h" onclick="showOptions(this)" style="cursor:pointer;"></i>
                    <div class="options-dropdown">
                      <a href="<?= base_url('profile/view_resume/' . $resume['doc_id']); ?>" target="_blank">
                        <i class="fas fa-file-alt"></i> View
                      </a>
                      <a href="<?= base_url('profile/download_resume/' . $resume['doc_id']); ?>">
                        <i class="fas fa-download"></i> Download
                      </a>
                      <a href="<?= base_url('profile/delete_resume/' . $resume['doc_id']); ?>">
                        <i class="fas fa-trash-alt"></i> Delete
                      </a>
                    </div>
                  </div>
                </div>

              <?php else: ?>

                <!-- Upload Resume -->
                <form id="resumeUploadForm" action="<?= base_url('profile/upload_resume'); ?>" method="post"
                  enctype="multipart/form-data">
                  <input type="file" name="resume_file" id="resumeFileInput" class="file-input" accept=".pdf,.doc,.docx">
                  <label for="resumeFileInput" class="upload-btn">
                    <i class="fas fa-upload icon"></i> Upload Resume
                  </label>
                </form>

                <div class="cv-maker-row">

                  <p class="cv-helper-text">
                    Create a professional CV in minutes
                  </p>

                  <a href="<?= base_url('cv-maker'); ?>" style="text-decoration:none;">
                    <div class="improve-card cv-maker-card">
                      <div>
                        <h4>Free CV Maker</h4>
                      </div>
                      <span class="arrow-link">›</span>
                    </div>
                  </a>

                </div>

              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ===== SECOND TRANSPARENT CARD (NEW) ===== -->
    <div class="glass-card">
      <h4 style="margin:0 0 14px;">Improve your job matches</h4>

      <div class="improve-grid">

        <a href="<?= base_url('profile/qualifications'); ?>" class="improve-card">
          <div>
            <h4>Qualifications / Work Experience / Skills / Centifcations</h4>
            <p>Highlight your skills and experience.</p>
          </div>
          <span class="arrow-link">›</span>
        </a>

        <a href="<?= base_url('JobPreferences'); ?>" class="improve-card">
          <div>
            <h4>Job preferences</h4>
            <p>Save specific details like minimum desired pay and schedule.</p>
          </div>
          <span class="arrow-link">›</span>
        </a>

        <a href="<?= base_url('profile/readyToWork'); ?>" class="improve-card">
          <div>
            <h4>Ready to work</h4>
            <p>Let employers know that you're available to start working as soon as possible.</p>
          </div>
          <span class="arrow-link">›</span>
        </a>

      </div>
    </div>

  </div>

  <script>
    function showOptions(element) {
      const dropdown = element.nextElementSibling;
      document.querySelectorAll('.options-dropdown').forEach(d => {
        if (d !== dropdown) d.style.display = "none";
      });
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    document.addEventListener('click', function (e) {
      if (!e.target.closest('.resume-actions')) {
        document.querySelectorAll('.options-dropdown').forEach(d => d.style.display = "none");
      }
    });

    document.getElementById('profilePhotoInput')?.addEventListener('change', function () {
      if (this.files.length > 0) {
        document.getElementById('profilePhotoForm').submit();
      }
    });

    document.getElementById('resumeFileInput')?.addEventListener('change', function () {
      if (this.files.length > 0) {
        document.getElementById('resumeUploadForm').submit();
      }
    });
  </script>

</body>

</html>