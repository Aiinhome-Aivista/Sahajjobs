<?php
// Filter completed sessions that have a valid overall_score
$completed_sessions = [];
if (!empty($session_history)) {
    foreach ($session_history as $session) {
        if (isset($session['overall_score']) && is_numeric($session['overall_score'])) {
            $completed_sessions[] = [
                'score' => floatval($session['overall_score']),
                'date' => date('d M', strtotime($session['created_at'] ?? $session['completed_at'] ?? ''))
            ];
        }
    }
}
$completed_count = count($completed_sessions);
$latest_5_chronological = array_reverse(array_slice($completed_sessions, 0, 5));
?>
<div class="mock-interview-wrapper">
    <div class="glass-container">
        <div class="history-btn-row">
            <button type="button" onclick="openHistoryModal()" class="history-btn">
                <i class="fas fa-history" style="font-size: 24px; color: #a855f7;"></i>
                <span class="history-btn-label">History</span>
            </button>
        </div>
        <!-- Header -->
        <div class="mi-header">
            <div class="mi-header-icon">
                <i class="fas fa-user-tie" style="font-size: 32px; color: #fff;"></i>
            </div>
            <h1 class="mi-title">Mock Interview</h1>
            <p class="mi-subtitle">
                Ace your technical and soft-skill interviews with real-time practice, interactive mock questions,
                and instant evaluation.
            </p>
        </div>

        <!-- Rules & Highlights -->
        <div class="stat-cards-grid">
            <!-- Card 1 -->
            <div class="stat-card">
                <div class="stat-icon-wrap" style="background: rgba(234, 179, 8, 0.08);">
                    <i class="fas fa-clock" style="color: #ca8a04; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 class="stat-title">2 Min Duration</h4>
                    <p class="stat-desc">Short and focused session</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="stat-card">
                <div class="stat-icon-wrap" style="background: rgba(168, 85, 247, 0.08);">
                    <i class="fas fa-award" style="color: #7c3aed; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 class="stat-title">Instant Assessment</h4>
                    <p class="stat-desc">Score & structured feedback</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="stat-card">
                <div class="stat-icon-wrap" style="background: rgba(34, 197, 94, 0.08);">
                    <i class="fas fa-envelope-open-text" style="color: #16a34a; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 class="stat-title">Email Delivery</h4>
                    <p class="stat-desc">Results sent to your inbox</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="stat-card">
                <div class="stat-icon-wrap" style="background: rgba(234, 179, 8, 0.08);">
                    <i class="fas fa-cubes" style="color: #d97706; font-size: 18px;"></i>
                </div>
                <div>
                    <h4 class="stat-title">Multiple Tracks</h4>
                    <p class="stat-desc">Soft & Technical options</p>
                </div>
            </div>
        </div>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mi-error-banner">
                <i class="fas fa-exclamation-circle" style="color: #ef4444; font-size: 15px;"></i>
                <span><?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
        <?php endif; ?>

        <!-- Mode & Interview Type Selection Form -->
        <form action="<?= base_url('mock-interview/start'); ?>" method="POST" id="startForm" class="mi-form">
            <input type="hidden" name="mode" id="selectedMode" value="hybrid">
            <input type="hidden" name="interview_type" id="selectedInterviewType" value="">

            <div class="mi-select-section">
                <h3 class="mi-section-title">Select Interview Type</h3>

                <div class="type-select-grid">
                    <!-- Soft Skill Interview Card (Unselected by default) -->
                    <div class="interview-card" id="softSkillCard" onclick="selectInterviewType('soft_skill')">
                        <div class="interview-icon-wrap" style="background: rgba(234, 179, 8, 0.1);">
                            <i class="fas fa-user-tie" style="font-size: 24px; color: #ca8a04;"></i>
                        </div>
                        <h4 class="interview-card-title">Soft Skill Interview</h4>
                        <p class="interview-card-desc">Evaluate communication, behavioral questions, adaptability, and
                            emotional intelligence.</p>
                    </div>

                    <!-- Technical Interview Card (Unselected by default) -->
                    <div class="interview-card" id="technicalCard" onclick="selectInterviewType('technical')">
                        <div class="interview-icon-wrap" style="background: rgba(168, 85, 247, 0.1);">
                            <i class="fas fa-code" style="font-size: 24px; color: #7c3aed;"></i>
                        </div>
                        <h4 class="interview-card-title">Technical Interview</h4>
                        <p class="interview-card-desc">Evaluate coding principles, data structures, algorithms, and
                            technical project experience.</p>
                    </div>
                </div>
            </div>

            <div class="hybrid-info-box">
                <h3 class="mi-section-title" style="margin-bottom: 8px;">Interactive Hybrid Interface</h3>
                <p class="hybrid-info-text">
                    During the interview, you can type your answers or use the microphone to speak. Click the speaker
                    icon next to
                    any question to listen to it read aloud.
                </p>

                <div class="hybrid-pill-row">
                    <span class="hybrid-pill"
                        style="background: rgba(234, 179, 8, 0.06); border: 1px solid rgba(234, 179, 8, 0.2); color: #ca8a04;">
                        <i class="fas fa-keyboard"></i> Text Input
                    </span>
                    <span class="hybrid-pill"
                        style="background: rgba(168, 85, 247, 0.06); border: 1px solid rgba(168, 85, 247, 0.2); color: #7c3aed;">
                        <i class="fas fa-microphone"></i> Voice Input
                    </span>
                    <span class="hybrid-pill"
                        style="background: rgba(34, 197, 94, 0.06); border: 1px solid rgba(34, 197, 94, 0.2); color: #16a34a;">
                        <i class="fas fa-volume-up"></i> Read Aloud
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== Wrapper & background ===== */
    .mock-interview-wrapper {
        width: 100%;
        min-height: calc(100vh - 70px);
        background: url("<?= base_url('./ALL_UPLOADS/images/SahajProfile2.jpeg'); ?>") center/cover no-repeat;
        background-attachment: scroll;
        position: relative;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        font-family: 'Nunito', sans-serif;
    }

    /* ===== Glass container ===== */
    .glass-container {
        backdrop-filter: blur(34px);
        -webkit-backdrop-filter: blur(34px);
        background: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.35);
        z-index: 0;
        border-radius: 20px;
        max-width: 1050px;
        width: 100%;
        padding: 30px;
        box-sizing: border-box;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        color: #333;
        animation: fadeIn 0.8s ease-out;
    }

    /* ===== History button ===== */
    .history-btn-row {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        margin-bottom: 12px;
    }

    .history-btn {
        display: flex;
        align-items: center;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .history-btn-label {
        margin-left: 8px;
        font-weight: 700;
        color: #475569;
        font-size: 14px;
        font-family: 'Nunito', sans-serif;
    }

    /* ===== Header ===== */
    .mi-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .mi-header-icon {
        display: inline-block;
        background: linear-gradient(135deg, #27365c 0%, #ffd500 100%);
        border-radius: 50%;
        padding: 12px;
        margin-bottom: 12px;
        box-shadow: 0 4px 15px rgba(39, 54, 92, 0.25);
    }

    .mi-title {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 5px 0;
        color: #27365c;
    }

    .mi-subtitle {
        color: #555;
        font-size: 16px;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.5;
    }

    /* ===== Stat cards ===== */
    .stat-cards-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #ffffff99;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    .stat-icon-wrap {
        border-radius: 8px;
        padding: 10px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-title {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        color: #27365c;
    }

    .stat-desc {
        margin: 2px 0 0 0;
        font-size: 11.5px;
        color: #64748b;
    }

    /* ===== Error banner ===== */
    .mi-error-banner {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        color: #b91c1c;
        padding: 10px 15px;
        border-radius: 12px;
        margin-bottom: 15px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== Form / selection section ===== */
    .mi-form {
        margin: 0;
    }

    .mi-select-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .mi-section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #27365c;
    }

    .type-select-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
    }

    .interview-card {
        background: #ffffff99;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .interview-icon-wrap {
        display: inline-block;
        border-radius: 50%;
        padding: 10px;
        margin-bottom: 10px;
    }

    .interview-card-title {
        margin: 0 0 5px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }

    .interview-card-desc {
        margin: 0;
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
    }

    .interview-card:hover {
        transform: translateY(-4px);
        background: rgba(255, 255, 255, 0.75) ;
        border-color: rgba(155, 200, 255, 0.7);
    }

    .interview-card.active {
        border-color: #FFF44F !important;
        background: rgba(255, 244, 79, 0.04) !important;
        box-shadow: 0 4px 15px rgba(255, 244, 79, 0.15) !important;
    }

    /* ===== Hybrid info box ===== */
    .hybrid-info-box {
        text-align: center;
        margin-bottom: 0;
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(0, 0, 0, 0.08);
        padding: 15px 20px;
        border-radius: 12px;
    }

    .hybrid-info-text {
        color: #555;
        font-size: 13px;
        line-height: 1.5;
        margin: 0 auto;
        max-width: 650px;
    }

    .hybrid-pill-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-top: 12px;
        flex-wrap: wrap;
    }

    .hybrid-pill {
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* ===== History modal stat cards (kept as-is, unaffected) ===== */

    /* =========================================================
   RESPONSIVE BREAKPOINTS
   ========================================================= */
    @media (max-width: 900px) {
        .stat-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .glass-container {
            padding: 22px;
        }
    }

    @media (max-width: 600px) {
        .mock-interview-wrapper {
            padding: 12px;
            min-height: auto;
        }

        .glass-container {
            padding: 16px;
            border-radius: 16px;
        }

        .stat-cards-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .type-select-grid {
            grid-template-columns: 1fr;
        }

        .mi-title {
            font-size: 24px;
        }

        .mi-subtitle {
            font-size: 14px;
        }

        .mi-header-icon i {
            font-size: 26px !important;
        }

        .hybrid-pill-row {
            gap: 8px;
        }

        .hybrid-pill {
            font-size: 11px;
            padding: 4px 10px;
        }
    }
</style>

<!-- Custom Modal for History -->
<div id="historyModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); align-items: center; justify-content: center; z-index: 1000; overflow: hidden;">
    <div id="historyModalContent" class="history-modal-content">
        <button type="button" onclick="closeHistoryModal()" class="history-modal-close">
            <i class="fas fa-times"></i>
        </button>
        <button type="button" onclick="openProgressReport()" class="progress-report-btn">
            <i class="fas fa-chart-line" style="color: #ca8a04;"></i> Progress Report
        </button>
        <div class="history-modal-header">
            <div class="history-modal-header-icon">
                <i class="fas fa-clock" style="font-size: 22px; color: #ca8a04;"></i>
            </div>
            <div>
                <h2 class="history-modal-title">Interview History</h2>
                <p class="history-modal-subtitle">Review your completed mock interviews and access question/answer
                    details.</p>
            </div>
        </div>

        <?php if (!empty($session_history)): ?>
            <div class="history-summary-grid">
                <div class="history-summary-card" style="border-color: #fef08a;">
                    <div class="history-summary-label">Total Interviews</div>
                    <div class="history-summary-value" style="color: #1e293b;"><?= $history_total; ?></div>
                </div>
                <div class="history-summary-card" style="border-color: #fef08a;">
                    <div class="history-summary-label">Average Score</div>
                    <div class="history-summary-value" style="color: #ca8a04;">
                        <?= number_format($history_average_score, 1); ?></div>
                </div>
                <div class="history-summary-card" style="border-color: #cfe8ff;">
                    <div class="history-summary-label">Best Score</div>
                    <div class="history-summary-value" style="color: #16a34a;"><?= number_format($history_best_score, 1); ?>
                    </div>
                </div>
                <div class="history-summary-card" style="border-color: #fef08a;">
                    <div class="history-summary-label">Last Interview</div>
                    <div class="history-summary-date">
                        <?= $history_last_interview_date ? date('d M Y, H:i A', strtotime($history_last_interview_date)) : 'N/A'; ?>
                    </div>
                </div>
            </div>

            <div class="history-sessions-grid">
                <?php
                $modal_sessions = array_slice($session_history, 0, 8);
                foreach ($modal_sessions as $session):
                    ?>
                    <div class="history-card">
                        <div>
                            <span class="history-tag"
                                style="background: <?= ($session['job_role'] === 'Technical Interview') ? 'rgba(168, 85, 247, 0.08)' : 'rgba(234, 179, 8, 0.08)'; ?>; border: 1px solid <?= ($session['job_role'] === 'Technical Interview') ? 'rgba(168, 85, 247, 0.2)' : 'rgba(234, 179, 8, 0.2)'; ?>; color: <?= ($session['job_role'] === 'Technical Interview') ? '#7c3aed' : '#ca8a04'; ?>;">
                                <?= htmlspecialchars($session['job_role'] ?? 'Interview', ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                            <div class="history-card-date"><?= date('d M Y, H:i A', strtotime($session['created_at'])); ?></div>
                            <div class="history-card-score">Overall Score: <span
                                    style="font-weight: 800; color: #1e293b;"><?= isset($session['overall_score']) && is_numeric($session['overall_score']) ? number_format($session['overall_score'], 1) : 'N/A'; ?></span>
                            </div>
                        </div>
                        <div>
                            <a href="<?= base_url('mock-interview/result/' . $session['id']); ?>" class="history-view-btn"
                                onmouseover="this.style.background='#ffd500';" onmouseout="this.style.background='#FFF44F';">
                                <i class="fas fa-eye" style="font-size: 11px;"></i>
                                View Q&A
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- View More Button -->
            <?php if (count($session_history) > 8): ?>
                <div class="history-view-more-row">
                    <a href="<?= base_url('mock-interview/history'); ?>" class="history-view-more-btn"
                        onmouseover="this.style.background='#ffd500';" onmouseout="this.style.background='#FFF44F';">
                        <span>View More</span> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="history-empty-box">
                <h3 class="history-empty-title">No mock interview history found.</h3>
                <p class="history-empty-desc">Complete your first mock interview to see your results here.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .history-modal-content {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 22px;
        max-width: 960px;
        width: 95%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 30px;
        position: relative;
        box-sizing: border-box;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.18);
    }

    .history-modal-close {
        position: absolute;
        top: 18px;
        right: 18px;
        background: transparent;
        border: none;
        color: #475569;
        cursor: pointer;
        font-size: 20px;
        z-index: 10;
    }

    .history-modal-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .history-modal-header-icon {
        background: rgba(234, 179, 8, 0.12);
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .history-modal-title {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
    }

    .history-modal-subtitle {
        margin: 4px 0 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .history-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .history-summary-card {
        background: #f8fafc;
        border: 1px solid;
        border-radius: 12px;
        padding: 12px 15px;
    }

    .history-summary-label {
        font-size: 11px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 4px;
        font-weight: 700;
    }

    .history-summary-value {
        font-size: 20px;
        font-weight: 800;
    }

    .history-summary-date {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.3;
    }

    .history-sessions-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .history-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        transition: all 0.2s;
    }

    .history-tag {
        display: inline-block;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 20px;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .history-card-date {
        font-size: 14px;
        font-weight: 800;
        color: #27365c;
        margin-bottom: 4px;
    }

    .history-card-score {
        font-size: 12.5px;
        color: #64748b;
    }

    .history-view-btn {
        background: #FFF44F;
        color: #27365c;
        text-decoration: none;
        border-radius: 30px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .history-view-more-row {
        text-align: center;
        margin-top: 20px;
    }

    .history-view-more-btn {
        background: #FFF44F;
        color: #27365c;
        text-decoration: none;
        border-radius: 30px;
        padding: 10px 30px;
        font-size: 13.5px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }

    .history-empty-box {
        background: #fefce8;
        border: 1px solid #fef08a;
        border-radius: 18px;
        padding: 30px;
        text-align: center;
    }

    .history-empty-title {
        margin: 0 0 12px 0;
        font-size: 22px;
        font-weight: 800;
        color: #854d0e;
    }

    .history-empty-desc {
        margin: 0;
        color: #475569;
        font-size: 15px;
        line-height: 1.75;
    }

    @media (max-width: 700px) {
        .history-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .history-sessions-grid {
            grid-template-columns: 1fr;
        }

        .history-modal-content {
            padding: 20px;
            width: 92%;
        }

        .history-modal-title {
            font-size: 20px;
        }
    }

    @media (max-width: 420px) {
        .history-summary-grid {
            grid-template-columns: 1fr;
        }

        .history-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .history-view-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Custom Modal for CV & Skills requirement -->
<div id="cvRequirementModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); align-items: center; justify-content: center; z-index: 1000; transition: all 0.3s ease;">
    <div class="cv-modal-content" id="cvRequirementContent">
        <div class="cv-modal-icon-wrap">
            <i class="fas fa-exclamation-triangle" style="color: #d97706; font-size: 24px;"></i>
        </div>
        <h3 class="cv-modal-title">CV & Skills Required</h3>
        <p class="cv-modal-desc">You must upload your CV or add skills to your profile in the Profile section to take a
            Technical Interview.</p>
        <div class="cv-modal-actions">
            <button type="button" onclick="closeCvModal()" class="cv-modal-cancel-btn"
                onmouseover="this.style.background='#e2e8f0'"
                onmouseout="this.style.background='#f1f5f9'">Cancel</button>
            <a href="<?= $profile_url; ?>" class="cv-modal-profile-btn" onmouseover="this.style.background='#ffd500';"
                onmouseout="this.style.background='#FFF44F';">Go to Profile <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>

<style>
    .cv-modal-content {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 20px;
        max-width: 450px;
        width: 90%;
        padding: 30px;
        text-align: center;
        box-sizing: border-box;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .cv-modal-icon-wrap {
        background: rgba(245, 158, 11, 0.1);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
        border: 1px solid rgba(245, 158, 11, 0.3);
        box-shadow: 0 0 15px rgba(245, 158, 11, 0.1);
    }

    .cv-modal-title {
        margin: 0 0 10px 0;
        color: #1e293b;
        font-size: 20px;
        font-weight: 700;
        font-family: 'Nunito', sans-serif;
    }

    .cv-modal-desc {
        margin: 0 0 25px 0;
        color: #64748b;
        font-size: 14.5px;
        line-height: 1.6;
        font-family: 'Nunito', sans-serif;
    }

    .cv-modal-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cv-modal-cancel-btn {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 30px;
        color: #475569;
        font-weight: 600;
        padding: 10px 24px;
        cursor: pointer;
        font-size: 14px;
        font-family: 'Nunito', sans-serif;
        transition: all 0.2s;
    }

    .cv-modal-profile-btn {
        background: #FFF44F;
        border: none;
        border-radius: 30px;
        color: #27365c;
        font-weight: 700;
        padding: 10px 24px;
        text-decoration: none;
        font-size: 14px;
        font-family: 'Nunito', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.2s;
    }

    @media (max-width: 420px) {
        .cv-modal-content {
            padding: 22px;
        }

        .cv-modal-actions {
            flex-direction: column;
        }

        .cv-modal-cancel-btn,
        .cv-modal-profile-btn {
            width: 100%;
            justify-content: center;
        }
    }

    .progress-report-btn {
        position: absolute;
        top: 14px;
        right: 54px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 20px;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        padding: 6px 16px;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10;
        font-family: 'Nunito', sans-serif;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .progress-report-btn:hover {
        background: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
    }

    /* Modal chart animations */
    @keyframes drawPath {
        from { stroke-dashoffset: 1000; }
        to { stroke-dashoffset: 0; }
    }
    @keyframes fadeInArea {
        from { opacity: 0; }
        to { opacity: 0.15; }
    }
    @keyframes popCircle {
        from { r: 0; opacity: 0; }
        to { r: 5.5; opacity: 1; }
    }

    .chart-trend-path {
        stroke-dasharray: 1000;
        stroke-dashoffset: 1000;
        animation: drawPath 1.5s ease-out forwards;
    }

    .chart-area-path {
        animation: fadeInArea 1s ease-out forwards;
        animation-delay: 1s;
    }

    .chart-circle-point {
        opacity: 0;
        animation: popCircle 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }
    .chart-circle-point:nth-of-type(1) { animation-delay: 0.3s; }
    .chart-circle-point:nth-of-type(2) { animation-delay: 0.5s; }
    .chart-circle-point:nth-of-type(3) { animation-delay: 0.7s; }
    .chart-circle-point:nth-of-type(4) { animation-delay: 0.9s; }
    .chart-circle-point:nth-of-type(5) { animation-delay: 1.1s; }

    @media (max-width: 600px) {
        .progress-report-btn {
            position: static;
            margin: 10px 0;
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Warning Modal for less than 5 interviews -->
<div id="progressAlertModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); align-items: center; justify-content: center; z-index: 1100; overflow: hidden;">
    <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 20px; max-width: 450px; width: 90%; padding: 25px; box-sizing: border-box; box-shadow: 0 20px 50px rgba(0,0,0,0.15); text-align: center; transform: translateY(20px); transition: transform 0.2s;" id="progressAlertContent">
        <div style="background: rgba(234, 179, 8, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px auto;">
            <i class="fas fa-chart-line" style="font-size: 26px; color: #ca8a04;"></i>
        </div>
        <h3 style="font-size: 18px; font-weight: 800; color: #27365c; margin: 0 0 10px 0;">Progress Report</h3>
        <p style="color: #475569; font-size: 14px; line-height: 1.5; margin: 0 0 20px 0;">Progress Report is available after completing at least 5 interviews. Please complete 5 interviews to view your performance trend.</p>
        <button type="button" onclick="closeProgressAlert()" style="background: #FFF44F; border: none; border-radius: 20px; color: #27365c; font-size: 14px; font-weight: 700; padding: 10px 30px; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#ffd500';" onmouseout="this.style.background='#FFF44F';">OK</button>
    </div>
</div>

<!-- Graph Modal for 5 or more interviews -->
<div id="progressReportModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); align-items: center; justify-content: center; z-index: 1100; overflow: hidden;">
    <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 22px; max-width: 650px; width: 95%; padding: 30px; box-sizing: border-box; box-shadow: 0 24px 60px rgba(0, 0, 0, 0.18); position: relative; transform: translateY(20px); transition: transform 0.2s;" id="progressReportContent">
        <button type="button" onclick="closeProgressReport()" style="position: absolute; top: 18px; right: 18px; background: transparent; border: none; color: #475569; cursor: pointer; font-size: 20px; z-index: 10;">
            <i class="fas fa-times"></i>
        </button>
        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px;">
            <div style="background: rgba(34, 197, 94, 0.1); width: 50px; height: 50px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fas fa-chart-line" style="font-size: 22px; color: #16a34a;"></i>
            </div>
            <div>
                <h2 style="margin: 0; font-size: 22px; font-weight: 800; color: #1e293b;">Performance Score Of Latest 5</h2>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13.5px;">Visualizing your overall score trend across the last 5 completed Interviews.</p>
            </div>
        </div>

        <!-- Graph Container -->
        <div style="border: 1px solid #e2e8f0; border-radius: 16px; padding: 15px; background: #f8fafc; position: relative;">
            <?php
            if (!function_exists('getScoreColor')) {
                function getScoreColor($score) {
                    if ($score <= 25) return "#EF4444";
                    if ($score <= 50) return "#F97316";
                    if ($score <= 75) return "#EAB308";
                    return "#22C55E";
                }
            }
            if (!function_exists('getPerformanceLevel')) {
                function getPerformanceLevel($score) {
                    if ($score <= 25) return "Poor";
                    if ($score <= 50) return "Average";
                    if ($score <= 75) return "Good";
                    return "Excellent";
                }
            }
            $line_color = '#22c55e';
            if ($completed_count >= 5) {
                $latest_score = $latest_5_chronological[4]['score'];
                $line_color = getScoreColor($latest_score);
            }
            ?>
            <svg viewBox="0 0 500 220" width="100%" height="100%" style="overflow: visible;">
                <defs>
                    <linearGradient id="chart-grad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="<?= $line_color; ?>" stop-opacity="0.25"/>
                        <stop offset="100%" stop-color="<?= $line_color; ?>" stop-opacity="0.0"/>
                    </linearGradient>
                </defs>

                <!-- Background grids & Zones (colored pastel zones) -->
                <!-- Excellent (76-100) -> y = 30 to 70 -->
                <rect x="50" y="30" width="400" height="40" fill="#bbf7d0" opacity="0.15" />
                <!-- Good (51-75) -> y = 70 to 110 -->
                <rect x="50" y="70" width="400" height="40" fill="#fef08a" opacity="0.15" />
                <!-- Average (26-50) -> y = 110 to 150 -->
                <rect x="50" y="110" width="400" height="40" fill="#fed7aa" opacity="0.15" />
                <!-- Poor (0-25) -> y = 150 to 190 -->
                <rect x="50" y="150" width="400" height="40" fill="#fecaca" opacity="0.15" />

                <!-- Grid lines -->
                <line x1="50" y1="30" x2="450" y2="30" stroke="#cbd5e1" stroke-dasharray="3,3" stroke-width="1" />
                <line x1="50" y1="70" x2="450" y2="70" stroke="#cbd5e1" stroke-dasharray="3,3" stroke-width="1" />
                <line x1="50" y1="110" x2="450" y2="110" stroke="#cbd5e1" stroke-dasharray="3,3" stroke-width="1" />
                <line x1="50" y1="150" x2="450" y2="150" stroke="#cbd5e1" stroke-dasharray="3,3" stroke-width="1" />
                <line x1="50" y1="190" x2="450" y2="190" stroke="#94a3b8" stroke-width="1.5" />

                <!-- Y-Axis Labels (Left) -->
                <text x="40" y="34" fill="#64748b" font-size="10" font-weight="700" text-anchor="end">100</text>
                <text x="40" y="74" fill="#64748b" font-size="10" font-weight="700" text-anchor="end">75</text>
                <text x="40" y="114" fill="#64748b" font-size="10" font-weight="700" text-anchor="end">50</text>
                <text x="40" y="154" fill="#64748b" font-size="10" font-weight="700" text-anchor="end">25</text>
                <text x="40" y="194" fill="#64748b" font-size="10" font-weight="700" text-anchor="end">0</text>

                <?php if ($completed_count >= 5): ?>
                    <?php
                    // Map the scores to coordinate y values
                    $points = [];
                    $x_coords = [50, 150, 250, 350, 450];
                    for ($i = 0; $i < 5; $i++) {
                        $score = $latest_5_chronological[$i]['score'];
                        $y = 30 + (160 * (100 - $score) / 100);
                        $points[] = "$x_coords[$i],$y";
                    }
                    $path_d = "M " . implode(" L ", $points);
                    $area_d = $path_d . " L 450,190 L 50,190 Z";
                    ?>

                    <!-- Area Gradient Fill -->
                    <path class="chart-area-path" d="<?= $area_d; ?>" fill="url(#chart-grad)" style="opacity: 0;" />

                    <!-- Dynamically Colored Line Segments (Sequence Animated) -->
                    <?php for ($i = 0; $i < 4; $i++): ?>
                        <?php
                        $x1 = $x_coords[$i];
                        $y1 = 30 + (160 * (100 - $latest_5_chronological[$i]['score']) / 100);
                        
                        $x2 = $x_coords[$i+1];
                        $dest_score = $latest_5_chronological[$i+1]['score'];
                        $y2 = 30 + (160 * (100 - $dest_score) / 100);
                        
                        $segment_color = getScoreColor($dest_score);
                        ?>
                        <line class="chart-trend-segment" x1="<?= $x1; ?>" y1="<?= $y1; ?>" x2="<?= $x2; ?>" y2="<?= $y2; ?>" stroke="<?= $segment_color; ?>" stroke-width="3.5" stroke-linecap="round" style="stroke-dasharray: 200; stroke-dashoffset: 200; animation: drawPath 0.4s ease-out forwards; animation-delay: <?= 0.2 + ($i * 0.3); ?>s;" />
                    <?php endfor; ?>

                    <!-- Interactive Circles/Dots -->
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <?php
                        $session_item = $latest_5_chronological[$i];
                        $x = $x_coords[$i];
                        $score = $session_item['score'];
                        $date = $session_item['date'];
                        $y = 30 + (160 * (100 - $score) / 100);
                        $label = "Interview " . ($i + 1);
                        $pt_color = getScoreColor($score);
                        $perf_level = getPerformanceLevel($score);
                        ?>
                        <circle class="chart-circle-point" cx="<?= $x; ?>" cy="<?= $y; ?>" r="5.5" fill="<?= $pt_color; ?>" stroke="#ffffff" stroke-width="2" style="cursor: pointer; transition: r 0.2s;" onmouseover="this.setAttribute('r', '8'); showChartTooltip(event, '<?= $label; ?><br><span style=\'color: <?= $pt_color; ?>\'>Score: <?= number_format($score, 1); ?>% (<?= $perf_level; ?>)</span><br><?= $date; ?>')" onmouseout="this.setAttribute('r', '5.5'); hideChartTooltip()" />
                        
                        <!-- X-Axis Labels -->
                        <text x="<?= $x; ?>" y="210" fill="#64748b" font-size="10.5" font-weight="700" text-anchor="middle"><?= $label; ?></text>
                    <?php endfor; ?>
                <?php endif; ?>
            </svg>

            <!-- Tooltip element -->
            <div id="chart-tooltip" style="display: none; position: absolute; background: #1e293b; color: #ffffff; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; line-height: 1.4; box-shadow: 0 4px 15px rgba(0,0,0,0.15); pointer-events: none; z-index: 1200; font-family: 'Nunito', sans-serif;"></div>
        </div>
    </div>
</div>

<script>
    const hasUploadedCv = <?= $has_uploaded_cv ? 'true' : 'false'; ?>;
    const hasSkills = <?= $has_skills ? 'true' : 'false'; ?>;
    const profileUrl = '<?= $profile_url; ?>';

    function openHistoryModal() {
        const modal = document.getElementById('historyModal');
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeHistoryModal() {
        const modal = document.getElementById('historyModal');
        if (!modal) return;
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }


    function openCvModal() {
        const modal = document.getElementById('cvRequirementModal');
        const content = document.getElementById('cvRequirementContent');
        modal.style.display = 'flex';
        setTimeout(() => {
            content.style.transform = 'translateY(0)';
        }, 50);
    }

    function closeCvModal() {
        const modal = document.getElementById('cvRequirementModal');
        const content = document.getElementById('cvRequirementContent');
        content.style.transform = 'translateY(20px)';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 200);
    }

    function selectInterviewType(type) {
        if (type === 'technical' && !hasUploadedCv && !hasSkills) {
            openCvModal();
            return;
        }

        document.getElementById('selectedInterviewType').value = type;

        const softCard = document.getElementById('softSkillCard');
        const techCard = document.getElementById('technicalCard');

        if (type === 'soft_skill') {
            softCard.classList.add('active');
            softCard.style.borderColor = '#FFF44F';
            softCard.style.boxShadow = '0 4px 15px rgba(255, 244, 79, 0.2)';

            techCard.classList.remove('active');
            techCard.style.borderColor = '#e2e8f0';
            techCard.style.boxShadow = 'none';
        } else {
            techCard.classList.add('active');
            techCard.style.borderColor = '#a855f7';
            techCard.style.boxShadow = '0 4px 15px rgba(168, 85, 247, 0.1)';

            softCard.classList.remove('active');
            softCard.style.borderColor = '#e2e8f0';
            softCard.style.boxShadow = 'none';
        }

        // Automatically submit form when type is selected
        document.getElementById('startForm').submit();
    }

    const completedInterviewsCount = <?= $completed_count; ?>;

    function openProgressReport() {
        // Prevent body scrolling
        document.body.style.overflow = 'hidden';

        if (completedInterviewsCount < 5) {
            const modal = document.getElementById('progressAlertModal');
            const content = document.getElementById('progressAlertContent');
            modal.style.display = 'flex';
            setTimeout(() => {
                content.style.transform = 'translateY(0)';
            }, 50);
        } else {
            const modal = document.getElementById('progressReportModal');
            const content = document.getElementById('progressReportContent');
            modal.style.display = 'flex';
            setTimeout(() => {
                content.style.transform = 'translateY(0)';
            }, 50);
        }
    }

    function closeProgressAlert() {
        const modal = document.getElementById('progressAlertModal');
        const content = document.getElementById('progressAlertContent');
        content.style.transform = 'translateY(20px)';
        setTimeout(() => {
            modal.style.display = 'none';
            const historyModal = document.getElementById('historyModal');
            if (historyModal.style.display === 'none') {
                document.body.style.overflow = '';
            }
        }, 200);
    }

    function closeProgressReport() {
        const modal = document.getElementById('progressReportModal');
        const content = document.getElementById('progressReportContent');
        content.style.transform = 'translateY(20px)';
        setTimeout(() => {
            modal.style.display = 'none';
            const historyModal = document.getElementById('historyModal');
            if (historyModal.style.display === 'none') {
                document.body.style.overflow = '';
            }
        }, 200);
    }

    function showChartTooltip(evt, text) {
        const tooltip = document.getElementById('chart-tooltip');
        tooltip.innerHTML = text;
        tooltip.style.display = 'block';
        
        const container = tooltip.parentElement;
        const rect = container.getBoundingClientRect();
        
        tooltip.style.left = (evt.clientX - rect.left + 12) + 'px';
        tooltip.style.top = (evt.clientY - rect.top - 55) + 'px';
    }

    function hideChartTooltip() {
        const tooltip = document.getElementById('chart-tooltip');
        tooltip.style.display = 'none';
    }
</script>