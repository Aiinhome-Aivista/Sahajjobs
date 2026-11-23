<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SahajJobs | Manage SEO</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

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
            padding: 14px 10px;
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
            list-style: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .sidebar-menu .submenu.show {
            max-height: 250px;
        }

        .sidebar-menu .submenu a {
            padding: 10px 20px;
            font-size: 0.95rem;
            position: relative;
        }

        .sidebar-menu .submenu a::before {
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
            margin-top: -5px;
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

        /* Table Container Styles - Matching job_post_management.php */
        .container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding-top: 40px;
            padding-left: 30px;
        }

        .container h2 {
            margin-left: 5px;
            position: relative;
            z-index: 1;
        }

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

        th {
            background: #fff567;
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
            background: none;
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

        .table-no-posts td {
            text-align: center;
            font-style: italic;
            color: #888;
        }

        /* Image thumbnail */
        .thumbnail {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .no-image {
            width: 50px;
            height: 50px;
            background: #f0f0f0;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            font-size: 12px;
        }

        /* Content preview */
        .content-preview {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        /* Modal Styles - FIXED: Remove scrollbar */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 600px;
            max-width: 90vh;
            transform: translateY(-50px);
            transition: transform 0.4s ease;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 15px 25px 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .modal-header h3 {
            font-size: 1.4rem;
            color: #333;
            font-weight: 600;
            margin: 0;
        }

        .modal-body {
            padding: 1rem;

            flex: 1;
            overflow-y: auto;
            max-height: calc(90vh - 130px);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(239, 218, 86, 0.2);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .modal-footer {
            padding: 15px 25px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-shrink: 0;
        }

        .modal-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .modal-btn-primary {
            background-color: var(--primary);
            color: #333;
        }

        .modal-btn-primary:hover {
            background-color: #e6cf4d;
        }

        .modal-btn-secondary {
            background-color: #f0f0f0;
            color: #555;
        }

        .modal-btn-secondary:hover {
            background-color: #e2e2e2;
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
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: var(--warning);
        }

        /* Select2 Custom Styling for Modal */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ddd;
            border-radius: 6px;
            min-height: 42px;
            padding: 5px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--primary);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(239, 218, 86, 0.2);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--primary);
            border: 1px solid #e0c841;
            border-radius: 4px;
            color: #333;
            font-size: 0.9rem;
            margin-right: 5px;
            margin-top: 5px;
            padding: 2px 8px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #666;
            margin-right: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #333;
        }

        ol,
        ul {
            padding-left: 1rem !important;
        }
    </style>

</head>

<body>
    <!-- Sidebar -->
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
                    <ul class="submenu" id="posts-submenu">
                        <li>
                            <a href="<?= base_url('admin/posts_manage'); ?>">Blog</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/posts_categories'); ?>">Categories</a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/posts_manage'); ?>">Government Jobs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('admin/comments'); ?>"><i class="fas fa-message"></i>
                        Comments</a>
                </li>
                <li>
                    <a href="<?= base_url('admin/seo_manage'); ?>" class="active"><i class="fas fa-globe"></i> SEO</a>
                </li>
                <li>
                    <a href="#" id="logoutBtn">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="main-content">

        <!-- ================= HEADER ================= -->
        <div class="header">
            <div class="header-title">
                <div class="title-container d-flex justify-content-between align-items-center mb-4">
                    <button class="sidebar-toggle"><i class="fas fa-bars"></i></button>
                    <h1>Manage SEO</h1>
                    <a href="<?= base_url('admin/seo_add'); ?>" class="btn text-dark"
                        style="background-color:#f1e42cff;">
                        <i class="fas fa-plus me-1"></i> Add SEO
                    </a>
                </div>
            </div>
        </div>

        <!-- ================= TABLE CONTAINER ================= -->
        <div class="container">

            <!-- SEARCH -->
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search SEO...">
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Keywords</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="seoTableBody">
                        <?php if (!empty($seo)):
                            foreach ($seo as $row): ?>
                                <tr data-id="<?= $row->id ?>">
                                    <td class="col-id">
                                        <?= $row->id ?>
                                    </td>
                                    <td class="col-title">
                                        <?= htmlspecialchars($row->title) ?>
                                    </td>
                                    <td class="col-description">
                                        <div class="content-preview" title="<?= htmlspecialchars($row->description) ?>">
                                            <?= htmlspecialchars(substr($row->description, 0, 50)) ?>...
                                        </div>
                                    </td>
                                    <td class="col-keywords">
                                        <?= htmlspecialchars($row->keywords) ?>
                                    </td>
                                    <td>
                                        <?= date('M d, Y', strtotime($row->created_at)) ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-table btn-edit"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-table btn-delete" data-id="<?= $row->id ?>"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                            <tr class="table-no-posts">
                                <td colspan="6">No SEO records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION (CLIENT SIDE – SAME JS CAN BE REUSED) -->
            <div class="pagination" id="paginationControls"></div>
        </div>

        <footer>&copy; 2025 SahajJobs Inc. All Rights Reserved.</footer>
    </div>

    <!-- ================= EDIT MODAL (MATCH BLOG MODAL) ================= -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit SEO</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_id">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="edit_title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id="edit_description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Keywords</label>
                    <input type="text" id="edit_keywords" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button id="updateBtn" class="modal-btn modal-btn-primary">Update</button>
                <button id="closeModal" class="modal-btn modal-btn-secondary">Cancel</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /* ===============================
           SIDEBAR & SUBMENU FUNCTIONALITY
        =============================== */
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const closeSidebar = document.querySelector('.close-sidebar');
        const postsMenuToggle = document.getElementById('posts-menu-toggle');
        const postsSubmenu = document.querySelector('.submenu');
        const logoutBtn = document.getElementById('logoutBtn');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('show');
        });

        postsMenuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            postsSubmenu.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992 &&
                !sidebar.contains(e.target) &&
                !sidebarToggle.contains(e.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function (e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('show');
                }
            });
        });

        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '<?= base_url("Admin_Dashboard/logout"); ?>';
            }
        });


        /* ===============================
           SEARCH & PAGINATION (SEO TABLE)
        =============================== */
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('seoTableBody');
            const paginationControls = document.getElementById('paginationControls');

            let allRows = [];
            let filteredRows = [];
            let currentPage = 1;
            const rowsPerPage = 5;

            function initializeTable() {
                const rows = Array.from(tableBody.querySelectorAll('tr:not(.table-no-posts)'));

                if (rows.length > 0) {
                    allRows = rows;
                    filteredRows = [...allRows];
                    paginationControls.style.display = 'flex';
                    updatePagination();
                } else {
                    paginationControls.style.display = 'none';
                }
            }

            searchInput.addEventListener('input', function () {
                const searchText = this.value.toLowerCase();

                if (searchText === '') {
                    filteredRows = [...allRows];
                } else {
                    filteredRows = allRows.filter(row => {
                        const title = row.querySelector('.col-title').textContent.toLowerCase();
                        const description = row.querySelector('.col-description').textContent.toLowerCase();
                        const keywords = row.querySelector('.col-keywords').textContent.toLowerCase();

                        return title.includes(searchText) ||
                            description.includes(searchText) ||
                            keywords.includes(searchText);
                    });
                }

                currentPage = 1;
                updatePagination();
            });

            function updatePagination() {
                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

                tableBody.innerHTML = '';

                if (filteredRows.length === 0) {
                    paginationControls.style.display = 'none';
                    tableBody.innerHTML = `
                    <tr class="table-no-posts">
                        <td colspan="6" style="text-align:center;">No SEO records found</td>
                    </tr>`;
                    return;
                }

                paginationControls.style.display = 'flex';

                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = startIndex + rowsPerPage;

                filteredRows.slice(startIndex, endIndex).forEach(row => {
                    tableBody.appendChild(row);
                });

                renderPaginationButtons(totalPages);
            }

            function renderPaginationButtons(totalPages) {
                paginationControls.innerHTML = '';

                const prevBtn = document.createElement('button');
                prevBtn.textContent = 'Prev';
                prevBtn.disabled = currentPage === 1;
                prevBtn.addEventListener('click', () => goToPage(currentPage - 1));
                paginationControls.appendChild(prevBtn);

                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    if (i === currentPage) {
                        btn.style.fontWeight = 'bold';
                        btn.style.backgroundColor = '#e6cf4d';
                    }
                    btn.addEventListener('click', () => goToPage(i));
                    paginationControls.appendChild(btn);
                }

                const nextBtn = document.createElement('button');
                nextBtn.textContent = 'Next';
                nextBtn.disabled = currentPage === totalPages;
                nextBtn.addEventListener('click', () => goToPage(currentPage + 1));
                paginationControls.appendChild(nextBtn);
            }

            function goToPage(page) {
                currentPage = page;
                updatePagination();
            }

            initializeTable();
        });


        /* ===============================
           EDIT SEO MODAL
        =============================== */
        document.addEventListener('click', e => {
            if (e.target.closest('.btn-edit')) {
                const row = e.target.closest('tr');

                document.getElementById('edit_id').value = row.dataset.id;
                document.getElementById('edit_title').value = row.querySelector('.col-title').textContent.trim();
                document.getElementById('edit_description').value =
                    row.querySelector('.col-description div').getAttribute('title');
                document.getElementById('edit_keywords').value =
                    row.querySelector('.col-keywords').textContent.trim();

                document.getElementById('editModal').classList.add('show');
            }
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('editModal').classList.remove('show');
        });


        /* ===============================
           UPDATE SEO
        =============================== */
        document.getElementById('updateBtn').addEventListener('click', () => {
            const data = new FormData();
            data.append('id', document.getElementById('edit_id').value);
            data.append('title', document.getElementById('edit_title').value);
            data.append('description', document.getElementById('edit_description').value);
            data.append('keywords', document.getElementById('edit_keywords').value);

            fetch('<?= base_url("admin/Seo/update") ?>', {
                method: 'POST',
                body: data
            })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        document.getElementById('editModal').classList.remove('show');
                        alert('SEO details updated successfully.');
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                });
        });


        /* ===============================
           DELETE SEO
        =============================== */
        $(document).on('click', '.btn-delete', function () {
            const seoId = $(this).data('id');

            if (confirm('Delete this SEO entry?')) {
                $.ajax({
                    url: "<?= base_url('admin/Seo/delete/') ?>" + seoId,
                    type: "POST",
                    dataType: "json",
                    success: function (res) {
                        if (res.status === 'success') {
                            alert("SEO deleted successfully!");
                            $("tr[data-id='" + seoId + "']").remove();
                        } else {
                            alert('Failed to delete SEO');
                        }
                    }
                });
            }
        });
    </script>


</body>

</html>