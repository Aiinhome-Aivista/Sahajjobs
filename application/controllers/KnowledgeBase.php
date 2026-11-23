<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KnowledgeBase extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Post_model');
        $this->load->library('session');
        $this->load->model('admin/Seo_model');
        $this->load->helper(['url', 'text']);
    }
    
    private function disable_cache()
    {
        $this->output
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache');
    }

    public function index()
    {
        $this->disable_cache();
        
        $category_id = $this->input->get('category');
        if (!empty($category_id)) {
            $data['posts'] = $this->Post_model->get_posts_by_category($category_id);
        } else {
            $data['posts'] = $this->Post_model->get_posts_with_categories();
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
        // -------- CAPTCHA END --------
        
        $data['seo'] = $this->Seo_model->get_details_seo();

        $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('knowledge_based', $data);
            $this->load->view('includes/footer', $data);
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('knowledge_based', $data);
            $this->load->view('includes/footer', $data);
        }
    }
    
    
      public function post($slug)
    {
        $this->disable_cache();
    
        // $data['post'] = $this->Post_model->get_post_by_id($id);
        $data['post'] = $this->Post_model->get_post_by_slug($slug);

        if (!$data['post']) {
            show_404();
        }
        
        $post_id = $data['post']->id;
        $category_id = $data['post']->category_id;

        $data['latest_posts']  = $this->Post_model->get_latest_posts($post_id);
        $data['related_posts'] = $this->Post_model->get_related_posts($category_id, $post_id);
        $data['prev_post']     = $this->Post_model->get_previous_post($post_id);
        $data['next_post']     = $this->Post_model->get_next_post($post_id);
        
       // ===== BLOG WISE DYNAMIC SEO (IMPORTANT) =====
        $data['seo'] = (object)[
            'title' => $data['post']->title . ' | ' . $data['post']->category_name . ' | SahajJobs',
    
            'description' => character_limiter(
                strip_tags($data['post']->content),
                155
            ),
    
            'keywords' => strtolower(
                $data['post']->category_name . ', ' .
                $data['post']->title . ', jobs, sahajjobs'
            )
        ];
        // ===========================================
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
        $this->load->view('includes/header',$data);
        $this->load->view('admin/post_details', $data); 
        $this->load->view('includes/footer');
    }

    // public function post($id)
    // {
    //     $this->disable_cache();
        
    //     if (!$this->session->userdata('logged_in')) {
    //         redirect(base_url('knowledge-based'));
    //     }
        
    //     $data['post'] = $this->Post_model->get_post_by_id($id);

    //     if (!$data['post']) {
    //         show_404();
    //     }

    //     $this->load->view('includes/login_header');
    //     $this->load->view('post_details', $data);
    //     $this->load->view('includes/footer');
    // }
}