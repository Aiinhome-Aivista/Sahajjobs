<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Post_model');
        $this->load->model('admin/Post_category_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('EmailService');
    }

    public function posts_add()
    {
        // Load categories for the dropdown
        $data['categories'] = $this->Post_category_model->get_categories_for_dropdown();
        $this->load->view('admin/posts_add', $data);
    }

    public function posts_manage()
    {
        // Get all posts with categories for client-side search and pagination
        $data['posts'] = $this->Post_model->get_posts_with_categories();
        $this->load->view('admin/posts_manage', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_message', validation_errors());
        } else {
        $title = $this->input->post('title');
        
        // slug generate
        $slug = url_title($title, 'dash', TRUE);
        
        // duplicate slug check
        $original_slug = $slug;
        $i = 1;
        while ($this->Post_model->get_post_by_slug($slug)) {
            $slug = $original_slug . '-' . $i;
            $i++;
        }
            $data = array(
                'title' => $this->input->post('title'),
                'author' => $this->input->post('author'),
                'slug'        => $slug,
                'content' => $this->input->post('content'),
                'category_id' => $this->input->post('category_id'),
                'created_at' => date('Y-m-d H:i:s')
            );

            // Handle file upload
            if (!empty($_FILES['featured_image']['name'])) {
                // $config['upload_path'] = './assets/images/';
                $config['upload_path'] = './ALL_UPLOADS/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('featured_image')) {
                    $upload_data = $this->upload->data();
                    // $data['featured_image'] = './assets/images/' . $upload_data['file_name'];
                    $data['featured_image'] = './ALL_UPLOADS/images/' . $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error_message', $this->upload->display_errors());
                    redirect('admin/posts_add');
                    return;
                }
            }

             $post_id = $this->Post_model->add_post($data);

            if ($post_id) {
                $subscribers = $this->Post_model->get_all_subscribers();


                if (empty($subscribers)) {
                    return;
                }

                $post_link = base_url('admin/post_details/index/' . $post_id);


                foreach ($subscribers as $sub) {

                    $emailContent = $this->load->view("emails/new_post_notification", [
                        'post_title' => $data['title'],
                        'post_link' => $post_link
                    ], TRUE);

                    $this->emailservice->sendEmail($sub['email'], 'New Blog Posted - SahajJobs', $emailContent);
                }

                $this->session->set_flashdata('success_message', 'Post added successfully!');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to add post.');
            }
        }

        redirect('admin/posts_add');
    }

    public function delete($id)
    {
        if ($this->Post_model->delete_post($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function update_post()
    {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $slug  = url_title($title, 'dash', TRUE);
        
        $original_slug = $slug;
        $i = 1;
        while (
            ($existing = $this->Post_model->get_post_by_slug($slug)) &&
            $existing->id != $id
        ) {
            $slug = $original_slug . '-' . $i;
            $i++;
        }

        $data = [
            'title' => $this->input->post('title'),
            'slug'        => $slug,
            'content' => $this->input->post('content'),
            'category_id' => $this->input->post('category_id'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

         $featured_image = null;

        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['name'] != '') {

            $config['upload_path'] = './ALL_UPLOADS/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('featured_image')) {

                $upload_data = $this->upload->data();

                $featured_image = './ALL_UPLOADS/images/' . $upload_data['file_name'];

                $data['featured_image'] = $featured_image;

                // delete old image
                $old_post = $this->Post_model->get_post_by_id($id);

                if ($old_post && !empty($old_post->featured_image) && file_exists($old_post->featured_image)) {
                    unlink($old_post->featured_image);
                }

            } else {

                echo json_encode([
                    'status' => 'error',
                    'message' => strip_tags($this->upload->display_errors())
                ]);

                return;
            }
        }

        if ($this->Post_model->update_post($id, $data)) {

            echo json_encode([
                'status' => 'success',
                'data' => [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'category_id' => $data['category_id'],
                    'featured_image' => isset($data['featured_image'])
                ? $data['featured_image']
                : null
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}