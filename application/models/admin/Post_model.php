<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{

    private $table = 'posts_add';
    private $categories_table = 'post_categories';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_post_by_id($id)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from($this->table);
        $this->db->join($this->categories_table, 'posts_add.category_id = post_categories.id', 'left');
        $this->db->where('posts_add.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    // Previous post (older)
    public function get_previous_post($post_id)
    {
        return $this->db
            ->where('id <', $post_id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('posts_add')
            ->row();
    }

    // Next post (newer)
    public function get_next_post($post_id)
    {
        return $this->db
            ->where('id >', $post_id)
            ->order_by('id', 'ASC')
            ->limit(1)
            ->get('posts_add')
            ->row();
    }
    
    public function get_latest_posts($post_id)
    {
        return $this->db
            ->where('id !=', $post_id)
            ->order_by('created_at', 'DESC')
            ->get('posts_add')
            ->result();
    }

    public function get_related_posts($category_id, $current_post_id, $limit = 10)
    {
        return $this->db
            ->where('category_id', $category_id)
            ->where('id !=', $current_post_id)
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('posts_add')
            ->result();
    }
    
    
    public function insert_subscriber($data)
    {
        return $this->db->insert('newsletter_subscribers', $data);
    }

    public function email_exists($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('newsletter_subscribers')
            ->row();
    }

    public function get_all_subscribers()
    {
        return $this->db
            ->select('email')
            ->from('newsletter_subscribers')
            ->get()
            ->result_array();
    }


    public function add_post($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_posts_with_categories($limit = null, $offset = null)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from($this->table);
        $this->db->join($this->categories_table, 'posts_add.category_id = post_categories.id', 'left');
        $this->db->order_by('posts_add.created_at', 'DESC');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $posts = $query->result();

        return $posts;
    }

    public function count_all_posts()
    {
        return $this->db->count_all($this->table);
    }


    public function search_posts($search_term, $limit = null, $offset = null)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from($this->table);
        $this->db->join($this->categories_table, 'posts_add.category_id = post_categories.id', 'left');

        $this->db->group_start();
        $this->db->like('posts_add.title', $search_term);
        $this->db->or_like('posts_add.content', $search_term);
        $this->db->or_like('post_categories.name', $search_term);
        $this->db->group_end();

        $this->db->order_by('posts_add.created_at', 'DESC');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $posts = $query->result();

        return $posts;
    }


    public function count_search_posts($search_term)
    {
        $this->db->from($this->table);
        $this->db->join($this->categories_table, 'posts_add.category_id = post_categories.id', 'left');

        $this->db->group_start();
        $this->db->like('posts_add.title', $search_term);
        $this->db->or_like('posts_add.content', $search_term);
        $this->db->or_like('post_categories.name', $search_term);
        $this->db->group_end();

        return $this->db->count_all_results();
    }


    public function delete_post($id)
    {
        // Fetch the post
        $post = $this->db->get_where('posts_add', ['id' => $id])->row();

        if ($post && !empty($post->featured_image)) {
            $file_path = FCPATH . $post->featured_image;

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete record
        return $this->db->delete('posts_add', ['id' => $id]);
    }



    public function update_post($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function get_posts_by_category($category_id)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from($this->table); // which is 'posts_add'
        $this->db->join($this->categories_table, 'posts_add.category_id = post_categories.id', 'left');
        $this->db->where('posts_add.category_id', $category_id);
        $this->db->order_by('posts_add.created_at', 'DESC');
        $query = $this->db->get();
        $posts = $query->result();


        return $posts;
    }

    public function get_posts_count()
    {
        return $this->db->count_all_results('posts_add');
    }

    public function get_posts_by_category_count($category_id)
    {
        $this->db->from('posts_add');
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results();
    }

    public function get_posts_with_categories_paginated($limit, $offset)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from('posts_add');
        $this->db->join('post_categories', 'posts_add.category_id = post_categories.id', 'left');
        $this->db->order_by('posts_add.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function get_posts_by_category_paginated($category_id, $limit, $offset)
    {
        $this->db->select('posts_add.*, post_categories.name as category_name');
        $this->db->from('posts_add');
        $this->db->join('post_categories', 'posts_add.category_id = post_categories.id', 'left');
        $this->db->where('posts_add.category_id', $category_id);
        $this->db->order_by('posts_add.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    public function get_post_by_slug($slug)
    {
        return $this->db
            ->select('posts_add.*, post_categories.name as category_name')
            ->from('posts_add')
            ->join('post_categories', 'posts_add.category_id = post_categories.id', 'left')
            ->where('posts_add.slug', $slug)
            ->get()
            ->row();
    }

}