<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate_management extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load the model
        $this->load->model('admin/Candidate_management_model');
    }

    public function index()
    {

        $data['candidates'] = $this->Candidate_management_model->get_all_candidates();

        $this->load->view('admin/candidate_management', $data);
    }

    // Delete candidate (AJAX request)
    public function delete_candidate($id = null)
    {

        header('Content-Type: application/json'); // important for fetch()

        if ($id && $this->Candidate_management_model->delete_candidate($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    public function update_candidate()
    {
        $id = $this->input->post('id');
        $data = [
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'mobile_number' => $this->input->post('mobile_number'),
            'work_status' => $this->input->post('work_status'),
        ];

        // $password = $this->input->post('password');
        // if (!empty($password)) {
        //     $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        // }

        if ($this->Candidate_management_model->update_candidate($id, $data)) {
            // Do not return password in response
            // unset($data['password']);
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }



    public function view_resume($candidateId = null)
    {
        if (empty($candidateId)) {
            show_404();
            return;
        }

        $resume = $this->Candidate_management_model->get_resume_by_candidate($candidateId);

        if (empty($resume)) {
            show_404();
            return;
        }

        if (!empty($resume->file_path) && (strpos($resume->file_path, 'http://') === 0 || strpos($resume->file_path, 'https://') === 0)) {
            redirect($resume->file_path);
            return;
        }

        $possible_paths = [];

        if (!empty($resume->file_path)) {
            if (file_exists($resume->file_path)) {
                $possible_paths[] = $resume->file_path;
            }

            $possible_paths[] = FCPATH . ltrim($resume->file_path, '/\\');

            $possible_paths[] = FCPATH . 'uploads/resumes/' . ltrim($resume->file_path, '/\\');
            $possible_paths[] = FCPATH . 'ALL_UPLOADS/resumes/' . ltrim($resume->file_path, '/\\');
        }

        if (empty($resume->file_path) && !empty($resume->file_name)) {
            $possible_paths[] = FCPATH . 'uploads/resumes/' . $resume->file_name;
            $possible_paths[] = FCPATH . 'ALL_UPLOADS/resumes/' . $resume->file_name;
        }

        $file = null;
        foreach ($possible_paths as $p) {
            if (!empty($p) && file_exists($p)) {
                $file = $p;
                break;
            }
        }

        if (empty($file)) {
            show_404();
            return;
        }

        // Determine mime type (prefer DB value if present)
        $mime = 'application/octet-stream';
        if (!empty($resume->mime_type)) {
            $mime = $resume->mime_type;
        } else {
            // try PHP detection
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $detected = finfo_file($finfo, $file);
                finfo_close($finfo);
                if (!empty($detected))
                    $mime = $detected;
            } elseif (function_exists('mime_content_type')) {
                $detected = mime_content_type($file);
                if (!empty($detected))
                    $mime = $detected;
            }
        }

        // Serve file inline so browser opens in new tab
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mime);
        header('Content-Disposition: inline; filename="' . basename($resume->file_name ?: $file) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        header('Content-Length: ' . filesize($file));

        // Clean output buffer and output file
        @ob_clean();
        @flush();
        readfile($file);
        exit;
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin/login'));
    }
}
