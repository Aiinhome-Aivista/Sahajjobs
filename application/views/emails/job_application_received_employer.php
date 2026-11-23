<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job Application Received - SahajJobs</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #334155;
            background-color: #f8fafc;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            margin: 20px auto;
        }

        .content {
            padding: 32px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .message {
            margin-bottom: 24px;
            font-size: 15px;
        }

        .note {
            background-color: #eff6ff;
            padding: 18px;
            border-radius: 10px;
            margin: 24px 0;
            border-left: 4px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        }

        .note-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #1d4ed8;
        }

        .closing {
            margin-top: 28px;
        }

        .signature {
            font-weight: 600;
            color: #1e293b;
            margin-top: 8px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #64748b;
            padding: 20px 0;
            border-top: 1px solid #e2e8f0;
            margin-top: 32px;
        }

        .footer-note {
            margin-bottom: 12px;
        }

        .copyright {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">

            <p class="greeting">Hello,</p>

            <p class="message">
                You have received a new application for the position of
                <strong><?php echo htmlspecialchars($job_title ?? 'the role'); ?></strong>.
            </p>

            <p class="message">
                <strong>Candidate Name:</strong>
                <?php echo htmlspecialchars($full_name ?? 'Candidate'); ?><br>
                <strong>Applied On:</strong>
                <?php echo htmlspecialchars($applied_at ?? date('Y-m-d H:i:s')); ?>
            </p>

            <div class="note">
                <div class="note-title">Next steps</div>
                <p>
                    Please log in to your SahajJobs employer dashboard to review the candidate’s profile,
                    shortlist, or take further action.
                </p>
                <p style="margin-top: 10px;">
                    Website URL:
                    <a href="https://www.sahajjobs.com/" target="_blank">
                        https://www.sahajjobs.com/
                    </a>
                </p>
            </div>

            <div class="closing">
                <p>Best regards,</p>
                <p class="signature">The SahajJobs Team</p>
            </div>
            <div style="margin-top: 16px;">
                <img src="https://sahajjobs.com/./ALL_UPLOADS/images/SahajJOB2.png" alt="SahajJobs Logo" width="140"
                    style="display: block; max-width: 140px;">
            </div>
        </div>

        <div class="footer">
            <p class="footer-note">
                This is an automated message. Please do not reply to this email.
            </p>
            <p class="copyright">
                &copy; <?php echo date('Y'); ?> SahajJobs. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>