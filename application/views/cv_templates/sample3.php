<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV</title>

    <style>
        /* ===== PAGE ===== */
        body {
            margin: 0;
            padding: 40px;
            background: #f3f4f6;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #1f2937;
        }

        .cv-container {
            max-width: 920px;
            margin: auto;
            background: #ffffff;
            padding: 45px;
            position: relative;
        }

        /* ===== HEADER ===== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .name {
            font-size: 34px;
            font-weight: 800;
        }

        .role {
            color: #2563eb;
            font-size: 20px;
            margin-top: 6px;
        }

        .contact {
            margin-top: 10px;
            font-size: 14px;
            color: #6b7280;
        }

        .profile-img img {
            width: 95px;
            height: 95px;
            border-radius: 12px;
            object-fit: cover;
        }

        /* ===== MAIN GRID ===== */
        .main {
            display: flex;
            gap: 40px;
            margin-top: 30px;
        }

        /* ===== LEFT SIDEBAR ===== */
        .sidebar {
            width: 32%;
            background: #fef08a;
            /* soft yellow */
            padding: 22px;
            border-radius: 10px;
        }

        .sidebar h3 {
            font-size: 13px;
            letter-spacing: 2px;
            color: #9ca3af;
            margin-bottom: 14px;
        }

        .skill-pill {
            display: inline-block;
            background: #eef2ff;
            color: #1d4ed8;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            margin: 4px 6px 4px 0;
            font-weight: 600;
        }

        .edu-item {
            margin-bottom: 18px;
        }

        .award {
            font-size: 14px;
            color: #374151;
            margin-bottom: 6px;
        }

        /* ===== RIGHT CONTENT ===== */
        .content {
            width: 68%;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        /* ===== TIMELINE ===== */
        .timeline {
            position: relative;
            padding-left: 22px;
        }

        .timeline:before {
            content: "";
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }

        .job {
            position: relative;
            margin-bottom: 34px;
        }

        .job:before {
            content: "";
            position: absolute;
            left: -22px;
            top: 6px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 3px solid #3b82f6;
            background: #ffffff;
        }

        .job-title {
            font-weight: 700;
            font-size: 17px;
        }

        .job-meta {
            font-size: 14px;
            color: #6b7280;
            margin: 4px 0 8px;
        }

        .job-desc {
            font-size: 14.5px;
            line-height: 1.7;
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
            width: 260px;
        }

        /* ===== PRINT ===== */
        @page {
            size: A4;
            margin: 20mm;
        }

        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .cv-container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body>

    <div class="cv-container">

        <!-- HEADER -->
        <div class="header">
            <div>
                <div class="name">
                    <?= $cv->first_name . ' ' . $cv->last_name ?>
                </div>
                <div class="role">
                    <?= !empty($cv->job_title) ? $cv->job_title : 'Professional' ?>
                </div>
                <div class="contact">
                    <?= $cv->email ?> • <?= $cv->phone ?> • <?= $cv->city ?>
                </div>
            </div>


            <div class="profile-img">
                <img src="<?= base_url('./ALL_UPLOADS/profile_photos/' . $cv->profile_image) ?>">
            </div>
        </div>

        <div class="main">

            <!-- ===== SIDEBAR ===== -->
            <div class="sidebar">

                <h3>TECH STACK</h3>
                <?php
                $skills = explode(',', $cv->skills);
                foreach ($skills as $skill) {
                    echo '<span class="skill-pill">' . trim($skill) . '</span>';
                }
                ?>

                <div style="margin-top:30px;">
                    <h3>EDUCATION</h3>
                    <?php foreach ($cv->education as $e): ?>
                        <div class="edu-item">
                            <strong><?= $e['degree'] ?></strong><br>
                            <span style="color:#6b7280; font-size:14px;">
                                <?= $e['school'] ?><br>
                                <?= $e['start_year'] ?> — <?= $e['end_year'] ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($cv->awards)): ?>
                    <div style="margin-top:30px;">
                        <h3>AWARDS</h3>
                        <?php
                        $awards = explode(',', $cv->awards);
                        foreach ($awards as $a) {
                            echo '<div class="award">★ ' . trim($a) . '</div>';
                        }
                        ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- ===== CONTENT ===== -->
            <div class="content">

                <div class="section-title">Professional Objective</div>
                <div class="job-desc" style="margin-bottom:28px;">
                    <?= nl2br($cv->objective) ?>
                </div>

                <div class="section-title">Professional Experience</div>

                <div class="timeline">
                    <?php foreach ($cv->work as $w): ?>
                        <div class="job">
                            <div class="job-title"><?= $w['job_title'] ?></div>
                            <div class="job-meta">
                                <?= $w['company'] ?> | <?= $w['city'] ?? '' ?>
                                &nbsp;&nbsp; <?= $w['start_year'] ?> — <?= $w['end_year'] ?>
                            </div>
                            <div class="job-desc">
                                <?= nl2br($w['job_desc']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- WATERMARK -->
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