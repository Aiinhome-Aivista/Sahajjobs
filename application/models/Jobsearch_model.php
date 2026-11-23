<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobsearch_model extends CI_Model
{

   public function get_jobs($filters = [])
    {
        $this->db->select('
        posted_jobs.*,
        employer_register.websiteUrl,
        employer_register.linkedInUrl,
        employer_register.fbUrl
    ');
        $this->db->from('posted_jobs');

        // JOIN employer_register table
        $this->db->join(
            'employer_register',
            'employer_register.id = posted_jobs.employer_id',
            'left'
        );

        if (!empty($filters['job'])) {
            $this->db->like('posted_jobs.title', $filters['job']);
        }

        if (!empty($filters['location'])) {
            $this->db->where('posted_jobs.location', $filters['location']);
        }

        if (!empty($filters['company'])) {
            $this->db->where('posted_jobs.company', $filters['company']);
        }

        if (!empty($filters['industry'])) {
            $this->db->where('posted_jobs.industry', $filters['industry']);
        }

        if (!empty($filters['job_type'])) {
            $this->db->where('posted_jobs.job_type', $filters['job_type']);
        }

        if (!empty($filters['work_mode'])) {
            $this->db->where('posted_jobs.work_mode', $filters['work_mode']);
        }

        if (!empty($filters['experience'])) {
            $this->db->like('posted_jobs.experience', $filters['experience']);
        }

        if (!empty($filters['salary'])) {
            $minSalary = intval(str_replace('+', '', $filters['salary']));
            $this->db->where(
                "CAST(REPLACE(REPLACE(posted_jobs.salary, '₹',''), ',', '') AS UNSIGNED) >= ",
                $minSalary,
                false
            );
        }

        // $this->db->where("(posted_jobs.last_date IS NULL OR posted_jobs.last_date >= CURDATE())", null, false);
        $this->db->order_by('posted_jobs.created_at', 'DESC');

        return $this->db->get()->result_array();
    }

    public function get_featured_companies($limit = 50)
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

     public function get_companies()
    {
        $this->db->select('TRIM(company) as company', false);
        $this->db->from('employer_register');
        $this->db->where("TRIM(company) <> ''", null, false);
        $this->db->where("company IS NOT NULL", null, false);
        $this->db->distinct();
        $this->db->order_by('company', 'ASC');

        $query = $this->db->get();
        $rows = $query->result_array();

        return array_map(function($r){ return $r['company']; }, $rows);
    }


    public function get_job_by_id($id)
    {
        return $this->db->get_where('posted_jobs', ['id' => $id])->row_array();
    }
}
