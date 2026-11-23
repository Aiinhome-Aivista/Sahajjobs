<?php
$user_name = $this->session->userdata('user_name') ?: 'User';
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
  <title>
    <?= htmlspecialchars($seo_title, ENT_QUOTES, 'UTF-8'); ?>
  </title>

  <meta name="description" content="<?= htmlspecialchars($seo_description, ENT_QUOTES, 'UTF-8'); ?>">

  <meta name="keywords" content="<?= htmlspecialchars($seo_keywords, ENT_QUOTES, 'UTF-8'); ?>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  
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


  <!-- Styles -->
  <style>
    /* --- Global Header Styles --- */
    .header-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 150px;
      height: 70px;
      position: relative;
    }

    .logoutbtn {
      cursor: pointer;
    }

    .logo {
      height: 70px;
      width: auto;
    }

    .user-menu {
      display: flex;
      align-items: center;
      gap: 20px;
      position: relative;
    }

    .menu-icon {
      background: none;
      border: none;
      font-size: 35px;
      cursor: pointer;
      color: #f5e602;
    }

    /* Popup Menu */
    .popup-menu {
      position: absolute;
      top: 40px;
      right: 0;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      width: 180px;
      flex-direction: column;
      z-index: 100;
      display: none;
    }

    .popup-menu.hidden {
      display: none;
    }

    .popup-menu .menu-item {
      display: flex;
      align-items: center;
      padding: 12px 15px;
      color: #333;
      text-decoration: none;
    }

    .popup-menu .menu-item:hover {
      background: #f5f5f5;
    }

    .popup-menu .menu-item i {
      margin-right: 10px;
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    /* Knowledge Dropdown */
    .knowledge-dropdown {
      position: relative;
      display: inline-block;
    }

    .knowledge-link {
      color: #27365c;
      font-size: 18px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
    }

    .govt-link {
      color: #27365c;
      font-size: 18px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
    }

    .caret {
      border: solid #27365c;
      border-width: 0 2px 2px 0;
      padding: 3px;
      transform: rotate(45deg);
      transition: transform .3s;
    }

    .knowledge-underline {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 3px;
      background: #FFF44F;
      border-radius: 2px;
      transform: scaleX(0);
      transition: transform .3s;
    }

    .knowledge-dropdown.active .knowledge-underline {
      transform: scaleX(1);
    }

    .knowledge-menu {
      display: none;
      position: absolute;
      top: 46px;
      left: 50%;
      transform: translateX(-50%);
      min-width: 180px;
      background: #fff;
      box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
      border-radius: 12px;
      padding: 12px 0;
      z-index: 100;
    }

    .knowledge-menu a {
      display: block;
      padding: 10px 20px;
      color: #27365c;
      font-size: 16px;
      text-decoration: none;
    }

    .knowledge-menu a:hover {
      background: #f7f8fa;
    }

    .knowledge-menu a.active {
      background: #FFF44F;
      font-weight: 600;
      color: #27365c;
      position: relative;
    }

    .knowledge-dropdown.active .knowledge-menu {
      display: block;
    }

    .knowledge-dropdown.active .caret {
      transform: rotate(-135deg);
    }


    .knowledge-menu a.active {
      background: #FFF44F;
      font-weight: bold;
      color: black;
    }
    
    .hamburger {
      display: none;
      background: none;
      border: none;
      font-size: 26px;
      cursor: pointer;
      color: #27365c;
    }

    /* Responsive Styles */
    /* Tablet (up to 1024px) */
    @media (max-width: 1024px) {
      .header-container {
        padding: 0 24px;
        height: 64px;
      }

      .logo {
        height: 56px;
      }

      .main-nav {
        gap: 16px;
      }

      .menu-link {
        font-size: 15px;
      }

      .menu-icon {
        font-size: 28px;
      }
    }

    /* Mobile (up to 768px) */
    @media (max-width: 768px) {
      .header-container {
        padding: 0 16px;
        height: 60px;
      }

      /* Logo scales down */
      .logo {
        height: 48px;
      }

      /* Nav hidden by default */
      .main-nav {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 56px;
        left: 0;
        right: 0;
        background: #fff;
        border-top: 1px solid #eee;
        padding: 16px;
        gap: 14px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, .12);
        z-index: 1000;
      }

      .main-nav.active {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .user-menu {
        flex-direction: column;
        align-items: center;
        gap: 12px;
        width: 100%;
      }

      .profile-wrapper {
        justify-content: center;
      }

      /* Links in mobile nav */
      .menu-link {
        font-size: 16px;
        padding: 10px 0;
      }

      /* User menu & hamburger */
      .user-menu {
        gap: 12px;
      }

      .menu-icon {
        font-size: 26px;
      }

      .hamburger {
        display: block;
      }

      .govt-link {
        color: #27365c;
        font-size: 16px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
      }

      .knowledge-link {
        color: #27365c;
        font-size: 16px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
      }
    }

    /* Extra Small (up to 480px) */
    @media (max-width: 480px) {
      .header-container {
        padding: 0 12px;
        height: 56px;
      }

      .logo {
        height: 42px;
      }

      .menu-link {
        font-size: 15px;
      }

      .menu-icon,
      .hamburger {
        font-size: 24px;
      }

      /* Popup reposition for tiny screens */
      .popup-menu {
        top: 46px;
        right: 8px;
        width: 160px;
      }
    }



    /* Scrollable Government Job Dropdown */
    #govtDropdown .knowledge-menu {
      max-height: 300px;
      /* adjust height as needed */
      overflow-y: auto;
      overflow-x: hidden;
    }

    /* Optional: smooth scrollbar for webkit browsers */
    #govtDropdown .knowledge-menu::-webkit-scrollbar {
      width: 6px;
    }

    #govtDropdown .knowledge-menu::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 6px;
    }

    #govtDropdown .knowledge-menu::-webkit-scrollbar-thumb {
      background: #cfcfcf;
      border-radius: 6px;
    }

    #govtDropdown .knowledge-menu::-webkit-scrollbar-thumb:hover {
      background: #b5b5b5;
    }
    
    .profile-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .user-name {
      font-family: 'Nunito', Arial, sans-serif;
      font-size: 16px;
      color: #27365c;
      font-weight: 600;
      white-space: nowrap;
    }
    
    .siteLogo {
      height: 55px;
      width: auto;
      display: block;
      position: absolute;
      top: 5px;
      left: 105px;
    }

    @media (max-width: 1024px) {
      .siteLogo {
        height: 50px;
        width: auto;
        display: block;
        position: absolute;
        top: 3px;
        left: 0px;
      }
    }

    @media (max-width: 768px) {
      .siteLogo {
        height: 50px;
        width: auto;
        display: block;
        position: absolute;
        top: -3px;
        left: 0px;
      }
    }

    @media (max-width: 480px) {
      .siteLogo {
        height: 50px;
        width: auto;
        display: block;
        position: absolute;
        top: -3px;
        left: 0px;
      }
    }
    
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
  </style>
