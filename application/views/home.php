<?php

$is_logged_in = $this->session->userdata('logged_in') ? true : false;
$user_role = $this->session->userdata('user_role');

$job_search_base = ($is_logged_in && $user_role === 'candidate')
    ? 'candidate_job_search'
    : 'job_search';
    
$mockInterviewUrl = $is_logged_in
    ? base_url('mock-interview')
    : base_url('?showLogin=true&redirect=mock-interview');

?>

<!--
<!DOCTYPE html>

<html lang="en">

<head>
-->

     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4658394539738219"
     crossorigin="anonymous"></script>

<!-- Preload the hero image (LCP) so the browser starts downloading it immediately -->
    <link rel="preload" as="image" href="./ALL_UPLOADS/images/SahajLanding1-1280.webp" type="image/webp"
        media="(max-width: 768px)" fetchpriority="high">
    <link rel="preload" as="image" href="./ALL_UPLOADS/images/SahajLanding1-1920.webp" type="image/webp"
        media="(min-width: 769px)" fetchpriority="high">

    <link rel="icon" type="image/x-icon" href="https://sahajjobs.com/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <style>
        body {

            font-family: 'Nunito', Arial, sans-serif;

            background-color: #f8f9fa;

        }



        .search-bar-container .form-control,

        .select-experience,

        .search-bar-container .btn-primary,

        .custom-footer {

            font-family: 'Nunito', Arial, sans-serif !important;

        }



        .form-control:focus {

            border-color: #FFC107;

            box-shadow: none;

            outline: none;

        }



        .hero-section {

            padding: 0px 0;

            text-align: center;

        }



        .hero-section h1 {
            font-size: 2.8rem;
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 1px 1px 0 black, -1px 1px 0 black, 1px -1px 0 black, -1px -1px 0 black;
            -webkit-text-stroke: 0.6px white;
        }

        .hero-section h2 {
            font-size: 2.6rem;
            color: black;
        }



        .hero-section p {

            color: #000000ff;

            font-size: 1.1rem;

            margin-bottom: 30px;
            
            text-align: center;

        }



        .select-experience {

            background: transparent;

            border: none;

            font-size: 1rem;

            color: #222;

            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;

            font-weight: 400;

            cursor: pointer;

            transition: color 0.2s;

        }



        .select-experience:focus {

            outline: none;

            color: #222;

        }



        .resume-section {

            background: linear-gradient(to right, #00c6ff, #0072ff);

            border-radius: 12px;

            padding: 30px;

            color: #fff;

            max-width: 100%;

            margin: 0 auto;

            display: flex;

            flex-wrap: wrap;

            justify-content: space-between;

            align-items: center;

            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);

            position: relative;

            overflow: hidden;

        }



        .resume-section h2 {

            font-size: 1.6rem;

            font-weight: bold;

            margin-bottom: 10px;

        }



        .resume-section p {

            font-size: 1rem;

            margin-bottom: 20px;

        }



        .resume-section .btn-light {

            background-color: #fff;

            color: #0072ff;

            border: none;

            padding: 10px 25px;

            border-radius: 6px;

            font-weight: bold;

            font-size: 1rem;

            transition: all 0.3s ease;

        }



        .resume-section .btn-light:hover {

            background-color: #f0f0f0;

            color: #0056b3;

        }



        .tagline-image {

            max-width: 100%;

            margin: 20px auto;

            text-align: center;

        }



        .tagline-image img {

            max-width: 76%;

            height: auto;

            border-radius: 12px;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

        }



        .job-categories {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));

            gap: 15px;

            justify-content: center;

            margin: 30px auto;

            max-width: 1000px;

        }



        .category-card {

            display: flex;

            align-items: center;

            gap: 10px;

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 15px;

            font-size: 14px;

            font-weight: 500;

            color: #111827;

            cursor: pointer;

            transition: all 0.2s ease-in-out;

            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);

        }



        .category-card i {

            font-size: 16px;

            color: #374151;

        }



        .category-card .arrow {

            margin-left: auto;

            font-size: 12px;

            color: #9ca3af;

        }



        .category-card:hover {

            background: #f9fafb;

            transform: translateY(-2px);

        }



        .company-card {

            min-width: 220px;

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 20px;

            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);

            text-align: center;

            flex: 1;

        }



        .company-card img {

            height: 45px;

            border-radius: 7px;

            background: #f9fafb;

            padding: 4px;

        }



        .companies-wrapper {

            display: flex;

            flex-wrap: wrap;

            gap: 15px;

            justify-content: center;

        }



        .featured-companies {

            margin-top: 60px;

            text-align: center;

        }



        .featured-wrapper {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));

            gap: 20px;

            justify-content: center;

        }



        .featured-card {

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 20px;

            text-align: center;

            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);

            transition: all 0.2s ease-in-out;

        }



        .featured-card img {

            height: 40px;

            margin-bottom: 12px;

        }



        .featured-card h5 {

            font-size: 15px;

            font-weight: 600;

            margin-bottom: 6px;

        }



        .featured-card p {

            font-size: 13px;

            color: #6b7280;

            margin-bottom: 10px;

            min-height: 36px;

        }



        .featured-rating {

            font-size: 13px;

            margin-bottom: 6px;

            color: #333;

        }



        .view-all-btn {

            border-radius: 999px;

            padding: 10px 20px;

            font-size: 15px;

            font-weight: 500;

            color: #050203;

            border: 1.8px solid #FFF44F;

            background: #fff;

            transition: all 0.2s ease;

        }



        .view-all-btn:hover {

            background: #FFF44F;

            color: #050203;


        }



        .siemens-banner {

            background: transparent;

            border-radius: 12px;

            overflow: hidden;

            max-width: 100%;

            margin: 30px auto;

            height: auto;

            display: flex;

            flex-direction: column;

        }



        .banner-right {

            position: relative;

            width: 100%;

        }



        .banner-image {

            width: 80%;

            height: 60%;

            object-fit: cover;

        }



        .error-outline {

            border: 1px solid #d32f2f;

            border-radius: 50px;

        }



        .modal-success .modal-title {

            color: #155724;

        }





        .modal-success {

            border-left: 4px solid #28a745;

        }



        .modal-error .modal-title {

            color: #721c24;

        }



        .modal-error {

            border-left: 4px solid #dc3545;

        }



        @media (max-width: 576px) {

            .hero-section h1 {

                font-size: 1.8rem;

            }



            .hero-section p {

                font-size: 0.95rem;

            }



            .company-card {

                flex: 1 1 100%;

            }



            .companies-wrapper {

                flex-direction: column;

                align-items: center;

            }

        }



        /* Make search bar auto-adjust */

        .search-bar-top {

            background: #fff;

            border-radius: 999px;

            width: 100%;

            max-width: 700px;

            margin: 0 auto;

            padding: 10px 25px;

            opacity: 0.8;

        }





        .search-bar-top .input-group-text {

            background-color: transparent;

            border: none;

            color: #8893b3;

            font-size: 1.3rem;

            padding-right: 12px;

            padding-left: 0;

            display: flex;

            align-items: center;

        }



        .search-bar-top .form-control {

            background: transparent;

            border: none;

            box-shadow: none;

            padding-left: 0;

            padding-right: 15px;

            font-size: 1.1rem;

            color: #222;

            font-family: 'Nunito', Arial, sans-serif !important;

            font-weight: 400;

            transition: color 0.2s;

        }





        .search-bar-top .input-group {

            width: 100%;

        }



        /* Input grows with screen */

        .search-bar-top .form-control {

            flex: 1 1 auto;

            min-width: 0;

        }



        /* Hide search icon on small screens */

        @media (max-width: 576px) {

            .search-bar-top .input-group-text {

                display: none;

            }

        }



        .job-categories a {

            text-decoration: none;

            color: inherit;

        }



        .job-categories a:hover {

            text-decoration: none;

            color: inherit;

        }


        .testimonial-main-wrapper {
            background: linear-gradient(135deg, #FFF44F, #ffffff);
            border-radius: 12px;
            color: #000;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .testimonial-main-wrapper-img {
            margin-left: 0rem;
        }
        
        .testimonial-section {
            gap: 1rem;
        }
        /*.testimonial-section > [class*="col-"]{*/
        /*    display:flex;*/
        /*}*/
        
        /*.testimonial-main-wrapper,*/
        /*.testimonial-main-wrapper-img{*/
        /*    flex:1;*/
        /*    height:100%;*/
        /*}*/

        .quote-circle {
            transform: translate(105px, -85px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
            background-color: white;
            border-radius: 50%;
            height: 80px;
            width: 90px;
            margin-top: 20px;
        }

        .big-quote {
            font-size: 70px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .left-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .left-desc {
            font-size: 15px;
            text-align: justify;
        }

        /* Card: use flex-basis calc so 3 cards fit exactly with gap */
        .t-card {
            background: white;
            color: #222;
            border-radius: 12px;
            padding: 20px;
            flex: 0 0 calc((100% - 40px) / 10);
            min-height: 250px;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-sizing: border-box;
        }

        .t-card:hover {
            transform: scale(1.05);
            z-index: 10;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .t-card.center {
            transform: scale(1.06);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.2);
        }

        .t-card .t-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #FFF44F;
            align-self: center;
        }

        .t-review {
            margin-top: 14px;
            font-size: 14px;
            text-align: justify;
            line-height: 1.5;
        }

        .t-name {
            font-weight: bold;
            margin-top: 12px;
            text-align: left;
        }

        .t-role {
            font-size: 13px;
            color: gray;
            text-align: left;
            font-weight: bold;
            display: flex;
        }

        /* Buttons */
        .t-btn {
            position: absolute;
            top: 45%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            background: #fff;
            cursor: pointer;
            z-index: 20;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .t-btn:hover {
            background: #FFF44F;
        }

        /* Dots */
        .t-dots {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-top: 15px;
        }

        .t-dot {
            width: 10px;
            height: 10px;
            background: #ffffff70;
            border: 2px solid #000;
            border-radius: 50%;
            cursor: pointer;
            box-sizing: border-box;
        }

        .t-dot.active {
            background: #000;
        }


        @media (max-width: 1200px) {
            .t-card {
                min-height: 220px;
                padding: 16px;
            }

            .testimonial-flex {
                align-items: center;
                flex-wrap: wrap;
            }

            .quote-circle {
                transform: translate(105px, -85px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
                background-color: white;
                border-radius: 50%;
                height: 80px;
                width: 90px;
            }

            .big-quote {
                font-size: 70px;
                font-weight: bold;
                margin-bottom: 10px;
            }
        }


        @media (max-width: 1000px) {
            .t-card {
                min-height: 220px;
                padding: 16px;
            }

            .testimonial-flex {
                align-items: center;
                flex-wrap: wrap;
            }

            .quote-circle {
                transform: translate(105px, -200px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
                background-color: white;
                border-radius: 50%;
                height: 80px;
                width: 90px;
                margin-top: 120px;
            }

            .big-quote {
                font-size: 70px;
                font-weight: bold;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 800px) {
            .t-card {
                min-height: 220px;
                padding: 16px;
            }

            .testimonial-flex {
                align-items: center;
                flex-wrap: wrap;
            }

            .quote-circle {
                transform: translate(105px, -200px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
                background-color: white;
                border-radius: 50%;
                height: 80px;
                width: 90px;
                margin-top: 120px;
            }

            .big-quote {
                font-size: 70px;
                font-weight: bold;
                margin-bottom: 10px;
            }
        }
        
         @media (max-width: 768px) {
            .quote-circle {
                transform: translate(105px, -200px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
                background-color: white;
                border-radius: 50%;
                height: 80px;
                width: 90px;
                margin-top: 100px;
            }
        }

        @media (max-width: 600px) {
            .testimonial-flex {
                align-items: center;
                flex-wrap: wrap;
                gap: 20px;
            }

            .t-card {
                min-height: 210px;
                padding: 16px;
            }

            .quote-circle {
                transform: translate(85px, -85px);
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
                background-color: white;
                border-radius: 50%;
                height: 80px;
                width: 90px;
                margin-top: 0px;
            }

            .big-quote {
                font-size: 70px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .left-title {
                font-size: 22px;
            }

            .testimonial-left {
                margin-bottom: 20px;
            }
            
            .testimonial-section {
                gap: 1rem;
            }
            
            .testimonial-main-wrapper-img {
                margin-left: 0rem;
            }
            /*.testimonial-section > [class*="col-"]{*/
            /*    display:flex;*/
                
            /*}*/
            
            /*.testimonial-main-wrapper,*/
            /*.testimonial-main-wrapper-img{*/
            /*    flex:1;*/
            /*    height:100%;*/
            /*}*/

        }

        .companies-slide-row {
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: stretch;
            flex-wrap: nowrap;
        }

        .topjobs-slide-row {
            display: flex;
            gap: 1rem;
            justify-content: center;
            align-items: stretch;
            flex-wrap: nowrap;
            width: 100%;
        }


        .company-card {
            box-sizing: border-box;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
            text-align: center;
            max-width: 24% !important;
        }

        .company-card img {
            max-width: 70px;
            display: inline-block;
            margin: 0.25rem;
        }

        .company-card h5 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .jobsactive .carousel-inner {
            height: 250px !important;
        }


        #topCompaniesCarousel .carousel-control-prev,
        #topCompaniesCarousel .carousel-control-next {
            width: auto;
            padding: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        #topCompaniesCarousel .carousel-control-prev {
            left: -25px;
        }

        #topCompaniesCarousel .carousel-control-next {
            right: -25px;
        }

        /* Styling the buttons */
        #topCompaniesCarousel .carousel-control-prev-icon,
        #topCompaniesCarousel .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            padding: 15px;
            background-size: 50% 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease-in-out;
        }

        /* Hover effect */
        #topCompaniesCarousel .carousel-control-prev-icon:hover,
        #topCompaniesCarousel .carousel-control-next-icon:hover {
            background-color: #000;
            transform: scale(1.1);
        }

        /* Positioning the indicators */
        #topCompaniesCarousel .carousel-indicators {
            bottom: -60px;
        }

        /* Indicator dots */
        #topCompaniesCarousel .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            background-color: #d0d0d0;
            border-radius: 50%;
            margin: 0 5px;
            opacity: 1;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Active indicator */
        #topCompaniesCarousel .carousel-indicators .active {
            background-color: #000;
        }

        /* Hover effect */
        #topCompaniesCarousel .carousel-indicators [data-bs-target]:hover {
            background-color: #444;
        }

        .extra-gap-below {
            margin-bottom: 100px !important;
        }




        .job-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(9, 30, 66, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 18px;
            box-sizing: border-box;
            width: 100%;
            flex: 0 0 24% !important;
        }



        .job-card-body {
            text-align: left;
        }

        .job-title {
            margin: 0 0 6px 0;
            font-size: 1.05rem;
            font-weight: 700;
            color: #111827;
        }

        .job-company {
            font-size: 0.95rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .job-meta {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
        }

        .meta-item {
            display: inline-flex;
            gap: 6px;
            align-items: center;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .meta-item .icon {
            display: inline-block;
            vertical-align: middle;
            color: #6b7280;
        }

        .job-salary {
            font-weight: 700;
            color: #6b7280;
            margin-top: 6px;
        }

        .job-action {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-apply {
            background: #FFF44F;
            border: none;
            padding: 4px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            color: #29374d;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-apply:hover {
            background: #ffe53b;
        }



        @media (max-width: 576px) {
            #topJobsCarousel .carousel-control-prev {
                left: -20px;
            }

            #topJobsCarousel .carousel-control-next {
                right: -20px;
            }

            .topjobs-slide-row {
                display: flex;
                gap: 1rem;
                justify-content: center;
                align-items: stretch;
                flex-wrap: nowrap;
                width: 100%;
            }
        }


        #topJobsCarousel .carousel-control-prev,
        #topJobsCarousel .carousel-control-next {
            width: auto;
            padding: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        #topJobsCarousel .carousel-control-prev {
            left: -25px;
        }

        #topJobsCarousel .carousel-control-next {
            right: -25px;
        }

        /* Styling the buttons */
        #topJobsCarousel .carousel-control-prev-icon,
        #topJobsCarousel .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            padding: 15px;
            background-size: 50% 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: 0.3s ease-in-out;
        }

        /* Hover effect */
        #topJobsCarousel .carousel-control-prev-icon:hover,
        #topJobsCarousel .carousel-control-next-icon:hover {
            background-color: #000;
            transform: scale(1.1);
        }

        /* Positioning the indicators */
        #topJobsCarousel .carousel-indicators {
            bottom: -60px;
        }

        /* Indicator dots */
        #topJobsCarousel .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            background-color: #d0d0d0;
            border-radius: 50%;
            margin: 0 5px;
            opacity: 1;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Active indicator */
        #topJobsCarousel .carousel-indicators .active {
            background-color: #000;
        }

        /* Hover effect */
        #topJobsCarousel .carousel-indicators [data-bs-target]:hover {
            background-color: #444;
        }

        /* Layout */
        .testimonial-left-col {
            display: flex;
            flex-direction: column;
            /* gap: 20px; */
        }

        .testimonial-right-col {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Image Grid (70%) */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            width: 100%;
        }


        .image-grid img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .image-grid a {
            display: block;
            cursor: pointer;
        }

        .image-grid a:hover img {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Vertical Carousel */
        .testimonial-vertical {
            overflow: hidden;
            height: 320px;
            position: relative;
        }

        .t-vertical-track {
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: max-content;
            animation: horizontalScroll 30s linear infinite;
        }

        .t-vertical-track:hover {
            animation-play-state: paused;
        }

        @keyframes horizontalScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }


        .t-card.vertical {
            width: 125px;
            min-height: 160px;
            min-width: 125px;
            flex-shrink: 0;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .image-grid {
                grid-template-columns: 1fr;
            }

            .testimonial-vertical {
                overflow: hidden;
                height: 290px;
                position: relative;
            }

            .t-vertical-track {
                display: flex;
                flex-direction: row;
                gap: 20px;
                width: max-content;
                animation: horizontalScroll 30s linear infinite;
            }

            .t-vertical-track:hover {
                animation-play-state: paused;
            }

           .t-card.vertical {
                width: 125px;
                min-height: 160px;
                min-width: 125px;
                flex-shrink: 0;
            }
        }
        
        .active-jobs-btn{
            text-decoration: none;
            color: #050203;
        }
        
        .neon-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
            font-family: 'Arial', sans-serif;
        }

        .neon-text {
            font-size: 4rem;
            color: #fff;
            text-shadow:
                0 0 5px #FFF44F,
                0 0 10px #FFF44F,
                0 0 20px #FFF44F,
                0 0 40px #FFF44F,
                0 0 80px #FFF44F;
            animation: glow 1.5s infinite alternate;
        }

        @keyframes glow {
            0% {
                text-shadow:
                    0 0 5px #FFF44F,
                    0 0 10px #FFF44F,
                    0 0 20px #FFF44F,
                    0 0 40px #FFF44F,
                    0 0 80px #FFF44F;
            }

            100% {
                text-shadow:
                    0 0 10px #00d4ff,
                    0 0 20px #00d4ff,
                    0 0 40px #00d4ff,
                    0 0 80px #00d4ff,
                    0 0 160px #00d4ff;
            }
        }
        
        .hero-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .hero-links a {
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Normal link */
        .hero-normal {
            color: #000000ff;
        }

        /* Neon glow links */
        .hero-neon {
            color: #000000ff;
            text-shadow:
                0 0 5px #FFF44F,
                0 0 10px #FFF44F,
                0 0 20px #FFF44F,
                0 0 40px #FFF44F;
            animation: heroGlow 1.5s infinite alternate;
        }

        /* Glow animation */
        @keyframes heroGlow {
            from {
                text-shadow:
                    0 0 5px #ffee00,
                    0 0 10px #ffee00,
                    0 0 20px #ffee00,
                    0 0 40px #ffee00;
            }

            to {
                text-shadow:
                    0 0 10px #fcf192,
                    0 0 20px #fcf192,
                    0 0 40px #fcf192,
                    0 0 80px #fcf192;
            }
        }

        /* Mobile */
        @media (max-width: 576px) {
            .hero-links {
                font-size: 0.7rem;
            }
        }



        .banner-video {
            width: 79%;
            height: 79%;
            object-fit: cover;
        }

        .banner-mobile-img {
            display: none;
            width: 100%;
            height: auto;
            border-radius: 12px;
        }

        @media (max-width: 768px) {

            .banner-video {
                display: none;
            }

            .banner-mobile-img {
                display: block;
            }

        }
        
        .company-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
         /* Resume Banner Section (new) */
        .resume-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
            padding: 50px;
            background: #f5f7fb;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .resume-left {
            width: 50%;
        }

        .resume-left img {
            width: 100%;
            max-width: 600px;
            height: auto;
        }

        .resume-right {
            width: 50%;
        }

        .resume-right h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .resume-right p {
            color: #555;
            margin-bottom: 15px;
            text-align: justify;
        }

        .resume-right a {
            color: teal;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }

        .resume-right a:hover {
            text-decoration: underline;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .resume-banner {
                flex-direction: column;
                text-align: center;
            }

            .resume-left,
            .resume-right {
                width: 100%;
            }
        }

        /* Stats Section */
        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            text-align: center;
            flex-wrap: wrap;
        }

        .stat-box {
            flex: 1;
            background: #f9fafb;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .stat-box h2 {
            font-size: 32px;
            font-weight: bold;
            color: teal;
            margin-bottom: 10px;
        }

        .stat-box p {
            font-size: 16px;
            color: #555;
        }

        .hero-section h3 {
            font-size: 2.1rem;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
            }

            .hero-section h3 {
                font-size: 1.6rem;
            }
        }
        
        
        /* ===== Mock Interview Promo Banner ===== */
        .mock-promo-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            padding: 40px 45px;
            border-radius: 16px;
            background: linear-gradient(120deg, #10182b 0%, #27365c 45%, #c99a00 85%, #FFF44F 100%);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.18);
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .mock-promo-icon {
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mock-promo-icon i {
            font-size: 28px;
            color: #FFF44F;
        }

        .mock-promo-text-group {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
            min-width: 260px;
        }

        .mock-promo-banner h3 {
            font-size: 1.7rem;
            font-weight: 800;
            margin: 0 0 6px 0;
            color: #fff;
        }

        .mock-promo-banner p {
            font-size: 0.98rem;
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
            max-width: 560px;
        }

        .mock-promo-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #FFF44F;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 12px;
            border-radius: 30px;
            margin-bottom: 10px;
        }

        .mock-promo-btn {
            background: #FFF44F;
            color: #050203;
            border: none;
            border-radius: 999px;
            padding: 13px 28px;
            font-size: 15px;
            font-weight: 700;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .mock-promo-btn:hover {
            background: #ffe53b;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .mock-promo-banner {
                flex-direction: column;
                text-align: center;
                padding: 30px 24px;
            }

            .mock-promo-text-group {
                flex-direction: column;
                text-align: center;
            }

            .mock-promo-banner p {
                max-width: 100%;
            }

            .mock-promo-btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        .hero-link-wrapper {
            position: relative;
            display: inline-block;
        }

        .new-badge {
            position: absolute;
            top: -10px;
            right: -30px;
            background: #ff1744;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 10px;
            text-transform: uppercase;
            animation: blinkBadge 1s infinite;
            box-shadow: 0 0 8px #ff1744;
            z-index: 2;
        }

        @keyframes blinkBadge {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.3;
                transform: scale(1.15);
            }
        }
        
         #jobs-carousel-indicators {
            display: none !important;
        }

        /* Hero background: optimized WebP (desktop 1920px, mobile 1280px). Original: SahajLanding1.jpeg (1 MB) */
        .hero-section .hero-bg {
            background-image: url('./ALL_UPLOADS/images/SahajLanding1-1920.webp');
        }

        @media (max-width: 768px) {
            .hero-section .hero-bg {
                background-image: url('./ALL_UPLOADS/images/SahajLanding1-1280.webp');
            }
        }

    </style>

