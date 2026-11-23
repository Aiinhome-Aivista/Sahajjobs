<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mock_interview_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_active_plan($user_id, $job_role = 'Soft Skill Interview')
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('job_role', $job_role);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('ai_interview_plans');
        return $query->row_array();
    }

    public function create_plan($user_id, $job_role = 'Soft Skill Interview')
    {
        $skills = ($job_role === 'Technical Interview')
            ? 'Coding, Data Structures, System Design, Algorithms'
            : 'Communication, Behavioral, Problem Solving';

        $data = [
            'user_id' => $user_id,
            'job_role' => $job_role,
            'skills' => $skills,
            'difficulty_level' => 'Medium',
            'current_week' => 1,
            // 'created_at' => date('Y-m-d H:i:s'),
            // 'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('ai_interview_plans', $data);
        return $this->db->insert_id();
    }

    public function get_plan($plan_id)
    {
        $this->db->where('id', $plan_id);
        $query = $this->db->get('ai_interview_plans');
        return $query->row_array();
    }

    public function create_session($plan_id, $user_id)
    {
        $data = [
            'plan_id' => $plan_id,
            'user_id' => $user_id,
            'week_number' => 1,
            'status' => 'started',
            // 'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('ai_interview_sessions', $data);
        return $this->db->insert_id();
    }

    public function get_session($session_id)
    {
        $this->db->where('id', $session_id);
        $query = $this->db->get('ai_interview_sessions');
        return $query->row_array();
    }

    public function add_question($session_id, $question_text, $question_order, $user_id)
    {
        $data = [
            'session_id' => $session_id,
            'user_id' => $user_id,
            'question_text' => $question_text,
            'answer_format' => 'text', // default format, can be updated dynamically
            'question_order' => $question_order,
            // 'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('ai_interview_questions', $data);
        return $this->db->insert_id();
    }

    public function save_answer($question_id, $answer_text, $answer_format = 'text')
    {
        $data = [
            'candidate_response' => $answer_text,
            'answer_format' => $answer_format,
            //  'answered_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $question_id);
        return $this->db->update('ai_interview_questions', $data);
    }

    public function get_questions($session_id)
    {
        $this->db->where('session_id', $session_id);
        $this->db->order_by('question_order', 'ASC');
        $query = $this->db->get('ai_interview_questions');
        return $query->result_array();
    }

    public function update_session($session_id, $data)
    {
        $this->db->where('id', $session_id);
        return $this->db->update('ai_interview_sessions', $data);
    }

    public function get_user_by_id($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('register');
        return $query->row_array();
    }

    public function get_user_resume($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('resumes');
        return $query->row_array();
    }

    public function get_user_skills($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_skills');
        return $query->result_array();
    }

     public function get_user_sessions($user_id, $status = 'completed')
    {
        $this->db->select('s.*, p.job_role');
        $this->db->from('ai_interview_sessions s');
        $this->db->join('ai_interview_plans p', 's.plan_id = p.id', 'left');
        $this->db->where('s.user_id', $user_id);
        if ($status !== null) {
            $this->db->where('s.status', $status);
        }
        $this->db->order_by('s.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_cv_details($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('cv_details');
        return $query->row_array();
    }
}
