<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV</title>

    <style>
        /* ===== PAGE ===== */
        body {
            margin: 0;
            padding: 50px 70px;
            background: #f3f4f6;
            font-family: Georgia, "Times New Roman", serif;
            color: #1f2937;
        }

        .cv-container {
            max-width: 850px;
            margin: auto;
            background: #ffffff;
            padding: 60px 70px;
            position: relative;
        }

        /* ===== HEADER ===== */
        .name {
            text-align: center;
            font-size: 38px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #2563eb;
        }

        .contact {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #6b7280;
        }

        .contact span {
            margin: 0 8px;
        }

        .linkedin {
            text-align: center;
            margin-top: 6px;
            font-size: 14px;
            color: #6b7280;
        }

        /* ===== SECTION ===== */
        .section {
            margin-top: 45px;
        }

        .section-title {
            font-size: 15px;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .divider {
            height: 1px;
            background: #d1d5db;
            margin: 10px 0 20px;
        }

        /* ===== TEXT ===== */
        p {
            font-size: 15px;
            line-height: 1.8;
            color: #374151;
        }

        /* ===== EXPERIENCE ===== */
        .job {
            margin-bottom: 35px;
        }

        .job-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 16px;
        }

        .job-sub {
            display: flex;
            justify-content: space-between;
            margin-top: 4px;
            font-size: 15px;
            color: #2563eb;
            font-style: italic;
        }

        .job-sub span:last-child {
            color: #6b7280;
            font-style: normal;
        }

        .job-desc {
            margin-top: 10px;
            font-size: 15px;
            line-height: 1.8;
            color: #374151;
        }

        /* ===== EDUCATION ===== */
        .edu {
            margin-bottom: 28px;
        }

        .edu-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 16px;
        }

        .edu-sub {
            display: flex;
            justify-content: space-between;
            margin-top: 4px;
            font-size: 15px;
            color: #2563eb;
            font-style: italic;
        }

        .edu-sub span:last-child {
            color: #6b7280;
            font-style: normal;
        }

        /* ===== SKILLS ===== */
        .skills-columns {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .skill-group {
            width: 48%;
        }

        .skill-group h4 {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #6b7280;
        }

        .skill-pill {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #c7d2fe;
            border-radius: 6px;
            font-size: 13px;
            margin: 5px 6px 0 0;
            background: #eef2ff;
            color: #1d4ed8;
        }

        .core {
            margin-top: 18px;
            font-style: italic;
            color: #374151;
        }

        /* ===== WATERMARK ===== */
        .watermark {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.32;
            z-index: 0;
            pointer-events: none;
        }

        .watermark img {
            width: 280px;
        }

        /* ===== PRINT ===== */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .cv-container {
                box-shadow: none;
                padding: 40px 60px;
            }
        }
    </style>
</head>

<body>

    <div class="cv-container">

        <div class="name">
            <?= strtoupper($cv->first_name . ' ' . $cv->last_name) ?>
        </div>

        <div class="contact">
            <span><?= $cv->email ?></span> •
            <span><?= $cv->phone ?></span> •
            <span><?= $cv->city ?></span>
        </div>

        <?php if (!empty($cv->linkedin)): ?>
            <div class="linkedin">
                <?= $cv->linkedin ?>
            </div>
        <?php endif; ?>

        <!-- ===== OBJECTIVE ===== -->
        <div class="section">
            <div class="section-title">Professional Objective</div>
            <div class="divider"></div>
            <p><?= nl2br($cv->objective) ?></p>
        </div>

        <!-- ===== EXPERIENCE ===== -->
        <div class="section">
            <div class="section-title">Professional Experience</div>
            <div class="divider"></div>

            <?php foreach ($cv->work as $w): ?>
                <div class="job">
                    <div class="job-header">
                        <span><?= $w['job_title'] ?></span>
                        <span><?= $w['start_year'] ?> – <?= $w['end_year'] ?></span>
                    </div>
                    <div class="job-sub">
                        <span><?= $w['company'] ?></span>
                        <span><?= $w['city'] ?? '' ?></span>
                    </div>
                    <div class="job-desc">
                        <?= nl2br($w['job_desc']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ===== EDUCATION ===== -->
        <div class="section">
            <div class="section-title">Education</div>
            <div class="divider"></div>

            <?php foreach ($cv->education as $e): ?>
                <div class="edu">
                    <div class="edu-header">
                        <span><?= $e['degree'] ?></span>
                        <span><?= $e['start_year'] ?> – <?= $e['end_year'] ?></span>
                    </div>
                    <div class="edu-sub">
                        <span><?= $e['school'] ?></span>
                        <span><?= $e['city'] ?? '' ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- ===== SKILLS ===== -->
        <div class="section">
            <div class="section-title">Tech Stack & Competencies</div>
            <div class="divider"></div>

            <div class="skills-columns">
                <div class="skill-group">
                    <h4>Professional Softwares</h4>
                    <?php
                    $skills = explode(',', $cv->skills);
                    foreach ($skills as $skill) {
                        echo '<span class="skill-pill">' . trim($skill) . '</span>';
                    }
                    ?>
                </div>
            </div>

            <div class="core">
                <?= nl2br($cv->core_competencies ?? '') ?>
            </div>
        </div>

    </div>

    <!-- ===== IMAGE WATERMARK ===== -->
    <div class="watermark">
        <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png') ?>" alt="watermark">
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>

</body>

</html>