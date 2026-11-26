<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(180deg, #eef1f7 0%, #e3e7ef 100%);
            font-family: 'Segoe UI', sans-serif;
        }

        /* ================= HEADER ================= */
        .top-header {
            background: url("<?= base_url('./ALL_UPLOADS/images/CV-background.png'); ?>") center/cover no-repeat;
            height: 400px;
            color: white;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .top-header::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .top-header h2,
        .top-header .step-bar {
            position: relative;
            z-index: 2;
            margin-bottom: 50px;
        }

        /* ================= STEPPER ================= */
        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #cfd3d7;
            color: black;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 24px 40px;
            font-size: 14px;
            cursor: pointer;
        }

        .step-circle.active {
            background: #FFF44F;
        }

        /* ================= CARD ================= */
        .form-card {
            position: relative;
            border-radius: 14px;
            padding: 32px;
            margin-top: -70px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
            z-index: 10;
            overflow: hidden;
        }

        .form-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.6);
            /* ← control opacity here */
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 0;
        }

        .form-card>* {
            position: relative;
            z-index: 1;
        }

        /* ================= PHOTO ================= */
        .photo-box {
            width: 120px;
            height: 208px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: #fafafa;
            margin-top: 10px;
            overflow: hidden;
        }

        /* ================= BUTTON ================= */
        .next-btn {
            background: #FFF44F;
            color: black;
            padding: 5px 11px 9px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
        }

        .next-btn:hover {
            background: #FFF44F;
        }

        /* ================= STEPS ================= */
        .step-section {
            display: none;
        }

        .step-section.active {
            display: block;
        }

        .work-item {
            background: #f8f9fa;
        }

        /* OPEN accordion header */
        .accordion-button:not(.collapsed) {
            background-color: #FFF44F !important;
            color: #000;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) i {
            color: #000;
        }

        /* Work experience wrapper */
        .work-item {
            position: relative;
            background: #f8f9fa;
        }

        .edu-item {
            position: relative;
            background: #f8f9fa;
        }

        /* delete button top-right */
        .exp-delete-btn {
            position: absolute;
            top: 8px;
            right: 10px;
            border: none;
            background: transparent;
            color: #6b7280;
            font-size: 18px;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 6px;
            transition: all .2s ease;
        }

        .exp-delete-btn:hover {
            background: #fee2e2;
            color: #dc2626;
        }
    </style>
</head>

