<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SahajJobs | Add Government Job</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', Arial, sans-serif;
        }

        :root {
            --primary: #efda56ff;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #1e1e2c;
            --light: #f8f9fa;
            --gray: #6c757d;
            --danger: #e63946;
            --warning: #fca311;
            --sidebar-width: 250px;
            --header-height: 60px;
        }

        body {
            background-color: #f5f7fb;
            color: #333;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: #48434394;
            color: black;
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1000;
            left: 0;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: space-between;
            position: relative;
        }

        .sidebar-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-sidebar {
            display: none;
            background: none;
            border: none;
            color: #000;
            font-size: 1.5rem;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .sidebar-menu {
            padding: 0px 0;
        }

        .sidebar-menu ul {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            color: #000000;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 14px 20px;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu a.active {
            background: var(--primary);
            border-left: 4px solid var(--warning);
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.2rem;
            min-width: 24px;
            text-align: center;
        }

        /* New Submenu Styles */
        .sidebar-menu .submenu {
            padding-left: 40px;
            /* Indent sub-options */
            list-style: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .sidebar-menu .submenu.show {
            max-height: 200px;
            /* Arbitrary large number to allow content to show */
        }

        .sidebar-menu .submenu a {
            padding: 10px 20px;
            /* Smaller padding for sub-items */
            font-size: 0.95rem;
            position: relative;
        }

        .sidebar-menu .submenu a::before {
            /* content: ''; */
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 5px;
            background-color: var(--warning);
            border-radius: 50%;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
            width: calc(100% - var(--sidebar-width));
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 15px 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            position: relative;
            flex-wrap: wrap;
        }

        .header-title {
            flex: 1;
            min-width: 250px;
        }

        .title-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 5px;
            flex-wrap: wrap;
        }

        .header-title h1 {
            font-size: 1.8rem;
            color: var(--dark);
            margin: 0;
        }

        .welcome-text {
            color: var(--gray);
            font-size: 0.9rem;
            margin-left: 2px;
            /* Align with the title text */
            margin-top: -5px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Toggle Button */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
            }

            .close-sidebar {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-toggle {
                display: block;
            }

            .header-title h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .user-info {
                align-self: flex-end;
            }

            .header-title,
            .user-info {
                width: 100%;
            }

            .title-container {
                justify-content: space-between;
            }

            .welcome-text {
                margin-left: 0;
                margin-top: 5px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px;
            }

            .header {
                padding: 12px 15px;
            }

            .header-title h1 {
                font-size: 1.3rem;
            }

            .user-info {
                justify-content: space-between;
            }

            .welcome-text {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 400px) {
            .sidebar {
                width: 100%;
            }

            .header-title h1 {
                font-size: 1.2rem;
            }

            .title-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .welcome-text {
                margin-left: 0;
            }
        }

        footer {
            text-align: center;
            padding: 30px 0;
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Form Styles */
        .form-container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control-select {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
            padding: 10px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(239, 218, 86, 0.2);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 85px;
        }

        .btn-submit {
            background-color: var(--primary);
            color: black;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #e0c841;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .text-danger {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        /* ===== FIX SELECT2 ARROW (Bootstrap 5 compatible) ===== */

        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 6px 36px 6px 12px;
            /* IMPORTANT: right padding for arrow */
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
            padding-left: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
            width: 20px;
        }

        /* ensure arrow is visible */
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #555 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
        }


        .sidebar-menu .submenu .submenu {
            padding-left: 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .sidebar-menu .submenu .submenu.show {
            max-height: 150px;
        }

        .sidebar-menu .submenu .submenu a {
            padding: 8px 20px;
            font-size: 0.9rem;
            position: relative;
        }

        .sidebar-menu .submenu .submenu a::before {
            /* content: '›'; */
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: var(--warning);
        }

        ol,
        ul {
            padding-left: 0.7rem !important;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?= base_url(); ?>"><img src="<?= base_url('./ALL_UPLOADS/images/sahajjobs1.png'); ?>"
                        alt="SahajJOB" style="height:50px; width:135px;"></a>
            </div>
            <button class="close-sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-home"></i>
                        <span>Dashboard</span></a></li>
                <li><a href="<?= base_url('admin/candidate_management') ?>"><i class="fas fa-user-graduate"></i>
                        <span>Candidates</span></a></li>
                <li><a href="<?= base_url('admin/employer_management') ?>"><i class="fas fa-users"></i>
                        <span>Employers</span></a></li>
                <li><a href="<?= base_url('admin/job_post_management') ?>"><i class="fas fa-file-alt"></i> <span>Job
                            Posts</span></a></li>
                <li><a href="<?= base_url('admin/featured_companies') ?>"><i class="fas fa-building"></i>
                        <span>Featured Companies</span></a></li>
                <li>
                    <a href="#" class="has-submenu" id="posts-menu-toggle">
                        <i class="fas fa-newspaper"></i>
                        <span>Posts</span>
                        <i class="fas fa-caret-down" style="margin-left: auto;"></i>
                    </a>
                    <ul class="submenu show" id="posts-submenu">
                        <li>
                            <a href="<?= base_url('admin/posts_manage'); ?>">Blog</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/posts_categories'); ?>">Categories</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/govt_jobs_manage'); ?>" class="active">Government Jobs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('admin/comments'); ?>"><i class="fas fa-message"></i>
                        Comments</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/seo_manage'); ?>"><i class="fas fa-globe"></i> SEO</a>
                </li>
                <li>
                    <a href="#" id="logoutBtn">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="main-content">

        <div class="header">
            <div class="header-title">
                <div class="title-container">
                    <button class="sidebar-toggle"><i class="fas fa-bars"></i></button>
                    <h1>Add Government Job</h1>
                </div>
            </div>
        </div>

        <div class="form-container">

            <?php if ($this->session->flashdata('success_message')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success_message'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error_message')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error_message'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/Govt_jobs/add') ?>" method="post">

                <input type="hidden" name="job_type" value="government">

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Job Title</label>
                        <input type="text" name="title" class="form-control" value="<?= set_value('title') ?>">
                        <?= form_error('title', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Department</label>
                        <input type="text" name="department" class="form-control"
                            value="<?= set_value('department') ?>">
                        <?= form_error('department', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Organization</label>
                        <input type="text" name="organization" class="form-control"
                            value="<?= set_value('organization') ?>">
                        <?= form_error('organization', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Country</label>
                        <select name="country" id="country" class="form-control-select">
                            <option value="">-- Select Country --</option>

                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Russia">Russia</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                        </select>
                    </div>



                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Salary</label>
                        <input type="text" name="salary" class="form-control" value="<?= set_value('salary') ?>">
                        <?= form_error('salary', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Experience</label>
                        <input type="text" name="experience" class="form-control"
                            value="<?= set_value('experience') ?>">
                        <?= form_error('experience', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Application Start Date</label>
                        <input type="date" name="application_start_date" class="form-control"
                            value="<?= set_value('application_start_date') ?>">
                        <?= form_error('application_start_date', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Application End Date</label>
                        <input type="date" name="application_end_date" class="form-control"
                            value="<?= set_value('application_end_date') ?>">
                        <?= form_error('application_end_date', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Qualification</label>
                        <textarea name="qualification" class="form-control"
                            rows="2"><?= set_value('qualification') ?></textarea>
                        <?= form_error('qualification', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Job Description</label>
                        <textarea name="description" class="form-control"
                            rows="2"><?= set_value('description') ?></textarea>
                        <?= form_error('description', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Total Vacancies</label>
                        <input type="number" name="total_vacancies" class="form-control"
                            value="<?= set_value('total_vacancies') ?>">
                        <?= form_error('total_vacancies', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Referral link URL</label>
                        <input type="url" name="referral_link_url" class="form-control"
                            value="<?= set_value('referral_link_url') ?>">
                        <?= form_error('referral_link_url', '<div class="text-danger">', '</div>') ?>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Publish Government Job</button>
            </form>

        </div>

        <footer>
            &copy; 2025 SahajJobs Inc. All Rights Reserved.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#country').select2({
                placeholder: "-- Select Country --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <script>
        // Toggle sidebar functionality
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const closeSidebar = document.querySelector('.close-sidebar');
        const mainContent = document.querySelector('.main-content');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('show');
        });

        const postsMenuToggle = document.getElementById('posts-menu-toggle');
        const postsSubmenu = postsMenuToggle.nextElementSibling;


        // Toggle submenu visibility for 'Posts'
        postsMenuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            if (postsSubmenu) {
                postsSubmenu.classList.toggle('show');
            }
        });

        // Close sidebar when clicking outside of it
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        // Highlight parent menu items based on the active child on page load
        const activeLink = document.querySelector('.sidebar-menu a.active');
        if (activeLink) {
            let parentSubmenu = activeLink.closest('.submenu');
            while (parentSubmenu) {
                const parentLink = parentSubmenu.previousElementSibling;
                if (parentLink && parentLink.classList.contains('has-submenu')) {
                    parentLink.classList.add('active-parent');
                    parentSubmenu.classList.add('show');
                }
                parentSubmenu = parentLink.closest('.submenu');
            }
        }

        // Only handle tab switching for links with valid href
        document.querySelectorAll('.sidebar-menu a').forEach(item => {
            item.addEventListener('click', function (e) {
                // Check if the clicked link has a valid URL
                if (this.getAttribute('href') !== '#' && this.getAttribute('href') !== '') {
                    // Find the parent submenus and collapse them
                    let parentSubmenu = this.closest('.submenu.show');
                    while (parentSubmenu) {
                        parentSubmenu.classList.remove('show');
                        parentSubmenu = parentSubmenu.parentElement.closest('.submenu.show');
                    }

                    if (window.innerWidth <= 992) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });

        // Logout functionality
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '<?= base_url("Admin_Dashboard/logout"); ?>';
            }
        });

        // Adjust table responsiveness on resize
        window.addEventListener('resize', function () {
            // This ensures proper rendering on orientation changes
            document.body.classList.toggle('resizing', true);
            setTimeout(() => {
                document.body.classList.toggle('resizing', false);
            }, 100);
        });
    </script>
</body>

</html>