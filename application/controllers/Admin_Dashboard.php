<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Admin_Dashboard extends CI_Controller

{



    public function __construct()

    {

        parent::__construct();
        
        $this->load->library('session');
        $method = $this->router->method;

        if ($method !== 'login') {
            if (!$this->session->userdata('admin_logged_in')) {
                redirect(base_url('admin/login'));
                exit;
            }
        }

        $this->load->model('admin/Candidate_management_model');

        $this->load->model('admin/Employer_management_model');

        $this->load->model('admin/Job_post_management_model');

        $this->load->model('admin/Featured_companies_model');

        $this->load->model('admin/Testimonials_model');

        $this->load->model('Admin_dashboard_model');

    }



    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect(base_url('admin/dashboard'));
            exit;
        }

        if ($this->input->post()) {

            $email = trim($this->input->post('email'));
            $password = $this->input->post('password');

            $admin = $this->Admin_dashboard_model->get_admin_by_email($email);

            if ($admin && $password === $admin->password) {

                // Set session
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_id' => $admin->id,
                    'admin_email' => $admin->email
                ]);

                redirect(base_url('admin/dashboard'));
                exit;

            } else {
                $data['error'] = 'Invalid email or password';
                $this->load->view('admin/login', $data);
                return;
            }
        }

        $this->load->view('admin/login');
    }



    public function dashboard()

    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(base_url('admin/login'));
            exit;
        }

        // Get candidate count

        $data['recent_jobs'] = $this->Admin_dashboard_model->get_recent_jobs();

        $data['candidate_count'] = $this->Candidate_management_model->count_candidates();

        $data['employer_count'] = $this->Employer_management_model->count_employers();

        $data['job_count'] = $this->Job_post_management_model->count_jobs();

        $this->load->view('admin/dashboard', $data);

    }



    public function candidate_management()

    {

        $data['candidates'] = $this->Candidate_management_model->get_all_candidates();

        $this->load->view('admin/candidate_management', $data);

    }



    public function employer_management()

    {

        $data['employers'] = $this->Employer_management_model->get_all_employers();

        $this->load->view('admin/employer_management', $data);

    }



    public function job_post_management()

    {

        $data['job_post'] = $this->Job_post_management_model->get_all_job_posts();

        $this->load->view('admin/job_post_management', $data);

    }



    public function featured_companies()

    {

        $data['employers'] = $this->Featured_companies_model->get_all_employers();

        $data['companies'] = $this->Featured_companies_model->get_all_company();

        $data['featured_companies'] = $this->Featured_companies_model->get_all_featured_companies_with_job_count();

        $this->load->view('admin/featured_companies', $data);

    }


    public function testimonials()
    {
        $data['testimonials'] = $this->Testimonials_model->get_all_testimonials_with_candidate_name();
        $data['candidates'] = $this->Testimonials_model->get_all_candidates();
        $this->load->view('admin/testimonials', $data);
    }



    public function logout()

    {

        $this->session->sess_destroy();

        redirect(base_url('admin/login'));

    }

}

