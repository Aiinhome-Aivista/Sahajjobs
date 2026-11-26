<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', Arial, sans-serif;
            background: #f4f6f9;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
            margin: 40px auto;
            max-width: 1300px;
        }

        .blog-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
            flex: 0 0 calc(33.333% - 25px);
            min-width: 280px;
            max-width: calc(33.333% - 25px);
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            overflow: hidden;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
        }

        .card-image-container {
            background: linear-gradient(135deg, #e4e4e3, #ffffff);
            padding: 25px;
            text-align: center;
            font-size: 17.5px;
            font-weight: 700;
            color: #b49d03;
            text-transform: uppercase;
        }

        .card-image-container img {
            height: 60px;
        }

        .card-content {
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .badge {
            display: inline-block;
            background: #f5e602;
            color: #333;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 8px;
            width: fit-content;
            font-weight: 600;
        }

        .category {
            font-size: 12px;
            font-weight: 700;
            color: #b49d03;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .meta {
            font-size: 13px;
            color: #555;
            margin-bottom: 10px;
        }

        .job-info {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .job-info span {
            display: block;
        }

        .read-more {
            margin-top: auto;
            background-color: #f5e602;
            color: #333;
            padding: 10px;
            text-align: center;
            border-radius: 6px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.3s;
        }

        .read-more:hover {
            background-color: #e6cf4d;
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .pagination button {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: #fff;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .pagination button:hover:not(:disabled) {
            background: #efda56;
        }

        .pagination button:disabled {
            background: #f1f1f1;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination button.active {
            background: #e6cf4d;
            color: #333;
            border-color: #e6cf4d;
        }

        .page-info {
            font-size: 13px;
            color: #666;
            margin-left: 10px;
        }

        @media (max-width: 992px) {
            .blog-card {
                flex: 0 0 calc(50% - 25px);
                max-width: calc(50% - 25px);
            }
        }

        @media (max-width: 600px) {
            .blog-card {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }


        .page-govt-dropdown {
            max-width: 170px;
            margin: 29px 40px;
            padding: 0 15px;
            position: relative;
            border: 1px solid #a8a8a8;
            text-align: left;
            border-radius: 20px;
        }

        .page-govt-toggle {
            font-size: 16px;
            font-weight: 700;
            color: #27365c;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .page-govt-menu {
            display: none;
            position: absolute;
            top: 38px;
            left: 0;
            min-width: 220px;
            max-height: 280px;
            overflow-y: auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .1);
            padding: 10px 0;
            z-index: 99;
        }

        .page-govt-menu a {
            display: block;
            padding: 10px 18px;
            font-size: 15px;
            color: #27365c;
            text-decoration: none;
        }

        .page-govt-menu a:hover,
        .page-govt-menu a.active {
            background: #FFF44F;
            font-weight: 700;
            color: #000;
        }

        .page-govt-dropdown.active .page-govt-menu {
            display: block;
        }

        .page-govt-dropdown.active .caret {
            transform: rotate(-135deg);
        }

        .caret {
            padding: 2px !important;
            margin-top: 0px !important;
        }

        .page-govt-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 29px 40px;
        }

        .filter-label {
            font-size: 15px;
            font-weight: 700;
            color: #27365c;
            white-space: nowrap;
        }

        .page-govt-dropdown {
            margin: 0;
        }
    </style>
</head>

<body>

    <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
        <div class="page-govt-wrapper">
            <span class="filter-label">Filter by Country</span>

            <div class="page-govt-dropdown" id="pageGovtDropdown">
                <a href="javascript:void(0)" class="page-govt-toggle" id="pageGovtToggle">
                    <span id="selectedCountry">All</span>
                    <span class="caret"></span>
                </a>
                <div class="page-govt-menu" id="pageGovtMenu"></div>
            </div>
        </div>

    <?php endif; ?>



    <div class="card-container" id="jobCardContainer">

        <?php if (!empty($jobs)): ?>
            <?php foreach ($jobs as $job): ?>

                <div class="blog-card">

                    <div class="card-image-container">
                        <?= htmlspecialchars($job->department); ?>
                    </div>

                    <div class="card-content">

                        <span class="badge">
                            <?= ucfirst($job->job_type); ?>
                        </span>


                        <div class="meta">
                            <?= htmlspecialchars($job->organization); ?>, <?= htmlspecialchars($job->country); ?>
                        </div>

                        <h2 class="title">
                            <?= htmlspecialchars($job->title); ?>
                        </h2>

                        <div class="job-info">
                            <span><strong>Vacancies:</strong>
                                <?= $job->total_vacancies ?? 'N/A'; ?>
                            </span>
                            <span><strong>Last Date:</strong>
                                <?= !empty($job->application_end_date)
                                    ? date('d M Y', strtotime($job->application_end_date))
                                    : 'Not Announced'; ?>
                            </span>
                        </div>

                        <a href="<?= base_url('admin/govt_jobs_details/index/' . $job->id); ?>" class="read-more">
                            View Details
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div style="width:100%;text-align:center;padding:40px;">
                <p>No government jobs available.</p>
            </div>
        <?php endif; ?>

    </div>

    <script>
        const isLoggedIn = <?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? 'true' : 'false'; ?>;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const cardContainer = document.getElementById('jobCardContainer');
            const paginationControls = document.createElement('div');
            paginationControls.className = 'pagination';
            paginationControls.innerHTML = `
        <button id="firstPage">First</button>
        <button id="prevPage">Prev</button>
        <span id="pageNumbers"></span>
        <button id="nextPage">Next</button>
        <button id="lastPage">Last</button>
        <span class="page-info" id="pageInfo"></span>
    `;
            cardContainer.after(paginationControls);

            const firstPageBtn = document.getElementById('firstPage');
            const prevPageBtn = document.getElementById('prevPage');
            const nextPageBtn = document.getElementById('nextPage');
            const lastPageBtn = document.getElementById('lastPage');
            const pageNumbers = document.getElementById('pageNumbers');
            const pageInfo = document.getElementById('pageInfo');

            const allCards = Array.from(cardContainer.querySelectorAll('.blog-card'));
            let currentPage = 1;
            const cardsPerPage = 6;

            if (allCards.length === 0) {
                paginationControls.style.display = 'none';
                return;
            }

            function updatePagination() {
                const totalPages = Math.ceil(allCards.length / cardsPerPage);

                firstPageBtn.disabled = currentPage === 1;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage === totalPages;
                lastPageBtn.disabled = currentPage === totalPages;

                pageNumbers.innerHTML = '';

                const maxVisiblePages = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;

                    if (i === currentPage) {
                        btn.classList.add('active');
                    }

                    btn.addEventListener('click', () => goToPage(i));
                    pageNumbers.appendChild(btn);
                }

                const startItem = (currentPage - 1) * cardsPerPage + 1;
                const endItem = Math.min(currentPage * cardsPerPage, allCards.length);
                pageInfo.textContent = `Showing ${startItem}-${endItem} of ${allCards.length} jobs`;

                displayCurrentPage();
            }

            function displayCurrentPage() {
                allCards.forEach(card => card.style.display = 'none');
                const start = (currentPage - 1) * cardsPerPage;
                const end = start + cardsPerPage;
                allCards.slice(start, end).forEach(card => card.style.display = 'flex');
            }

            function goToPage(page) {
                currentPage = page;
                updatePagination();
            }

            firstPageBtn.onclick = () => goToPage(1);
            prevPageBtn.onclick = () => goToPage(currentPage - 1);
            nextPageBtn.onclick = () => goToPage(currentPage + 1);
            lastPageBtn.onclick = () => goToPage(Math.ceil(allCards.length / cardsPerPage));

            updatePagination();
        });
    </script>

    <script>
        // document.addEventListener('DOMContentLoaded', function () {

        //     const isLoggedIn = <?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true ? 'true' : 'false'; ?>;

        //     document.querySelectorAll('.read-more').forEach(link => {
        //         link.addEventListener('click', function (e) {

        //             if (!isLoggedIn) {
        //                 e.preventDefault();


        //                 const articleUrl = this.href;
        //                 sessionStorage.setItem('redirectAfterLogin', articleUrl);


        //                 const redirectInput = document.getElementById('redirect_url');
        //                 if (redirectInput) {
        //                     redirectInput.value = articleUrl;
        //                 }

        //                 const loginPopupBg = document.getElementById('loginPopupBg');
        //                 if (loginPopupBg) {
        //                     loginPopupBg.style.display = 'flex';
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const dropdown = document.getElementById("pageGovtDropdown");
            if (!dropdown) return;

            const toggle = document.getElementById("pageGovtToggle");
            const menu = document.getElementById("pageGovtMenu");

            const currentCountry = new URLSearchParams(window.location.search).get("country");

            const countries = [
                "All",
                "Afghanistan",
                "Australia",
                "Bangladesh",
                "Brazil",
                "Canada",
                "China",
                "France",
                "Germany",
                "India",
                "Indonesia",
                "Italy",
                "Japan",
                "Mexico",
                "Nepal",
                "Pakistan",
                "Russia",
                "Saudi Arabia",
                "South Africa",
                "Sri Lanka",
                "United Kingdom",
                "United States"
            ];

            menu.innerHTML = "";

            countries.forEach(country => {
                const countryParam =
                    country === "All" ? "" : `?country=${encodeURIComponent(country)}`;

                const isActive =
                    (!currentCountry && country === "All") ||
                    (currentCountry === country);

                menu.innerHTML += `
      <a href="<?= base_url('government-jobs'); ?>${countryParam}"
         class="${isActive ? 'active' : ''}">
        ${country}
      </a>
    `;
            });

            const selectedCountryEl = document.getElementById("selectedCountry");

            if (currentCountry) {
                selectedCountryEl.textContent = currentCountry;
            } else {
                selectedCountryEl.textContent = "All";
            }


            toggle.addEventListener("click", e => {
                e.stopPropagation();
                dropdown.classList.toggle("active");

                if (dropdown.classList.contains("active")) {
                    setTimeout(() => {
                        const activeItem = menu.querySelector("a.active");
                        if (activeItem) {
                            menu.scrollTop =
                                activeItem.offsetTop -
                                menu.clientHeight / 2 +
                                activeItem.clientHeight / 2;
                        }
                    }, 30);
                }
            });

            document.addEventListener("click", e => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove("active");
                }
            });

        });
    </script>



</body>

</html>