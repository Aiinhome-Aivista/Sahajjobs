<?php defined('BASEPATH') OR exit('No direct script access allowed');

function escape($s)
{
    return html_escape($s);
}

function format_description_html($text)
{
    if (empty($text))
        return '';
    $lines = preg_split("/\r\n|\n|\r/", $text);
    $html = '';
    $inList = false;
    $headerStartedList = false;

    foreach ($lines as $raw) {
        $raw = str_replace("\t", ' ', $raw);
        $trim = trim($raw);

        // explicit bullets
        if (preg_match('/^\s*([-*•]|\d+\.)\s+/', $raw)) {
            if (!$inList) {
                $html .= '<ul>';
                $inList = true;
                $headerStartedList = false;
            }
            $item = preg_replace('/^\s*([-*•]|\d+\.)\s*/', '', $raw);
            $html .= '<li>' . html_escape($item) . '</li>';
            continue;
        }

        // header lines ending with colon OR keywords
        if ($trim !== '' && (preg_match('/:\s*$/', $trim) || preg_match('/\b(key\s+responsibil|responsibil|requirements?|benefits?)\b/i', $trim))) {
            if ($inList) {
                $html .= '</ul>';
                $inList = false;
            }
            $headerStartedList = true;
            $html .= '<p><strong>' . html_escape(rtrim($trim, ':')) . '</strong></p>';
            continue;
        }

        if ($trim === '') {
            if ($headerStartedList) {
                continue;
            } else {
                if ($inList) {
                    $html .= '</ul>';
                    $inList = false;
                }
                $headerStartedList = false;
                continue;
            }
        }

        if ($headerStartedList) {
            if (!$inList) {
                $html .= '<ul>';
                $inList = true;
            }
            $html .= '<li>' . html_escape($trim) . '</li>';
            continue;
        }

        if ($inList) {
            $html .= '</ul>';
            $inList = false;
        }
        $html .= '<p>' . html_escape($trim) . '</p>';
    }

    if ($inList)
        $html .= '</ul>';
    return $html;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= escape($job['title']) ?> — <?= escape($job['company']) ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        body {
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
</head>

<body>
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

</body>

</html>