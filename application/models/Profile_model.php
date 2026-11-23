<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_profile($user_id)
    {
        return $this->db->get_where('register', ['id' => $user_id])->row_array();
    }

    public function get_contact($user_id)
    {
        return $this->db->get_where('user_contact', ['user_id' => $user_id])->row_array();
    }

    public function save_contact($data)
    {
        $existing = $this->db->get_where('user_contact', ['user_id' => $data['user_id']])->row_array();
        if ($existing) {
            $this->db->where('user_id', $data['user_id'])->update('user_contact', $data);
            return $this->db->affected_rows() > 0;
        } else {
            return $this->db->insert('user_contact', $data);
        }
    }

    // Resume methods
    public function get_resume($user_id)
    {
        return $this->db->get_where('resumes', ['user_id' => $user_id])->row_array();
    }

    // public function save_resume($data)
    // {
    //     $this->db->where('user_id', $data['user_id'])->delete('resumes');
    //     return $this->db->insert('resumes', $data);
    // }
    
    public function save_resume($data)
    {
        $existing = $this->get_resume($data['user_id']);
        if ($existing && !empty($existing['file_path'])) {
            $file_path = FCPATH . $existing['file_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $this->db->where('user_id', $data['user_id'])->delete('resumes');
        return $this->db->insert('resumes', $data);
    }

    public function get_resume_by_id($doc_id)
    {
        return $this->db->get_where('resumes', ['doc_id' => $doc_id])->row_array();
    }

    public function delete_resume($doc_id)
    {
        return $this->db->delete('resumes', ['doc_id' => $doc_id]);
    }

    // Profile photo methods
    public function get_profile_photo($user_id)
    {
        // $result = $this->db->get_where('profile_photos', ['user_id' => $user_id])->row_array();
        // return $result ? 'assets/profile_photos/' . $result['file_name'] : null;

        $result = $this->db->get_where('profile_photos', ['user_id' => $user_id])->row_array();
        return $result ? './ALL_UPLOADS/profile_photos/' . $result['file_name'] : null;
    }

    public function save_profile_photo($user_id, $file_name)
    {
        $data = [
            'user_id' => $user_id,
            'file_name' => $file_name,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('profile_photos', $data);
    }

    public function update_profile_photo($user_id, $file_name)
    {
        $data = [
            'file_name' => $file_name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('user_id', $user_id)->update('profile_photos', $data);
        return $this->db->affected_rows() > 0;
    }


    // New Qualification methods to fix the issue

    public function get_user_qualifications($user_id)
    {
        $data = [];
        $data['work_experience'] = $this->db->get_where('user_work_experience', ['user_id' => $user_id])->result_array();
        $data['education'] = $this->db->get_where('user_education', ['user_id' => $user_id])->result_array();
        $data['skills'] = $this->db->get_where('user_skills', ['user_id' => $user_id])->result_array();
        $data['licenses'] = $this->db->get_where('user_licenses', ['user_id' => $user_id])->result_array();
        $data['certifications'] = $this->db->get_where('user_certifications', ['user_id' => $user_id])->result_array();
        $data['languages'] = $this->db->get_where('user_languages', ['user_id' => $user_id])->result_array();
        return $data;
    }

    public function save_qualification($type, $item)
    {
        $table = '';
        switch ($type) {
            case 'work_experience':
                $table = 'user_work_experience';
                break;
            case 'education':
                $table = 'user_education';
                break;
            case 'skills':
                $table = 'user_skills';
                break;
            case 'licenses':
                $table = 'user_licenses';
                break;
            case 'certifications':
                $table = 'user_certifications';
                break;
            case 'languages':
                $table = 'user_languages';
                break;
            default:
                return false; // Invalid type
        }
        return $this->db->insert($table, $item);
    }

    public function delete_qualification($type, $id, $user_id)
    {
        $table = '';
        switch ($type) {
            case 'work_experience':
                $table = 'user_work_experience';
                break;
            case 'education':
                $table = 'user_education';
                break;
            case 'skills':
                $table = 'user_skills';
                break;
            case 'licenses':
                $table = 'user_licenses';
                break;
            case 'certifications':
                $table = 'user_certifications';
                break;
            case 'languages':
                $table = 'user_languages';
                break;
            default:
                return false; // Invalid type
        }
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->delete($table);
    }

    public function update_qualification($id, $type, $data) {
        $table = '';
        switch ($type) {
            case 'work_experience':
                $table = 'user_work_experience';
                break;
            case 'education':
                $table = 'user_education';
                break;
            case 'skills':
                $table = 'user_skills';
                break;
            case 'licenses':
                $table = 'user_licenses';
                break;
            case 'certifications':
                $table = 'user_certifications';
                break;
            case 'languages':
                $table = 'user_languages';
                break;
            default:
                return false;
        }
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }

    public function get_qualification_by_id($id, $type, $user_id)
    {
        $table = '';
        switch ($type) {
            case 'work_experience':
                $table = 'user_work_experience';
                break;
            case 'education':
                $table = 'user_education';
                break;
            case 'skills':
                $table = 'user_skills';
                break;
            case 'licenses':
                $table = 'user_licenses';
                break;
            case 'certifications':
                $table = 'user_certifications';
                break;
            case 'languages':
                $table = 'user_languages';
                break;
            default:
                return null;
        }
        return $this->db->get_where($table, ['id' => $id, 'user_id' => $user_id])->row_array();
    }
    
    public function save_cv_details($user_id, $full_text, $skills, $projects)
    {
        log_message('error', 'Beginning of save_cv_details() for user: ' . $user_id);
        $data = [
            'user_id' => $user_id,
            'full_text' => $full_text,
            'skills' => $skills,
            'projects' => $projects,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Synchronize user_skills table
        log_message('error', 'Synchronizing user_skills for user: ' . $user_id);
        $this->db->where('user_id', $user_id)->delete('user_skills');
        if (!empty($skills)) {
            $skills_array = explode(',', $skills);
            $inserted_skills = [];
            foreach ($skills_array as $skill) {
                $trimmed = trim($skill);
                if ($trimmed !== '') {
                    $lower_trimmed = strtolower($trimmed);
                    if (!in_array($lower_trimmed, $inserted_skills)) {
                        $this->db->insert('user_skills', [
                            'user_id' => $user_id,
                            'skill_name' => $trimmed
                        ]);
                        $inserted_skills[] = $lower_trimmed;
                    }
                }
            }
        }

        $existing = $this->db->get_where('cv_details', ['user_id' => $user_id])->row_array();
        if ($existing) {
            log_message('error', 'Performing UPDATE on cv_details for user: ' . $user_id);
            $result = $this->db->where('user_id', $user_id)->update('cv_details', $data);
            log_message('error', 'Update returned: ' . ($result ? 'TRUE' : 'FALSE'));
            log_message('error', 'Affected rows: ' . $this->db->affected_rows());
            log_message('error', 'Last Query: ' . $this->db->last_query());
            log_message('error', 'DB Error: ' . print_r($this->db->error(), true));
            log_message('error', 'Transaction status: ' . ($this->db->trans_status() ? 'TRUE' : 'FALSE'));
            return $result;
        } else {
            log_message('error', 'Performing INSERT on cv_details for user: ' . $user_id);
            $result = $this->db->insert('cv_details', $data);
            log_message('error', 'Insert returned: ' . ($result ? 'TRUE' : 'FALSE'));
            log_message('error', 'Affected rows: ' . $this->db->affected_rows());
            log_message('error', 'Last Query: ' . $this->db->last_query());
            log_message('error', 'DB Error: ' . print_r($this->db->error(), true));
            log_message('error', 'Transaction status: ' . ($this->db->trans_status() ? 'TRUE' : 'FALSE'));
            return $result;
        }
    }
}