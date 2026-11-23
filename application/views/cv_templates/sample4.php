<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV</title>

    <style>
        /* ===== PAGE ===== */
        body {
            margin: 0;
            background: #f3f4f6;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #1f2937;
        }

        .cv {
            max-width: 950px;
            margin: auto;
            background: #fff;
            position: relative;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            padding: 40px 45px 70px;
            position: relative;
            overflow: hidden;
        }

        .header:after {
            content: "";
            position: absolute;
            bottom: -40px;
            left: 0;
            width: 100%;
            height: 80px;
            background: #fff;
            transform: skewY(-3deg);
        }

        .name {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .role {
            font-size: 20px;
            margin-top: 6px;
            opacity: .95;
        }

        .contact {
            position: absolute;
            right: 45px;
            top: 45px;
            text-align: right;
            font-size: 14px;
            line-height: 1.8;
        }

        /* ===== MAIN ===== */
        .main {
            display: flex;
            gap: 30px;
            padding: 30px 45px 45px;
        }

        .left {
            width: 60%;
        }

        .right {
            width: 40%;
        }

        /* ===== SECTION ===== */
        .section-title {
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 16px;
            margin: 22px 0 14px;
        }

        /* ===== TIMELINE ===== */
        .timeline {
            border-left: 2px solid #e5e7eb;
            padding-left: 20px;
        }

        .job {
            margin-bottom: 26px;
            position: relative;
        }

        .job:before {
            content: "";
            position: absolute;
            left: -28px;
            top: 4px;
            width: 10px;
            height: 10px;
            background: #3b82f6;
            border-radius: 50%;
        }

        .job-title {
            font-weight: 700;
        }

        .job-meta {
            font-size: 13px;
            color: #6b7280;
            margin: 3px 0 6px;
        }

        .badge {
            background: #e0e7ff;
            color: #1d4ed8;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            float: right;
        }

        .job-desc {
            font-size: 14px;
            line-height: 1.7;
            color: #374151;
        }

        /* ===== CARD ===== */
        .card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin-top: 0;
            font-size: 15px;
            letter-spacing: 2px;
        }

        /* ===== SKILL BAR ===== */
        .skill {
            margin-bottom: 12px;
        }

        .skill-name {
            font-size: 13px;
            margin-bottom: 4px;
        }

        .bar {
            height: 6px;
            background: #e5e7eb;
            border-radius: 6px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: #2563eb;
        }

        /* ===== PILLS ===== */
        .pill {
            display: inline-block;
            padding: 5px 9px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            font-size: 12px;
            margin: 4px 5px 0 0;
            background: #fff;
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
                background: #fff;
            }
        }
    </style>
</head>

<body>

    <div class="cv">

        <!-- ===== HEADER ===== -->
        <div class="header">
            <div class="name">
                <?= strtoupper($cv->first_name . ' ' . $cv->last_name) ?>
            </div>
            <div class="role">
                <?= !empty($cv->job_title) ? $cv->job_title : 'Professional' ?>
            </div>

            <div class="contact">
                <?= $cv->email ?><br>
                <?= $cv->city ?>
            </div>
        </div>

        <div class="main">

            <!-- LEFT -->
            <div class="left">

                <div class="section-title">PROFESSIONAL OBJECTIVE</div>
                <div class="job-desc" style="margin-bottom:18px;">
                    <?= nl2br($cv->objective) ?>
                </div>

                <div class="section-title">EXPERIENCE</div>

                <div class="timeline">
                    <?php foreach ($cv->work as $w): ?>
                        <div class="job">
                            <span class="badge">
                                <?= $w['start_year'] ?> -
                                <?= $w['end_year'] ?>
                            </span>
                            <div class="job-title">
                                <?= $w['job_title'] ?>
                            </div>
                            <div class="job-meta">
                                <?= $w['company'] ?> |
                                <?= $w['city'] ?? '' ?>
                            </div>
                            <div class="job-desc">
                                <?= nl2br($w['job_desc']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="section-title">EDUCATION</div>

                <?php foreach ($cv->education as $e): ?>
                    <div class="job">
                        <div class="job-title">
                            <?= $e['degree'] ?>
                        </div>
                        <div class="job-meta">
                            <?= $e['school'] ?> |
                            <?= $e['start_year'] ?> -
                            <?= $e['end_year'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- RIGHT -->
            <div class="right">

                <div class="card">
                    <h3>TECH STACK</h3>

                    <?php
                    $skills = explode(',', $cv->skills);
                    foreach ($skills as $s):
                        $percent = rand(75, 95);
                        ?>
                        <div class="skill">
                            <div class="skill-name">
                                <?= trim($s) ?> <span style="float:right;">
                                    <?= $percent ?>%
                                </span>
                            </div>
                            <div class="bar">
                                <div class="bar-fill" style="width:<?= $percent ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="card">
                    <h3>TOOLS & OTHERS</h3>
                    <?php foreach ($skills as $s): ?>
                        <span class="pill">
                            <?= trim($s) ?>
                        </span>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($cv->languages)): ?>
                    <div class="card">
                        <h3>LANGUAGES</h3>
                        <?= nl2br($cv->languages) ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- WATERMARK -->
    <div class="watermark">
        <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png') ?>">
    </div>

    <script>
        window.onload = function () { window.print(); };
    </script>

</body>

</html>