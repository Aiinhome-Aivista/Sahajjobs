<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Job_model');
        $this->load->model('Menu_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->helper('captcha');
        $this->load->helper('job');
    }

    // other methods...

    // Captcha image for the login popup in the shared header (same as other pages).
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

        // ---------- SEO values (title/description/canonical are output by includes/header.php) ----------
        $job_url = base_url('job/view/' . (int) $job['id']);
        $plain   = trim(preg_replace('/\s+/', ' ', strip_tags((string) $job['description'])));
        $lead    = trim($job['title'] . ' job at ' . $job['company']
                   . (!empty($job['location']) ? ' in ' . $job['location'] : '') . '.');
        $full    = $lead . ' ' . $plain;
        $len     = function_exists('mb_strlen') ? mb_strlen($full) : strlen($full);
        $desc    = function_exists('mb_substr') ? mb_substr($full, 0, 155) : substr($full, 0, 155);
        if ($len > 155) {
            $desc = rtrim($desc) . '...';
        }

        $data['seo'] = (object) [
            'title'       => $job['title'] . ' — ' . $job['company'] . ' | SahajJobs',
            'description' => $desc,
            'keywords'    => strtolower($job['title'] . ', ' . $job['company'] . ', jobs'
                             . (!empty($job['industry']) ? ', ' . $job['industry'] . ' jobs' : '')),
        ];

        // Open Graph + JobPosting schema, injected into the <head> by the header via $extra_head
        $data['seo_job_url']  = $job_url;
        $data['seo_og_title'] = trim($job['title'] . ' at ' . $job['company']
                                . (!empty($job['location']) ? ' - ' . $job['location'] : ''));
        $data['seo_desc']     = $desc;
        // Expired job (last_date before today): page still opens, but Google is told not to index it
        $data['job_expired'] = !empty($job['last_date'])
            && strtotime($job['last_date']) !== false
            && date('Y-m-d', strtotime($job['last_date'])) < date('Y-m-d');
        $data['extra_head']   = $this->load->view('job_seo_head', $data, TRUE);

        // ---------- Shared site layout (same as the other pages) ----------
        $data['captcha_image'] = $this->generate_captcha();
        $data['menu']          = $this->Menu_model->get_menu();

        $user_id = $this->session->userdata('user_id');
        $this->load->view(!empty($user_id) ? 'includes/login_header' : 'includes/header', $data);
        $this->load->view('job_detail_view', $data);
        $this->load->view('includes/footer', $data);
    }
}
