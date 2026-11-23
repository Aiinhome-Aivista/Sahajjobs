<?php
class Recruiter_post_model extends CI_Model {

     public function insert_job($data) {
        $this->db->insert('posted_jobs', $data);
         return $this->db->insert_id();
    }
    
     public function get_company_name($employer_id)
     {
          $this->db->select('company');
          $this->db->where('id', $employer_id);
          $query = $this->db->get('employer_register');
          return $query->row();
     }
     
     public function get_currencies()
     {
          return $this->db
               ->select("id, code, symbol, CONCAT(code, ' - ', symbol) AS display")
               ->where('is_active', 1)
               ->order_by('display', 'ASC')
               ->get('currencies')
               ->result();
     }
     
     public function get_currency_by_id($id)
     {
          return $this->db
               ->select('symbol')
               ->where('id', $id)
               ->get('currencies')
               ->row();
     }
}