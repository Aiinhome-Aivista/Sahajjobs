<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qualifications</title>
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
            --gray-bg: #F1EFE8;
            --gray-text: #5F5E5A;
            --pink-bg: #FBEAF0;
            --pink-text: #993556;

            --danger: #E24B4A;
            --success: #639922;

            --r-sm: 6px;
            --r-md: 10px;
            --r-lg: 14px;
            --r-xl: 18px;
            --shadow-card: 0 1px 4px rgba(0, 0, 0, 0.06), 0 0 0 0.5px rgba(0, 0, 0, 0.07);
            --shadow-toast: 0 8px 24px rgba(0, 0, 0, 0.12);
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

        /* ─── MAIN ───────────────────────────────── */
        .main {
            max-width: 1180px;
            margin: 0 auto;
            padding: 32px 20px 72px;
        }

        /* ─── BACK ───────────────────────────────── */
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

        /* ─── PAGE HEADER ────────────────────────── */
        .page-head {
            text-align: center;
            margin-bottom: 36px;
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
            font-weight: 400;
        }

        .category-pills {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin-top: 18px;
        }

        .cpill {
            font-size: 13.5px;
            font-weight: 500;
            padding: 4px 13px;
            border-radius: 20px;
            letter-spacing: 0.1px;
        }

        .cpill-skills {
            background: var(--blue-bg);
            color: var(--blue-text);
        }

        .cpill-work {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .cpill-edu {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .cpill-id {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .cpill-cert {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .cpill-lang {
            background: var(--pink-bg);
            color: var(--pink-text);
        }

        /* ─── GRID ───────────────────────────────── */
        .sections-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        /* ─── CARD ───────────────────────────────── */
        .qual-card {
            background: var(--white);
            border-radius: var(--r-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .qual-card:hover {
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.10), 0 0 0 0.5px rgba(0, 0, 0, 0.07);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--g100);
            gap: 8px;
        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--r-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .icon-skills {
            background: var(--blue-bg);
            color: var(--blue-text);
        }

        .icon-work {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .icon-edu {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .icon-id {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .icon-cert {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .icon-lang {
            background: var(--pink-bg);
            color: var(--pink-text);
        }

        .card-title-wrap {}

        .card-title {
            font-size: 15.5px;
            font-weight: 600;
            color: var(--g900);
        }

        .card-count {
            font-size: 13.5px;
            color: var(--g400);
            margin-top: 1px;
        }

        .card-btns {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cbtn {
            width: 30px;
            height: 30px;
            border: 1px solid var(--border);
            border-radius: var(--r-md);
            background: var(--white);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12.5px;
            color: var(--g500);
            transition: var(--transition);
        }

        .cbtn:hover {
            background: var(--g100);
            color: var(--black);
            border-color: var(--g200);
        }

        .cbtn-add {
            background: #f5e602;
            border-color: #f5e602;
            color: var(--yellow-text);
        }

        .cbtn-add:hover {
            background: #04AA6D;
            border-color: #04AA6D;
            color: var(--white);
        }
        
        .cbtn-del-all {
            display: none;
            background: #FEF2F2;
            border-color: #FECACA;
            color: var(--danger);
        }

        .cbtn-del-all:hover {
            background: #FEE2E2;
        }

        /* ─── TABLE ──────────────────────────────── */
        .table-scroll {
            overflow-x: auto;
        }

        .qual-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .qual-table thead th {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--g400);
            text-transform: uppercase;
            letter-spacing: 0.55px;
            padding: 9px 14px;
            border-bottom: 1px solid var(--border);
            background: var(--g100);
            text-align: left;
            white-space: nowrap;
        }

        .qual-table thead th.th-cb {
            width: 34px;
            padding-left: 18px;
        }

        .qual-table thead th.th-act {
            text-align: right;
            padding-right: 16px;
        }

        .qual-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s;
        }

        .qual-table tbody tr:last-child {
            border-bottom: none;
        }

        .qual-table tbody tr:hover {
            background: var(--g050);
        }

        .qual-table tbody tr.row-selected {
            background: var(--yellow-pale) !important;
        }

        .qual-table tbody td {
            padding: 10px 14px;
            vertical-align: middle;
            color: var(--g900);
            font-weight: 400;
            font-size: 14px;
        }

        .qual-table tbody td.td-cb {
            padding-left: 18px;
            width: 34px;
        }

        .qual-table tbody td.td-act {
            text-align: right;
            padding-right: 14px;
        }

        input[type="checkbox"] {
            width: 14px;
            height: 14px;
            accent-color: var(--yellow);
            cursor: pointer;
        }

        .del-row-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: none;
            cursor: pointer;
            border-radius: var(--r-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12.5px;
            color: var(--g200);
            transition: var(--transition);
        }

        .del-row-btn:hover {
            background: #FEF2F2;
            color: var(--danger);
        }

        /* ─── EMPTY STATE ────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 28px 20px;
        }

        .empty-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--g100);
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--g200);
        }

        .empty-state p {
            font-size: 12.5px;
            color: var(--g400);
            font-style: italic;
        }

        /* ─── INLINE FORM ────────────────────────── */
        .inline-input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: 6px 9px;
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 12.5px;
            color: var(--black);
            background: var(--white);
            outline: none;
            transition: var(--transition);
        }

        .inline-input:focus {
            border-color: var(--yellow);
            box-shadow: 0 0 0 3px rgba(212, 192, 0, 0.14);
        }

        .inline-input.is-invalid {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(226, 75, 74, 0.12);
        }

        .save-cancel-row {
            display: flex;
            gap: 5px;
            justify-content: flex-end;
            flex-wrap: nowrap;
        }

        .btn-save {
            padding: 5px 13px;
            background: var(--yellow);
            color: var(--yellow-text);
            border: none;
            border-radius: var(--r-sm);
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-save:hover {
            background: var(--yellow-hover);
        }

        .btn-cancel {
            padding: 5px 11px;
            background: var(--g100);
            color: var(--g700);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .btn-cancel:hover {
            background: var(--g200);
        }

        /* ─── TOAST ──────────────────────────────── */
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

        /* ─── RESPONSIVE ─────────────────────────── */
        @media (max-width: 720px) {
            .sections-grid {
                grid-template-columns: 1fr;
            }

            .page-head h1 {
                font-size: 22px;
            }

            .topbar {
                padding: 0 16px;
            }

            .main {
                padding: 24px 14px 64px;
            }

            .category-pills {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .topbar-link {
                display: none;
            }
        }
    </style>
</head>

<body>


    <!-- ─── MAIN ───────────────────────────────────────────────── -->
    <div class="main">

        <!-- Back -->
        <a href="<?= base_url('profile'); ?>" class="back-link">
            <i class="fas fa-chevron-left"></i> Go to Profile
        </a>

        <!-- Page header -->
        <div class="page-head">
            <h1>Qualifications</h1>
            <p>We use these details to show you jobs that match your unique skills and experience.</p>
            <div class="category-pills">
                <span class="cpill cpill-skills">Skills</span>
                <span class="cpill cpill-work">Work Experience</span>
                <span class="cpill cpill-edu">Education</span>
                <span class="cpill cpill-id">Identification</span>
                <span class="cpill cpill-cert">Certifications</span>
                <span class="cpill cpill-lang">Languages</span>
            </div>
        </div>

        <?php
        $sections = [
            'skills' => [
                'label' => 'Skills',
                'icon' => 'fa-star',
                'iclass' => 'icon-skills',
                'fields' => ['skill_name'],
                'headers' => ['Skill Name'],
            ],
            'work_experience' => [
                'label' => 'Work Experience',
                'icon' => 'fa-briefcase',
                'iclass' => 'icon-work',
                'fields' => ['job_title', 'company_name'],
                'headers' => ['Job Title', 'Company'],
            ],
            'education' => [
                'label' => 'Education',
                'icon' => 'fa-graduation-cap',
                'iclass' => 'icon-edu',
                'fields' => ['school_name', 'degree'],
                'headers' => ['School / University', 'Degree'],
            ],
            'licenses' => [
                'label' => 'Identification Details',
                'icon' => 'fa-id-card',
                'iclass' => 'icon-id',
                'fields' => ['license_name'],
                'headers' => ['License / ID No.'],
            ],
            'certifications' => [
                'label' => 'Certifications',
                'icon' => 'fa-certificate',
                'iclass' => 'icon-cert',
                'fields' => ['cert_name'],
                'headers' => ['Certification Name'],
            ],
            'languages' => [
                'label' => 'Languages',
                'icon' => 'fa-language',
                'iclass' => 'icon-lang',
                'fields' => ['language_name'],
                'headers' => ['Language'],
            ],
        ];
        ?>

        <!-- Sections grid -->
        <div class="sections-grid">
            <?php foreach ($sections as $type => $meta):
                $items = $$type ?? [];
                $itemCount = count($items);
                $colSpan = count($meta['fields']) + 2;
                ?>
                <div class="qual-card" id="card-<?= $type ?>">

                    <!-- Card header -->
                    <div class="card-header">
                        <div class="card-header-left">
                            <div class="card-icon <?= $meta['iclass'] ?>">
                                <i class="fas <?= $meta['icon'] ?>"></i>
                            </div>
                            <div class="card-title-wrap">
                                <div class="card-title">
                                    <?= $meta['label'] ?>
                                </div>
                                <div class="card-count" id="count-<?= $type ?>">
                                    <?= $itemCount ?> item
                                    <?= $itemCount !== 1 ? 's' : '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-btns">
                            <button class="cbtn cbtn-select-all" data-type="<?= $type ?>" title="Select all">
                                <i class="fas fa-check-square"></i>
                            </button>
                            <button class="cbtn cbtn-del-all" id="delbtn-<?= $type ?>" data-type="<?= $type ?>"
                                title="Delete selected">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="cbtn cbtn-add" data-type="<?= $type ?>" title="Add new">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-scroll">
                        <table class="qual-table" id="table-<?= $type ?>">
                            <thead>
                                <tr>
                                    <th class="th-cb"></th>
                                    <?php foreach ($meta['headers'] as $h): ?>
                                        <th>
                                            <?= $h ?>
                                        </th>
                                    <?php endforeach; ?>
                                    <th class="th-act"></th>
                                </tr>
                            </thead>
                            <tbody id="<?= $type ?>-list">
                                <?php if (!empty($items)): ?>
                                    <?php foreach ($items as $item): ?>
                                        <tr data-id="<?= html_escape($item['id']) ?>">
                                            <td class="td-cb">
                                                <input type="checkbox" class="row-checkbox">
                                            </td>
                                            <?php foreach ($meta['fields'] as $field): ?>
                                                <td>
                                                    <?= html_escape($item[$field] ?? '') ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td class="td-act">
                                                <button class="del-row-btn" data-id="<?= html_escape($item['id']) ?>"
                                                    data-type="<?= $type ?>" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr id="empty-<?= $type ?>">
                                        <td colspan="<?= $colSpan ?>">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <i class="fas <?= $meta['icon'] ?>"></i>
                                                </div>
                                                <p>No
                                                    <?= strtolower($meta['label']) ?> added yet.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- /sections-grid -->
    </div><!-- /main -->

    <!-- ─── TOAST ──────────────────────────────────────────────── -->
    <div class="toast" id="toast">
        <div class="toast-dot dot-success" id="toast-dot"></div>
        <span id="toast-msg">Done!</span>
    </div>

    <!-- ─── SCRIPTS ────────────────────────────────────────────── -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {

            /* ── Section config (mirrors PHP) ── */
            const cfg = {
                skills: {
                    title: 'Skills',
                    fields: [{ n: 'skill_name', l: 'Skill Name', req: true }]
                },
                work_experience: {
                    title: 'Work Experience',
                    fields: [
                        { n: 'job_title', l: 'Job Title', req: true },
                        { n: 'company_name', l: 'Company', req: false }
                    ]
                },
                education: {
                    title: 'Education',
                    fields: [
                        { n: 'school_name', l: 'School / University', req: true },
                        { n: 'degree', l: 'Degree', req: false }
                    ]
                },
                licenses: {
                    title: 'Identification',
                    fields: [{ n: 'license_name', l: 'License / ID No.', req: true }]
                },
                certifications: {
                    title: 'Certifications',
                    fields: [{ n: 'cert_name', l: 'Certification Name', req: true }]
                },
                languages: {
                    title: 'Languages',
                    fields: [{ n: 'language_name', l: 'Language', req: true }]
                }
            };

            /* ── Toast ── */
            let toastTimer;
            function showToast(msg, type = 'success') {
                clearTimeout(toastTimer);
                $('#toast-msg').text(msg);
                $('#toast-dot').attr('class', 'toast-dot ' + (type === 'success' ? 'dot-success' : 'dot-error'));
                $('#toast').addClass('show');
                toastTimer = setTimeout(() => $('#toast').removeClass('show'), 3000);
            }

            /* ── HTML escape ── */
            function esc(s) {
                if (typeof s !== 'string') return s;
                return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
            }

            /* ── Update item count label ── */
            function updateCount(type) {
                const n = $(`#${type}-list tr[data-id]`).length;
                $(`#count-${type}`).text(n + ' item' + (n !== 1 ? 's' : ''));
            }

            /* ── Show / hide bulk-delete button ── */
            function updateBulkBtn(type) {
                const n = $(`#${type}-list .row-checkbox:checked`).length;
                $(`#delbtn-${type}`).toggle(n > 0);
            }

            /* ── Ensure empty-state row if tbody has no real rows ── */
            function ensureEmpty(type) {
                const $tbody = $(`#${type}-list`);
                const hasRows = $tbody.find('tr[data-id]').length > 0 || $tbody.find('.new-row').length > 0;
                if (!hasRows && !$tbody.find(`#empty-${type}`).length) {
                    const colspan = cfg[type].fields.length + 2;
                    $tbody.append(`
                <tr id="empty-${type}">
                    <td colspan="${colspan}">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                            <p>No ${type.replace(/_/g, ' ')} added yet.</p>
                        </div>
                    </td>
                </tr>`);
                }
            }

            /* ── Individual checkbox change ── */
            $(document).on('change', '.row-checkbox', function () {
                $(this).closest('tr').toggleClass('row-selected', this.checked);
                const type = $(this).closest('tbody').attr('id').replace('-list', '');
                updateBulkBtn(type);
            });

            /* ── Select-all button ── */
            $(document).on('click', '.cbtn-select-all', function () {
                const type = $(this).data('type');
                const $boxes = $(`#${type}-list .row-checkbox`);
                const allChecked = $boxes.length && $boxes.length === $boxes.filter(':checked').length;
                $boxes.prop('checked', !allChecked);
                $(`#${type}-list tr[data-id]`).toggleClass('row-selected', !allChecked);
                updateBulkBtn(type);
            });

            /* ── Add new row (inline) ── */
            $(document).on('click', '.cbtn-add', function () {
                const type = $(this).data('type');
                const $tbody = $(`#${type}-list`);
                $tbody.find(`#empty-${type}`).remove();

                let cells = `<td class="td-cb"><input type="checkbox" class="row-checkbox"></td>`;
                cfg[type].fields.forEach(f => {
                    cells += `<td>
                <input class="inline-input" name="${f.n}" placeholder="${f.l}${f.req ? ' *' : ''}">
                <input type="hidden" name="_type" value="${type}">
            </td>`;
                });
                cells += `<td class="td-act">
            <div class="save-cancel-row">
                <button class="btn-save"><i class="fas fa-check"></i> Save</button>
                <button class="btn-cancel"><i class="fas fa-times"></i></button>
            </div>
        </td>`;

                const $row = $(`<tr class="new-row">${cells}</tr>`);
                $tbody.append($row);
                $row.find('.inline-input').first().focus();
            });

            /* ── Save new row ── */
            $(document).on('click', '.btn-save', function () {
                const $row = $(this).closest('tr');
                const type = $row.find('input[name="_type"]').val();
                const section = cfg[type];
                let data = { type };
                let values = [];
                let valid = true;

                $row.find('.inline-input').each(function () {
                    const name = $(this).attr('name');
                    const val = $(this).val().trim();
                    data[name] = val;
                    const fld = section.fields.find(f => f.n === name);
                    if (fld && fld.req && !val) {
                        $(this).addClass('is-invalid');
                        valid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        values.push(val);
                    }
                });

                if (!valid) { showToast('Please fill in all required fields.', 'error'); return; }

                $.ajax({
                    url: '<?= base_url('profile/submit_qualification'); ?>',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success(r) {
                    if(r.success) {
                    let cells = `<td class="td-cb"><input type="checkbox" class="row-checkbox"></td>`;
                    values.forEach(v => cells += `<td>${esc(v)}</td>`);
                    cells += `<td class="td-act">
                        <button class="del-row-btn" data-id="${r.id}" data-type="${type}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>`;
                    $row.replaceWith(`<tr data-id="${r.id}">${cells}</tr>`);
                    updateCount(type);
                    showToast('Item added successfully!');
                } else {
                    showToast(r.message || 'Save failed.', 'error');
                }
            },
                error() { showToast('An error occurred during save.', 'error'); }
                });
            });

        /* ── Cancel new row ── */
        $(document).on('click', '.btn-cancel', function () {
            const $row = $(this).closest('tr');
            const type = $row.find('input[name="_type"]').val();
            $row.remove();
            ensureEmpty(type);
        });

        /* ── Delete single row ── */
        $(document).on('click', '.del-row-btn', function () {
            const id = $(this).data('id');
            const type = $(this).data('type');
            const $row = $(this).closest('tr');

            if (!confirm('Are you sure you want to delete this item?')) return;

            $.ajax({
                url: '<?= base_url('profile/delete_qualification'); ?>',
                type: 'POST',
                data: { id, type },
                dataType: 'json',
                success(r) {
                if(r.success) {
                $row.remove();
                updateCount(type);
                updateBulkBtn(type);
                ensureEmpty(type);
                showToast('Item deleted.');
            } else {
                showToast(r.message || 'Delete failed.', 'error');
            }
        },
            error() { showToast('An error occurred during deletion.', 'error'); }
                });
            });

        /* ── Bulk delete ── */
        $(document).on('click', '.cbtn-del-all', function () {
            const type = $(this).data('type');
            const $selRows = $(`#${type}-list tr.row-selected`);

            if (!$selRows.length) return;
            if (!confirm(`Delete ${$selRows.length} selected item(s)?`)) return;

            const items = [];
            $selRows.each(function () {
                items.push({ id: $(this).data('id'), type });
            });

            $.ajax({
                url: '<?= base_url('profile/delete_qualifications_batch'); ?>',
                type: 'POST',
                data: { items },
                dataType: 'json',
                success(r) {
                if(r.success) {
                $selRows.remove();
                updateCount(type);
                updateBulkBtn(type);
                ensureEmpty(type);
                showToast(`${items.length} item(s) deleted.`);
                $(`#delbtn-${type}`).hide();
            } else {
                showToast(r.message || 'Batch delete failed.', 'error');
            }
        },
            error() { showToast('An error occurred during batch deletion.', 'error'); }
                });
            });

        /* ── Init: ensure empty states on load ── */
        Object.keys(cfg).forEach(type => {
            updateCount(type);
            updateBulkBtn(type);
            ensureEmpty(type);
        });

        });
    </script>
</body>

</html>