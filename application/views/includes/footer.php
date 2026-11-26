<?php

$is_logged_in = $this->session->userdata('logged_in') ? true : false;

$mockInterviewUrl = $is_logged_in
    ? base_url('mock-interview')
    : base_url('?showLogin=true&redirect=mock-interview');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .custom-footer {
            font-family: 'Montserrat', Arial, sans-serif !important;
        }

        .footer-top-wrapper {
            position: relative;
            background: #FFF44F;
            overflow: hidden;

        }


        .footer-top-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 445px;
            height: 600px;
            background: #fffcbc;
            clip-path: polygon(0 0, 100% 0, 0 100%);
            z-index: 1;

        }


        .footer-top {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            gap: 140px;
            padding: 80px 120px 60px 120px;
        }



        .footer-logo-social {
            flex: 0 0 260px;
            display: flex;
            flex-direction: column;

        }

        .footer-logo img {
            width: 200px;
            margin-bottom: 30px;
            margin-left: 15px;

        }

        .footer-social {
            margin-left: 28px;
        }

        .footer-social-label {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 14px;
            color: #29374d;

        }

        .footer-social-icons a {
            margin-right: 8px;
            display: inline-block;
            /* background: #eef2f7; */
            border-radius: 6px;
            /* padding: 6px; */
            transition: .2s ease;
        }

        .footer-social-icons a:hover {
            /* box-shadow: 0 0 0 2px #dfe6ef; */
        }

        .footer-social-icons img {
            width: 22px;
            height: 22px;
        }


        .footer-links {
            display: flex;
            gap: 150px;
            flex: 0 1 auto;
            text-align: left;

        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            text-decoration: none;
            color: #1f2d3d;
            font-size: 16px;
            font-weight: 500;
            transition: .2s;
        }

        .footer-links a:hover {
            color: #000;
        }

        .footer-yellow {
            font-weight: 700;
        }



        .footer-bottom {
            background: #FFF44F;
            display: flex;
            justify-content: center;
            padding: 20px 0 30px 0;
        }

        .footer-text {
            font-size: 14px;
            color: #29374d;
        }



        @media(max-width:1400px) {

            .footer-top {
                padding: 70px 90px 50px 90px;
                gap: 110px;
            }

            .footer-links {
                gap: 150px;
            }

            .footer-logo-social {
                flex: 0 0 0px;
            }

        }

        @media(max-width:1200px) {

            .footer-top {
                padding: 60px 70px 45px 70px;
                gap: 80px;
            }

            .footer-links {
                gap: 70px;
            }

            .footer-top-wrapper::before {
                width: 360px;
            }

            .footer-logo-social {
                flex: 0 0 0px;
            }

        }

        @media(max-width:1024px) {

            .footer-top {
                flex-direction: column;
                gap: 50px;
                padding: 60px 50px 40px 50px;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 60px;
            }

            .footer-top-wrapper::before {
                width: 500px;
                height: 285px;

            }

            .footer-logo-social {
                flex: 0 0 0px;
            }

        }

        @media(max-width:768px) {

            .footer-top {
                align-items: center;
                text-align: center;
                padding: 55px 30px 35px 30px;
            }

            .footer-logo-social {
                align-items: center;
                flex: 0 0 0px;
            }

            .footer-links {
                flex-direction: column;
                align-items: center;
                gap: 25px;
            }

            .footer-links ul {
                width: 220px;
                text-align: left;
            }

            .footer-top-wrapper::before {
                width: 480px;
                height: 300px;
            }

            .footer-social-label {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 14px;
                color: #29374d;
                margin-left: -15px;
            }

        }

        @media(max-width:480px) {

            .footer-logo img {
                width: 180px;
            }

            .footer-links ul {
                width: 200px;
            }

            .footer-social-icons img {
                width: 20px;
                height: 20px;
            }

            .footer-text {
                font-size: 13px;
            }

            .footer-top-wrapper::before {
                width: 480px;
                height: 300px;
            }

        }

        .footer-social-icons i {
            font-size: 24px;
            margin-right: 12px;
        }

        .fa-facebook {
            color: #1877F2;
        }

        .fa-instagram {
            color: #E4405F;
        }

        .fa-instagram {
            background: radial-gradient(circle at 30% 107%,
                    #fdf497 0%, #fdf497 5%,
                    #fd5949 45%,
                    #d6249f 60%,
                    #285AEB 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

</head>

<body>

    <footer class="custom-footer">

        <div class="footer-top-wrapper">

            <div class="footer-top">

                <div class="footer-logo-social">

                    <a href="<?= base_url(); ?>" class="footer-logo">

                        <img src="<?= base_url('./ALL_UPLOADS/images/SahajJOB2.png'); ?>" alt="SahajJOB2">

                    </a>

                    <div class="footer-social">

                        <div class="footer-social-label">

                            Connect with us

                        </div>

                        <div class="footer-social-icons">

                            <a href="https://www.facebook.com/sahajjobs.developer" target="_blank" rel="noopener">
                                <i class="fa-brands fa-facebook"></i>
                            </a>

                            <a href="https://www.instagram.com/sahaj_jobs/" target="_blank"
                                rel="noopener">
                                <i class="fa-brands fa-instagram"></i>
                            </a>

                            <a href="https://www.linkedin.com/company/sahajjobs/" target="_blank" rel="noopener">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>

                        </div>

                    </div>

                </div>


                <div class="footer-links">

                    <ul>

                        <li><a href="<?= base_url('about-us'); ?>">About us</a></li>

                        <li><a href="<?= base_url('careers'); ?>">Careers</a></li>

                        <li><a href="<?= base_url('employer-home'); ?>">Employer home</a></li>

                        <li><a class="footer-yellow" href="" id="knowledgeBasedLink">Knowledge Base</a></li>

                    </ul>

                    <ul>

                        <li><a class="footer-yellow" href="<?= base_url('government-jobs'); ?>">Government Jobs</a></li>
                        
                        <li><a href="<?= $mockInterviewUrl ?>">Mock Interview</a></li>

                        <li><a href="<?= base_url('FAQ'); ?>">FAQ</a></li>

                        <li><a href="<?= base_url('report-issue'); ?>">Report issue</a></li>

                    </ul>

                    <ul>
                        <li><a href="<?= base_url('trust-safety'); ?>">Trust & safety</a></li>

                        <li><a href="<?= base_url('privacy-policy'); ?>">Privacy policy</a></li>

                        <li><a href="<?= base_url('cookie-policy'); ?>">Cookie Policy</a></li>

                        <li><a href="<?= base_url('terms-and-conditions'); ?>">Terms & conditions</a></li>

                    </ul>

                </div>

            </div>

        </div>


        <div class="footer-bottom">

            <div class="footer-text">

                All rights reserved © 2026 Sahajjobs.com

            </div>

        </div>

    </footer>


    <script>

        document.getElementById('knowledgeBasedLink').addEventListener('click', function (event) {

            event.preventDefault();

            window.location.href = '<?= base_url('blogs'); ?>';

        });

    </script>


    <?php if ($this->session->userdata('logged_in')): ?>

        <script>

            let inactivityTimer;

            const LOGOUT_URL = "<?= base_url('Candidate_jobsearch/logout'); ?>";

            function resetInactivityTimer() {

                clearTimeout(inactivityTimer);

                inactivityTimer = setTimeout(function () {

                    window.location.href = LOGOUT_URL;

                }, 100000);

            }

            window.onload = resetInactivityTimer;

            document.onmousemove = resetInactivityTimer;

            document.onkeydown = resetInactivityTimer;

            document.onclick = resetInactivityTimer;

            document.onscroll = resetInactivityTimer;

        </script>

    <?php endif; ?>


    <script>

        window.addEventListener('pageshow', function (event) {

            if (event.persisted) {

                window.location.reload();

            }

        });

    </script>

</body>

</html>