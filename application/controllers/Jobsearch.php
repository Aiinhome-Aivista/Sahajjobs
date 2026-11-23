<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobsearch extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jobsearch_model');
        $this->load->model('Menu_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin/Seo_model');
    }

    public function index()
    {
        $data['menu'] = $this->Menu_model->get_menu();

        // Collect all possible filters from GET params
        $filters = [
            'job' => $this->input->get('job'),
            'location' => $this->input->get('location'),
            'company' => $this->input->get('company'),
            'industry' => $this->input->get('industry'),
            'job_type' => $this->input->get('job_type'),
            'work_mode' => $this->input->get('work_mode'),
            'experience' => $this->input->get('experience'),
            'salary' => $this->input->get('salary')
        ];

        // Pass filters to model
        $data['jobs'] = $this->Jobsearch_model->get_jobs($filters);
        $data['featured_companies'] = $this->Jobsearch_model->get_featured_companies(50);
        $data['companies'] = $this->Jobsearch_model->get_companies();
        
        $data['seo'] = $this->Seo_model->get_details_seo();
        
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
        // -------- CAPTCHA END --------

        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('job_search', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('job_search', $data);
            $this->load->view('includes/footer', $data);
        }
    }


    public function get_job_detail($id)
    {
        $job = $this->Jobsearch_model->get_job_by_id($id);
        echo json_encode($job);
    }
}
