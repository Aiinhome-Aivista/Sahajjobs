<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SahajJobs | Job Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">



    <style>
        body {

            font-family: 'Nunito', Arial, sans-serif;

            background-color: #f8f9fa;

        }



        .search-results-container {

            max-width: 1400px;

            margin: 20px auto;

            padding: 0 15px;

        }



        .back-to-search {

            display: inline-flex;

            align-items: center;

            color: #343a40;

            text-decoration: none;

            margin-bottom: 20px;

            font-weight: 500;

        }



        .back-to-search i {

            margin-right: 8px;

        }



        /* Search bar */

        .search-bar-top {

            background: #fff;

            border-radius: 999px;

            padding: 10px 20px;

            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.08);

            display: flex;

            align-items: center;

            margin-bottom: 20px;

            border: none;

        }



        .search-bar-top .input-group-text {

            background-color: transparent;

            border: none;

            color: #8893b3;

            font-size: 1.2rem;

        }



        .search-bar-top .form-control {

            background: transparent;

            border: none;

            box-shadow: none;

            font-size: 1rem;

            color: #222;

        }



        .search-bar-top .form-control::placeholder {

            color: #8893b3;

        }



        .search-bar-top .btn-primary {

            background-color: #2563eb;

            border: none;

            padding: 8px 25px;

            border-radius: 999px;

            font-size: 1rem;

            font-weight: 560;

            color: #fff;

            margin-left: 15px;

            transition: background 0.2s;

        }



        .search-bar-top .btn-primary:hover {

            background-color: #174bbd;

        }



        /* Filters */

        .filter-bar {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-bottom: 20px;

            justify-content: center;

        }



        .filter-btn {

            background: #f1f3f4;

            border: none;

            border-radius: 24px;

            padding: 7px 16px;

            font-size: 14px;

            font-weight: 500;

            color: #333;

        }



        .dropdown-menu {

            border-radius: 12px;

            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);

        }



        /* Layout */

        .jobs-layout {

            display: grid;

            grid-template-columns: 1fr 2fr 1fr;

            gap: 20px;

            align-items: start;

        }



        .jobs-list {

            max-height: 80vh;

            overflow-y: auto;

        }



        .job-card {

            background: white;

            border-radius: 12px;

            padding: 15px;

            margin-bottom: 15px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);

            cursor: pointer;

            transition: all 0.2s ease;

        }



        .job-card:hover,

        .job-card.active {

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);

            border-left: 4px solid #FFF44F;

        }



        .job-card.active {

            background-color: #f8f9fa;

        }



        .job-title {

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 5px;

            color: #212529;

        }



        .company-name {

            font-size: 15px;

            color: #495057;

            margin-bottom: 8px;

        }



        .job-info {

            display: flex;

            gap: 12px;

            font-size: 13px;

            color: #6c757d;

            margin-bottom: 8px;

            flex-wrap: wrap;

        }



        .job-salary {

            font-weight: 600;

            color: #7b7a6e;

            margin-bottom: 5px;

        }



        .job-tags {

            display: flex;

            gap: 6px;

            flex-wrap: wrap;

        }



        .tag {

            background: #e9ecef;

            padding: 3px 10px;

            border-radius: 50px;

            font-size: 12px;

            color: #495057;

        }



        .job-detail {

            background: white;

            border-radius: 12px;

            padding: 20px;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);

        }



        .detail-header {

            display: flex;

            justify-content: space-between;

            flex-wrap: wrap;

            gap: 15px;

            margin-bottom: 20px;

        }



        .detail-title {

            font-size: 22px;

            font-weight: 700;

            margin-bottom: 5px;

        }



        .detail-company {

            font-size: 16px;

            color: #495057;

            margin-bottom: 10px;

        }



        .apply-btn {

            background-color: #2563eb;

            color: white;

            border: none;

            padding: 10px 20px;

            border-radius: 8px;

            font-weight: 560;

            transition: background 0.2s;

        }



        .apply-btn:hover {

            background-color: #1d4ed8;

        }



        .detail-info {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));

            gap: 12px;

            margin-bottom: 20px;

        }
        
        .top-search-row .search-bar-top {
            margin-bottom: 0;
            width: 74%;
        }



        .info-item {

            display: flex;

            align-items: center;

            gap: 8px;

            font-size: 14px;

        }



        .detail-section {

            margin-bottom: 20px;

        }



        .section-title {

            font-size: 17px;

            font-weight: 600;

            margin-bottom: 10px;

        }



        .requirements-list {

            padding-left: 20px;

        }



        .requirements-list li {

            margin-bottom: 6px;

            font-size: 14px;

        }



        .no-results {

            text-align: center;

            padding: 40px;

            color: #6c757d;

        }



        /* Featured companies */

        .featured-companies {

            background: white;

            border-radius: 12px;

            padding: 15px;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);

        }



        .featured-companies p {

            margin-bottom: 12px;

            font-size: 15px;

            font-weight: 600;

        }



        .featured-companies img {

            border: 1px solid #e9ecef;

            border-radius: 8px;

            padding: 6px;

            background: #fff;

            width: 100%;

        }



        /* Responsive tweaks */

        @media (max-width: 1200px) {

            .jobs-layout {

                grid-template-columns: 1fr 1.5fr;

            }



            .featured-companies {

                display: none;

            }

        }



        @media (max-width: 768px) {

            .jobs-layout {

                grid-template-columns: 1fr;

            }



            .jobs-list {

                max-height: none;

            }



            .search-bar-top {

                flex-direction: column;

                padding: 15px;

                border-radius: 24px;

            }



            .search-bar-top .btn-primary {

                width: 100%;

                margin-top: 10px;

                margin-left: 0;

            }
            
            .top-search-row .search-bar-top {
                margin-bottom: 0;
                width: 100%;
            }

        }



        .form-check-input:checked {

            background-color: #e9dd2b !important;

            border-color: #e9dd2b !important;

        }
        
        
        .no-bullets i {
            font-size: 16px;
            min-width: 20px;
        }

        .no-bullets a {
            text-decoration: none;
            color: black;
            font-weight: 500;
        }

        .no-bullets a:hover {
            text-decoration: underline;
        }
        
        /* Top row layout */
        .top-search-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        

        /* Back button spacing fix */
        .top-search-row .back-to-search {
            margin-bottom: 0;
            white-space: nowrap;
        }

        /* Mobile: stack nicely */
        @media (max-width: 768px) {
            .top-search-row {
                flex-direction: column;
                align-items: stretch;
            }

            .top-search-row .back-to-search {
                align-self: flex-start;
            }
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 15px;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #6c757d;
        }

        .breadcrumb-item.active {
            color: #b6aa05;
        }
    </style>

