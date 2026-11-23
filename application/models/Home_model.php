<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Home_model extends CI_Model
{


    public function getTopHiringEmployers($limit = 4)
    {
        $this->db->select('
            er.id,
            er.company,
            er.picture AS image_path,
            fc.logo AS company_logo,
            COUNT(pj.employer_id) AS total_jobs
        ');

    
        $this->db->from('posted_jobs AS pj');

   
        $this->db->join('employer_register AS er', 'pj.employer_id = er.id');

    
        $this->db->join('featured_companies AS fc', 'fc.employer_id = er.id', 'left');

   
        $this->db->group_by('er.id');

   
        $this->db->order_by('total_jobs', 'DESC');
        $this->db->order_by('er.company', 'ASC');

        $this->db->limit($limit);

        return $this->db->get()->result();
    }


    public function getFeaturedCompanies($limit = 50)
    {

        $this->db->select('*');

        $this->db->from('featured_companies');

        $this->db->where('is_featured', 1);

        $this->db->order_by('rating', 'DESC');

        $this->db->order_by('reviews', 'DESC');

        $this->db->limit($limit);

        $query = $this->db->get();

        return $query->result();

    }


    public function get_active_jobs()
    {
        $today = date('Y-m-d');
        $this->db->select('id, title, company, location, experience, salary, last_date, created_at');
        $this->db->from('posted_jobs');
        // $this->db->where('last_date >=', $today);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_home_stats()
    {
        // Unique applied candidates from applied_jobs table
        $applied_candidates = $this->db
            ->select('COUNT(DISTINCT user_id) AS total')
            ->from('applied_jobs')
            ->get()
            ->row()
            ->total;

        // Total posted jobs
        $posted_jobs = $this->db
            ->count_all('posted_jobs');

        // Total hiring companies
        $hiring_companies = $this->db
            ->count_all('employer_register');

        return [
            'applied_candidates' => (int) $applied_candidates,
            'posted_jobs' => (int) $posted_jobs,
            'hiring_companies' => (int) $hiring_companies,
        ];
    }

}