<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Blog Posted - SahajJobs</title>

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
            margin-bottom: 18px;
            font-size: 15px;
        }

        .post-box {
            background: #f1f5f9;
            padding: 16px;
            border-radius: 10px;
            margin: 18px 0;
            font-weight: 600;
            color: #0f172a;
        }

        .read-btn {
            display: block;
            background: #FFF44F;
            color: #29374d;
            text-align: center;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            margin: 24px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
                We’ve just published a new article on SahajJobs that you might find useful.
            </p>

            <div class="post-box">
                <?= htmlspecialchars($post_title) ?>
            </div>

            <a href="<?= $post_link ?>" class="read-btn">
                Read Full Article
            </a>

            <div class="note">
                <div class="note-title">Why you're receiving this</div>
                <p>You are receiving this email because you subscribed to SahajJobs updates.</p>
            </div>

            <p class="message">
                If the button above doesn't work, copy and paste this link into your browser:
            </p>


            <div class="closing">
                <p>Best regards,</p>
                <p class="signature">The SahajJobs Team</p>
            </div>
        </div>

        <div class="footer">
            <p class="footer-note">
                This is an automated message. Please do not reply to this email.
            </p>
            <p class="copyright">
                &copy; <?= date('Y'); ?> SahajJobs. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>