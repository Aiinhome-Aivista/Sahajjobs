<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Job_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('text');
    }

    // other methods...

    public function view($id = null) {
        if ($id === null) {
            show_404();
            return;
        }

        $job = $this->Job_model->get_job($id);
        if (empty($job)) {
            show_404();
            return;
        }

        $data['job'] = $job;
        $this->load->view('job_detail_view', $data);
    }
}
