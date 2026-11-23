<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Govt_jobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('admin/GovtJob_model');
    }

    public function govt_jobs_manage()
    {
        $data['jobs'] = $this->GovtJob_model->get_government_jobs();
        $this->load->view('admin/govt_jobs_manage', $data);
    }

    public function govt_jobs_add()
    {
        $this->load->view('admin/govt_jobs_add');
    }

    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('organization', 'Organization', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('salary', 'Salary', 'required');
        $this->form_validation->set_rules('experience', 'Experience', 'required');
        $this->form_validation->set_rules('application_start_date', 'Application_start_date', 'required');
        $this->form_validation->set_rules('application_end_date', 'Application_end_date', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('total_vacancies', 'Total_vacancies', 'required');
        $this->form_validation->set_rules('referral_link_url', 'Referral_link_url', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_message', validation_errors());
        } else {

            $data = array(
                'title' => $this->input->post('title'),
                'department' => $this->input->post('department'),
                'organization' => $this->input->post('organization'),
                'country' => $this->input->post('country'),
                'job_type' => $this->input->post('job_type'),
                'qualification' => $this->input->post('qualification'),
                'experience' => $this->input->post('experience'),
                'total_vacancies' => $this->input->post('total_vacancies'),
                'application_start_date' => $this->input->post('application_start_date'),
                'application_end_date' => $this->input->post('application_end_date'),
                'salary' => $this->input->post('salary'),
                'description' => $this->input->post('description'),
                'referral_link_url' => $this->input->post('referral_link_url'),
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->GovtJob_model->add_govt_jobs($data)) {
                $this->session->set_flashdata('success_message', 'Job published successfully!');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to publish job.');
            }
        }

        redirect('admin/govt_jobs_add');
    }


    public function update()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid job ID']);
            return;
        }

        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'department' => $this->input->post('department'),
            'referral_link_url' => $this->input->post('referral_link_url'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->GovtJob_model->update_job($id, $data)) {

            echo json_encode([
                'status' => 'success',
                'data' => [
                    'id' => $id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'department' => $data['department'],
                    'referral_link_url' => $data['referral_link_url']
                ]
            ]);

        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update government job'
            ]);
        }
    }

    public function delete($id)
    {
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid job ID']);
            return;
        }

        if ($this->GovtJob_model->delete_job($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete government job'
            ]);
        }
    }


}