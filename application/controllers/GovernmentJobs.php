<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GovernmentJobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/GovtJob_model');
        $this->load->library('session');
        $this->load->model('admin/Seo_model');
    }

    public function index()
    {
        $country = $this->input->get('country');
        if (!empty($country)) {
            $data['jobs'] = $this->GovtJob_model->get_jobs_by_country($country);
        } else {
            $data['jobs'] = $this->GovtJob_model->get_government_jobs();
        }

        // -------- CAPTCHA START --------
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

        $this->session->set_userdata('login_captcha_word', $captcha['word']);
        $data['captcha_image'] = $captcha['image'];
        $data['seo'] = $this->Seo_model->get_details_seo();
        // -------- CAPTCHA END --------

        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('government_jobs', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('government_jobs', $data);
            $this->load->view('includes/footer', $data);
        }
    }
}
