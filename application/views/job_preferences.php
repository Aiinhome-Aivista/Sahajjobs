<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Preferences</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
        :root {
            --yellow: #D4C000;
            --yellow-hover: #F0D800;
            --yellow-pale: #FDFCE8;
            --yellow-badge: #FFF8CC;
            --yellow-text: #5A4D00;

            --black: #111111;
            --g900: #1C1C1E;
            --g700: #3A3A3C;
            --g500: #636366;
            --g400: #8E8E93;
            --g200: #D1D1D6;
            --g100: #F2F2F7;
            --g050: #F8F8F4;
            --white: #FFFFFF;
            --border: #E5E5EA;

            --blue-bg: #EDF5FF;
            --blue-text: #185FA5;
            --green-bg: #EAF3DE;
            --green-text: #3B6D11;
            --amber-bg: #FEF3DC;
            --amber-text: #854F0B;
            --red-bg: #FAECE7;
            --red-text: #993C1D;
            --purple-bg: #EEEDFE;
            --purple-text: #3C3489;
            --pink-bg: #FBEAF0;
            --pink-text: #993556;

            --danger: #E24B4A;
            --success: #639922;

            --r-sm: 6px;
            --r-md: 10px;
            --r-lg: 14px;
            --r-xl: 18px;
            --shadow-card: 0 1px 4px rgba(0, 0, 0, 0.06), 0 0 0 0.5px rgba(0, 0, 0, 0.07);
            --shadow-modal: 0 20px 60px rgba(0, 0, 0, 0.18);
            --shadow-toast: 0 8px 24px rgba(0, 0, 0, 0.13);
            --transition: all 0.18s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nunito', Arial, sans-serif;
            background: var(--g050);
            color: var(--black);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── MAIN ───────────────────────────────── */
        .main {
            max-width: 950px;
            margin: 0 auto;
            padding: 32px 20px 72px;
        }

        /* ── BACK LINK ───────────────────────────── */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 15.5px;
            font-weight: 500;
            color: var(--g500);
            text-decoration: none;
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            padding: 6px 13px;
            transition: var(--transition);
            background: var(--white);
            margin-bottom: 10px;
        }

        .back-link:hover {
            color: var(--black);
            border-color: var(--g200);
            background: var(--g100);
        }

        .back-link i {
            font-size: 10px;
        }

        /* ── PAGE HEADER ─────────────────────────── */
        .page-head {
            text-align: center;
            margin-bottom: 32px;
        }

        .page-head h1 {
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.6px;
            color: var(--black);
        }

        .page-head p {
            font-size: 15.5px;
            color: var(--g500);
            margin-top: 7px;
        }

        /* ── PREFERENCE CARD WRAPPER ─────────────── */
        .pref-card {
            background: var(--white);
            border-radius: var(--r-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        /* ── PREFERENCE ROW ──────────────────────── */
        .pref-row {
            display: flex;
            align-items: center;
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            gap: 14px;
            transition: background 0.14s;
        }

        .pref-row:last-child {
            border-bottom: none;
        }

        .pref-row:hover {
            background: var(--g050);
        }

        /* Icon badge */
        .pref-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .pi-title {
            background: var(--blue-bg);
            color: var(--blue-text);
        }

        .pi-type {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .pi-pay {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .pi-relocate {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .pi-remote {
            background: var(--purple-bg);
            color: var(--purple-text);
        }

        /* Text block */
        .pref-text {
            flex: 1;
            min-width: 0;
        }

        .pref-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--g400);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .pref-value {
            font-size: 15px;
            font-weight: 500;
            color: var(--g900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pref-value.not-set {
            color: var(--g200);
            font-style: italic;
            font-weight: 400;
        }

        /* Value badges for job types / work setting */
        .badge-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 2px;
        }

        .badge-pill {
            font-size: 11px;
            font-weight: 500;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--yellow-badge);
            color: var(--yellow-text);
        }

        /* Edit / Add button */
        .pref-action {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: var(--g400);
            cursor: pointer;
            transition: var(--transition);
        }

        .pref-action:hover {
            background: var(--g100);
            color: var(--black);
            border-color: var(--g200);
        }

        .pref-action.add-icon {
            background: var(--yellow);
            border-color: var(--yellow);
            color: var(--yellow-text);
        }

        .pref-action.add-icon:hover {
            background: var(--yellow-hover);
        }

        .pref-action.edit-icon {}

        /* ── MODAL OVERLAY ───────────────────────── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(17, 17, 17, 0.45);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-box {
            background: var(--white);
            border-radius: var(--r-xl);
            width: 100%;
            max-width: 460px;
            box-shadow: var(--shadow-modal);
            animation: modalIn 0.22s cubic-bezier(.4, 0, .2, 1);
            overflow: hidden;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px 16px;
            border-bottom: 1px solid var(--border);
        }

        .modal-head-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-head-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            background: var(--yellow-badge);
            color: var(--yellow-text);
        }

        .modal-title {
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
        }

        .modal-close {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--g100);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: var(--g500);
            transition: var(--transition);
        }

        .modal-close:hover {
            background: var(--border);
            color: var(--black);
        }

        .modal-body-inner {
            padding: 20px 22px;
        }

        /* Info banner inside modal */
        .modal-info {
            background: var(--blue-bg);
            color: var(--blue-text);
            border-left: 3px solid var(--blue-text);
            border-radius: var(--r-sm);
            padding: 10px 13px;
            font-size: 12.5px;
            margin-bottom: 16px;
        }

        /* Form elements */
        .field-group {
            margin-bottom: 14px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--g500);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }

        .field-input,
        .field-select {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            padding: 9px 12px;
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 13.5px;
            color: var(--black);
            background: var(--white);
            outline: none;
            transition: var(--transition);
            appearance: none;
            -webkit-appearance: none;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(212, 192, 0, 0.14);
        }

        .field-row {
            display: flex;
            gap: 12px;
        }

        .field-row .field-group {
            flex: 1;
        }

        /* Checkbox / radio items */
        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 13px;
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            margin-bottom: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .check-item:last-child {
            margin-bottom: 0;
        }

        .check-item:hover {
            background: var(--g050);
            border-color: var(--g200);
        }

        .check-item.is-checked {
            background: var(--yellow-pale);
            border-color: var(--yellow);
        }

        .check-item input[type="checkbox"],
        .check-item input[type="radio"] {
            width: 15px;
            height: 15px;
            accent-color: var(--yellow);
            cursor: pointer;
            flex-shrink: 0;
        }

        .check-item label {
            font-size: 13.5px;
            color: var(--g900);
            cursor: pointer;
            flex: 1;
        }

        /* Modal footer */
        .modal-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 22px;
            border-top: 1px solid var(--border);
            background: var(--g050);
        }

        .modal-foot-right {
            display: flex;
            gap: 8px;
        }

        .btn-delete {
            padding: 8px 16px;
            border: 1px solid #FECACA;
            border-radius: var(--r-md);
            background: #FEF2F2;
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: var(--danger);
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-delete:hover {
            background: #FEE2E2;
        }

        .btn-modal-cancel {
            padding: 8px 16px;
            background: var(--g100);
            color: var(--g700);
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-modal-cancel:hover {
            background: var(--g200);
        }

        .btn-modal-save {
            padding: 8px 20px;
            background: var(--yellow);
            color: var(--yellow-text);
            border: 1px solid var(--yellow);
            border-radius: var(--r-md);
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-modal-save:hover {
            background: var(--yellow-hover);
        }

        /* ── TOAST ───────────────────────────────── */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            background: var(--g900);
            color: var(--white);
            padding: 12px 18px;
            border-radius: var(--r-lg);
            font-size: 13px;
            font-weight: 500;
            box-shadow: var(--shadow-toast);
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateY(70px);
            opacity: 0;
            transition: all 0.28s cubic-bezier(.4, 0, .2, 1);
            pointer-events: none;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .dot-success {
            background: #4ade80;
        }

        .dot-error {
            background: #f87171;
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 600px) {
            .topbar {
                padding: 0 16px;
            }

            .main {
                padding: 20px 12px 60px;
            }

            .page-head h1 {
                font-size: 22px;
            }

            .pref-row {
                padding: 14px 16px;
            }

            .field-row {
                flex-direction: column;
                gap: 0;
            }

            .topbar-link {
                display: none;
            }
        }
        
        #remoteInlineOptions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        #remoteInlineOptions .check-item {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <!-- ── MAIN ───────────────────────────────────────────────── -->
    <div class="main">

        <!-- Back -->
        <a href="<?= base_url('profile'); ?>" class="back-link">
            <i class="fas fa-chevron-left"></i> Go to Profile
        </a>

        <!-- Page header -->
        <div class="page-head">
            <h1>Job Preferences</h1>
            <p>Define your ideal job parameters to help us find the best matches for you.</p>
        </div>

        <!-- Preference card -->
        <div class="pref-card">

            <!-- Job Title -->
            <div class="pref-row" id="job-title-section">
                <div class="pref-icon pi-title"><i class="fas fa-briefcase"></i></div>
                <div class="pref-text">
                    <div class="pref-label">Job Title</div>
                    <div class="pref-value <?= empty($job_title) ? 'not-set' : '' ?>" id="jobTitleDisplay">
                        <?= !empty($job_title) ? html_escape($job_title) : 'Not specified' ?>
                    </div>
                </div>
                <?php if (!empty($job_title)): ?>
                    <button class="pref-action edit-icon" data-modal-type="job_title"
                        data-current-value="<?= html_escape($job_title) ?>" title="Edit">
                        <i class="fas fa-pen"></i>
                    </button>
                <?php else: ?>
                    <button class="pref-action add-icon" data-modal-type="job_title" title="Add">
                        <i class="fas fa-plus"></i>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Job Types -->
            <div class="pref-row" id="job-types-section">
                <div class="pref-icon pi-type"><i class="fas fa-layer-group"></i></div>
                <div class="pref-text">
                    <div class="pref-label">Job Types</div>
                    <?php if (!empty($job_types)): ?>
                        <div class="badge-list" id="jobTypesDisplay">
                            <?php foreach ($job_types as $t): ?>
                                <span class="badge-pill">
                                    <?= html_escape($t) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="pref-value not-set" id="jobTypesDisplay">Not specified</div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($job_types)): ?>
                    <button class="pref-action edit-icon" data-modal-type="job_types"
                        data-current-values="<?= html_escape(json_encode($job_types)) ?>" title="Edit">
                        <i class="fas fa-pen"></i>
                    </button>
                <?php else: ?>
                    <button class="pref-action add-icon" data-modal-type="job_types" title="Add">
                        <i class="fas fa-plus"></i>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Minimum Base Pay -->
            <div class="pref-row" id="pay-section">
                <div class="pref-icon pi-pay"><i class="fas fa-indian-rupee-sign"></i></div>
                <div class="pref-text">
                    <div class="pref-label">Minimum Base Pay</div>
                    <div class="pref-value <?= empty($min_base_pay) ? 'not-set' : '' ?>" id="payDisplay">
                        <?php
                        if (!empty($min_base_pay)) {
                            echo '₹' . number_format($min_base_pay) . ' ' . html_escape($pay_period);
                        } else {
                            echo 'Not specified';
                        }
                        ?>
                    </div>
                </div>
                <?php if (!empty($min_base_pay)): ?>
                    <button class="pref-action edit-icon" data-modal-type="pay"
                        data-current-min-pay="<?= html_escape($min_base_pay) ?>"
                        data-current-pay-period="<?= html_escape($pay_period) ?>" title="Edit">
                        <i class="fas fa-pen"></i>
                    </button>
                <?php else: ?>
                    <button class="pref-action add-icon" data-modal-type="pay" title="Add">
                        <i class="fas fa-plus"></i>
                    </button>
                <?php endif; ?>
            </div>

            <!-- Relocation -->
            <div class="pref-row" id="relocation-section">
                <div class="pref-icon pi-relocate">
                    <i class="fas fa-map-location-dot"></i>
                </div>

                <div class="pref-text">
                    <div class="pref-label">Relocation</div>

                    <label class="check-item <?= $is_willing_to_relocate ? 'is-checked' : '' ?>">
                        <input type="checkbox" id="relocationCheckboxInline" <?= $is_willing_to_relocate ? 'checked' : '' ?>>
                        <span>Willing to relocate</span>
                    </label>
                </div>
            </div>

            <!-- Remote Work -->
            <div class="pref-row" id="remote-section">
                <div class="pref-icon pi-remote">
                    <i class="fas fa-laptop-house"></i>
                </div>

                <div class="pref-text">
                    <div class="pref-label">Work Type</div>

                    <div id="remoteInlineOptions">

                        <?php
                        $workOptions = ['In-office', 'Hybrid', 'Remote'];
                        foreach ($workOptions as $option):
                            ?>

                            <label class="check-item <?= ($work_setting == $option) ? 'is-checked' : '' ?>">
                                <input type="radio" name="work_setting_inline" value="<?= $option ?>"
                                    <?= ($work_setting == $option) ? 'checked' : '' ?>>
                                <span><?= $option ?></span>
                            </label>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div><!-- /pref-card -->
    </div><!-- /main -->

    <!-- ── MODAL ──────────────────────────────────────────────── -->
    <div class="modal-overlay" id="prefModal">
        <div class="modal-box">
            <div class="modal-head">
                <div class="modal-head-left">
                    <div class="modal-head-icon"><i class="fas fa-sliders" id="modalHeadIcon"></i></div>
                    <span class="modal-title" id="modalTitle">Edit Preference</span>
                </div>
                <button class="modal-close" id="modalClose"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body-inner" id="modalBody"></div>
            <div class="modal-foot">
                <button class="btn-delete" id="deleteButton" style="display:none;">
                    <i class="fas fa-trash-alt" style="margin-right:6px;font-size:11px;"></i> Remove
                </button>
                <div class="modal-foot-right">
                    <button class="btn-modal-cancel" id="modalCancelBtn">Cancel</button>
                    <button class="btn-modal-save" id="saveButton">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ── TOAST ──────────────────────────────────────────────── -->
    <div class="toast" id="toast">
        <div class="toast-dot dot-success" id="toast-dot"></div>
        <span id="toast-msg">Saved!</span>
    </div>

    <!-- ── SCRIPTS ─────────────────────────────────────────────── -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {

            /* ── Toast ── */
            let toastTimer;
            function showToast(msg, type) {
                type = type || 'success';
                clearTimeout(toastTimer);
                $('#toast-msg').text(msg);
                $('#toast-dot').attr('class', 'toast-dot ' + (type === 'success' ? 'dot-success' : 'dot-error'));
                $('#toast').addClass('show');
                toastTimer = setTimeout(function () { $('#toast').removeClass('show'); }, 3000);
            }

            /* ── HTML escape ── */
            function esc(s) {
                if (typeof s !== 'string') return s;
                return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
            }

            /* ── Modal open/close ── */
            const $modal = $('#prefModal');
            let modalType = '';

            function openModal() { $modal.addClass('active'); }
            function closeModal() { $modal.removeClass('active'); }

            $('#modalClose, #modalCancelBtn').on('click', closeModal);
            $modal.on('click', function (e) { if ($(e.target).is(this)) closeModal(); });

            /* ── Display update helpers ── */
            function setDisplay($el, html, isEmpty) {
                $el.html(html);
                $el.toggleClass('not-set', !!isEmpty);
            }

            function updateJobTitleDisplay(title) {
                const $display = $('#jobTitleDisplay');
                const $section = $('#job-title-section');
                if (title) {
                    setDisplay($display, esc(title), false);
                    swapActionBtn($section, 'edit', 'job_title', { 'data-current-value': esc(title) });
                } else {
                    setDisplay($display, 'Not specified', true);
                    swapActionBtn($section, 'add', 'job_title', {});
                }
            }

            function updateJobTypesDisplay(types) {
                const $display = $('#jobTypesDisplay');
                const $section = $('#job-types-section');
                if (types && types.length > 0) {
                    const pills = types.map(function (t) {
                        return '<span class="badge-pill">' + esc(t) + '</span>';
                    }).join('');
                    $display.html('<div class="badge-list" id="jobTypesDisplay">' + pills + '</div>');
                    $display.removeClass('pref-value not-set');
                    swapActionBtn($section, 'edit', 'job_types', { 'data-current-values': JSON.stringify(types) });
                } else {
                    setDisplay($display, 'Not specified', true);
                    $display.addClass('pref-value');
                    swapActionBtn($section, 'add', 'job_types', {});
                }
            }

            function updatePayDisplay(minPay, payPeriod) {
                const $display = $('#payDisplay');
                const $section = $('#pay-section');
                if (minPay && minPay !== 'null' && minPay !== '') {
                    const fmt = parseFloat(minPay).toLocaleString('en-IN');
                    setDisplay($display, '₹' + fmt + ' ' + esc(payPeriod), false);
                    swapActionBtn($section, 'edit', 'pay', {
                        'data-current-min-pay': minPay,
                        'data-current-pay-period': payPeriod
                    });
                } else {
                    setDisplay($display, 'Not specified', true);
                    swapActionBtn($section, 'add', 'pay', {});
                }
            }

            function updateRelocationDisplay(isWilling) {
                $('#relocationDisplay').text(isWilling ? 'Willing to relocate' : 'Not willing to relocate');
                $('#relocation-section .pref-action').data('current-willingness', isWilling);
            }

            function updateRemoteDisplay(setting) {
                const $display = $('#remoteDisplay');
                const $section = $('#remote-section');
                if (setting) {
                    setDisplay($display, esc(setting), false);
                    swapActionBtn($section, 'edit', 'work_setting', { 'data-current-setting': esc(setting) });
                } else {
                    setDisplay($display, 'Not specified', true);
                    swapActionBtn($section, 'add', 'work_setting', {});
                }
            }

            function swapActionBtn($section, mode, type, attrs) {
                const $btn = $section.find('.pref-action');
                $btn.removeClass('add-icon edit-icon');
                $btn.addClass(mode === 'add' ? 'add-icon' : 'edit-icon');
                $btn.attr('data-modal-type', type).attr('title', mode === 'add' ? 'Add' : 'Edit');
                $btn.find('i').attr('class', mode === 'add' ? 'fas fa-plus' : 'fas fa-pen');
                $.each(attrs, function (k, v) { $btn.attr(k, v); });
            }

            /* ── Open modal on button click ── */
            $(document).on('click', '.pref-action', function () {
                const $btn = $(this);
                modalType = $btn.data('modal-type');

                const titles = {
                    job_title: 'Job Title',
                    job_types: 'Job Types',
                    pay: 'Minimum Base Pay',
                    relocation: 'Relocation',
                    work_setting: 'Remote Work'
                };
                const icons = {
                    job_title: 'fa-briefcase',
                    job_types: 'fa-layer-group',
                    pay: 'fa-indian-rupee-sign',
                    relocation: 'fa-map-location-dot',
                    work_setting: 'fa-laptop-house'
                };

                $('#modalTitle').text(titles[modalType] || 'Preference');
                $('#modalHeadIcon').attr('class', 'fas ' + (icons[modalType] || 'fa-sliders'));
                loadModalContent(modalType, $btn.data());

                /* Show delete only for edit actions or relocation */
                if ($btn.hasClass('edit-icon') || modalType === 'relocation') {
                    $('#deleteButton').show();
                } else {
                    $('#deleteButton').hide();
                }

                openModal();
            });

            /* ── Build modal content ── */
            function loadModalContent(type, data) {
                let html = '';

                if (type === 'job_title') {
                    const v = data.currentValue || '';
                    html = `<form id="dynamicForm" action="<?= base_url('jobpreferences/update_job_title'); ?>">
                <div class="field-group">
                    <label class="field-label">Job Title</label>
                    <input class="field-input" type="text" id="jobTitle" name="job_title"
                           value="${esc(v)}" placeholder="e.g., Software Engineer">
                </div>
            </form>`;
                }

                else if (type === 'job_types') {
                    let selected = [];
                    if (data.currentValues) {
                        try { selected = typeof data.currentValues === 'string' ? JSON.parse(data.currentValues) : data.currentValues; }
                        catch (e) { selected = []; }
                    }
                    const opts = ['Permanent', 'Contract', 'Temporary', 'Internship', 'Fresher'];
                    html = `<form id="dynamicForm" action="<?= base_url('jobpreferences/update_job_types'); ?>">`;
                    opts.forEach(function (o) {
                        const checked = selected.includes(o);
                        html += `<label class="check-item ${checked ? 'is-checked' : ''}">
                    <input type="checkbox" name="job_types[]" value="${o}" ${checked ? 'checked' : ''}>
                    <span>${o}</span>
                </label>`;
                    });
                    html += '</form>';
                }

                else if (type === 'pay') {
                    const mp = data.currentMinPay || '';
                    const pp = data.currentPayPeriod || 'per month';
                    html = `<form id="dynamicForm" action="<?= base_url('jobpreferences/update_pay'); ?>">
                <div class="modal-info">Enter the minimum base pay you are looking for.</div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Amount (₹)</label>
                        <input class="field-input" type="number" id="minBasePay" name="min_base_pay"
                               value="${esc(mp)}" placeholder="e.g., 25000">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Period</label>
                        <select class="field-select" id="payPeriod" name="pay_period">
                            <option value="per month" ${pp === 'per month' ? 'selected' : ''}>Per month</option>
                            <option value="per year"  ${pp === 'per year' ? 'selected' : ''}>Per year</option>
                        </select>
                    </div>
                </div>
            </form>`;
                }

                else if (type === 'relocation') {
                    const willing = (data.currentWillingness === true || data.currentWillingness === 'true');
                    html = `<form id="dynamicForm" action="<?= base_url('jobpreferences/update_relocation'); ?>">
                <label class="check-item ${willing ? 'is-checked' : ''}">
                    <input type="checkbox" id="relocationCheckbox" name="is_willing_to_relocate" ${willing ? 'checked' : ''}>
                    <span>Willing to relocate</span>
                </label>
            </form>`;
                }

                else if (type === 'work_setting') {
                    const cur = data.currentSetting || '';
                    const opts = ['In-office', 'Hybrid', 'Remote'];
                    html = `<form id="dynamicForm" action="<?= base_url('jobpreferences/update_work_setting'); ?>">`;
                    opts.forEach(function (o) {
                        const checked = cur === o;
                        html += `<label class="check-item ${checked ? 'is-checked' : ''}">
                    <input type="radio" name="work_setting" id="ws-${o}" value="${o}" ${checked ? 'checked' : ''}>
                    <span>${o}</span>
                </label>`;
                    });
                    html += '</form>';
                }

                $('#modalBody').html(html);

                /* Live check-item highlight */
                $('#modalBody').find('.check-item input').on('change', function () {
                    const $label = $(this).closest('.check-item');
                    if ($(this).attr('type') === 'radio') {
                        $('#modalBody .check-item').removeClass('is-checked');
                    }
                    $label.toggleClass('is-checked', this.checked);
                });
            }

            /* ── Save ── */
            $('#saveButton').on('click', function (e) {
                e.preventDefault();
                const $form = $('#dynamicForm');
                const url = $form.attr('action');
                const data = $form.serialize();

                $.ajax({
                    url: url, type: 'POST', data: data, dataType: 'json',
                    success: function (r) {
                        if (r.success) {
                            switch (modalType) {
                                case 'job_title':
                                    updateJobTitleDisplay($('#jobTitle').val());
                                    break;
                                case 'job_types':
                                    const sel = [];
                                    $('input[name="job_types[]"]:checked').each(function () { sel.push($(this).val()); });
                                    updateJobTypesDisplay(sel);
                                    break;
                                case 'pay':
                                    updatePayDisplay($('#minBasePay').val(), $('#payPeriod').val());
                                    break;
                                case 'relocation':
                                    updateRelocationDisplay($('#relocationCheckbox').is(':checked'));
                                    break;
                                case 'work_setting':
                                    updateRemoteDisplay($('input[name="work_setting"]:checked').val());
                                    break;
                            }
                            closeModal();
                            showToast('Preference saved!');
                        } else {
                            showToast(r.message || 'Save failed.', 'error');
                        }
                    },
                    error: function () { showToast('An error occurred.', 'error'); }
                });
            });

            /* ── Delete ── */
            $('#deleteButton').on('click', function () {
                const urls = {
                    job_title: '<?= base_url('jobpreferences/delete_job_title'); ?>',
                    job_types: '<?= base_url('jobpreferences/delete_job_types'); ?>',
                    pay: '<?= base_url('jobpreferences/delete_pay'); ?>',
                    relocation: '<?= base_url('jobpreferences/delete_relocation'); ?>',
                    work_setting: '<?= base_url('jobpreferences/delete_work_setting'); ?>'
                };
                const callbacks = {
                    job_title: function () { updateJobTitleDisplay(null); },
                    job_types: function () { updateJobTypesDisplay([]); },
                    pay: function () { updatePayDisplay(null, null); },
                    relocation: function () { updateRelocationDisplay(false); },
                    work_setting: function () { updateRemoteDisplay(null); }
                };

                const url = urls[modalType];
                if (!url) return;

                $.ajax({
                    url: url, type: 'POST', dataType: 'json',
                    success: function (r) {
                        if (r.success) {
                            callbacks[modalType]();
                            closeModal();
                            showToast('Preference removed.');
                        } else {
                            showToast(r.message || 'Delete failed.', 'error');
                        }
                    },
                    error: function () { showToast('An error occurred.', 'error'); }
                });
            });
        });
    </script>
    <script>

        /* ───────── Relocation inline update ───────── */

        $(document).on('change', '#relocationCheckboxInline', function () {

            const isChecked = $(this).is(':checked');

            $.ajax({

                url: "<?= base_url('jobpreferences/update_relocation'); ?>",

                type: "POST",

                data: {
                    is_willing_to_relocate: isChecked ? 'true' : 'false'
                },

                dataType: "json",

                success: function (r) {

                    if (r.success) {

                        $('#relocationCheckboxInline')
                            .closest('.check-item')
                            .toggleClass('is-checked', isChecked);

                        showToast('Relocation preference updated');

                    } else {

                        showToast(r.message || 'Update failed', 'error');

                    }

                },

                error: function () {

                    showToast('Server error', 'error');

                }

            });

        });


        /* ───────── Remote work inline update ───────── */

        $(document).on('change', 'input[name="work_setting_inline"]', function () {

            const setting = $(this).val();

            $.ajax({

                url: "<?= base_url('jobpreferences/update_work_setting'); ?>",

                type: "POST",

                data: {

                    work_setting: setting

                },

                dataType: "json",

                success: function (r) {

                    if (r.success) {

                        $('#remoteInlineOptions .check-item')
                            .removeClass('is-checked');

                        $('input[name="work_setting_inline"]:checked')
                            .closest('.check-item')
                            .addClass('is-checked');

                        showToast('Work setting updated');

                    }

                    else {

                        showToast('Update failed', 'error');

                    }

                },

                error: function () {

                    showToast('Server error', 'error');

                }

            });

        });
    </script>
</body>

</html>