</head>



<body>

    <div class="search-results-container">
        <h1 class="fw-bold text-center mb-4 neon-text">50000+ Jobs waiting for you</h1>
        <div class="top-search-row">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <i class="fas fa-chevron-left"></i> <a href="<?php echo base_url('profile'); ?>">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Job Search
                    </li>
                </ol>
            </nav>



            <!-- Search bar -->

            <div class="search-bar-top">

                <div class="input-group">

                    <span class="input-group-text"><i class="fas fa-search"></i></span>

                    <input type="text" id="job-search-input" class="form-control"
                    placeholder="Jobs / Designation / Location"
                    value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">

                    <button id="search-button" class="btn btn-primary"
                    style="background-color: #FFF44F; color: black; border-radius: 50px;">

                        Search

                    </button>

                </div>

            </div>
        </div>



        <!-- Filter bar -->

        <div class="filter-bar">

            <!-- Pay -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="pay">Pay</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-min="" data-max="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-min="200000" data-max="">₹2,00,000+</a></li>

                    <li><a class="dropdown-item" href="#" data-min="300000" data-max="">₹3,00,000+</a></li>

                    <li><a class="dropdown-item" href="#" data-min="600000" data-max="">₹6,00,000+</a></li>

                </ul>

            </div>



            <!-- Work mode -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="workMode">Work mode</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-value="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-value="On-site">On-site</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Remote">Remote</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Hybrid">Hybrid</a></li>

                </ul>

            </div>



            <!-- Company -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="company">Company</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-value="">Any</a></li>



                    <?php if (!empty($companies)): ?>

                        <?php foreach ($companies as $company): ?>

                            <?php

                            $val = html_escape($company);

                            $active = (isset($selected_company) && $selected_company === $company) ? ' active' : '';

                            ?>

                            <li>

                                <a class="dropdown-item<?= $active ?>" href="#" data-value="<?= $val ?>">

                                    <?= $val ?>

                                </a>

                            </li>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </ul>

            </div>



            <!-- Job type -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="jobType">Job type</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-value="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Full-time">Full-time</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Part-time">Part-time</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Contract">Contract</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Internship">Internship</a></li>

                </ul>

            </div>



            <!-- Location -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="location">Location</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-value="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-value="West Bengal">West Bengal</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Delhi">Delhi</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Bangalore">Bangalore</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Noida">Noida</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Hyderabad">Hyderabad</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Mumbai">Mumbai</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Pune">Pune</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Chennai">Chennai</a></li>

                </ul>

            </div>



            <!-- Industry -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="industry">Industry</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-value="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-value="IT Services">IT services</a></li>

                    <li><a class="dropdown-item" href="#" data-value="Finance">Finance</a></li>

                    <li><a class="dropdown-item" href="#" data-value="BPO">BPO</a></li>

                </ul>

            </div>



            <!-- Experience -->

            <div class="dropdown">

                <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-filter="experience">Experience</button>

                <ul class="dropdown-menu">

                    <li><a class="dropdown-item" href="#" data-min="" data-max="">Any</a></li>

                    <li><a class="dropdown-item" href="#" data-min="0" data-max="0">Fresher</a></li>

                    <li><a class="dropdown-item" href="#" data-min="1" data-max="2">1-2 years</a></li>

                    <li><a class="dropdown-item" href="#" data-min="2" data-max="3">2-3 years</a></li>

                    <li><a class="dropdown-item" href="#" data-min="4" data-max="6">4-6 years</a></li>

                    <li><a class="dropdown-item" href="#" data-min="7" data-max="10">7-10 years</a></li>

                </ul>

            </div>



            <div class="form-check" style="align-self: center; margin-left: 10px;">

                <input class="form-check-input" type="checkbox" value="" id="filter-applied">

                <label class="form-check-label" for="filter-applied">

                    Applied Jobs

                </label>

            </div>

        </div>



        <!-- Jobs layout -->

        <div class="jobs-layout">

            <div class="jobs-list">

                <?php foreach ($jobs as $index => $job): ?>

                    <div class="job-card <?= $index === 0 ? 'active' : '' ?>" data-job-id="<?= $job['id'] ?>">

                        <div class="job-title"><?= htmlspecialchars($job['title']) ?></div>

                        <div class="company-name"><?= htmlspecialchars($job['company']) ?></div>

                        <div class="job-info">

                            <span><i class="fas fa-map-marker-alt"></i>

                                <?= htmlspecialchars($job['location']) ?></span>

                            <span><i class="fas fa-briefcase"></i>

                                <?= htmlspecialchars($job['experience']) ?></span>

                        </div>

                        <div class="job-salary"><?= htmlspecialchars($job['salary']) ?></div>

                        <div class="job-tags">

                            <span class="tag"><?= htmlspecialchars($job['job_type']) ?></span>

                            <span class="tag"><?= htmlspecialchars($job['work_mode']) ?></span>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>



            <div class="job-detail" id="job-detail-panel">

                <!-- Job details loaded dynamically -->

            </div>



            <div class="job-detail featured-companies">

                <p>See Jobs in Featured Companies</p>

                <div class="company-logos">

                    <div class="row g-2">

                        <?php if (!empty($featured_companies)): ?>

                            <?php foreach ($featured_companies as $company): ?>

                                <div class="col-6 col-md-4 col-lg-3 text-center">

                                    <a
                                        href="<?= base_url('candidate_job_search' . '?company=' . urlencode($company->company_name)) ?>">
                                        <img src="<?= base_url($company->logo) ?>"
                                            alt="<?= htmlspecialchars($company->company_name) ?>"
                                            class="img-fluid featured-logo" style="max-height: 80px; object-fit: contain;">
                                    </a>

                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <p class="text-center">No featured companies available</p>

                        <?php endif; ?>

                    </div>

                </div>

            </div>



        </div>

    </div>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>





    <script>

        /* ---------- jobData from PHP (keep as-is) ---------- */

        const jobData = <?= json_encode($jobs, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;



        /* ---------- filter state ---------- */

        const filters = {

            payMin: null,    // rupees (e.g. 200000)

            payMax: null,    // optional

            workMode: '',    // "On-site" | "Remote" | "Hybrid"

            company: '',     // string

            jobType: '',     // string

            location: '',    // substring match

            industry: '',    // string

            expMin: null,    // numeric years

            expMax: null,    // numeric years

            applied: false

        };



        /* ---------- helper: parse salary string into rupee numbers ---------- */

        function parseSalaryString(s) {

            if (!s && s !== 0) return { min: null, max: null };

            const str = String(s).trim();

            if (!str) return { min: null, max: null };



            const low = str.toLowerCase();



            // detect if values are in L (lakh), LPA or K

            const isLakh = /lakh|lacs?|lpa|\bl\W|\bl\b/i.test(low);

            const isK = /\bk\b/i.test(low);



            // get numeric tokens (handles "50,000", "2", "3.5", "2-3", "2 LPA", "₹2,00,000+")

            const nums = str.match(/(\d+(?:[,\.\d]*\d)*)/g);

            if (!nums || nums.length === 0) {

                return { min: null, max: null };

            }



            const convert = token => {

                // remove commas/spaces

                const raw = token.replace(/[, ]+/g, '').replace(/^\./, '0.');

                let val = parseFloat(raw);

                if (isNaN(val)) return null;

                if (isLakh) return Math.round(val * 100000); // LPA -> rupees

                if (isK) return Math.round(val * 1000);

                // detect explicit units like "k" or "l" near token

                // (if no unit and token small but string contains words like 'lakh', above handled)

                return Math.round(val);

            };



            if (nums.length >= 2) {

                const a = convert(nums[0]);

                const b = convert(nums[1]);

                return { min: a, max: b };

            } else {

                const only = convert(nums[0]);

                // if string includes '+' or 'above', treat as min only

                if (/[+]|plus|above|or more/i.test(str)) {

                    return { min: only, max: null };

                }

                // otherwise treat as exact value for both min & max

                return { min: only, max: only };

            }

        }



        /* ---------- helper: parse experience string ---------- */

        function parseExperienceString(s) {

            if (!s && s !== 0) return { min: null, max: null };

            const str = String(s).trim();

            if (!str) return { min: null, max: null };

            const low = str.toLowerCase();



            if (/fresher|no experience/i.test(low)) return { min: 0, max: 0 };



            const nums = str.match(/\d+(?:\.\d+)?/g);

            if (!nums) return { min: null, max: null };



            if (nums.length >= 2) {

                const a = Math.floor(parseFloat(nums[0]));

                const b = Math.ceil(parseFloat(nums[1]));

                return { min: a, max: b };

            } else {

                const n = Math.floor(parseFloat(nums[0]));

                if (/[+]|or more|and above/i.test(low)) return { min: n, max: 1000 };

                return { min: n, max: n };

            }

        }



        /* ---------- helpers to read job numeric values (prefer explicit DB columns if present) ---------- */

        function jobSalaryMin(job) {

            // prefer numeric fields if you later add them (salary_min)

            if (job.salary_min !== undefined && job.salary_min !== null && job.salary_min !== '') {

                return Number(job.salary_min);

            }

            // fallback parse salary text

            return parseSalaryString(job.salary).min;

        }

        function jobSalaryMax(job) {

            if (job.salary_max !== undefined && job.salary_max !== null && job.salary_max !== '') {

                return Number(job.salary_max);

            }

            return parseSalaryString(job.salary).max;

        }

        function jobExperienceMin(job) {

            if (job.experience_min !== undefined && job.experience_min !== null && job.experience_min !== '') {

                return Number(job.experience_min);

            }

            return parseExperienceString(job.experience).min;

        }

        function jobExperienceMax(job) {

            if (job.experience_max !== undefined && job.experience_max !== null && job.experience_max !== '') {

                return Number(job.experience_max);

            }

            return parseExperienceString(job.experience).max;

        }



        /* ---------- showJobDetails (keeps your markup; kept same as original) ---------- */

         function showJobDetails(jobId) {

            const job = jobData.find(j => j.id == jobId);

            if (!job) return;



            const requirements = job.requirements
                ? job.requirements.split(/\r?\n/).map(s => s.trim()).filter(Boolean)
                : [];

            const benefits = job.benefits
                ? job.benefits.split(/\r?\n/).map(s => s.trim()).filter(Boolean)
                : [];



            const detailPanel = document.getElementById('job-detail-panel');
            
            let applyButtonHtml;
            if (job.has_applied == 1) {
                console.log('job2', job.has_applied);
                applyButtonHtml = `<button class="btn btn-success applied-btn" disabled><i class="fas fa-check"></i> Applied</button>`;
            } else {
                console.log('job3 error', job.has_applied);
                applyButtonHtml = `<button class="apply-btn" style="background-color: #FFF44F; color: black;" onclick="window.location.href='<?= base_url('candidate_jobsearch/apply?job_id=') ?>${job.id}'">Apply Now</button>`;
            }

            let applyButtonFooterHtml;
            if (job.has_applied == 1) {
                applyButtonFooterHtml = `<button class="btn btn-success applied-btn" disabled style="width: 100%;"><i class="fas fa-check"></i> Applied</button>`;
            } else {
                applyButtonFooterHtml = `<button class="apply-btn" style="background-color: #FFF44F; color: black; width: 100%;" onclick="window.location.href='<?= base_url('candidate_jobsearch/apply?job_id=') ?>${job.id}'">Apply for this job</button>`;
            }

            function shortenUrl(url, maxLength = 50) {
                if (!url) return '';
                return url.length > maxLength
                    ? url.slice(0, maxLength) + '...'
                    : url;
            }

            function buildUrlList(job) {
                let html = '';

                if (job.websiteUrl) {
                    const fullUrl = escapeHtml(job.websiteUrl);
                    const displayUrl = escapeHtml(shortenUrl(job.websiteUrl));

                    html += `
        <li>
            <i class="fas fa-globe"></i>
            <a href="${fullUrl}"
               target="_blank"
               rel="noopener noreferrer"
               title="${fullUrl}">
                ${displayUrl}
            </a>
        </li>`;
                }

                if (job.linkedInUrl) {
                    const fullUrl = escapeHtml(job.linkedInUrl);
                    const displayUrl = escapeHtml(shortenUrl(job.linkedInUrl));

                    html += `
        <li>
            <i class="fab fa-linkedin"></i>
            <a href="${fullUrl}"
               target="_blank"
               rel="noopener noreferrer"
               title="${fullUrl}">
                ${displayUrl}
            </a>
        </li>`;
                }

                if (job.fbUrl) {
                    const fullUrl = escapeHtml(job.fbUrl);
                    const displayUrl = escapeHtml(shortenUrl(job.fbUrl));

                    html += `
        <li>
            <i class="fab fa-facebook"></i>
            <a href="${fullUrl}"
               target="_blank"
               rel="noopener noreferrer"
               title="${fullUrl}">
                ${displayUrl}
            </a>
        </li>`;
                }

                return html || '<li>No URLs provided</li>';
            }

            function escapeHtml(str) {
                if (str == null) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            function formatDescription(text) {
                if (!text) return '';
                const rawLines = text.split(/\r?\n/);

                let html = '';
                let inList = false;
                let headerStartedList = false;

                function closeList() {
                    if (inList) { html += '</ul>'; inList = false; }
                }

                function isListHeader(line) {
                    if (!line) return false;
                    const lower = line.toLowerCase();
                    return /:\s*$/.test(line) || /\b(key\s+responsibil|responsibil|requirements?|benefits?)\b/.test(lower);
                }

                function isExplicitBullet(line) {
                    return /^\s*([-*•]|\d+\.)\s+/.test(line);
                }


                for (let i = 0; i < rawLines.length; i++) {
                    const raw = rawLines[i].replace(/\t/g, ' ').replace(/\u00A0/g, ' ');
                    const trimmed = raw.trim();

                    if (isExplicitBullet(raw)) {
                        if (!inList) { html += '<ul>'; inList = true; headerStartedList = false; }
                        const item = raw.replace(/^\s*([-*•]|\d+\.)\s*/, '');
                        html += `<li>${escapeHtml(item)}</li>`;
                        continue;
                    }

                    if (isListHeader(trimmed)) {
                        closeList();
                        headerStartedList = true;
                        html += `<p><strong>${escapeHtml(trimmed.replace(/:\s*$/, ''))}</strong></p>`;
                        continue;
                    }


                    if (trimmed === '') {
                        if (headerStartedList) {
                            continue;
                        } else {
                            closeList();
                            headerStartedList = false;
                            continue;
                        }
                    }

                    if (headerStartedList) {
                        if (!inList) { html += '<ul>'; inList = true; }
                        html += `<li>${escapeHtml(trimmed)}</li>`;
                        continue;
                    }

                    closeList();
                    html += `<p>${escapeHtml(trimmed)}</p>`;
                }

                closeList();
                return html;
            }


            detailPanel.innerHTML = `

    <div class="detail-header">

        <div>

            <h2 class="detail-title">
                <a href="<?= base_url('job/view/'); ?>${job.id}" target="_blank" rel="noopener" style="color:inherit; text-decoration:none;">
                    ${job.title}
                </a>
            </h2>

            <div class="detail-company">${job.company}</div>

        </div>

        ${applyButtonHtml}

    </div>



    <div class="detail-info">

        <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>${job.location || ''}</span></div>

        <div class="info-item"><i class="fas fa-briefcase"></i><span>${job.experience || ''}</span></div>

        <div class="info-item"><i class="fas fa-money-bill-wave"></i><span>${job.salary || ''}</span></div>

        <div class="info-item"><i class="fas fa-clock"></i><span>${job.job_type || ''}</span></div>

        <div class="info-item"><i class="fas fa-building"></i><span>${job.industry || ''}</span></div>

    </div>



    <div class="detail-section">

        <h3 class="section-title">Job Description</h3>

        <div class="job-description">${formatDescription(job.description || '')}</div>

    </div>



    <div class="detail-section">

        <h3 class="section-title">Requirements</h3>

        <ul class="requirements-list">

            ${requirements.map(req => `<li>${req}</li>`).join('')}

        </ul>

    </div>



    <div class="detail-section">

        <h3 class="section-title">Benefits</h3>

        <ul class="requirements-list">

            ${benefits.map(b => `<li>${b}</li>`).join('')}

        </ul>

    </div>

    <div class="detail-section">
        <h3 class="section-title">URL's</h3>
        <ul class="requirements-list no-bullets">
            ${buildUrlList(job)}
        </ul>
    </div>




    ${applyButtonFooterHtml}

  `;

        }


        /* ---------- main filter function (search text + dropdowns) ---------- */

        function filterJobs() {

            const searchTerm = document.getElementById('job-search-input').value.toLowerCase();

            const jobCards = document.querySelectorAll('.job-card');

            let firstVisibleCard = null;



            jobCards.forEach(card => {

                const jobId = card.getAttribute('data-job-id');

                const job = jobData.find(j => j.id == jobId);

                if (!job) { card.style.display = 'none'; return; }



                // search matching (title/company/location/tags)

                const title = (job.title || '').toLowerCase();

                const company = (job.company || '').toLowerCase();

                const location = (job.location || '').toLowerCase();

                const tags = Array.from(card.querySelectorAll('.tag')).map(tag => tag.textContent.toLowerCase());
                
                const requirements = (job.requirements || '').toLowerCase();

                const description = (job.description || '').toLowerCase();

                const benefits = (job.benefits || '').toLowerCase();




                const matchesSearch =

                    title.includes(searchTerm) ||

                    company.includes(searchTerm) ||

                    location.includes(searchTerm) ||

                    tags.some(t => t.includes(searchTerm))||
                    
                    requirements.includes(searchTerm) ||
                    
                    benefits.includes(searchTerm) ||

                    description.includes(searchTerm);



                // dropdown filters



                // Pay

                let matchesPay = true;

                if (filters.payMin !== null && filters.payMin !== '') {

                    const jMax = jobSalaryMax(job);

                    const jMin = jobSalaryMin(job);

                    // if we can estimate salary, check overlap with filter min

                    if (jMin == null && jMax == null) {

                        matchesPay = true; // unknown -> allow

                    } else {

                        // if job has max, use that; else use min. Accept if job's max >= filter.min

                        const use = (jMax !== null) ? jMax : jMin;

                        matchesPay = (use !== null) ? (use >= Number(filters.payMin)) : true;

                    }

                }



                // Work mode

                let matchesWorkMode = true;

                if (filters.workMode) {

                    const jm = (job.work_mode || job.workMode || '').toString().toLowerCase();

                    matchesWorkMode = jm === filters.workMode.toLowerCase();

                }



                // Company

                let matchesCompany = true;

                if (filters.company) {

                    matchesCompany = (job.company || '').toString().toLowerCase() === filters.company.toLowerCase();

                }



                // Job type

                let matchesJobType = true;

                if (filters.jobType) {

                    matchesJobType = (job.job_type || '').toString().toLowerCase() === filters.jobType.toLowerCase();

                }



                // Location (substring match)

                let matchesLocation = true;

                if (filters.location) {

                    matchesLocation = (job.location || '').toString().toLowerCase().includes(filters.location.toLowerCase());

                }



                // Industry

                let matchesIndustry = true;

                if (filters.industry) {

                    matchesIndustry = (job.industry || '').toString().toLowerCase() === filters.industry.toLowerCase();

                }



                // Experience (range overlap)

                let matchesExperience = true;

                if (filters.expMin !== null && filters.expMin !== '') {

                    const jMin = jobExperienceMin(job);

                    const jMax = jobExperienceMax(job);

                    // if unknown, allow

                    if (jMin == null && jMax == null) {

                        matchesExperience = true;

                    } else {

                        const jobMin = (jMin !== null) ? jMin : 0;

                        const jobMax = (jMax !== null) ? jMax : jobMin;

                        // check overlap: jobMax >= filterMin && jobMin <= filterMax

                        const fMin = Number(filters.expMin);

                        const fMax = (filters.expMax !== null && filters.expMax !== '') ? Number(filters.expMax) : fMin;

                        matchesExperience = (jobMax >= fMin) && (jobMin <= fMax);

                    }

                }



                // Applied jobs filter

                let matchesApplied = true;

                if (filters.applied) {

                    matchesApplied = job.has_applied == 1;

                }



                const visible = matchesSearch && matchesPay && matchesWorkMode && matchesCompany &&

                    matchesJobType && matchesLocation && matchesIndustry && matchesExperience && matchesApplied;



                card.style.display = visible ? 'block' : 'none';

                if (visible && !firstVisibleCard) firstVisibleCard = card;

            });



            if (firstVisibleCard) {

                document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));

                firstVisibleCard.classList.add('active');

                showJobDetails(firstVisibleCard.getAttribute('data-job-id'));

            } else {

                document.getElementById('job-detail-panel').innerHTML = `

      <div class="no-results">

        <h3>No jobs found</h3>

        <p>Try adjusting your search criteria</p>

      </div>

    `;

            }



            // Rebind clicks only for visible cards

            document.querySelectorAll('.job-card').forEach(card => {

                if (card.style.display !== "none") {

                    card.onclick = function () {

                        document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));

                        this.classList.add('active');

                        showJobDetails(this.getAttribute('data-job-id'));

                    };

                }

            });

        }



        /* ---------- wire up dropdown clicks to update filters ---------- */

        document.addEventListener('DOMContentLoaded', function () {

            // initial detail panel

            if (jobData.length > 0) showJobDetails(jobData[0].id);



            // original card click behaviour

            document.querySelectorAll('.job-card').forEach(card => {

                card.addEventListener('click', function () {

                    document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));

                    this.classList.add('active');

                    showJobDetails(this.getAttribute('data-job-id'));

                });

            });



            // attach listener to every dropdown item

            document.querySelectorAll('.filter-bar .dropdown-menu .dropdown-item').forEach(item => {

                item.addEventListener('click', function (e) {

                    e.preventDefault();

                    const parent = this.closest('.dropdown');

                    const btn = parent.querySelector('.filter-btn');

                    const filterKey = btn.getAttribute('data-filter');



                    // set button text to selection

                    btn.textContent = this.textContent.trim();



                    if (filterKey === 'pay') {

                        const min = this.dataset.min ? Number(this.dataset.min) : null;

                        const max = this.dataset.max ? Number(this.dataset.max) : null;

                        filters.payMin = (min !== null && !isNaN(min)) ? min : null;

                        filters.payMax = (max !== null && !isNaN(max)) ? max : null;

                    } else if (filterKey === 'experience') {

                        const emin = this.dataset.min ? Number(this.dataset.min) : null;

                        const emax = this.dataset.max ? Number(this.dataset.max) : null;

                        filters.expMin = (emin !== null && !isNaN(emin)) ? emin : null;

                        filters.expMax = (emax !== null && !isNaN(emax)) ? emax : null;

                    } else if (filterKey === 'industry') {

                        const raw = this.dataset.value !== undefined ? String(this.dataset.value).trim() : '';
                        const params = new URLSearchParams(window.location.search);

                        if (raw === '') params.delete('industry'); else params.set('industry', raw);

                        window.location.href = window.location.pathname + '?' + params.toString();
                    } else {

                        // simple string filters (workMode, company, jobType, location, industry)

                        const val = this.dataset.value !== undefined ? this.dataset.value : '';

                        // normalize filter keys: workMode -> workMode, jobType->jobType etc

                        filters[filterKey] = val || '';

                    }



                    // apply filters

                    filterJobs();

                });

            });





            // ---------------- Add Applied Jobs checkbox listener ----------------

            const appliedCheckbox = document.getElementById('filter-applied');

            if (appliedCheckbox) {

                appliedCheckbox.addEventListener('change', function () {

                    filters.applied = this.checked;

                    filterJobs();

                });

            }



            // search button + enter

            document.getElementById('search-button').addEventListener('click', filterJobs);

            document.getElementById('job-search-input').addEventListener('keyup', e => {

                if (e.key === 'Enter') filterJobs();

            });



            // initial auto-filter if q param present

            // const urlParams = new URLSearchParams(window.location.search);

            // if (urlParams.get("q")) filterJobs();



            const urlParams = new URLSearchParams(window.location.search);

            let hasUrlFilter = false;



            if (urlParams.get("q")) {

                document.getElementById('job-search-input').value = urlParams.get("q");

                hasUrlFilter = true;

            }



            function setFilterBtnText(filterKey, text) {

                const btn = document.querySelector(`.filter-btn[data-filter="${filterKey}"]`);

                if (btn) btn.textContent = text;

            }



            if (urlParams.get('workMode')) {

                filters.workMode = urlParams.get('workMode');

                setFilterBtnText('workMode', decodeURIComponent(urlParams.get('workMode')));

                hasUrlFilter = true;

            }

            const companyParam = urlParams.get('company');
            if (companyParam !== null) {
                const raw = decodeURIComponent(companyParam || '').trim();
                const normalized = (raw === '' || raw.toLowerCase() === 'any') ? '' : raw;
                filters.company = normalized;
                const companyBtn = document.querySelector('.filter-btn[data-filter="company"]');
                if (companyBtn) companyBtn.textContent = (normalized === '') ? 'Any' : normalized;
                hasUrlFilter = true;
            }



            if (urlParams.get('jobType')) {

                filters.jobType = urlParams.get('jobType');

                setFilterBtnText('jobType', decodeURIComponent(urlParams.get('jobType')));

                hasUrlFilter = true;

            }



            if (urlParams.get('industry')) {

                filters.industry = urlParams.get('industry');

                setFilterBtnText('industry', decodeURIComponent(urlParams.get('industry')));

                hasUrlFilter = true;

            }



            if (urlParams.get('expMin') !== null || urlParams.get('expMax') !== null) {

                filters.expMin = urlParams.get('expMin') ? Number(urlParams.get('expMin')) : null;

                filters.expMax = urlParams.get('expMax') ? Number(urlParams.get('expMax')) : null;

                hasUrlFilter = true;



                if (filters.expMin === 0 && filters.expMax === 0) {

                    setFilterBtnText('experience', 'Fresher');

                } else {

                    setFilterBtnText(

                        'experience',

                        (filters.expMin ?? '0') + (filters.expMax ? ' - ' + filters.expMax + ' yrs' : ' yrs')

                    );

                }

            }



            if (hasUrlFilter) {

                filterJobs();

            }

        });

    </script>

    <script>
        (function () {
            const urlParams = new URLSearchParams(window.location.search);
            const jobIdParam = urlParams.get('job_id');
            if (!jobIdParam) return;

            // Ensure filters applied so job cards are visible/hide correctly
            filterJobs();

            // Small delay to let filterJobs() update DOM/display states
            setTimeout(() => {
                const card = document.querySelector(`.job-card[data-job-id="${jobIdParam}"]`);
                const listContainer = document.querySelector('.jobs-list'); // your job list container

                if (card) {
                    // mark the card active & show details (no scrolling of details panel)
                    document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));
                    card.classList.add('active');

                    showJobDetails(jobIdParam);

                    // Scroll ONLY the job list container so the active card is nicely visible/centered
                    if (listContainer) {
                        // card and container rects
                        const cardRect = card.getBoundingClientRect();
                        const containerRect = listContainer.getBoundingClientRect();

                        // compute vertical center offset: position card in the vertical center of container
                        const cardCenterInContainer = (cardRect.top + cardRect.bottom) / 2 - containerRect.top;

                        // compute new scrollTop
                        const targetScrollTop = listContainer.scrollTop + cardCenterInContainer - (listContainer.clientHeight / 2);

                        // clamp value between 0 and scrollHeight
                        const clamped = Math.max(0, Math.min(targetScrollTop, listContainer.scrollHeight - listContainer.clientHeight));

                        // animate scroll
                        listContainer.scrollTo({
                            top: clamped,
                            behavior: 'smooth'
                        });
                    }
                } else {
                    // Not found in DOM (maybe not loaded / paginated / filtered out)
                    console.warn('Job id not found in job list:', jobIdParam);

                    // still show details if you want (keeps details panel behavior unchanged)
                    showJobDetails(jobIdParam);

                    // Do NOT scroll job-detail panel per your request.
                }
            }, 80); // small timeout; increase to 200ms if DOM updates are slower on your app
        })();
    </script>



</body>



</html>