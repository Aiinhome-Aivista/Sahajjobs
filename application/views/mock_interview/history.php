<div class="mock-interview-wrapper" style="background: #ffffff; height: calc(100vh - 70px); display: flex; align-items: center; justify-content: center; padding: 20px; font-family: 'Nunito', sans-serif; overflow: hidden; box-sizing: border-box;">
    <div class="glass-container" style="background: #f3f4f6; border: 1px solid #e2e8f0; border-radius: 20px; max-width: 1450px; width: 100%; height: 100%; max-height: calc(100vh - 110px); padding: 30px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); color: #333; display: flex; flex-direction: column; overflow: hidden; box-sizing: border-box; animation: fadeIn 0.8s ease-out;">
        
        <!-- Fixed Header Section (Sticky) -->
        <div style="flex-shrink: 0; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 14px;">
                    <div style="background: rgba(234, 179, 8, 0.12); width: 46px; height: 46px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-history" style="font-size: 20px; color: #ca8a04;"></i>
                    </div>
                    <div>
                        <h2 style="margin: 0; font-size: 22px; font-weight: 800; color: #27365c; line-height: 1.2;">Full Interview History</h2>
                        <p style="margin: 3px 0 0 0; color: #64748b; font-size: 13.5px;">Review all your completed mock interviews and access detailed reports.</p>
                    </div>
                </div>
                <a href="<?= base_url('mock-interview'); ?>" style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 30px; color: #475569; font-size: 13.5px; font-weight: 700; padding: 10px 22px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9';" onmouseout="this.style.background='#ffffff';">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <?php if (!empty($session_history)): ?>
                <!-- Stats Row -->
                <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 15px;">
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; font-weight: 700;">Total Interviews</div>
                        <div style="font-size: 22px; font-weight: 800; color: #27365c;"><?= $history_total; ?></div>
                    </div>
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; font-weight: 700;">Average Score</div>
                        <div style="font-size: 22px; font-weight: 800; color: #ca8a04;"><?= number_format($history_average_score, 1); ?></div>
                    </div>
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; font-weight: 700;">Best Score</div>
                        <div style="font-size: 22px; font-weight: 800; color: #16a34a;"><?= number_format($history_best_score, 1); ?></div>
                    </div>
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                        <div style="font-size: 11px; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; font-weight: 700;">Last Session</div>
                        <div style="font-size: 14px; font-weight: 700; color: #27365c; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?= $history_last_interview_date ? date('d M Y, H:i A', strtotime($history_last_interview_date)) : 'N/A'; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($session_history)): ?>
            <!-- Scrollable Cards Section -->
            <div style="flex: 1; overflow-y: auto; padding-right: 5px; margin-top: 5px; margin-bottom: 5px;" class="scrollable-content">
                <!-- Grid (4 per row on desktop, cards are wider) -->
                <div class="history-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; padding-bottom: 10px;">
                    <?php foreach ($session_history as $session): ?>
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 12px rgba(0,0,0,0.02); transition: all 0.2s; min-height: 160px; box-sizing: border-box;" class="history-card">
                            <div>
                                <span style="display: inline-block; background: <?= ($session['job_role'] === 'Technical Interview') ? 'rgba(168, 85, 247, 0.08)' : 'rgba(234, 179, 8, 0.08)'; ?>; border: 1px solid <?= ($session['job_role'] === 'Technical Interview') ? 'rgba(168, 85, 247, 0.2)' : 'rgba(234, 179, 8, 0.2)'; ?>; color: <?= ($session['job_role'] === 'Technical Interview') ? '#7c3aed' : '#ca8a04'; ?>; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 20px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <?= htmlspecialchars($session['job_role'] ?? 'Interview', ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                                <div style="font-size: 14.5px; font-weight: 800; color: #27365c; margin-bottom: 5px; line-height: 1.3;">
                                    <?= date('d M Y, H:i A', strtotime($session['created_at'])); ?>
                                </div>
                                <div style="font-size: 13px; color: #64748b; margin-bottom: 15px;">
                                    Overall Score: <span style="font-weight: 800; color: #1e293b;"><?= isset($session['overall_score']) && is_numeric($session['overall_score']) ? number_format($session['overall_score'], 1) : 'N/A'; ?></span>
                                </div>
                            </div>
                            <a href="<?= base_url('mock-interview/result/' . $session['id']); ?>" style="background: #FFF44F; color: #27365c; text-decoration: none; border-radius: 30px; padding: 9px 12px; font-size: 12.5px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 10px rgba(255, 244, 79, 0.15); transition: all 0.2s;" onmouseover="this.style.background='#ffd500';" onmouseout="this.style.background='#FFF44F';">
                                <i class="fas fa-eye" style="font-size: 11px;"></i> View Q&A
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                <div style="background: #fefce8; border: 1px solid #fef08a; border-radius: 18px; padding: 40px; text-align: center; max-width: 500px; width: 100%;">
                    <h3 style="margin: 0 0 12px 0; font-size: 20px; font-weight: 800; color: #854d0e;">No mock interview history found.</h3>
                    <p style="margin: 0; color: #475569; font-size: 14px; line-height: 1.6;">Complete your first mock interview to see your results here.</p>
                    <div style="margin-top: 20px;">
                        <a href="<?= base_url('mock-interview'); ?>" style="background: #FFF44F; color: #27365c; text-decoration: none; border-radius: 30px; padding: 10px 25px; font-size: 14px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);" onmouseover="this.style.background='#ffd500';" onmouseout="this.style.background='#FFF44F';">
                            <span>Start Mock Interview</span> <i class="fas fa-play" style="font-size: 11px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Custom Scrollbar Styles for the cards list */
.scrollable-content::-webkit-scrollbar {
    width: 6px;
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

.history-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.04) !important;
    border-color: #cbd5e1 !important;
}

/* Responsive grid adjustments */
@media (max-width: 1200px) {
    .history-grid {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}
@media (max-width: 768px) {
    .history-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (max-width: 480px) {
    .history-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>
