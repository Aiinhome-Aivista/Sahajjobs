<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Home extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();

        $this->load->model('Menu_model', 'menu_model');

        $this->load->model('Home_model');

        $this->load->model('admin/Testimonials_model');

        $this->load->library('session');

        $this->load->helper('url');
        
        $this->load->model('admin/Seo_model');
        
        $this->load->helper('captcha');

    }



    public function index()

    {
        $data['top_companies'] = $this->Home_model->getTopHiringEmployers();

        $data['featured_companies'] = $this->Home_model->getFeaturedCompanies();

        $data['testimonials'] = $this->Testimonials_model->get_all_testimonials_with_candidate_name();

        $data['top_jobs'] = $this->Home_model->get_active_jobs();

        $data['menu'] = $this->menu_model->get_menu();
        
        $data['seo'] = $this->Seo_model->get_details_seo();
        
         // ===== HOME STATS =====
        $stats = $this->Home_model->get_home_stats();

        // Static counts
        $static_applied_candidates = 52320;
        $static_posted_jobs = 57235;
        $static_hiring_companies = 37234;

        // Final dynamic + static totals
        $data['stats'] = [
            'applied_candidates' => $static_applied_candidates + $stats['applied_candidates'],
            'posted_jobs' => $static_posted_jobs + $stats['posted_jobs'],
            'hiring_companies' => $static_hiring_companies + $stats['hiring_companies'],
        ];
        // ===== END HOME STATS =====


        // -------- CAPTCHA FOR LOGIN POPUP --------
        $config = [
            'img_path' => './captcha/',
            'img_url' => base_url('captcha'),
            'font_path' => FCPATH . 'system/fonts/texb.ttf',
            'img_width' => 150,
            'img_height' => 40,
            'word_length' => 5,
            'font_size' => 20,
            'expiration' => 300,
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyz'
        ];

        if (!$this->session->userdata('login_captcha_word')) {
            $captcha = create_captcha($config);
            $this->session->set_userdata('login_captcha_word', $captcha['word']);
            $data['captcha_image'] = $captcha['image'];
        } else {
            $config['word'] = $this->session->userdata('login_captcha_word');
            $captcha = create_captcha($config);
            $data['captcha_image'] = $captcha['image'];
        }
        // -------- CAPTCHA END --------

        $user_id = $this->session->userdata('user_id');



        if (!empty($user_id)) {

            $this->load->view('includes/login_header', $data);

            $this->load->view('home', $data);

            $this->load->view('includes/footer', $data);

        } else {

            $this->load->view('includes/header', $data);

            $this->load->view('home', $data);

            $this->load->view('includes/footer', $data);

        }

    }



    public function policy()

    {

        $data['menu'] = $this->menu_model->get_menu();



        $this->load->view('policy', $data);

    }

}

