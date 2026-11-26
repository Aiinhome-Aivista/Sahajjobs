<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Per-page <title> and meta description, keyed by URI (uri_string()).
 * Applied in views/includes/header.php and login_header.php so every page gets a
 * unique title (<= 60 chars) and description (<= 160 chars) instead of the single
 * shared row from seo_details. Add new pages here.
 */
$config['page_seo'] = [
    'about-us' => ['About Us | SahajJobs', 'Learn about SahajJobs, a free job portal connecting job seekers and employers across India and the UAE.'],
    'careers' => ['Careers at SahajJobs | Join Our Team', 'Explore career opportunities at SahajJobs and help us build a better way for people to find work.'],
    'employer-home' => ['Hire Talent | Post Jobs Free | SahajJobs', 'Post jobs for free, reach qualified candidates and manage applications easily with SahajJobs for Employers.'],
    'FAQ' => ['Help Center & FAQ | SahajJobs', 'Answers to common questions about searching jobs, applying, creating a profile and posting jobs on SahajJobs.'],
    'report-issue' => ['Report an Issue | SahajJobs', 'Found a problem, fake job or bug? Report it to the SahajJobs team and we will look into it.'],
    'privacy-policy' => ['Privacy Policy | SahajJobs', 'Read how SahajJobs collects, uses and protects your personal information.'],
    'cookie-policy' => ['Cookie Policy | SahajJobs', 'Learn how SahajJobs uses cookies and similar technologies, and how you can control them.'],
    'terms-and-conditions' => ['Terms & Conditions | SahajJobs', 'The terms and conditions for using the SahajJobs website for job seekers and employers.'],
    'trust-safety' => ['Trust & Safety | SahajJobs', 'Tips and policies to keep job seekers and employers safe from scams and misuse on SahajJobs.'],
    'job_search' => ['Search Jobs in India & UAE | SahajJobs', 'Search thousands of jobs by role, skill and location across India and the UAE. Apply free on SahajJobs.'],
    'government-jobs' => ['Government Jobs & Sarkari Naukri | SahajJobs', 'Latest government job notifications, vacancies and last dates across India, updated regularly.'],
    'blogs' => ['Career Blog & Job Tips | SahajJobs', 'Read career advice, interview tips, resume guides and job market updates on the SahajJobs blog.'],
    'cv-maker' => ['Free CV Maker & Resume Builder | SahajJobs', 'Create a professional CV online in minutes with free templates and download it as a PDF.'],
    'register' => ['Create Your Free Account | SahajJobs', 'Sign up on SahajJobs to build your profile, apply to jobs and get job alerts.'],
    'employer_register' => ['Employer Registration | SahajJobs', 'Register your company on SahajJobs to post jobs and hire candidates for free.'],
    'employer_login' => ['Employer Login | SahajJobs', 'Log in to your SahajJobs employer account to manage jobs and applications.'],
];
