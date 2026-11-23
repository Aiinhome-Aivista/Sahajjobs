<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Job page content only. <html>/<head>/title/canonical/description come from includes/header.php;
// Open Graph + JobPosting schema come from views/job_seo_head.php (see Job::view()).
?>
<style>
        .job-detail-page {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px
        }

        .job-detail {
            max-width: 900px;
            margin: 0 auto
        }

        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px
        }

        .detail-title {
            font-size: 24px;
            margin: 0
        }

        .detail-company {
            color: #6c757d
        }

        .apply-btn {
            background-color: #FFF44F;
            color: #000;
            border: none;
            padding: 8px 14px;
            border-radius: 6px
        }

        .header-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .share-btn {
            background: #e9ecef;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .share-btn i {
            font-size: 16px;
        }
    </style>

<div class="job-detail-page">
<div class="job-detail">
        <div class="detail-header">
            <div>
                <h2 class="detail-title"><?= escape($job['title']) ?></h2>
                <div class="detail-company"><?= escape($job['company']) ?></div>
            </div>
            <!-- Share Button -->
            <div class="header-buttons">
                <!-- Share Button -->
                <button class="share-btn" onclick="shareJob()">
                    <i class="fa-solid fa-share"></i> Share
                </button>


                <!-- Apply Button -->
                <button class="apply-btn" onclick="window.location.href='<?= base_url('register'); ?>'">
                    Apply Now
                </button>
            </div>
        </div>

        <div class="detail-info mb-3">
            <div><strong>Location:</strong> <?= escape($job['location']) ?></div>
            <div><strong>Experience:</strong> <?= escape($job['experience']) ?></div>
            <div><strong>Salary:</strong> <?= escape($job['salary']) ?></div>
            <div><strong>Type:</strong> <?= escape($job['job_type']) ?></div>
            <div><strong>Industry:</strong> <?= escape($job['industry']) ?></div>
        </div>

        <div class="detail-section mb-3">
            <h4>Job Description</h4>
            <div class="job-description"><?= format_description_html($job['description']) ?></div>
        </div>

        <?php if (!empty($job['requirements'])): ?>
            <div class="detail-section mb-3">
                <h4>Requirements</h4>
                <ul>
                    <?php foreach (preg_split("/\r\n|\n|\r/", $job['requirements']) as $r):
                        if (trim($r) === '')
                            continue; ?>
                        <li><?= html_escape(trim($r)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($job['benefits'])): ?>
            <div class="detail-section mb-3">
                <h4>Benefits</h4>
                <ul>
                    <?php foreach (preg_split("/\r\n|\n|\r/", $job['benefits']) as $b):
                        if (trim($b) === '')
                            continue; ?>
                        <li><?= html_escape(trim($b)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>


    <script>
        function shareJob() {
            const shareUrl = "<?= base_url('job/view/' . $job['id']); ?>";
            const shareTitle = "<?= escape($job['title']); ?>";
            const shareText = "Check out this job: <?= escape($job['title']); ?> at <?= escape($job['company']); ?>";

            if (navigator.share) {
                navigator.share({
                    title: shareTitle,
                    text: shareText,
                    url: shareUrl
                }).catch((err) => console.log("Share failed:", err));
            } else {
                // Fallback – copy to clipboard
                navigator.clipboard.writeText(shareUrl).then(() => {
                    alert("Share link copied:\n" + shareUrl);
                });
            }
        }
    </script>
</div>
