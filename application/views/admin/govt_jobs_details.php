<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', Arial, sans-serif !important;
        }

        .job-detail-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .job-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .job-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .job-meta span {
            margin-right: 15px;
        }

        .job-section {
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .job-section h3 {
            font-size: 18px;
            color: #a89d00;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .job-section p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .job-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 6px;
            font-size: 14px;
        }

        .info-box strong {
            color: #333;
        }

        .action-buttons {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            color: #333;
            background: #efda56;
        }

        .btn.secondary {
            background: #e9ecef;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .job-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <?php if (!empty($job)): ?>

        <div class="job-detail-container">

            <h1 class="job-title">
                <?= htmlspecialchars($job->title) ?>
            </h1>

            <div class="job-meta">
                <span><strong>Organization:</strong>
                    <?= htmlspecialchars($job->organization) ?>
                </span>
                <span><strong>Department:</strong>
                    <?= htmlspecialchars($job->department) ?>
                </span>
            </div>

            <div class="job-info-grid">
                <div class="info-box">
                    <strong>Country:</strong>
                    <?= htmlspecialchars($job->country ?? 'N/A') ?>
                </div>

                <div class="info-box">
                    <strong>Job Type:</strong>
                    <?= ucfirst(htmlspecialchars($job->job_type)) ?>
                </div>

                <div class="info-box">
                    <strong>Total Vacancies:</strong>
                    <?= htmlspecialchars($job->total_vacancies ?? 0) ?>
                </div>

                <?php if (!empty($job->experience)) { ?>
                    <div class="info-box">
                        <strong>Experience:</strong>
                        <?= htmlspecialchars($job->experience ?? 'As per notification') ?>
                    </div>
                <?php } ?>

                <div class="info-box">
                    <strong>Salary:</strong>
                    <?= htmlspecialchars($job->salary ?? 'As per rules') ?>
                </div>

                <div class="info-box">
                    <strong>Application Start Date:</strong>
                    <?= !empty($job->application_start_date) ? date('d M Y', strtotime($job->application_start_date)) : 'N/A' ?>
                </div>

                <div class="info-box">
                    <strong>Application End Date:</strong>
                    <?= !empty($job->application_end_date) ? date('d M Y', strtotime($job->application_end_date)) : 'N/A' ?>
                </div>
            </div>

            <div class="job-section">
                <h3>Qualification</h3>
                <p>
                    <?= nl2br(htmlspecialchars($job->qualification ?? 'Not specified')) ?>
                </p>
            </div>

            <div class="job-section">
                <h3>Job Description</h3>
                <p>
                    <?= nl2br(htmlspecialchars($job->description ?? 'No description available')) ?>
                </p>
            </div>

            <div class="job-section">
                <h3>Referral link</h3>
                <p>
                    <?= nl2br(htmlspecialchars($job->referral_link_url ?? 'No referral link available')) ?>
                </p>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url('government-jobs') ?>" class="btn secondary">
                    ← Back to Jobs
                </a>
            </div>

        </div>

    <?php else: ?>
        <p style="text-align:center; margin-top:50px;">Job not found.</p>
    <?php endif; ?>

</body>

</html>