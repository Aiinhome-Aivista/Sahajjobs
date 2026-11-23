<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {
    protected $table = 'posted_jobs';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_job($id) {
        $this->db->where('id', (int)$id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }
}
