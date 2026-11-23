<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimonials_model extends CI_Model
{
    public function get_all_testimonials()
    {
        $this->db->select('t.*, r.full_name as candidate_name');
        $this->db->from('testimonials t');
        $this->db->join('register r', 'r.id = t.candidate_id', 'left');
        $this->db->order_by('t.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_testimonials_with_candidate_name()
    {
        return $this->get_all_testimonials();
    }

    public function get_all_candidates()
    {
        $this->db->select('id, full_name');
        $this->db->from('register');
        $this->db->order_by('full_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_testimonial_by_id($id)
    {
        $this->db->select('t.*, r.full_name as candidate_name');
        $this->db->from('testimonials t');
        $this->db->join('register r', 'r.id = t.candidate_id', 'left');
        $this->db->where('t.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data)
    {
        return $this->db->insert('testimonials', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('testimonials', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('testimonials');
    }
}
