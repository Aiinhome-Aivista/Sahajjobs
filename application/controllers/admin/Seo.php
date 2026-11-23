<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('admin/Seo_model');
    }

    public function seo_manage()
    {
        $data['seo'] = $this->Seo_model->get_seo_details();
        $this->load->view('admin/seo_manage', $data);
    }

    public function seo_add()
    {
        $this->load->view('admin/seo_add');
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('keywords', 'Keywords', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_message', validation_errors());
        } else {

            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'keywords' => $this->input->post('keywords'),
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->Seo_model->add_seo_details($data)) {
                $this->session->set_flashdata('success_message', 'SEO details added successfully!');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to add SEO details.');
            }
        }

        redirect('admin/seo_add');
    }


    public function update()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid SEO ID']);
            return;
        }

        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'keywords' => $this->input->post('keywords'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->Seo_model->update_seo_details($id, $data)) {

            echo json_encode([
                'status' => 'success',
                'data' => [
                    'id' => $id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'keywords' => $data['keywords']
                ]
            ]);

        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update SEO details'
            ]);
        }
    }

    public function delete($id)
    {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid SEO ID']);
            return;
        }

        if ($this->Seo_model->delete_seo_details($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete SEO details'
            ]);
        }
    }


}