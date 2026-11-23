<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CV</title>

    <style>
        /* ===== PAGE ===== */
        body {
            font-family: "Segoe UI", Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 40px;
            color: #111827;
        }

        .cv-container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 55px 65px;
            box-shadow: 0 12px 45px rgba(0, 0, 0, 0.10);
        }

        /* ===== HEADER ===== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .name {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: .5px;
            line-height: 1.1;
        }

        .role {
            color: #2563eb;
            font-size: 20px;
            margin-top: 8px;
            font-weight: 500;
        }

        .contact {
            text-align: right;
            font-size: 14px;
            color: #6b7280;
            line-height: 1.9;
            min-width: 220px;
        }

        /* ===== SECTION ===== */
        .section {
            margin-top: 42px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.6px;
            color: #111827;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 12px 0 20px;
        }

        .summary {
            color: #4b5563;
            line-height: 1.75;
            font-size: 14.5px;
        }

        /* ===== EXPERIENCE ===== */
        .job {
            margin-bottom: 24px;
        }

        .job-head {
            display: flex;
            justify-content: space-between;
            font-size: 15.5px;
            font-weight: 700;
        }

        .company {
            color: #2563eb;
            font-size: 14px;
            margin: 5px 0 7px;
            font-weight: 500;
        }

        .job-desc {
            font-size: 14.5px;
            color: #4b5563;
            line-height: 1.75;
        }

        /* ===== EDUCATION ===== */
        .edu-block {
            margin-bottom: 16px;
        }

        .edu-row {
            display: flex;
            justify-content: space-between;
            font-size: 15.5px;
            font-weight: 700;
        }

        .edu-school {
            color: #6b7280;
            font-size: 14px;
            margin-top: 4px;
        }

        /* ===== SKILLS ===== */
        .skills-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .skill-pill {
            background: #fce300;
            color: black;
            padding: 6px 12px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 600;
        }

        /* ===== PRINT ===== */
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }

            .cv-container {
                box-shadow: none;
                max-width: 100%;
                padding: 40px 50px;
            }
        }

        /* ===== IMAGE WATERMARK ===== */
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
            width: 220px;
            /* adjust if needed */
        }

        @media print {
            .watermark-img {
                bottom: 10px;
                opacity: 0.10;
            }
        }
    </style>
</head>

<body>

    <div class="cv-container">

        <!-- ===== HEADER ===== -->
        <div class="header">
            <div>
                <div class="name">
                    <?= strtoupper($cv->first_name . ' ' . $cv->last_name) ?>
                </div>

                <div class="role">
                    <?= !empty($cv->job_title) ? $cv->job_title : 'Professional' ?>
                </div>
            </div>

            <div class="contact">
                <?= $cv->email ?><br>
                <?= $cv->phone ?><br>
                <?= $cv->city ?><br>
                <?= $cv->address ?>
            </div>
        </div>

        <!-- ===== SUMMARY ===== -->
        <div class="section">
            <div class="section-title">PROFESSIONAL SUMMARY</div>
            <div class="divider"></div>

            <div class="summary">
                <?= nl2br($cv->objective) ?>
            </div>
        </div>

        <!-- ===== EXPERIENCE ===== -->
        <div class="section">
            <div class="section-title">PROFESSIONAL EXPERIENCE</div>
            <div class="divider"></div>

            <?php if (!empty($cv->work)): ?>
                <?php foreach ($cv->work as $w): ?>
                    <div class="job">

                        <div class="job-head">
                            <span><?= $w['job_title'] ?></span>
                            <span><?= $w['start_year'] ?> – <?= $w['end_year'] ?></span>
                        </div>

                        <div class="company"><?= $w['company'] ?></div>

                        <div class="job-desc">
                            <?= nl2br($w['job_desc']) ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ===== EDUCATION ===== -->
        <div class="section">
            <div class="section-title">EDUCATION</div>
            <div class="divider"></div>

            <?php if (!empty($cv->education)): ?>
                <?php foreach ($cv->education as $e): ?>
                    <div class="edu-block">

                        <div class="edu-row">
                            <span><?= $e['degree'] ?></span>
                            <span><?= $e['start_year'] ?> – <?= $e['end_year'] ?></span>
                        </div>

                        <div class="edu-school"><?= $e['school'] ?></div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- ===== SKILLS ===== -->
        <div class="section">
            <div class="section-title">TECH STACK & SKILLS</div>
            <div class="divider"></div>

            <div class="skills-wrap">
                <?php
                if (!empty($cv->skills)) {
                    $skills = explode(',', $cv->skills);
                    foreach ($skills as $skill) {
                        echo '<span class="skill-pill">' . trim($skill) . '</span>';
                    }
                }
                ?>
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