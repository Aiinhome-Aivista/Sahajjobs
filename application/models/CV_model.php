<?php
class CV_model extends CI_Model
{
    public function insert_cv($data)
    {
        $this->db->insert('cv_profiles', $data);
        return $this->db->insert_id();
    }

    public function get_cv($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('cv_profiles')
            ->row();
    }

    // public function check_recent_duplicate($email)
    // {
    //     return $this->db
    //         ->where('email', $email)
    //         ->order_by('id', 'DESC')
    //         ->limit(1)
    //         ->get('cv_profiles')
    //         ->row();
    // }
}