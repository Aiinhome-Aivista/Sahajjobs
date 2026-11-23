<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seo_model extends CI_Model
{
    private $table = 'seo_details';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_seo_details($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_seo_details($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('seo_details', $data);
    }

    public function delete_seo_details($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete('seo_details');
    }

    
    public function get_seo_details()
    {
        return $this->db
            ->order_by('created_at', 'ASC')
            ->get('seo_details')
            ->result();
    }

    public function get_details_seo()
    {
        return $this->db
            ->order_by('created_at', 'ASC')
            ->get('seo_details')
            ->row();
    }
}