<!--
</head>

<body>
-->

    <!-- Hero Section -->

    <section class="hero-section">

        

            <div class="container hero-bg" style="background-size: cover;
            background-position: center; 
            background-repeat: no-repeat;
            padding: 85px 20px;
            width: 100%;
            max-width: 100%;">

            <h1 class="fw-bold">Unlock Your Next Job Opportunity </h1>

            <div class="hero-links">


                <a href="<?= base_url($job_search_base); ?>" class="neon-text text-black">
                    Thousands of jobs
                </a>

                <a href="<?= base_url('government-jobs'); ?>" class="hero-neon">
                    Government jobs
                </a>
                
                <div class="hero-link-wrapper">
                    <a href="<?= $mockInterviewUrl ?>" class="neon-text text-black">
                        Mock Interview
                    </a>
                    <span class="new-badge">NEW</span>
                </div>

            </div>




            <div class="search-bar-top" id="search-container">

                <div class="input-group">

                    <span class="input-group-text"><i class="fas fa-search"></i></span>

                    <input type="text" id="job-search-input" class="form-control"
                        placeholder="Jobs / Designation / Location">

                    <button id="search-button" class="btn btn-primary"
                        style="background-color: black; color: #FFF44F; border-radius: 50px; border: none;">Search</button>

                </div>

            </div>



            <!-- Error Message -->

            <div id="search-error-message"
                style="display:none; color:#d32f2f; margin-top:5px; font-size:0.95em; font-weight:500;">

                Please enter keywords to search relevant jobs

            </div>

        </div>


        <div class="container">
            <!-- Active Jobs -->

            <div class="jobsactive container my-5 extra-gap-below">
                <a href="<?= base_url($job_search_base . '?company=') ?>" class="active-jobs-btn"><h2 class="fw-bold text-center mb-4 neon-text">Active Jobs</h2></a>

                <?php if (!empty($top_jobs)): ?>

                    <!-- Hidden source nodes (used by JS to build slides) -->
                    <div id="jobs-source" class="d-none">
                        <?php foreach ($top_jobs as $index => $job): ?>
                            <div class="job-source-item" data-id="<?= (int) $job->id ?>"
                                data-title="<?= htmlspecialchars(mb_strlen($job->title) > 25 ? mb_substr($job->title, 0, 25) . '...' : $job->title, ENT_QUOTES) ?>"
                                data-company="<?= htmlspecialchars(mb_strlen($job->company) > 25 ? mb_substr($job->company, 0, 25) . '...' : $job->company, ENT_QUOTES) ?>"
                                data-location="<?= htmlspecialchars(mb_strlen($job->location ?? '') > 25 ? mb_substr($job->location ?? '', 0, 25) . '...' : ($job->location ?? ''), ENT_QUOTES) ?>"
                                data-experience="<?= htmlspecialchars($job->experience ?? '', ENT_QUOTES) ?>"
                                data-salary="<?= htmlspecialchars($job->salary ?? '', ENT_QUOTES) ?>"
                                data-index="<?= (int) $index ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel -->
                    <div id="topJobsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-indicators" id="jobs-carousel-indicators"></div>

                        <div class="carousel-inner" id="jobs-carousel-inner">
                            <!-- Slides injected by JS -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#topJobsCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#topJobsCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                <?php else: ?>
                    <p class="text-center">No active jobs available at the moment</p>
                <?php endif; ?>
            </div>




           



            <!-- Job Categories -->

            <div class="job-categories">

                <a href="<?= base_url($job_search_base . '?workMode=Remote') ?>" class="category-card">

                    <i class="fas fa-laptop-house"></i><span>Remote</span><i class="fas fa-chevron-right arrow"></i>

                </a>



                <a href="<?= base_url($job_search_base . '?jobType=Internship') ?>" class="category-card">

                    <i class="fas fa-user-graduate"></i><span>Internship</span><i
                        class="fas fa-chevron-right arrow"></i>

                </a>



                <a href="<?= base_url($job_search_base . '?expMin=0&expMax=0') ?>" class="category-card">

                    <i class="fas fa-user-friends"></i><span>Fresher</span><i class="fas fa-chevron-right arrow"></i>

                </a>



                <a href="<?= base_url($job_search_base . '?industry=' . urlencode('IT Services')) ?>"
                    class="category-card">

                    <i class="fas fa-building"></i><span>IT Services</span><i class="fas fa-chevron-right arrow"></i>

                </a>



                <a href="<?= base_url($job_search_base . '?industry=Finance') ?>" class="category-card">

                    <i class="fas fa-university"></i><span>Finance</span><i class="fas fa-chevron-right arrow"></i>

                </a>



                <a href="<?= base_url($job_search_base . '?industry=BPO') ?>" class="category-card">

                    <i class="fas fa-cogs"></i><span>BPO</span><i class="fas fa-chevron-right arrow"></i>

                </a>

            </div>
        


          <!-- Top Companies -->

            <div class="container my-5 extra-gap-below">
                <h3 class="fw-bold text-center mb-4">Top companies hiring now</h3>

                <?php if (!empty($top_companies)): ?>

                    <!-- Hidden source nodes (used by JS to build slides) -->
                    <div id="companies-source" class="d-none">
                        <?php foreach ($top_companies as $index => $company): ?>
                            <div class="company-source-item"
                                data-company="<?= htmlspecialchars($company->company, ENT_QUOTES) ?>"
    data-display="<?= htmlspecialchars(mb_strimwidth($company->company, 0, 15, '...'), ENT_QUOTES) ?>"
    data-logo="<?= base_url($company->company_logo) ?>">>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Carousel -->
                    <div id="topCompaniesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="carousel-indicators" id="carousel-indicators"></div>

                        <div class="carousel-inner" id="carousel-inner">
                            <!-- Slides will be injected here by JS -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#topCompaniesCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#topCompaniesCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                <?php else: ?>
                    <p class="text-center">No companies hiring at the moment</p>
                <?php endif; ?>
            </div>


            <!-- Testimonial Section -->
            <div class="container-fluid my-5">
                <div class="row g-0 align-items-stretch testimonial-section">

                    <!-- LEFT 50% : Testimonial Section -->
                    <div class="col-lg-12 col-md-12">
                        <div class="testimonial-main-wrapper p-5">
                            <div class="container">
                                <div class="quote-circle">
                                    <span class="big-quote">❝</span>
                                </div>
                                
                                    <div class="col-lg-12 col-md-12">
                                        <h3 class="left-title">From Search to Success</h3>
                                        <p class="left-desc">
                                            Every great result starts with a single search - see how clear guidance can
                                            turn
                                            curiosity
                                            into achievement.
                                        </p>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <?php if (!empty($testimonials)): ?>
                                            <div class="testimonial-vertical">
                                                <div class="t-vertical-track">
                                                    <?php foreach ($testimonials as $t): ?>
                                                        <div class="t-card vertical">
                                                            <img src="<?= base_url($t->image) ?>" class="t-img" alt="Candidate photo" width="80" height="80" loading="lazy" decoding="async">
                                                            <div class="t-review">“<?= htmlspecialchars($t->review) ?>”</div>
                                                            <div class="t-name">- <?= htmlspecialchars($t->candidate_name) ?>
                                                            </div>
                                                            <div class="t-role">
                                                                <?= htmlspecialchars($t->candidate_role ?? '') ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <?php foreach ($testimonials as $t): ?>
                                                        <div class="t-card vertical">
                                                            <img src="<?= base_url($t->image) ?>" class="t-img" alt="Candidate photo" width="80" height="80" loading="lazy" decoding="async">
                                                            <div class="t-review">“<?= htmlspecialchars($t->review) ?>”</div>
                                                            <div class="t-name">- <?= htmlspecialchars($t->candidate_name) ?>
                                                            </div>
                                                            <div class="t-role">
                                                                <?= htmlspecialchars($t->candidate_role ?? '') ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mock Interview Promo Section -->

                  <div class="container">

                      <div class="mock-promo-banner">

                          <div class="mock-promo-text-group">

                             <div class="mock-promo-icon">

                                   <i class="fas fa-user-tie"></i>

                              </div>

                              <div>

                                   <span class="mock-promo-badge"><i class="fas fa-bolt"></i> New Feature</span>

                                  <h3>Practice with our Mock Interview</h3>

                                  <p>

                                      Get real-time practice with interactive mock questions and instant, structured

                                    feedback for both soft-skill and technical interviews.
                               </p>

                             </div>

                          </div>



                           <button type="button" class="mock-promo-btn" data-bs-toggle="modal"
                               data-bs-target="#loginModal" onclick="window.location.href='<?= $mockInterviewUrl ?>'">
                                <span>Try Mock Interview</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>

                     </div>

                  </div>
                    
                    <!-- Resume Template Section -->
                        <div class="resume-banner">

                            <!-- Left Image -->
                            <div class="resume-left">
                                <img style="border-radius: 12px;" src="<?= base_url('./ALL_UPLOADS/images/SahajCV.jpeg'); ?>" alt="Free online CV maker for freshers" width="900" height="675" loading="lazy" decoding="async">
                            </div>

                            <!-- Right Content -->
                            <div class="resume-right">
                                <h2>Make your smart CV</h2>
                                <p>
                                    Explore a wide range of professionally designed resume templates tailored for every
                                    career path. Pick the one that suits your style and customize it effortlessly in
                                    just a few clicks.
                                </p>
                                <a href="<?= base_url('cv-maker'); ?>">
                                    Go for your free CV →
                                </a>
                            </div>

                        </div>

                   <div>
                        <h4 class="mt-4">Real Results, Real Careers</h4>
                    </div>
                    <!-- Stats Section -->
                    <div class="container stats-section">
                        <div class="stats-container">

                            <!-- Candidates -->
                            <div class="stat-box">
                                <i class="fas fa-users" style="font-size:40px; margin-bottom:20px;"></i>
                                <h2><?= number_format($stats['applied_candidates']); ?></h2>
                                <p>Applied Candidates</p>
                            </div>

                            <!-- Jobs -->
                            <div class="stat-box">
                                <i class="fas fa-briefcase" style="font-size:40px; margin-bottom:20px;"></i>
                                <h2><?= number_format($stats['posted_jobs']); ?></h2>
                                <p>Posted Jobs</p>
                            </div>

                            <!-- Companies -->
                            <div class="stat-box">
                                <i class="fas fa-building" style="font-size:40px; margin-bottom:20px;"></i>
                                <h2><?= number_format($stats['hiring_companies']); ?></h2>
                                <p>Hiring Companies</p>
                            </div>

                        </div>
                    </div>

                    <div>
                        <h6 class="mt-4">Advertisement</h6>
                    </div>

                    <!-- RIGHT 50% : Image Grid (SEPARATE SECTION) -->
                    <div class="testimonial-main-wrapper-img col-lg-12 col-md-12">
                        <div class="image-grid">
                            <a href="https://mymdindia.com/" target="_blank" class="image-link">
                                <img src="./ALL_UPLOADS/images/myMD.jpeg" alt="myMD" width="288" height="191" loading="lazy" decoding="async">
                            </a>

                            <a href="https://aiinhome.com" target="_blank" class="image-link">
                                <img src="./ALL_UPLOADS/images/AiiH.jpg" alt="Aiinhome" width="480" height="320" loading="lazy" decoding="async">
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Featured Companies -->

            <div class="container featured-companies">

                <h3 class="fw-bold text-center mb-4">Featured companies actively hiring</h3>

                <div class="featured-wrapper">

                    <?php if (!empty($featured_companies)): ?>

                        <?php foreach ($featured_companies as $company): ?>

                            <div class="featured-card">

                                <img src="<?= base_url($company->logo) ?>"
                                    alt="<?= htmlspecialchars($company->company_name) ?>" height="40" loading="lazy" decoding="async">

                                <h5><?= htmlspecialchars($company->company_name) ?></h5>

                                <div class="featured-rating">

                                    ⭐ <?= $company->rating ?> | <?= $company->reviews ?> reviews

                                </div>

                                <p><?= htmlspecialchars($company->description) ?></p>

                                <a href="<?= base_url($job_search_base . '?company=' . urlencode($company->company_name)) ?>"
                                    class="btn btn-sm" style="background:#FFF44F; color:#29374d;"
                                    aria-label="View jobs at <?= htmlspecialchars($company->company_name) ?>">
                                    View jobs
                                </a>


                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <p class="text-center">No featured companies at the moment</p>

                    <?php endif; ?>

                </div>

            </div>





            <div class="text-center mt-4">
                <a href="<?= base_url($job_search_base . '?company=') ?>" class="btn view-all-btn">
                    View all companies
                </a>
            </div>



            <!-- Siemens Video Banner -->

            <div class="container mt-5">

                <div class="siemens-banner">

                    <div class="banner-right position-relative">

                         <!-- Desktop Video -->
                        <video id="bannerVideo" muted loop playsinline preload="none"
                            poster="./ALL_UPLOADS/images/image-vid.jpg" class="banner-video">

                            <source src="./ALL_UPLOADS/videos/image_video.mp4" type="video/mp4">

                            Your browser does not support the video tag.

                        </video>
                        <script>
                            // Play only on desktop widths. On mobile the video is hidden by CSS,
                            // so it is never downloaded (preload="none" + no autoplay).
                            (function () {
                                var v = document.getElementById('bannerVideo');
                                var mq = window.matchMedia('(min-width: 769px)');
                                function start() {
                                    if (mq.matches && v.paused) {
                                        var p = v.play();
                                        if (p && p.catch) p.catch(function () {});
                                    }
                                }
                                start();
                                if (mq.addEventListener) mq.addEventListener('change', start);
                            })();
                        </script>

                        <!-- Mobile Image -->
                        <img src="./ALL_UPLOADS/images/image-vid.jpg" class="banner-mobile-img" alt="Banner Image" width="876" height="492" loading="lazy" decoding="async">

                    </div>

                </div>

            </div>

        </div>

    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
        window.jobSearchBase = "<?= base_url($job_search_base) ?>";
    </script>

    <script>
        (function () {

            // Responsive breakpoints -> cards per slide
            function getCardsPerSlide() {
                if (window.matchMedia('(min-width: 992px)').matches) return 4;
                if (window.matchMedia('(min-width: 768px)').matches) return 3;
                if (window.matchMedia('(min-width: 576px)').matches) return 2;
                return 1;
            }

            // Escape helper
            function escapeHtml(str) {
                if (typeof str !== 'string') return str;
                return str.replace(/[&<>"']/g, function (m) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
                });
            }

            // Read companies from hidden source
            function readCompaniesSource() {
                const nodes = Array.from(document.querySelectorAll('#companies-source .company-source-item'));
                return nodes.map(n => ({
                    company: n.getAttribute('data-company'),
                    display: n.getAttribute('data-display'),
                    logo: n.getAttribute('data-logo')
                }));
            }

            // Create a single card
            function createCardHtml(companyName, displayName, logo, cardWidthPercent) {
                const safeLogo = logo || '../ALL_UPLOADS/images/company-placeholder.gif';

                const url =
                    window.jobSearchBase +
                    '?company=' +
                    encodeURIComponent(companyName);

                return `
        <a href="${url}" class="company-card-link">
            <div class="company-card"
                 style="flex: 0 0 ${cardWidthPercent}%; max-width: ${cardWidthPercent}%;">
                <h5 title="${escapeHtml(companyName)}">${escapeHtml(displayName)}</h5>
                <div class="d-flex justify-content-center">
                    <img src="${safeLogo}" 
                         alt="${escapeHtml(companyName)}" 
                         class="img-fluid company-logo"
                         loading="lazy">
                </div>
            </div>
        </a>
    `;
            }

            // Build carousel
            function buildCarousel(cardsPerSlide) {
                const companies = readCompaniesSource();
                const inner = document.getElementById('carousel-inner');
                const indicators = document.getElementById('carousel-indicators');

                inner.innerHTML = '';
                indicators.innerHTML = '';

                if (companies.length === 0) {
                    inner.innerHTML = `<div class="carousel-item active"><p class="text-center">No companies hiring at the moment</p></div>`;
                    return;
                }

                const cardWidthPercent = (100 / cardsPerSlide).toFixed(6);

                for (let i = 0; i < companies.length; i += cardsPerSlide) {
                    const slice = companies.slice(i, i + cardsPerSlide);

                    const cardsHtml = slice
                        .map(c => createCardHtml(c.company, c.display, c.logo, cardWidthPercent))
                        .join('');

                    const item = document.createElement('div');
                    item.className = 'carousel-item';
                    item.innerHTML = `<div class="companies-slide-row">${cardsHtml}</div>`;
                    inner.appendChild(item);

                    // indicator
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.setAttribute('data-bs-target', '#topCompaniesCarousel');
                    btn.setAttribute('data-bs-slide-to', String(i / cardsPerSlide));
                    btn.setAttribute('aria-label', `Slide ${i / cardsPerSlide + 1}`);
                    indicators.appendChild(btn);
                }

                // activate first slide
                const firstItem = inner.querySelector('.carousel-item');
                if (firstItem) firstItem.classList.add('active');

                const firstIndicator = indicators.querySelector('button');
                if (firstIndicator) {
                    firstIndicator.classList.add('active');
                    firstIndicator.setAttribute('aria-current', 'true');
                }
            }

            // Rebuild on resize
            let currentPer = null;
            function rebuildIfNeeded() {
                const per = getCardsPerSlide();
                if (per !== currentPer) {
                    currentPer = per;
                    buildCarousel(per);
                }
            }

            // Initialize
            window.addEventListener('load', function () {
                rebuildIfNeeded();

                const carouselEl = document.getElementById('topCompaniesCarousel');
                if (carouselEl && window.bootstrap && bootstrap.Carousel) {
                    const existing = bootstrap.Carousel.getInstance(carouselEl);
                    if (existing) existing.dispose();
                    new bootstrap.Carousel(carouselEl, { interval: 5000, ride: 'carousel' });
                }
            });

            // Resize listener
            let resizeTimer = null;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(rebuildIfNeeded, 120);
            });

        })();
    </script>


    <script>
        window._jobDetailBase = "<?= base_url($job_search_base) ?>";
        // Job card links: public visitors go to the crawlable job page (/job/view/ID);
        // logged-in candidates keep the existing in-app job view.
        window._jobDetailPrefix = "<?= ($is_logged_in && $user_role === 'candidate')
            ? base_url('candidate_job_search') . '?job_id='
            : base_url('job/view') . '/' ?>";
        (function () {
            // Responsive breakpoints -> cards per slide (same as companies script)
            function getCardsPerSlide() {
                if (window.matchMedia('(min-width: 992px)').matches) return 4;
                if (window.matchMedia('(min-width: 768px)').matches) return 3;
                if (window.matchMedia('(min-width: 576px)').matches) return 2;
                return 1;
            }

            // Simple escape helper (same as companies script)
            function escapeHtml(str) {
                if (typeof str !== 'string') return str || '';
                return str.replace(/[&<>"']/g, function (m) {
                    return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m];
                });
            }

            // Read jobs from hidden source nodes
            function readJobsSource() {
                const nodes = Array.from(document.querySelectorAll('#jobs-source .job-source-item'));
                return nodes.map(n => ({
                    id: n.getAttribute('data-id'),
                    title: n.getAttribute('data-title'),
                    company: n.getAttribute('data-company'),
                    location: n.getAttribute('data-location') || '',
                    experience: n.getAttribute('data-experience') || '',
                    salary: n.getAttribute('data-salary') || '',
                    index: parseInt(n.getAttribute('data-index') || '0', 10)
                }));
            }

            // Create a job card HTML (keeps design from earlier)
            function createJobCardHtml(job, cardWidthPercent, jobDetailBase) {
                const detailUrl = window._jobDetailPrefix + encodeURIComponent(job.id);
                return `
            <article class="job-card" style="flex: 0 0 ${cardWidthPercent}%; max-width: ${cardWidthPercent}%;">
              <div class="job-card-body">
                <h4 class="job-title">${escapeHtml(job.title)}</h4>
                <div class="job-company">${escapeHtml(job.company)}</div>

                <div class="job-meta">
                  <div class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true">
                      <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z" fill="currentColor"/>
                    </svg>
                    <span>${escapeHtml(job.location)}</span>
                  </div>

                  <div class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" width="16" height="16">
                      <path d="M20 6h-3V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2zM9 4h6v2H9z" fill="currentColor"/>
                    </svg>
                    <span>${escapeHtml(job.experience)}</span>
                  </div>
                </div>

                <div class="job-salary">${escapeHtml(job.salary)}</div>
              </div>

              <div class="job-action">
                <a class="btn-apply" href="${detailUrl}">View job</a>
              </div>
            </article>
        `;
            }

            // Build carousel slides and indicators with `cardsPerSlide` jobs per slide
            function buildJobsCarousel(cardsPerSlide) {
                const jobs = readJobsSource();
                const inner = document.getElementById('jobs-carousel-inner') || document.getElementById('jobs-carousel-inner'); // fallback
                const indicators = document.getElementById('jobs-carousel-indicators');

                if (!inner || !indicators) return; // safety

                inner.innerHTML = '';
                indicators.innerHTML = '';

                if (jobs.length === 0) {
                    inner.innerHTML = `<div class="carousel-item active"><p class="text-center">No top jobs available at the moment</p></div>`;
                    return;
                }

                const cardWidthPercent = (100 / cardsPerSlide).toFixed(6);

                // Optional: base URL for job detail - adjust server-side if needed
                // If you rendered a JS variable jobDetailBase earlier in the page, it will be used; otherwise default '#'
                const jobDetailBase = window._jobDetailBase || null;

                for (let i = 0; i < jobs.length; i += cardsPerSlide) {
                    const slice = jobs.slice(i, i + cardsPerSlide);
                    const cardsHtml = slice.map(j => createJobCardHtml(j, cardWidthPercent, jobDetailBase)).join('');
                    const item = document.createElement('div');
                    item.className = 'carousel-item';
                    item.innerHTML = `<div class="companies-slide-row">${cardsHtml}</div>`;
                    inner.appendChild(item);

                    // create indicator button (same pattern as companies script)
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.setAttribute('data-bs-target', '#topJobsCarousel');
                    btn.setAttribute('data-bs-slide-to', String(i / cardsPerSlide));
                    btn.setAttribute('aria-label', `Slide ${i / cardsPerSlide + 1}`);
                    indicators.appendChild(btn);
                }

                // Activate first slide + indicator
                const firstItem = inner.querySelector('.carousel-item');
                if (firstItem) firstItem.classList.add('active');
                const firstIndicator = indicators.querySelector('button');
                if (firstIndicator) {
                    firstIndicator.classList.add('active');
                    firstIndicator.setAttribute('aria-current', 'true');
                }
            }

            // Keep track of current per and rebuild only when breakpoint changes
            let currentPer = null;
            function rebuildIfNeeded() {
                const per = getCardsPerSlide();
                if (per !== currentPer) {
                    currentPer = per;
                    buildJobsCarousel(per);
                }
            }

            // Initialize on load, re-init bootstrap Carousel safely
            window.addEventListener('load', function () {
                rebuildIfNeeded();

                const carouselEl = document.getElementById('topJobsCarousel');
                if (carouselEl && typeof bootstrap !== 'undefined' && bootstrap && bootstrap.Carousel) {
                    const existing = bootstrap.Carousel.getInstance(carouselEl);
                    if (existing) existing.dispose();
                    new bootstrap.Carousel(carouselEl, { interval: 5000, ride: 'carousel' });
                }
            });

            // Throttled resize handler
            let resizeTimer = null;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(rebuildIfNeeded, 120);
            });

        })();
    </script>


    <script>

        document.getElementById("search-button").addEventListener("click", function (e) {

            const input = document.getElementById("job-search-input");

            const search = input.value.trim();

            const errorMsg = document.getElementById("search-error-message");

            const container = document.getElementById("search-container");



            if (!search) {

                e.preventDefault();

                errorMsg.style.display = "block";

                container.classList.add("error-outline");

            } else {

                errorMsg.style.display = "none";

                container.classList.remove("error-outline");

                const query = new URLSearchParams();

                query.append("q", search);

                // window.location.href = "<?php //base_url('job_search'); ?>?" + query.toString();



                <?php
                $role = $this->session->userdata('user_role');
                $logged_in = $this->session->userdata('logged_in');

                $searchUrl = ($logged_in && $role === 'candidate')
                    ? 'candidate_job_search'
                    : 'job_search';
                ?>

                const baseSearchUrl = "<?= base_url($searchUrl); ?>";

                window.location.href = baseSearchUrl + "?" + query.toString();

            }

        });



        document.getElementById("job-search-input").addEventListener("keyup", function (event) {

            if (event.key === "Enter") {

                document.getElementById("search-button").click();

            }

        });



        document.getElementById("job-search-input").addEventListener("input", function () {

            document.getElementById("search-error-message").style.display = "none";

            document.getElementById("search-container").classList.remove("error-outline");

        });

    </script>



    <script>

        // Show flash messages in modal

        document.addEventListener('DOMContentLoaded', function () {

            <?php if ($this->session->flashdata('success')): ?>

                showFlashModal('success', '<?= $this->session->flashdata('success') ?>');

            <?php endif; ?>



            <?php if ($this->session->flashdata('error')): ?>

                showFlashModal('error', '<?= $this->session->flashdata('error') ?>');

            <?php endif; ?>



            function showFlashModal(type, message) {

                const modal = document.getElementById('flashModal');

                const modalContent = document.getElementById('modalContent');

                const modalTitle = document.getElementById('modalTitle');

                const modalMessage = document.getElementById('modalMessage');



                // Set modal content based on type

                if (type === 'success') {

                    modalTitle.textContent = 'Success';

                    modalContent.classList.add('modal-success');

                } else {

                    modalTitle.textContent = 'Error';

                    modalContent.classList.add('modal-error');

                }



                modalMessage.textContent = message;

                modal.style.display = 'block';



                // Auto close after 5 seconds

                setTimeout(() => {

                    modal.style.display = 'none';

                }, 15000);

            }



            // Close modal when clicking close button

            document.getElementById('modalClose').addEventListener('click', function () {

                document.getElementById('flashModal').style.display = 'none';

            });



            // Close modal when clicking outside

            window.addEventListener('click', function (event) {

                const modal = document.getElementById('flashModal');

                if (event.target === modal) {

                    modal.style.display = 'none';

                }

            });

        });

    </script>

<!--
</body>

</html>
-->
