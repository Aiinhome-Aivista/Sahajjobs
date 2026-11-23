<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SahajJobs | Employer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary: #fca911d4;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #1e1e2c;
            --light: #f8f9fa;
            --gray: #6c757d;
            --danger: #e63946;
            --warning: #fca311;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', Arial, sans-serif;
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
            background: #c9c9c9;
            color: black;
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1000;
            left: 0;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .sidebar-header h2,
        .sidebar.collapsed .sidebar-menu span {
            display: none;
        }

        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 15px 0;
        }

        .sidebar.collapsed .sidebar-menu i {
            margin-right: 0;
            font-size: 1.4rem;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: space-between;
            position: relative;
        }

        .sidebar-toggle {
            display: none;
            position: absolute;
            right: -15px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu ul {
            list-style: none;
            padding-left: 0;
            /* override Bootstrap reboot */
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            color: #000000;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu a.active {
            background: #FFF44F;
            border-left: 4px solid var(--warning);
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.2rem;
            min-width: 24px;
            text-align: center;
        }

        /* Main Content */
        .content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed~.content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Table Styling */

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        .table th {
            background: #FFF44F;
            color: #48494a;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        /* Action buttons */
        .btn-table {
            border: none;
            padding: 6px 10px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .btn-table i {
            font-size: 0.9rem;
        }

        .btn-view {
            color: #1e1e2c;
        }

        .btn-edit {
            color: #d97706;
        }

        .btn-delete {
            color: #b91c1c;
        }

        /* Search and Pagination Styles */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination button {
            padding: 8px 12px;
            background-color: var(--primary);
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .pagination button:hover:not(:disabled) {
            background-color: #e6cf4d;
        }

        .pagination button:disabled {
            background-color: #f5f7fb;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination span {
            padding: 8px 12px;
            font-size: 14px;
        }

        .page-info {
            margin-left: 15px;
            color: #6c757d;
        }

        /* Table responsive fixes */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .table-no-candidates td {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        /* Mobile menu toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            background: var(--primary);
            border: none;
            border-radius: 4px;
            width: 40px;
            height: 40px;
            z-index: 1100;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666;
            margin-top: 40px;
        }

        /* Responsive styles */
        @media screen and (max-width: 1024px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }

            .sidebar .sidebar-header h2,
            .sidebar .sidebar-menu span {
                display: none;
            }

            .sidebar .sidebar-menu a {
                justify-content: center;
                padding: 15px 0;
            }

            .sidebar .sidebar-menu i {
                margin-right: 0;
                font-size: 1.4rem;
            }

            .content {
                margin-left: var(--sidebar-collapsed-width);
            }

            .sidebar-toggle {
                display: block;
            }

            .sidebar.collapsed {
                width: 0;
            }

            .sidebar.collapsed~.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 768px) {
            .content {
                padding: 60px;
            }

            .container {
                padding: 15px;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
                border-radius: 5px;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            /* Modified pagination for mobile */
            .pagination {
                flex-direction: row;
                flex-wrap: nowrap;
                overflow-x: auto;
                justify-content: center;
                align-items: center;
                padding-bottom: 5px;
            }

            .pagination button {
                flex-shrink: 0;
                padding: 6px 10px;
                font-size: 13px;
            }

            .page-info {
                margin: 0;
                flex-shrink: 0;
                font-size: 13px;
            }

            .mobile-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar.show .sidebar-header h2,
            .sidebar.show .sidebar-menu span {
                display: block;
            }

            .sidebar.show .sidebar-menu a {
                justify-content: flex-start;
                padding: 15px 20px;
            }

            .sidebar.show .sidebar-menu i {
                margin-right: 10px;
            }

            .content {
                margin-left: 0 !important;
            }

            .sidebar.collapsed {
                width: 0;
            }
        }

        @media screen and (max-width: 480px) {
            td {
                padding-left: 40%;
            }

            td:before {
                width: 35%;
            }

            h2 {
                font-size: 1.5rem;
            }

            /* Further adjustments for pagination on very small screens */
            .pagination {
                gap: 4px;
            }

            .pagination button {
                padding: 5px 8px;
                font-size: 12px;
            }

            .pagination span {
                padding: 5px 8px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Toggle Button for Mobile -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>


    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <!-- <div style="display: flex; align-items: center; gap: 10px;">
                <img src="<?php //base_url('assets/images/sahajjobs1.png'); ?>" alt="SahajJobs"
                    style="height:50px; width:135px;">
            </div> -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?= base_url(); ?>"><img src="<?= base_url('./ALL_UPLOADS/images/sahajjobs1.png'); ?>"
                        alt="SahajJobs" style="height:50px; width:135px;"></a>
            </div>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li><a href="<?= base_url('employer_dashboard'); ?>"><i class="fas fa-home me-2"></i>
                        <span>Dashboard</span></a></li>
                <li><a href="<?= base_url('employer_job_post'); ?>"><i class="fas fa-file-alt me-2"></i>
                        <span>Post
                            Job</span></a></li>
                <li><a href="<?= base_url('employer_manage_jobs'); ?>"><i class="fas fa-briefcase me-2"></i>
                        <span>Manage Jobs</span></a></li>
                <li><a href="<?= base_url('employer_manage_applications'); ?>"><i class="fas fa-user-graduate me-2"></i>
                        <span>Applications</span></a>
                </li>
                <li><a href="<?= base_url('employer_profile'); ?>" class="active"><i class="fas fa-building"></i>
                        <span>Employer
                            Profile</span></a></li>
                <li>
                    <a href="#" id="logoutBtn">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Content -->
    <div class="content" id="content">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body text-center p-5">

                            <!-- Profile Avatar -->
                            <?php if (!empty($employer['picture'])): ?>
                                <!-- If picture exists -->
                                <!-- <img src="<?php //base_url('assets/profile_photos/' . $employer['picture']); ?>"
                                    alt="Profile Picture"
                                    class="rounded-circle mb-3 border border-3 border-primary profile-avatar"> -->
                                <img src="<?= base_url('./ALL_UPLOADS/profile_photos/' . $employer['picture']); ?>"
                                    alt="Profile Picture"
                                    class="rounded-circle mb-3 border border-3 border-primary profile-avatar">
                            <?php else: ?>
                                <!-- If no picture, show first letter avatar -->
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 border border-3 profile-avatar"
                                    style="background: #FFF44F; color: #fff; font-size: 28px; font-weight: bold; width: 60px; height: 60px;">
                                    <?= strtoupper(substr($employer['full_name'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Name & Designation -->
                            <h3 class="fw-bold mb-0"><?= $employer['full_name']; ?></h3>
                            <p class="text-muted"><?= $employer['designation']; ?> @ <?= $employer['company']; ?></p>

                            <hr class="my-4">

                            <!-- Profile Info -->
                            <div class="row text-start px-4">
                                <div class="col-md-6 mb-2">
                                    <i class="fas fa-envelope text-warning me-2"></i>
                                    <strong>Email:</strong> <?= $employer['email']; ?>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <i class="fas fa-phone text-warning me-2"></i>
                                    <strong>Mobile:</strong> <?= $employer['mobile_number']; ?>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <i class="fas fa-calendar-alt text-warning me-2"></i>
                                    <strong>Joined On:</strong>
                                    <?= date("d M Y", strtotime($employer['created_at'])); ?>
                                </div>
                            </div>


                            <!-- Edit Profile Button -->
                            <button type="button" class="btn btn-primary mt-4 px-4 rounded-pill"
                                style="background-color: #FFF44F; color: #000000; border-color: #FFF44F;"
                                data-bs-toggle="modal" data-bs-target="#editProfileModal"
                                data-id="<?= $employer['id']; ?>">
                                <i class="fas fa-edit me-2"></i> Edit Profile
                            </button>


                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer>
            &copy; 2025 SahajJobs Inc. All Rights Reserved.
        </footer>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLabel">Edit Employer Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editProfileForm">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="employer_id">

                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" id="designation" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Company</label>
                                <input type="text" name="company" id="company" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" style="background:#FFF44F; color:#29374d;">Save
                                Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickInsideToggle = sidebarToggle.contains(event.target);

            if (window.innerWidth < 768 && !isClickInsideSidebar && !isClickInsideToggle && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // Logout functionality
        const logoutBtn = document.getElementById('logoutBtn');
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '<?= base_url("Employer_controller/logout"); ?>';
            }
        });

        // Profile edit modal functionality
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('[data-bs-target="#editProfileModal"]').forEach(button => {
                button.addEventListener("click", function () {
                    let employerId = this.getAttribute("data-id");

                    fetch("<?= base_url('Employer_controller/getEmployerById'); ?>/" + employerId)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("employer_id").value = data.id;
                            document.getElementById("full_name").value = data.full_name;
                            document.getElementById("designation").value = data.designation;
                            document.getElementById("company").value = data.company;
                            document.getElementById("email").value = data.email;
                            document.getElementById("mobile_number").value = data.mobile_number;
                        })
                        .catch(err => console.error("Error fetching data:", err));
                });
            });

            // Handle form submission
            document.getElementById("editProfileForm").addEventListener("submit", function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch("<?= base_url('Employer_controller/updateEmployer'); ?>", {
                    method: "POST",
                    body: formData
                })
                    .then(response => response.text())
                    .then(result => {
                        alert("Profile updated successfully!");
                        location.reload();
                    })
                    .catch(err => console.error("Error updating:", err));
            });
        });
    </script>

</body>

</html>