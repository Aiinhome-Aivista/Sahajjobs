<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Govt_jobs_details extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/GovtJob_model');
    }

    private function disable_cache()
    {
        $this->output
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache');
    }

    public function index($job_id = null)
    {
        $this->disable_cache();

        // if (!$this->session->userdata('logged_in')) {
        //     redirect(base_url('government-jobs'));
        //     return;
        // }

        if (!$job_id) {
            show_404();
        }

        $data['job'] = $this->GovtJob_model->get_govt_jobs_by_id($job_id);

        $this->load->view('includes/header');
        $this->load->view('admin/govt_jobs_details', $data);
        $this->load->view('includes/footer');
    }
}