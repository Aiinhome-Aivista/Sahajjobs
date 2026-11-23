<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Static_pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the Menu_model in the constructor to make it available for all methods
        $this->load->model('Menu_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin/Seo_model');
        $this->load->helper('captcha');

    }
    private function generate_captcha()
    {
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
    
        $captcha = create_captcha($config);
    
        $this->session->set_userdata('captcha_word', $captcha['word']);
    
        return $captcha['image'];
    }

    public function about_us()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('about_us', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('about_us', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function careers()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('careers', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('careers', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function employer_home()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('employer_home', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('employer_home', $data);
            $this->load->view('includes/footer', $data);
        }
    }


    public function help_center()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('help_center', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('help_center', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function report_issue()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('report_issue', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('report_issue', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function privacy_policy()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('privacy_policy', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('privacy_policy', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    public function cookie_policy()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('cookie_policy', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('cookie_policy', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function terms_and_conditions()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('terms_and_conditions', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('terms_and_conditions', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function trust_safety()
    {
        $data['captcha_image'] = $this->generate_captcha();
        $data['seo'] = $this->Seo_model->get_details_seo();
        $data['menu'] = $this->Menu_model->get_menu();
        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('trust_safety', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('trust_safety', $data);
            $this->load->view('includes/footer', $data);
        }
    }
}