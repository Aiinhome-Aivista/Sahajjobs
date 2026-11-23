<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Mock Interview Results</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
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
            border: 1px solid #e2e8f0;
        }
        
        .header {
            background: #FFF44F;
            color: #000000;
            padding: 35px 24px;
            text-align: center;
            position: relative;
        }
        
        .logo {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 5px;
            color: #000000;
        }
        
        .logo-subtitle {
            font-weight: 500;
            opacity: 0.85;
            font-size: 15px;
            color: #27365c;
        }
        
        .content {
            padding: 32px 24px;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #1e293b;
        }
        
        .intro {
            font-size: 15px;
            margin-bottom: 24px;
            color: #475569;
        }
        
        /* Score display badge */
        .score-card {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 25px;
        }
        
        .score-val {
            font-size: 42px;
            font-weight: 800;
            color: #16a34a;
            line-height: 1;
        }
        
        .score-lbl {
            font-size: 14px;
            font-weight: 700;
            color: #15803d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 5px;
        }
        
        .summary-box {
            background: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            margin-bottom: 25px;
            border-radius: 0 8px 8px 0;
            font-size: 14px;
            font-style: italic;
            color: #334155;
        }
        
        .feedback-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }
        
        .bullet-list {
            padding-left: 20px;
            font-size: 14px;
            color: #475569;
        }
        
        .bullet-list li {
            margin-bottom: 6px;
        }
        
        .footer {
            background: #f8fafc;
            padding: 24px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">SahajJobs</div>
            <div class="logo-subtitle">Mock Interview Assessment</div>
        </div>
        
        <!-- Content -->
        <div class="content">
            <p class="greeting">Hello <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>,</p>
            <p class="intro">Thank you for completing your mock interview with SahajJobs. We've analyzed your interview responses and prepared a personalized assessment highlighting your performance, strengths, opportunities for improvement, and recommended learning resources to help you perform even better in future interviews.</p>
            
            <!-- Score Card -->
            <div class="score-card">
                <div class="score-val"><?= $score; ?> <span style="font-size: 20px; font-weight: 500; color: #86efac;">/ 100</span></div>
                <div class="score-lbl">Overall Performance Score</div>
                <div style="font-size: 12px; color: #15803d; opacity: 0.85; margin-top: 6px; font-weight: 500; line-height: 1.4;">This score reflects your overall interview performance based on communication, response quality, clarity, confidence, and completeness.</div>
            </div>
            
            <!-- Summary -->
            <div class="summary-box">
                "<?= htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); ?>"
            </div>
            
            <!-- Feedback Highlights -->
            <div class="feedback-section">
                <h4 class="section-title" style="color: #16a34a;">✔ Your Strengths</h4>
                <div style="font-size: 14px; color: #475569; padding-left: 5px; white-space: pre-line;">
                    <?= htmlspecialchars($strengths, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>
            
            <div class="feedback-section">
                <h4 class="section-title" style="color: #dc2626;">⚠ Opportunities for Improvement</h4>
                <div style="font-size: 14px; color: #475569; padding-left: 5px; white-space: pre-line;">
                    <?= htmlspecialchars($weaknesses, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>

            <div class="feedback-section">
                <h4 class="section-title" style="color: #2563eb;">💡 Personalized Recommendations</h4>
                <div style="font-size: 14px; color: #475569; padding-left: 5px; white-space: pre-line;">
                    <?= $suggestions; ?>
                </div>
            </div>

            <?php if (!empty($recommended_resources)): ?>
            <div class="feedback-section" style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 25px;">
                <h4 class="section-title" style="color: #7c3aed; font-size: 16px; margin-bottom: 12px;">📚 Recommended Learning Resources</h4>
                <div style="font-size: 13.5px; color: #64748b; margin-bottom: 15px; line-height: 1.45;">Continue building your interview skills with these carefully selected resources. These guides and courses are recommended based on your interview performance and can help strengthen your communication, confidence, and overall interview readiness.</div>
                
                <?php foreach ($recommended_resources as $resource): ?>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                        <span style="display: inline-block; background: #FFF44F; border: 1px solid #eab308; color: #27365c; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 20px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <?= htmlspecialchars($resource['type'] ?? 'Documentation', ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                        <h5 style="margin: 0 0 4px 0; font-size: 14.5px; font-weight: 700; color: #1e293b;"><?= htmlspecialchars($resource['title'] ?? 'Learning Resource', ENT_QUOTES, 'UTF-8'); ?></h5>
                        <p style="margin: 0 0 12px 0; font-size: 13px; line-height: 1.5; color: #475569;"><?= htmlspecialchars($resource['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                        
                        <?php
                        $res_type = strtolower($resource['type'] ?? '');
                        $cta_text = 'Explore Guide →';
                        if (strpos($res_type, 'website') !== false || strpos($res_type, 'documentation') !== false || strpos($res_type, 'docs') !== false) {
                            $cta_text = 'Visit Website →';
                        } elseif (strpos($res_type, 'course') !== false || strpos($res_type, 'tutorial') !== false || strpos($res_type, 'video') !== false) {
                            $cta_text = 'Start Course →';
                        } elseif (strpos($res_type, 'article') !== false || strpos($res_type, 'blog') !== false) {
                            $cta_text = 'Read Article →';
                        }
                        ?>
                        <a href="<?= htmlspecialchars($resource['url'] ?? '#', ENT_QUOTES, 'UTF-8'); ?>" target="_blank" style="color: #2563eb; font-size: 13px; font-weight: 600; text-decoration: underline;">
                            <?= $cta_text; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <p style="margin-top:30px;">Best Wishes,</p>
        <p><strong>Team SahajJobs</strong></p>

        <div style="margin-top: 16px;">
            <img src="https://sahajjobs.com/./ALL_UPLOADS/images/SahajJOB2.png" 
            alt="SahajJobs Logo" width="140">
        </div>

        <!-- Footer -->
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
