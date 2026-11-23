<?php
$score = intval($session['overall_score']);

function getScoreColor($score)
{
    if ($score <= 25)
        return "#EF4444";
    if ($score <= 50)
        return "#F97316";
    if ($score <= 75)
        return "#EAB308";
    return "#22C55E";
}

$scoreColor = getScoreColor($score);

if ($score <= 25) {
    $cardBg = '#fef2f2';
    $cardBorder = '#fca5a5';
    $textColor = '#dc2626';
    $scoreLabel = 'Poor';
} elseif ($score <= 50) {
    $cardBg = '#fff7ed';
    $cardBorder = '#ffedd5';
    $textColor = '#ea580c';
    $scoreLabel = 'Average';
} elseif ($score <= 75) {
    $cardBg = '#fefce8';
    $cardBorder = '#fef08a';
    $textColor = '#ca8a04';
    $scoreLabel = 'Good';
} else {
    $cardBg = '#f0fdf4';
    $cardBorder = '#bbf7d0';
    $textColor = '#16a34a';
    $scoreLabel = 'Excellent';
}
?>
<div class="mock-interview-wrapper">
    <div class="result-glass-container">

        <!-- Fixed Header Title Section -->
        <div style="text-align: center; margin-bottom: 12px; flex-shrink: 0; position: relative;">
            <a href="<?= base_url('mock-interview'); ?>" class="dashboard-btn-wrapper">
                <i class="fas fa-chevron-left"></i> Go to Dashboard
            </a>

            <span
                style="background: rgba(34, 197, 94, 0.08); border: 1px solid rgba(34, 197, 94, 0.2); color: #16a34a; font-size: 12px; font-weight: 700; padding: 4px 14px; border-radius: 30px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 6px;">
                <i class="fas fa-check-circle"></i> Interview Completed
            </span>
            <h1 style="font-size: 26px; font-weight: 800; margin: 0 0 4px 0; color: #27365c;">Assessment Report</h1>
            <p style="color: #64748b; font-size: 14px; margin: 0;">Here is a comprehensive evaluation of your
                <?= htmlspecialchars($job_role, ENT_QUOTES, 'UTF-8'); ?>.
            </p>
        </div>

        <!-- Main Content Area: Stack of 3 rows -->
        <div class="results-content-area">

            <!-- ROW 1: Overall Score, Performance Scale, Interviewer's Summary -->
            <div class="row-1-grid">
                <!-- Score Card -->
                <div
                    style="background: <?= $cardBg; ?>; border: 1px solid <?= $cardBorder; ?>; border-radius: 16px; padding: 15px; text-align: center; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; transition: all 0.3s ease; box-sizing: border-box;">
                    <h3
                        style="margin: 0 0 8px 0; font-size: 13.5px; font-weight: 700; color: <?= $textColor; ?>; text-transform: uppercase; letter-spacing: 0.5px;">
                        Overall Score</h3>

                    <!-- Circular Score Meter -->
                    <div style="position: relative; width: 90px; height: 90px; margin-bottom: 8px;">
                        <svg viewBox="0 0 36 36" style="width: 100%; height: 100%; transform: rotate(-90deg);">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="rgba(0,0,0,0.03)" stroke-width="3.5" />
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                fill="none" stroke="<?= $textColor; ?>" stroke-dasharray="<?= $score; ?>, 100"
                                stroke-width="3.5" stroke-linecap="round"
                                style="transition: stroke-dasharray 1s ease-out;" />
                        </svg>
                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <span style="font-size: 24px; font-weight: 800; color: <?= $textColor; ?>; line-height: 1;">
                                <?= $score; ?>
                            </span>
                            <span
                                style="font-size: 10px; font-weight: 600; color: <?= $textColor; ?>; opacity: 0.8; margin-top: 1px;">/
                                100</span>
                        </div>
                    </div>

                    <div
                        style="font-size: 12.5px; font-weight: 700; color: <?= $textColor; ?>; text-transform: uppercase; letter-spacing: 1px;">
                        <?= $scoreLabel; ?>
                    </div>
                </div>

                <!-- Performance Scale Card -->
                <div
                    style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 15px 18px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; justify-content: center; height: 100%; box-sizing: border-box;">
                    <h4
                        style="margin: 0 0 10px 0; font-size: 13.5px; font-weight: 700; color: #27365c; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-chart-line" style="color: #ca8a04;"></i> Performance Scale
                    </h4>

                    <div style="display: flex; gap: 12px; align-items: stretch; flex: 1; min-height: 0;">
                        <!-- Labels (Left) aligned with the corresponding ranges -->
                        <div
                            style="display: flex; flex-direction: column; justify-content: space-between; min-width: 100px; box-sizing: border-box; padding: 2px 0; height: 100%;">
                            <div
                                style="display: flex; align-items: center; height: 25%; font-size: 10px; font-weight: 700; color: <?= ($score > 75) ? '#16a34a' : '#94a3b8'; ?>;">
                                <span>Excellent (76-100)</span>
                            </div>
                            <div
                                style="display: flex; align-items: center; height: 25%; font-size: 10px; font-weight: 700; color: <?= ($score > 50 && $score <= 75) ? '#ca8a04' : '#94a3b8'; ?>;">
                                <span>Good (51-75)</span>
                            </div>
                            <div
                                style="display: flex; align-items: center; height: 25%; font-size: 10px; font-weight: 700; color: <?= ($score > 25 && $score <= 50) ? '#ea580c' : '#94a3b8'; ?>;">
                                <span>Average (26-50)</span>
                            </div>
                            <div
                                style="display: flex; align-items: center; height: 25%; font-size: 10px; font-weight: 700; color: <?= ($score <= 25) ? '#dc2626' : '#94a3b8'; ?>;">
                                <span>Poor (0-25)</span>
                            </div>
                        </div>

                        <!-- Continuous Vertical Bar (Right) -->
                        <div
                            style="flex: 1; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; position: relative; overflow: hidden; box-shadow: inset 0 2px 4px rgba(0,0,0,0.03); box-sizing: border-box; height: 100%;">

                            <!-- SVG overlay drawing the pillars and score indicator -->
                            <svg width="100%" height="100%"
                                style="position: absolute; top: 0; left: 0; pointer-events: none;">
                                <!-- Grid lines -->
                                <line x1="0%" y1="75%" x2="100%" y2="75%" stroke="#e2e8f0" stroke-dasharray="3,3"
                                    stroke-width="1" />
                                <line x1="0%" y1="55%" x2="100%" y2="55%" stroke="#e2e8f0" stroke-dasharray="3,3"
                                    stroke-width="1" />
                                <line x1="0%" y1="35%" x2="100%" y2="35%" stroke="#e2e8f0" stroke-dasharray="3,3"
                                    stroke-width="1" />
                                <line x1="0%" y1="15%" x2="100%" y2="15%" stroke="#e2e8f0" stroke-dasharray="3,3"
                                    stroke-width="1" />

                                <!-- Pillars -->
                                <rect x="0%" y="75%" width="25%" height="25%" fill="#f77373ff" />
                                <rect x="25%" y="55%" width="25%" height="45%" fill="#f8c97cff" />
                                <rect x="50%" y="35%" width="25%" height="65%" fill="#ebde81ff" />
                                <rect x="75%" y="15%" width="25%" height="85%" fill="#84f5abff" />

                                <!-- Pillar Labels (Heights) -->
                                <text x="12.5%" y="72%" fill="#64748b" font-size="10" font-weight="800"
                                    text-anchor="middle">25%</text>
                                <text x="37.5%" y="52%" fill="#64748b" font-size="10" font-weight="800"
                                    text-anchor="middle">50%</text>
                                <text x="62.5%" y="32%" fill="#64748b" font-size="10" font-weight="800"
                                    text-anchor="middle">75%</text>
                                <text x="87.5%" y="12%" fill="#64748b" font-size="10" font-weight="800"
                                    text-anchor="middle">100%</text>

                                <?php
                                $y = 95 - ($score * 0.8);
                                if ($score <= 25) {
                                    $lineX1 = "0%";
                                    $lineX2 = "25%";
                                    $textX = "12.5%";
                                } elseif ($score <= 50) {
                                    $lineX1 = "25%";
                                    $lineX2 = "50%";
                                    $textX = "37.5%";
                                } elseif ($score <= 75) {
                                    $lineX1 = "50%";
                                    $lineX2 = "75%";
                                    $textX = "62.5%";
                                } else {
                                    $lineX1 = "75%";
                                    $lineX2 = "100%";
                                    $textX = "87.5%";
                                }
                                ?>

                                <!-- White backing line for contrast (reduced to 6px) -->
                                <line x1="<?= $lineX1; ?>" y1="<?= $y; ?>%" x2="<?= $lineX2; ?>" y2="<?= $y; ?>%"
                                    stroke="#ffffff" stroke-width="6" stroke-linecap="round" />
                                <!-- Dynamic horizontal indicator line based on score range -->
                                <line x1="<?= $lineX1; ?>" y1="<?= $y; ?>%" x2="<?= $lineX2; ?>" y2="<?= $y; ?>%"
                                    stroke="<?= $scoreColor; ?>" stroke-width="3.5" stroke-linecap="round" />

                                <!-- End point marker circle (reduced to 5.5px) -->
                                <circle cx="<?= $lineX2; ?>" cy="<?= $y; ?>%" r="5.5" fill="<?= $scoreColor; ?>"
                                    stroke="#ffffff" stroke-width="2" />

                                <!-- Label indicating score percent -->
                                <text x="<?= $textX; ?>" y="<?= ($score < 14) ? ($y - 3) : ($y + 9.5); ?>%" fill="<?= $scoreColor; ?>" font-size="11"
                                    font-weight="800" text-anchor="middle">
                                    <?= $score; ?>%
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Interviewer's Summary Card -->
                <div
                    style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; justify-content: space-between; height: 100%; box-sizing: border-box; overflow: hidden;">
                    <div style="flex: 1; display: flex; flex-direction: column; min-height: 0; margin-bottom: 8px;">
                        <h3
                            style="margin: 0 0 4px 0; font-size: 13.5px; font-weight: 700; color: #27365c; flex-shrink: 0;">
                            Interviewer's Summary</h3>
                        <div style="margin: 0; color: #475569; font-size: 12.5px; line-height: 1.4; font-style: italic; overflow-y: auto; flex: 1; padding-right: 2px;"
                            class="scrollable-content">
                            "
                            <?= htmlspecialchars($session['summary'], ENT_QUOTES, 'UTF-8'); ?>"
                        </div>
                    </div>

                    <div style="flex: 1; display: flex; flex-direction: column; min-height: 0;">
                        <h3
                            style="margin: 0 0 4px 0; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; flex-shrink: 0;">
                            General Feedback</h3>
                        <div style="margin: 0; color: #475569; font-size: 12.5px; line-height: 1.4; overflow-y: auto; flex: 1; padding-right: 2px;"
                            class="scrollable-content">
                            <?= htmlspecialchars($session['feedback'], ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: Key Strengths, Areas for Growth, How to Improve -->
            <div class="row-2-grid">
                <!-- Key Strengths (Green Theme) -->
                <div
                    style="background: rgba(34, 197, 94, 0.04); border: 1px solid rgba(34, 197, 94, 0.15); border-radius: 16px; padding: 18px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; height: auto; box-sizing: border-box; overflow: hidden;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-shrink: 0;">
                        <div
                            style="background: rgba(34, 197, 94, 0.08); padding: 5px; border-radius: 6px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-thumbs-up" style="color: #16a34a; font-size: 12px;"></i>
                        </div>
                        <h4 style="margin: 0; font-size: 13.5px; font-weight: 700; color: #16a34a;">Key Strengths</h4>
                    </div>
                    <div class="scrollable-content"
                        style="font-size: 12.5px; line-height: 1.45; color: #475569; padding-right: 2px; flex: 1;">
                        <?= htmlspecialchars($session['strengths'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <!-- Areas for Growth (Red Theme) -->
                <div
                    style="background: rgba(239, 68, 68, 0.04); border: 1px solid rgba(239, 68, 68, 0.15); border-radius: 16px; padding: 18px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; height: auto; box-sizing: border-box; overflow: hidden;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-shrink: 0;">
                        <div
                            style="background: rgba(239, 68, 68, 0.08); padding: 5px; border-radius: 6px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exclamation-triangle" style="color: #dc2626; font-size: 12px;"></i>
                        </div>
                        <h4 style="margin: 0; font-size: 13.5px; font-weight: 700; color: #dc2626;">Areas for Growth
                        </h4>
                    </div>
                    <div class="scrollable-content"
                        style="font-size: 12.5px; line-height: 1.45; color: #475569; padding-right: 2px; flex: 1;">
                        <?= htmlspecialchars($session['weaknesses'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <!-- How to Improve (Blue Theme) -->
                <div
                    style="background: rgba(59, 130, 246, 0.04); border: 1px solid rgba(59, 130, 246, 0.15); border-radius: 16px; padding: 18px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; height: auto; box-sizing: border-box; overflow: hidden;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; flex-shrink: 0;">
                        <div
                            style="background: rgba(59, 130, 246, 0.08); padding: 5px; border-radius: 6px; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-lightbulb" style="color: #2563eb; font-size: 12px;"></i>
                        </div>
                        <h4 style="margin: 0; font-size: 13.5px; font-weight: 700; color: #2563eb;">How to Improve</h4>
                    </div>
                    <div class="scrollable-content"
                        style="font-size: 12.5px; line-height: 1.45; color: #475569; padding-right: 2px; flex: 1;">
                        <?= $session['improvement_suggestions']; ?>
                    </div>
                </div>
            </div>

            <!-- ROW 3: Recommended Resources & Interview Transcript -->
            <div class="row-3-grid">
                <!-- Learning Resources Card -->
                <div
                    style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; height: 100%; box-sizing: border-box; overflow: hidden;">
                    <h4
                        style="margin: 0 0 4px 0; font-size: 14px; font-weight: 700; color: #27365c; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-book-reader" style="color: #7c3aed;"></i> Recommended Resources
                    </h4>
                    <p style="color: #64748b; font-size: 11px; margin: 0 0 10px 0; flex-shrink: 0;">Dynamic links
                        curated for your weak areas:</p>

                    <div class="scrollable-content"
                        style="padding-right: 4px; display: flex; flex-direction: column; gap: 8px; flex: 1;">
                        <?php if (!empty($recommended_resources)): ?>
                            <?php foreach ($recommended_resources as $resource): ?>
                                <div
                                    style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 12px; display: flex; align-items: center; justify-content: space-between; gap: 10px; transition: all 0.2s;">
                                    <div style="overflow: hidden; flex: 1;">
                                        <div style="font-size: 12px; font-weight: 700; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                            title="<?= htmlspecialchars($resource['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                            <?= htmlspecialchars($resource['title'] ?? 'Study Guide', ENT_QUOTES, 'UTF-8'); ?>
                                        </div>
                                        <span
                                            style="font-size: 9px; color: #7c3aed; font-weight: 800; text-transform: uppercase; letter-spacing: 0.3px;">
                                            <?= htmlspecialchars($resource['type'] ?? 'Tutorial', ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                    </div>
                                    <a href="<?= htmlspecialchars($resource['url'] ?? '#', ENT_QUOTES, 'UTF-8'); ?>"
                                        target="_blank"
                                        style="background: #FFF44F; color: #27365c; text-decoration: none; border-radius: 6px; padding: 5px 10px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.03);">
                                        <span>Open</span> <i class="fas fa-external-link-alt" style="font-size: 8px;"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="font-size: 12px; color: #64748b; text-align: center; padding: 15px;">
                                No resource links generated. Use general recommendations instead.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Interview Transcript Card -->
                <div
                    style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; height: 100%; box-sizing: border-box; overflow: hidden;">
                    <h4
                        style="margin: 0 0 10px 0; font-size: 14px; font-weight: 700; color: #27365c; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-clipboard-list" style="color: #ca8a04;"></i> Interview Transcript
                    </h4>

                    <div class="scrollable-content"
                        style="padding-right: 4px; display: flex; flex-direction: column; gap: 12px; flex: 1;">
                        <?php foreach ($questions as $q): ?>
                            <div style="border-left: 3px solid #cbd5e1; padding-left: 10px; margin-bottom: 4px;">
                                <div
                                    style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #ca8a04; letter-spacing: 0.5px; margin-bottom: 2px;">
                                    Interviewer (Q
                                    <?= $q['question_order']; ?>)
                                </div>
                                <div
                                    style="font-size: 12.5px; color: #1e293b; line-height: 1.4; margin-bottom: 4px; font-weight: 600;">
                                    <?= htmlspecialchars($q['question_text'], ENT_QUOTES, 'UTF-8'); ?>
                                </div>
                                <div
                                    style="font-size: 11px; font-weight: 800; text-transform: uppercase; color: #7c3aed; letter-spacing: 0.5px; margin-bottom: 2px;">
                                    <?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?> <span
                                        style="font-size: 9px; color: #64748b; font-weight: 500; text-transform: lowercase;">(via
                                        <?= htmlspecialchars($q['answer_format'], ENT_QUOTES, 'UTF-8'); ?>)
                                    </span>
                                </div>
                                <div style="font-size: 12.5px; color: #475569; line-height: 1.4; font-style: italic;">
                                    "
                                    <?= htmlspecialchars($q['candidate_response'] ?: '(No response provided)', ENT_QUOTES, 'UTF-8'); ?>"
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>
<!-- Bottom Action Bar (Fixed) -->
<div class="bottom-action-bar">
    <a href="<?= base_url('candidate_job_search'); ?>"
        style="background: #FFF44F; border: none; border-radius: 30px; color: #27365c; font-size: 16px; font-weight: 700; padding: 10px 24px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06); transition: all 0.2s;"
        onmouseover="this.style.background='#04D9FF'; this.style.transform='translateY(-1px)';"
        onmouseout="this.style.background='#FFD900'; this.style.transform='none';">
        <span>Back to Job Search</span>
        <!-- <i class="fas fa-arrow-right"></i> -->
    </a>

    <a href="<?= base_url('mock-interview'); ?>"
        style="background: #FFF44F; border: 1px solid #cbd5e1; border-radius: 30px; color: #475569; font-size: 16px; font-weight: 700; padding: 10px 24px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;"
        onmouseover="this.style.background='#04D9FF';" onmouseout="this.style.background='#FFD900';">
        <i class="fas fa-redo"></i> Try Again
    </a>
</div>
<style>
    .bottom-action-bar {
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-shrink: 0;
        padding-bottom: 15px;

        /* match .result-glass-container sizing */
        max-width: 1475px;
        width: 100%;
        margin: 0 auto;
        box-sizing: border-box;
        padding-left: 15px;
        padding-right: 15px;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Custom Scrollbar Styles for the list cards */
    .scrollable-content::-webkit-scrollbar {
        width: 5px;
    }

    .scrollable-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollable-content::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .scrollable-content::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Default / Mobile & Tablet view styles */
    .mock-interview-wrapper {
        background: #ffffff;
        min-height: calc(100vh - 70px);
        padding: 20px 15px;
        font-family: 'Nunito', sans-serif;
        color: #333;
        box-sizing: border-box;
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    .result-glass-container {
        max-width: 1450px;
        width: 100%;
        background: #f3f4f6;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
        animation: slideUp 0.6s ease-out;
    }

    .dashboard-btn-wrapper {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 30px;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        padding: 8px 18px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        margin-bottom: 12px;
    }

    .dashboard-btn-wrapper:hover {
        background: #f1f5f9;
    }

    .results-content-area {
        display: flex;
        flex-direction: column;
        gap: 15px;
        box-sizing: border-box;
    }

    .row-1-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .row-2-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .row-3-grid {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .scrollable-content {
        max-height: 250px;
        overflow-y: auto;
    }

    /* Desktop view overrides.
   Uses the same 3/3/2-column grid as before, but no longer forces an exact
   viewport height with overflow:hidden. That combination clipped content
   (score circle, transcript, etc. getting cut off) whenever the browser
   window/screen was shorter than the content needed. Instead we let the
   whole page scroll naturally when content is taller than the viewport,
   and each card grows to fit its content (min-height instead of a hard
   ceiling), while still using its own internal scrollbar for very long
   text so cards don't grow unbounded. */
    @media (min-width: 993px) {
        .mock-interview-wrapper {
            min-height: calc(100vh - 70px);
            height: auto;
            overflow: visible;
            padding: 15px;
            align-items: flex-start;
        }

        .result-glass-container {
            min-height: calc(100vh - 100px);
            height: auto;
            overflow: visible;
            padding: 20px 30px;
        }

        .dashboard-btn-wrapper {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            margin-bottom: 0;
        }

        .results-content-area {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .row-1-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr 1.3fr;
            gap: 15px;
            align-items: stretch;
        }

        .row-2-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .row-3-grid {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 15px;
            align-items: stretch;
        }

        .scrollable-content {
            max-height: 220px;
            overflow-y: auto;
        }
    }

    /* Extra-tall desktop screens: let cards use more of the available height
   and cap internal scroll areas a bit higher so less scrolling is needed
   inside individual cards. */
    @media (min-width: 993px) and (min-height: 850px) {
        .scrollable-content {
            max-height: 320px;
        }
    }
</style>