</head>

<body>

  <header style="background:#fff; border-bottom:1px solid #f2f2f2; position:relative; z-index:10;">
    <div class="header-container">

      <!-- Logo Section -->
      <div class="logo-section">
        <a href="<?= base_url(); ?>">
          <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png'); ?>" alt="SahajJOB2" class="siteLogo">
        </a>
      </div>
      
      <button id="menuToggle" class="hamburger">
        ☰
      </button>

      <!-- Profile & Knowledge Section -->
     <div class="main-nav">
      <div class="user-menu">

        <!-- Knowledge Dropdown (only visible on Knowledge pages) -->
        <div class="knowledge-dropdown" id="knowledgeDropdown"
          style="font-family: 'Nunito', Arial, sans-serif !important; display:none;">
          <a href="javascript:void(0)" class="knowledge-link" id="knowledgeToggle">
            Knowledge Base <span class="caret"></span>
          </a>
          <span class="knowledge-underline"></span>
          <div class="knowledge-menu" id="knowledgeMenu"></div>
        </div>

        <!-- Government Job Dropdown -->
        <div class="knowledge-dropdown" id="govtDropdown"
          style="font-family: 'Nunito', Arial, sans-serif !important; display:none;">
          <a href="javascript:void(0)" class="govt-link" id="govtToggle">
            Jobs by Country<span class="caret"></span>
          </a>
          <span class="knowledge-underline"></span>
          <div class="knowledge-menu" id="govtMenu"></div>
        </div>


        <a href="<?= base_url('blogs'); ?>" class="hero-neon">
            Knowledge base
        </a>
          
        <!-- Profile Icon -->
       <div class="profile-wrapper">
          <button id="profileToggle" class="menu-icon">
            <i class="fas fa-user-circle"></i>
          </button>

          <span class="user-name">
            <?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?>
          </span>
        </div>

        <!-- Popup Menu -->
        <div id="popupMenu" class="popup-menu hidden">
          <a href="<?= base_url('profile'); ?>" class="menu-item">
            <i class="fas fa-user"></i>
            <span>My Profile</span>
          </a>
          <a href="<?= base_url('candidate_job_search'); ?>" class="menu-item">
            <i class="fas fa-briefcase"></i>
            <span>Job Search</span>
          </a>
          <a href="<?= base_url('mock-interview'); ?>" class="menu-item">
              <i class="fas fa-comments"></i>
              <span>Practice Mock Interview</span>
          </a>
          <div class="menu-item logoutbtn" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </div>
        </div>
      </div>
      </div>
    </div>
  </header>


  <!-- Scripts -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const logoutBtn = document.getElementById("logoutBtn");
      const profileToggle = document.getElementById("profileToggle");
      const popupMenu = document.getElementById("popupMenu");
      const knowledgeDropdown = document.getElementById("knowledgeDropdown");
      const knowledgeToggle = document.getElementById("knowledgeToggle");
      
       // MOBILE MENU TOGGLE 

      const menuToggle = document.getElementById("menuToggle");

      const mainNav = document.querySelector(".main-nav");

      if (menuToggle) {

        menuToggle.addEventListener("click", () => {

          mainNav.classList.toggle("active");

        });

      }

      // --- Profile Menu ---
      profileToggle.addEventListener("click", (e) => {
        e.stopPropagation();
        // Close knowledge menu if open
        knowledgeDropdown.classList.remove("active");
        popupMenu.classList.toggle("hidden");
        popupMenu.style.display = popupMenu.classList.contains("hidden") ? "none" : "flex";
      });

      document.addEventListener("click", (e) => {
        if (!profileToggle.contains(e.target) && !popupMenu.contains(e.target)) {
          popupMenu.classList.add("hidden");
          popupMenu.style.display = "none";
        }
      });

      if (logoutBtn) {
        logoutBtn.addEventListener("click", () => {
          if (confirm("Are you sure you want to logout?")) {
            window.location.href = '<?= base_url("Candidate_jobsearch/logout"); ?>';
          }
        });
      }

      // --- Knowledge Dropdown ---
      function isKnowledgeBasedPage() {
        return window.location.pathname.includes("blogs");
      }

      function isGovtJobPage() {
        return window.location.pathname.includes("government-jobs");
      }


      function loadCategories() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeCategory = urlParams.get("category");

        fetch('<?= base_url("admin/Posts_categories/get_categories_json"); ?>')
          .then(res => res.json())
          .then(cats => {
            const menu = document.getElementById("knowledgeMenu");

            // "All" link
            menu.innerHTML = `
        <a href="<?= base_url("blogs"); ?>" 
           class="menu-item ${!activeCategory ? "active" : ""}">
          <span>All</span>
        </a>
      `;

            // Category links
            cats.forEach(c => {
              menu.innerHTML += `
          <a href="<?= base_url("blogs?category="); ?>${c.id}" 
             class="menu-item ${activeCategory == c.id ? "active" : ""}">
            <span>${c.name}</span>
          </a>
        `;
            });
          })
          .catch(() => {
            const menu = document.getElementById("knowledgeMenu");
            const defaultCats = [
              { id: "engineering", name: "Engineering" },
              { id: "fresher", name: "Fresher" }
            ];

            menu.innerHTML = `
        <a href="<?= base_url("blogs"); ?>" 
           class="menu-item ${!activeCategory ? "active" : ""}">
          <span>All</span>
        </a>
      `;

            defaultCats.forEach(c => {
              menu.innerHTML += `
          <a href="<?= base_url("blogs?category="); ?>${c.id}" 
             class="menu-item ${activeCategory == c.id ? "active" : ""}">
            <span>${c.name}</span>
          </a>
        `;
            });
          });
      }

      function loadGovtJobsMenu() {
        const menu = document.getElementById("govtMenu");

        // Get selected country from URL
        const currentCountry = new URLSearchParams(window.location.search).get("country");

        const countries = [
          "All",
          "Afghanistan",
          "Australia",
          "Bangladesh",
          "Brazil",
          "Canada",
          "China",
          "France",
          "Germany",
          "India",
          "Indonesia",
          "Italy",
          "Japan",
          "Mexico",
          "Nepal",
          "Pakistan",
          "Russia",
          "Saudi Arabia",
          "South Africa",
          "Sri Lanka",
          "United Kingdom",
          "United States"
        ];

        menu.innerHTML = "";

        countries.forEach(country => {

          // URL for country
          const countryParam =
            country === "All"
              ? ""
              : `?country=${encodeURIComponent(country)}`;

          // Active country logic (same as state)
          const isActive =
            (!currentCountry && country === "All") ||
            (currentCountry === country);

          menu.innerHTML += `
      <a href="<?= base_url('government-jobs'); ?>${countryParam}"
         class="menu-item ${isActive ? 'active' : ''}">
        <span>${country}</span>
      </a>
    `;
        });
      }



      if (knowledgeDropdown && isKnowledgeBasedPage()) {
        knowledgeDropdown.style.display = "inline-block";
        loadCategories();
        knowledgeToggle.addEventListener("click", (e) => {
          e.stopPropagation();
          popupMenu.classList.add("hidden");
          popupMenu.style.display = "none";
          knowledgeDropdown.classList.toggle("active");
        });
        document.addEventListener("click", (e) => {
          if (!knowledgeDropdown.contains(e.target)) {
            knowledgeDropdown.classList.remove("active");
          }
        });
      }

      /* -------- Government Job Dropdown -------- */
      const govtDropdown = document.getElementById("govtDropdown");
      const govtToggle = document.getElementById("govtToggle");

      if (govtDropdown && isGovtJobPage()) {
        govtDropdown.style.display = "inline-block";
        loadGovtJobsMenu();

        govtToggle.addEventListener("click", (e) => {
          e.stopPropagation();
          popupMenu.classList.add("hidden");
          popupMenu.style.display = "none";
          govtDropdown.classList.toggle("active");

          if (govtDropdown.classList.contains("active")) {
            setTimeout(() => {
              const menu = document.getElementById("govtMenu");
              const activeItem = menu.querySelector(".menu-item.active");

              if (activeItem) {
                menu.scrollTop =
                  activeItem.offsetTop -
                  menu.offsetTop -
                  menu.clientHeight / 2 +
                  activeItem.clientHeight / 2;
              }
            }, 50);
          }
        });

        document.addEventListener("click", (e) => {
          if (!govtDropdown.contains(e.target)) {
            govtDropdown.classList.remove("active");
          }
        });
      }
    });
  </script>

</body>

</html>