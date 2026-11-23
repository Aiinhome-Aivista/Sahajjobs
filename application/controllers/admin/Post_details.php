<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_details extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Post_model');
        $this->load->model('admin/Comment_model');
        $this->load->library('session');
    }

    private function disable_cache()
    {
        $this->output
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0')
            ->set_header('Cache-Control: post-check=0, pre-check=0', false)
            ->set_header('Pragma: no-cache');
    }

    public function index($post_id = null)
    {
        $this->disable_cache();

        // If no post ID is provided, show 404 or redirect
        if (!$post_id) {
            show_404();
        }

        // Get the specific post by ID
        $data['post'] = $this->Post_model->get_post_by_id($post_id);
        
        // If post doesn't exist, show 404
        if (!$data['post']) {
            show_404();
        }

        $data['latest_posts'] = $this->Post_model->get_latest_posts($post_id);
        $data['related_posts'] = $this->Post_model->get_related_posts($data['post']->category_id, $post_id);

        // Previous post
        $data['prev_post'] = $this->Post_model->get_previous_post($post_id);
        // echo '<pre>'; print_r($data['prev_post']);die();
        
        // Next post
        $data['next_post'] = $this->Post_model->get_next_post($post_id);
        

        // Get comments for this post
        $data['comments'] = $this->Comment_model->get_comments_by_post($post_id);
        $data['comment_count'] = $this->Comment_model->get_comment_count_by_post($post_id);

        $user_id = $this->session->userdata('user_id');


        if (!empty($user_id)) {
            $this->load->view('includes/login_header');
            $this->load->view('admin/post_details', $data);
            $this->load->view('includes/footer');
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('admin/post_details', $data);
            $this->load->view('includes/footer', $data);
        }
    }

    public function add_comment()
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['success' => false, 'message' => 'Please log in to post a comment.']);
            return;
        }

        $post_id = $this->input->post('post_id');
        $comment = $this->input->post('comment');

        if (empty($comment)) {
            echo json_encode(['success' => false, 'message' => 'Comment cannot be empty.']);
            return;
        }

        $data = [
            'post_id' => $post_id,
            'user_id' => $this->session->userdata('user_id'),
            'comment' => $comment,
            'status' => 'pending', // comments need approval
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Comment_model->add_comment($data)) {
            echo json_encode(['success' => true, 'message' => 'Your comment has been successfully submitted.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to submit comment. Please try again.']);
        }
    }


    public function subscribe()
    {

        $email = trim($this->input->post('email'));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ]);
            return;
        }

        if ($this->Post_model->email_exists($email)) {
            echo json_encode([
                'success' => false,
                'message' => 'This email is already subscribed.'
            ]);
            return;
        }

        $data = [
            'email' => $email,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Post_model->insert_subscriber($data)) {
            echo json_encode([
                'success' => true,
                'message' => 'Subscribed successfully!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ]);
        }
    }
}