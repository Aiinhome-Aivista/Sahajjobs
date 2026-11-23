<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GovtJob_model extends CI_Model
{
    private $table = 'government_jobs';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_govt_jobs($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_job($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('government_jobs', $data);
    }

    public function delete_job($id)
    {
        return $this->db
            ->where('id', $id)
            ->delete('government_jobs');
    }

    public function get_jobs_by_country($country)
    {
        return $this->db
            ->where('country', $country)
            ->get('government_jobs')
            ->result();
    }


    public function get_government_jobs()
    {
        return $this->db
            ->where('job_type', 'government')
            ->where('status', 'active')
            ->order_by('created_at', 'ASC')
            ->get('government_jobs')
            ->result();
    }

    public function get_govt_jobs_by_id($id)
    {
        $this->db->select('government_jobs.*');
        $this->db->from($this->table);
        $this->db->where('government_jobs.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}