<body>

    <!-- ================= HEADER ================= -->
    <div class="top-header">
        <h2>Your Smart CV Builder</h2>

        <div class="step-bar">
            <span class="step-circle active">1</span>
            <span class="step-circle">2</span>
            <span class="step-circle">3</span>

            <div style="font-size:17px;margin-top: -25px;">
                Personal &nbsp;&nbsp;&nbsp;&nbsp; Experiences &nbsp;&nbsp;&nbsp;&nbsp; Template
            </div>
        </div>
    </div>

    <div class="container" style="max-width:900px;">
        <div class="form-card">

            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <form method="post" action="<?= base_url('cv-maker/save'); ?>" enctype="multipart/form-data" id="cvForm">

                <!-- ================= STEP 1 ================= -->
                <div id="step1" class="step-section active">

                    <div class="d-flex justify-content-between mb-3">
                        <div class="section-title"><b>Personal details</b></div>
                    </div>

                    <div class="row">

                        <!-- PHOTO -->
                        <div class="col-md-3 text-center">
                            <label class="photo-box w-100">
                                <img id="photoPreview" src=""
                                    style="display:none;width:100%;height:100%;object-fit:cover;border-radius:6px;">
                                <span id="photoText">📷<br><small>Add photo</small></span>
                                <input type="file" name="profile_image" accept="image/*" onchange="previewPhoto(this)"
                                    hidden>
                            </label>
                        </div>

                        <!-- FORM FIELDS -->
                        <div class="col-md-9">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>First name *</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Last name *</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Email address *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Phone number</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Zip code</label>
                            <input type="text" name="zip" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>City/Town</label>
                            <input type="text" name="city" class="form-control">
                        </div>


                        <div class="col-md-4 mb-3">
                            <label>Date of birth *</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control">
                        </div>

                    </div>


                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="next-btn" onclick="nextStep(2)">
                            Next step →
                        </button>
                    </div>

                </div>

                <!-- ================= STEP 2 ================= -->
                <div id="step2" class="step-section">

                    <h5 class="mb-4"><b>My experiences</b></h5>

                    <div class="accordion" id="cvAccordion">

                        <!-- OBJECTIVE -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#objective">
                                    <i class="bi bi-bullseye me-2"></i>Career objective
                                </button>
                            </h2>

                            <div id="objective" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <textarea name="objective" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- WORK EXPERIENCE -->
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#work">
                                    <i class="bi bi-briefcase-fill me-2"></i>Work experience
                                </button>
                            </h2>

                            <div id="work" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <div id="workWrapper">

                                        <div class="work-item border rounded p-3 mb-3">

                                            <!-- DELETE BUTTON -->
                                            <button type="button" class="exp-delete-btn">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                            <div class="row">

                                                <!-- Job Title -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Job Title</label>
                                                    <input type="text" name="job_title[]" class="form-control"
                                                        placeholder="e.g. Sales Manager">
                                                </div>

                                                <!-- City -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">City/Town</label>
                                                    <input type="text" name="job_city[]" class="form-control"
                                                        placeholder="e.g. San Francisco">
                                                </div>

                                                <!-- Employer -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label fw-semibold">Employer</label>
                                                    <input type="text" name="company[]" class="form-control"
                                                        placeholder="e.g. ABC Pvt. Ltd">
                                                </div>

                                                <!-- Start Date -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Start Date</label>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <select name="start_month[]" class="form-select">
                                                                <option>January</option>
                                                                <option>February</option>
                                                                <option>March</option>
                                                                <option>April</option>
                                                                <option>May</option>
                                                                <option>June</option>
                                                                <option>July</option>
                                                                <option>August</option>
                                                                <option selected>September</option>
                                                                <option>October</option>
                                                                <option>November</option>
                                                                <option>December</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="start_year[]" class="form-select">
                                                                <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                                                    <option>
                                                                        <?= $y ?>
                                                                    </option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- End Date -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">End Date</label>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <select name="end_month[]" class="form-select">
                                                                <option>January</option>
                                                                <option>February</option>
                                                                <option>March</option>
                                                                <option>April</option>
                                                                <option>May</option>
                                                                <option>June</option>
                                                                <option selected>July</option>
                                                                <option>August</option>
                                                                <option>September</option>
                                                                <option>October</option>
                                                                <option>November</option>
                                                                <option>December</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="end_year[]" class="form-select">
                                                                <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                                                    <option>
                                                                        <?= $y ?>
                                                                    </option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea name="job_desc[]" class="form-control" rows="4"
                                                        placeholder="Describe your responsibilities and achievements"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addWork()">
                                        + Add work experience
                                    </button>

                                </div>
                            </div>
                        </div>

                        <!-- EDUCATION -->
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#education">
                                    <i class="bi bi-mortarboard-fill me-2"></i>Education and Qualifications
                                </button>
                            </h2>

                            <div id="education" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div id="eduWrapper">

                                        <div class="edu-item border rounded p-3 mb-3">

                                            <!-- DELETE BUTTON -->
                                            <button type="button" class="exp-delete-btn">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                            <div class="row">

                                                <!-- Degree -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Degree</label>
                                                    <input type="text" name="degree[]" class="form-control"
                                                        placeholder="e.g. Bachelor of Science">
                                                </div>

                                                <!-- City -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">City/Town</label>
                                                    <input type="text" name="edu_city[]" class="form-control"
                                                        placeholder="e.g. San Francisco">
                                                </div>

                                                <!-- School -->
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label fw-semibold">University/College/School</label>
                                                    <input type="text" name="school[]" class="form-control"
                                                        placeholder="e.g. New York University">
                                                </div>

                                                <!-- Start Date -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Start Date</label>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <select name="edu_start_month[]" class="form-select">
                                                                <option>January</option>
                                                                <option>February</option>
                                                                <option>March</option>
                                                                <option>April</option>
                                                                <option>May</option>
                                                                <option>June</option>
                                                                <option>July</option>
                                                                <option>August</option>
                                                                <option selected>September</option>
                                                                <option>October</option>
                                                                <option>November</option>
                                                                <option>December</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="edu_start_year[]" class="form-select">
                                                                <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                                                    <option><?= $y ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- End Date -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">End Date</label>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <select name="edu_end_month[]" class="form-select">
                                                                <option>January</option>
                                                                <option>February</option>
                                                                <option>March</option>
                                                                <option>April</option>
                                                                <option>May</option>
                                                                <option>June</option>
                                                                <option selected>July</option>
                                                                <option>August</option>
                                                                <option>September</option>
                                                                <option>October</option>
                                                                <option>November</option>
                                                                <option>December</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <select name="edu_end_year[]" class="form-select">
                                                                <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                                                    <option><?= $y ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold">Description</label>
                                                    <textarea name="edu_desc[]" class="form-control" rows="4"
                                                        placeholder="Optional description"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        onclick="addEducation()">
                                        + Add education
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- SKILLS -->
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#skills">
                                    <i class="bi bi-lightning-fill me-2"></i>Skills
                                </button>
                            </h2>

                            <div id="skills" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    <textarea name="skills" class="form-control" rows="3"></textarea>

                                    <!-- <div id="skillsWrapper">

                                        
                                        <div class="skill-item border rounded p-3 mb-3 position-relative">

                                            
                                            <button type="button"
                                                class="exp-delete-btn btn btn-sm btn-light position-absolute top-0 end-0 m-2">
                                                <i class="bi bi-x-lg"></i>
                                            </button>

                                            <div class="row">

                                              
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Skill</label>
                                                    <input type="text" name="skill_name[]" class="form-control"
                                                        placeholder="e.g. Microsoft Word">
                                                </div>

                                               
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Level</label>
                                                    <select name="skill_level[]" class="form-select">
                                                        <option value="">Select level</option>
                                                        <option>Beginner</option>
                                                        <option>Intermediate</option>
                                                        <option>Advanced</option>
                                                        <option>Expert</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSkill()">
                                        + Add skill
                                    </button> -->

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- NAVIGATION -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(1)">← Back</button>
                        <button type="button" id="submitBtn" class="next-btn">
                            Save →
                        </button>
                    </div>

                </div>

                <!-- ================= STEP 3 ================= -->
                <div id="step3" class="step-section">

                    <style>
                        .template-card {
                            border-radius: 10px;
                            padding: 10px;
                            background: #fff;
                            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
                            cursor: pointer;
                            transition: all .25s ease;
                            border: 2px solid transparent;
                        }

                        .template-card:hover {
                            transform: translateY(-3px);
                        }

                        .template-card.active {
                            border: 2px solid #FFF44F;
                        }

                        .template-card img {
                            width: 100%;
                            border-radius: 6px;
                            height: 265px;
                        }

                        .template-title {
                            font-weight: 600;
                            margin-top: 6px;
                            font-size: 14px;
                        }
                    </style>

                    <h5 class="mb-4 text-center"><b>Choose your CV template</b></h5>

                    <div class="row g-4">

                        <!-- TEMPLATE 1 -->
                        <div class="col-md-3">
                            <div class="template-card active" data-template="sample1">
                                <img src="<?= base_url('./ALL_UPLOADS/images/sample1.png') ?>">
                            </div>
                        </div>

                        <!-- TEMPLATE 2 -->
                        <div class="col-md-3">
                            <div class="template-card" data-template="sample2">
                                <img src="<?= base_url('./ALL_UPLOADS/images/sample2.png') ?>">
                            </div>
                        </div>

                        <!-- TEMPLATE 3 -->
                        <div class="col-md-3">
                            <div class="template-card" data-template="sample3">
                                <img src="<?= base_url('./ALL_UPLOADS/images/sample3.png') ?>">
                            </div>
                        </div>

                        <!-- TEMPLATE 4 -->
                        <div class="col-md-3">
                            <div class="template-card" data-template="sample4">
                                <img src="<?= base_url('./ALL_UPLOADS/images/sample4.png') ?>">
                            </div>
                        </div>

                    </div>

                    <!-- hidden selected template -->
                    <input type="hidden" name="cv_template" id="cvTemplate" value="sample1">

                    <!-- NAV BUTTONS -->
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                            ← Back
                        </button>

                        <a id="downloadBtn" class="btn btn-warning btn-md">
                            Download CV
                        </a>
                    </div>

                </div>

            </form>
        </div>
    </div>
    
    <!-- ================= FAQ SECTION ================= -->
    <div class="container mt-5 mb-5">

        <!-- HEADER -->
        <div class="text-center text-black py-5 rounded">
            <h2 class="fw-bold">FAQ</h2>
            <p class="mb-0">
                Have questions about creating your CV or applying for jobs on SahajJobs?
                Find quick answers below.
            </p>
        </div>

        <!-- GRID -->
        <div class="row mt-4 g-3">

            <!-- ITEM 1 -->
            <div class="col-md-6">
                <div class="accordion" id="faq1Accordion">
                    <div class="accordion-item border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1">
                                Can I add a photo to my CV?
                            </button>
                        </h2>

                        <div id="faq1" class="accordion-collapse collapse">
                            <div class="accordion-body text-muted">
                                Yes, you can upload your profile photo in the Personal Details step.
                                Adding a professional photo can improve your chances of getting noticed by employers.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ITEM 2 -->
            <div class="col-md-6">
                <div class="accordion" id="faq2Accordion">
                    <div class="accordion-item border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2">
                                Can I download my CV after creating it?
                            </button>
                        </h2>

                        <div id="faq2" class="accordion-collapse collapse">
                            <div class="accordion-body text-muted">
                                Yes, once your CV is completed, you can download it in a professional format
                                and use it to apply for jobs on SahajJobs or anywhere else.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ITEM 3 -->
            <div class="col-md-6">
                <div class="accordion" id="faq3Accordion">
                    <div class="accordion-item border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3">
                                Is creating a CV on SahajJobs free?
                            </button>
                        </h2>

                        <div id="faq3" class="accordion-collapse collapse">
                            <div class="accordion-body text-muted">
                                Yes, creating your CV on SahajJobs is completely free.
                                You can build, edit, and download your CV without any charges.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ITEM 4 -->
            <div class="col-md-6">
                <div class="accordion" id="faq4Accordion">
                    <div class="accordion-item border-0 shadow-sm rounded">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4">
                                How long does it take to create a CV?
                            </button>
                        </h2>

                        <div id="faq4" class="accordion-collapse collapse">
                            <div class="accordion-body text-muted">
                                It usually takes 5–10 minutes to create a professional CV using our builder.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("click", function (e) {
            const card = e.target.closest(".template-card");
            if (!card) return;

            document.querySelectorAll(".template-card")
                .forEach(c => c.classList.remove("active"));

            card.classList.add("active");

            document.getElementById("cvTemplate").value =
                card.getAttribute("data-template");
        });
    </script>

    <script>
        document.getElementById("downloadBtn").addEventListener("click", function () {

            if (!window.cvId) {
                alert("Please save first.");
                return;
            }

            const template = document.getElementById("cvTemplate").value || "sample1";

            // Get first & last name
            const firstName = document.querySelector("input[name='first_name']").value;
            const lastName = document.querySelector("input[name='last_name']").value;

            // Combine full name
            const fullName = firstName + " " + lastName;

            // Get email
            const email = document.querySelector("input[name='email']").value;

            // Redirect to register
            window.location.href =
                "<?= base_url('register'); ?>" +
                "?cv_id=" + window.cvId +
                "&template=" + template +
                "&email=" + encodeURIComponent(email) +
                "&fullname=" + encodeURIComponent(fullName);
        });
    </script>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('photoPreview').src = e.target.result;
                    document.getElementById('photoPreview').style.display = 'block';
                    document.getElementById('photoText').style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function goStep(step) {
            document.querySelectorAll('.step-section').forEach(s => s.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');

            document.querySelectorAll('.step-circle').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.step-circle')[step - 1].classList.add('active');
        }

        function nextStep(step) {
            if (step === 2) {
                let requiredFields = document.querySelectorAll('#step1 input[required]');
                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        field.focus();
                        alert('Please fill all required fields');
                        return;
                    }
                }
            }
            goStep(step);
        }

        function prevStep(step) { goStep(step); }

        function addWork() {
            let html = `
    <div class="work-item border rounded p-3 mb-3">

        <!-- DELETE BUTTON -->
        <button type="button" class="exp-delete-btn">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Job Title</label>
                <input type="text" name="job_title[]" class="form-control"
                       placeholder="e.g. Sales Manager">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">City/Town</label>
                <input type="text" name="job_city[]" class="form-control"
                       placeholder="e.g. San Francisco">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold">Employer</label>
                <input type="text" name="company[]" class="form-control"
                       placeholder="e.g. Aiinhome">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Start Date</label>
                <div class="row g-2">
                    <div class="col-6">
                        <select name="start_month[]" class="form-select">
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option selected>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="start_year[]" class="form-select">
                            <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                <option>
                                <?= $y ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">End Date</label>
                <div class="row g-2">
                    <div class="col-6">
                        <select name="end_month[]" class="form-select">
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option selected>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="end_year[]" class="form-select">
                            <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                <option>
                                <?= $y ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="job_desc[]" class="form-control"
                          rows="4"
                          placeholder="Describe your responsibilities and achievements"></textarea>
            </div>

        </div>
    </div>`;

            document.getElementById('workWrapper').insertAdjacentHTML('beforeend', html);
        }
    </script>

    <script>
        document.addEventListener("click", function (e) {
            const btn = e.target.closest(".exp-delete-btn");
            if (!btn) return;

            const workItem = btn.closest(".work-item");
            const eduItem = btn.closest(".edu-item");
            const skillItem = btn.closest(".skill-item");

            if (workItem) {
                const items = document.querySelectorAll(".work-item");
                if (items.length === 1) {
                    alert("At least one work experience is required.");
                    return;
                }
                workItem.remove();
            }

            if (eduItem) {
                const items = document.querySelectorAll(".edu-item");
                if (items.length === 1) {
                    alert("At least one education entry is required.");
                    return;
                }
                eduItem.remove();
            }
        });
    </script>


    <script>
        function addEducation() {
            let html = `
    <div class="edu-item border rounded p-3 mb-3">

        <button type="button" class="exp-delete-btn">
            <i class="bi bi-x-lg"></i>
        </button>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Degree</label>
                <input type="text" name="degree[]" class="form-control"
                       placeholder="e.g. Bachelor of Science">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">City/Town</label>
                <input type="text" name="edu_city[]" class="form-control"
                       placeholder="e.g. San Francisco">
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold">School</label>
                <input type="text" name="school[]" class="form-control"
                       placeholder="e.g. New York University">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Start Date</label>
                <div class="row g-2">
                    <div class="col-6">
                        <select name="edu_start_month[]" class="form-select">
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option selected>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="edu_start_year[]" class="form-select">
                            <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                <option><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">End Date</label>
                <div class="row g-2">
                    <div class="col-6">
                        <select name="edu_end_month[]" class="form-select">
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option selected>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="edu_end_year[]" class="form-select">
                            <?php for ($y = date('Y'); $y >= 1980; $y--): ?>
                                <option><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="edu_desc[]" class="form-control"
                          rows="4"
                          placeholder="Optional description"></textarea>
            </div>

        </div>
    </div>`;

            document.getElementById('eduWrapper')
                .insertAdjacentHTML('beforeend', html);
        }
    </script>

    <script>
        document.getElementById("submitBtn").addEventListener("click", function () {

            let form = document.getElementById("cvForm");
            let formData = new FormData(form);

            fetch("<?= base_url('cv-maker/save'); ?>", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status === "success") {

                        // store ID if needed later
                        window.cvId = data.insert_id;

                        // move to step 3
                        goStep(3);

                    } else {
                        alert("Save failed");
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("Something went wrong");
                });
        });
    </script>

</body>

</html>