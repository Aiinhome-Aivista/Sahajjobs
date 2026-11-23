<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_dashboard_model extends CI_Model
{
    public function get_recent_jobs($limit = 5)
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('posted_jobs');
        return $query->result();
    }
    
    public function get_admin_by_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('admin_login')
            ->row();
    }

}
