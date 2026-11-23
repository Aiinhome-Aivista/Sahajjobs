<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->model('User_model');
        $this->load->model('Menu_model');

        $this->load->helper(['form', 'url', 'download']);
        $this->load->library('session');
        $this->load->model('admin/Seo_model');
    }

    // ===============================
    // PROFILE MAIN PAGE
    // ===============================
    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        $data['user'] = $this->Profile_model->get_user_profile($user_id);
        $data['location'] = $this->Profile_model->get_contact($user_id);
        $data['resume'] = $this->Profile_model->get_resume($user_id);
        $data['menu'] = $this->Menu_model->get_menu();
        $data['profile_photo'] = $this->Profile_model->get_profile_photo($user_id);
        $qualifications = $this->Profile_model->get_user_qualifications($user_id);
        $data = array_merge($data, $qualifications);
        
        $data['seo'] = $this->Seo_model->get_details_seo();
        
        $this->load->view("includes/login_header", $data);
        $this->load->view('profile_view', $data);
        $this->load->view('includes/footer', $data);
    }

    // ===============================
    // READY TO WORK FEATURE
    // ===============================
    public function readyToWork()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        $data['user_availability'] = $this->User_model->getUserAvailability($user_id);
        $this->load->view('ready_to_work_view', $data);
    }

    public function updateAvailability()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            return;
        }

        if ($this->input->is_ajax_request() && $this->input->post()) {
            $is_available = $this->input->post('is_available');
            $update_data = ['is_available' => $is_available];
            $result = $this->User_model->updateUserAvailability($user_id, $update_data);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Availability updated successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update availability.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }
    }

    // ===============================
    // CONTACT INFO
    // ===============================
    public function edit_contact()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        $data['user'] = $this->Profile_model->get_user_profile($user_id);
        $data['location'] = $this->Profile_model->get_contact($user_id);
        $this->load->view('edit_contact', $data);
    }

    public function update_contact()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        $updateUser = [
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'mobile_number' => $this->input->post('mobile_number')
        ];
        $this->db->where('id', $user_id)->update('register', $updateUser);

        $updateContact = [
            'user_id' => $user_id,
            'country' => $this->input->post('country'),
            'street' => $this->input->post('street'),
            'city_state' => $this->input->post('city_state'),
            'area' => $this->input->post('area'),
            'pincode' => $this->input->post('pincode'),
            'relocation' => $this->input->post('relocation') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->Profile_model->save_contact($updateContact);

        $this->session->set_flashdata('success', 'Profile updated successfully!');
        redirect('profile');
    }

    // ===============================
    // RESUME HANDLING
    // ===============================
    public function upload_resume()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        if (empty($_FILES['resume_file']['name'])) {
            $this->session->set_flashdata('error', 'No file selected.');
            redirect('profile');
        }

        $config['upload_path'] = FCPATH . 'ALL_UPLOADS/resumes/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;
        $config['detect_mime'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('resume_file')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
            redirect('profile');
        }

        $fileData = $this->upload->data();

        $allowed_extensions = ['.pdf', '.doc', '.docx'];

        if (!in_array(strtolower($fileData['file_ext']), $allowed_extensions)) {
            unlink($fileData['full_path']);
            $this->session->set_flashdata('error', 'Invalid resume file type.');
            redirect('profile');
        }

        $resumeData = [
            'user_id' => $user_id,
            'file_name' => $fileData['client_name'],
            'file_path' => 'ALL_UPLOADS/resumes/' . $fileData['file_name'],
            // 'uploaded_at' => date('Y-m-d H:i:s')
        ];

        $this->Profile_model->save_resume($resumeData);
        log_message('error', 'CV upload succeeded for user: ' . $user_id);
        log_message('error', 'Uploaded file path: ' . $resumeData['file_path']);
        
                // Extract skills and projects from CV and save
        $full_resume_path = FCPATH . $resumeData['file_path'];
        log_message('error', 'Calling Python parser on path: ' . $full_resume_path);
        $cv_text = $this->get_cv_text($full_resume_path);
        if ($cv_text) {
            log_message('error', 'Python parser output (first 200 chars): ' . substr($cv_text, 0, 200));
            $prompt = "You are an expert resume parsing AI. Below is the text content extracted from a candidate's CV:
---
$cv_text
---

TASK: Extract the candidate's skills and projects from the CV text.
Format your response exactly as a JSON object with the following two keys:
1. 'skills': A comma-separated string listing all the technical skills, programming languages, databases, libraries, tools, and soft skills mentioned in the CV (e.g. \"Python, SQL, JavaScript, React, Git, Agile\").
2. 'projects': A string detailing the projects described in the CV. Keep the project description concise, clear, and formatted as neat bullet points or short paragraphs.

Do not include any introductory text, markdown formatting blocks (like ```json), or explanations. Return ONLY the raw JSON string.";

            $extracted_json = $this->call_mistral($prompt);
            log_message('error', 'Mistral API raw response: ' . $extracted_json);
            if ($extracted_json) {
                $clean_json = preg_replace('/^```(?:json)?\s*|```\s*$/i', '', trim($extracted_json));
                $parsed_data = json_decode($clean_json, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $skills = $parsed_data['skills'] ?? '';
                    $projects = $parsed_data['projects'] ?? '';
                    log_message('error', 'Calling save_cv_details() for user: ' . $user_id . ' | Skills: ' . $skills . ' | Projects: ' . $projects);
                    $this->Profile_model->save_cv_details($user_id, $cv_text, $skills, $projects);
                } else {
                    log_message('error', 'Failed to parse CV extraction JSON: ' . $clean_json);
                }
            }
        } else {
            log_message('error', 'Python parser failed or returned empty text for path: ' . $full_resume_path);
        }
        
        $this->session->set_flashdata('success', 'Resume uploaded successfully!');
        redirect('profile');
    }

    public function view_resume($doc_id)
    {
        $resume = $this->Profile_model->get_resume_by_id($doc_id);
        if ($resume) {
            redirect(base_url($resume['file_path']));
        } else {
            show_404();
        }
    }

    public function download_resume($doc_id)
    {
        $resume = $this->Profile_model->get_resume_by_id($doc_id);
        if ($resume) {
            force_download(FCPATH . $resume['file_path'], NULL);
        } else {
            show_404();
        }
    }

    public function delete_resume($doc_id)
    {
        $resume = $this->Profile_model->get_resume_by_id($doc_id);
        if ($resume && file_exists(FCPATH . $resume['file_path'])) {
            unlink(FCPATH . $resume['file_path']);
            $this->Profile_model->delete_resume($doc_id);
            $this->session->set_flashdata('success', 'Resume deleted successfully!');
        }
        redirect('profile');
    }

    // ===============================
    // QUALIFICATIONS
    // ===============================
    public function qualifications()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $user_id = $this->session->userdata('user_id');
        $data = $this->Profile_model->get_user_qualifications($user_id);
         $this->load->view("includes/login_header", $data);
        $this->load->view('qualifications_view', $data);
        $this->load->view("includes/footer", $data);
    }

    public function submit_qualification()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            return;
        }

        $type = $this->input->post('type');
        $item = $this->input->post();
        unset($item['type']);
        $item['user_id'] = $user_id;

        if ($this->Profile_model->save_qualification($type, $item)) {
            $id = $this->db->insert_id();
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save qualification.']);
        }
    }

    public function delete_qualification()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            return;
        }

        $id = $this->input->post('id');
        $type = $this->input->post('type');

        if ($this->Profile_model->delete_qualification($type, $id, $user_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete qualification.']);
        }
    }

    public function get_qualification_details()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            return;
        }

        $id = $this->input->get('id');
        $type = $this->input->get('type');

        if (empty($id) || empty($type)) {
            echo json_encode(['success' => false, 'message' => 'Missing ID or type.']);
            return;
        }

        $item = $this->Profile_model->get_qualification_by_id($id, $type, $user_id);

        if ($item) {
            echo json_encode(['success' => true, 'item' => $item]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Item not found or does not belong to the user.']);
        }
    }

    public function update_qualification()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            return;
        }

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $data = $this->input->post();
        unset($data['id']);
        unset($data['type']);

        $existing_item = $this->Profile_model->get_qualification_by_id($id, $type, $user_id);

        if (!$existing_item) {
            echo json_encode(['success' => false, 'message' => 'Item not found or unauthorized update attempt.']);
            return;
        }

        if ($this->Profile_model->update_qualification($id, $type, $data)) {
            $updated_item = $this->Profile_model->get_qualification_by_id($id, $type, $user_id);
            echo json_encode(['success' => true, 'updated_item' => $updated_item]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update qualification.']);
        }
    }

    public function delete_qualifications_batch()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
            return;
        }

        $items = $this->input->post('items');

        if (empty($items) || !is_array($items)) {
            echo json_encode(['success' => false, 'message' => 'No items provided for deletion.']);
            return;
        }

        $success = true;
        foreach ($items as $item) {
            if (!$this->Profile_model->delete_qualification($item['type'], $item['id'], $user_id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Selected items deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'An error occurred during batch deletion.']);
        }
    }

    public function upload_photo()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');

        // $config['upload_path'] = FCPATH . 'assets/profile_photos/';
        $config['upload_path'] = FCPATH . './ALL_UPLOADS/profile_photos/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024; // 1MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->load->model('Profile_model');

        if (!$this->upload->do_upload('profile_photo')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            // $file_path = 'assets/profile_photos/' . $file_name;
            $file_path = './ALL_UPLOADS/profile_photos/' . $file_name;

            $existing_photo = $this->Profile_model->get_profile_photo($user_id);

            if ($existing_photo) {
                if (file_exists(FCPATH . $existing_photo)) {
                    unlink(FCPATH . $existing_photo);
                }
                $this->Profile_model->update_profile_photo($user_id, $file_name);
            } else {
                $this->Profile_model->save_profile_photo($user_id, $file_name);
            }

            $this->session->set_flashdata('success', 'Profile photo uploaded successfully!');
        }
        redirect('profile');
    }
    
    private function get_cv_text($resume_path)
    {
        if (!file_exists($resume_path)) {
            log_message('error', 'File not found inside get_cv_text: ' . $resume_path);
            return null;
        }

        // $python = escapeshellarg(FCPATH . 'venv\\Scripts\\python.exe');
        // $python_script = escapeshellarg(APPPATH . 'helpers\\parse_resume.py');
        // $escaped_path = escapeshellarg($resume_path);

        // $command = "$python $python_script $escaped_path 2>&1";
        
        $python = escapeshellarg('/home/capdpgtz/sahajjobs.com/venv/bin/python');
        $python_script = escapeshellarg('/home/capdpgtz/sahajjobs.com/application/helpers/parse_resume.py');
        $escaped_path = escapeshellarg($resume_path);

        $command = "$python $python_script $escaped_path 2>&1";

        log_message('error', 'Executing command inside get_cv_text: ' . $command);

        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);

        log_message('error', 'Python parser return_var: ' . $return_var);
        log_message('error', 'Python parser output array: ' . print_r($output, true));

        if ($return_var === 0) {
            $parsed_text = trim(implode("\n", $output));
            log_message('error', 'Successfully parsed text. Length: ' . strlen($parsed_text));
            log_message('error', 'First 500 characters of the parsed text: ' . substr($parsed_text, 0, 500));
            return $parsed_text;
        }

        log_message('error', 'Python parser execution failed with status code ' . $return_var . '. Output: ' . implode("\n", $output));
        return null;
    }

    private function call_mistral($prompt)
    {
        $data = [
            'model' => 'mistral-small:24b',
            'prompt' => $prompt,
            'stream' => false
        ];

        $ch = curl_init('http://122.163.121.176:3041/api/generate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            log_message('error', 'Mistral API Error: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        $json = json_decode($response, true);
        return isset($json['response']) ? trim($json['response']) : null;
    }
}