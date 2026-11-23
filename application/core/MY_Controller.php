<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $timeout = 600;

    public function __construct()
    {
        parent::__construct();

        $this->output
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache')
            ->set_header('Expires: 0');

        if (!$this->session->userdata('logged_in') && $this->router->class !== 'login') {
            redirect(base_url());
            exit;
        }

        $this->load->library('session');
        $this->load->helper('url');

        if ($this->router->class === 'login') {
            return;
        }

        if ($this->session->userdata('logged_in')) {

            $last_activity = $this->session->userdata('last_activity');

            if ($last_activity && (time() - $last_activity) > $this->timeout) {

                $this->session->sess_destroy();
                redirect(base_url('?showLogin=true'));
                exit;
            }

            $this->session->set_userdata('last_activity', time());
        }
    }
}
