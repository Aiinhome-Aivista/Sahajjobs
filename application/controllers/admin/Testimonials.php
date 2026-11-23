<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimonials extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Testimonials_model');
    }

    public function index()
    {
        $data['testimonials'] = $this->Testimonials_model->get_all_testimonials_with_candidate_name();
        $data['candidates'] = $this->Testimonials_model->get_all_candidates();
        $this->load->view('admin/testimonials', $data);
    }

    public function delete_testimonial($id = null)
    {
        header('Content-Type: application/json');

        if ($id && $this->Testimonials_model->delete($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function update_testimonial()
    {
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $data = [
            'candidate_id' => $this->input->post('candidate_id'),
            'review' => $this->input->post('review'),
        ];

        // Handle file upload
        $image_path = $this->input->post('current_image');

        if (!empty($_FILES['image_file']['name'])) {
            $config['upload_path'] = './ALL_UPLOADS/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = FALSE;
            $config['file_name'] = $_FILES['image_file']['name'];

            // Create directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image_file')) {
                $upload_data = $this->upload->data();
                $image_path = 'ALL_UPLOADS/images/' . $upload_data['file_name'];
                
                // Delete old image if exists
                if (!empty($this->input->post('current_image'))) {
                    $old_image = './' . $this->input->post('current_image');
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(['status' => 'error', 'message' => $error]);
                return;
            }
        }

        $data['image'] = $image_path;

        if ($this->Testimonials_model->update($id, $data)) {
            $updated_testimonial = $this->Testimonials_model->get_testimonial_by_id($id);
            echo json_encode([
                'status' => 'success',
                'message' => 'Testimonial updated successfully.',
                'data' => [
                    'candidate_name' => $updated_testimonial->candidate_name,
                    'image' => $updated_testimonial->image,
                    'review' => $updated_testimonial->review
                ]
            ]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function add_testimonial()
    {
        header('Content-Type: application/json');

        // Handle file upload
        $image_path = '';

        if (!empty($_FILES['image_file']['name'])) {
            $config['upload_path'] = './ALL_UPLOADS/images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = FALSE;
            $config['file_name'] =  $_FILES['image_file']['name'];

            // Create directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image_file')) {
                $upload_data = $this->upload->data();
                $image_path = 'ALL_UPLOADS/images/' . $upload_data['file_name'];
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(['status' => 'error', 'message' => $error]);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Image file is required']);
            return;
        }

        $data = [
            'candidate_id' => $this->input->post('candidate_id'),
            'image' => $image_path,
            'review' => $this->input->post('review'),
        ];

        if ($this->Testimonials_model->insert($data)) {
            echo json_encode(['status' => 'success']);
        } else {
            log_message('error', 'Database insertion failed: ' . $this->db->error()['message']);
            echo json_encode([
                'status' => 'error',
                'message' => 'Database insertion failed.'
            ]);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
    }
}
