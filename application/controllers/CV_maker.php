<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CV_maker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CV_model');
        $this->load->library('upload');
        $this->load->library('session');
    }

    // show form
    public function index()
    {
         // CAPTCHA config
        $config = array(
            'img_path' => './captcha/',
            'img_url' => base_url('captcha'),
            'font_path' => FCPATH . 'system/fonts/texb.ttf',
            'img_width' => 150,
            'img_height' => 40,
            'expiration' => 300,
            'word_length' => 5,
            'font_size' => 20,
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyz'
        );

        $captcha = create_captcha($config);

        // Save captcha word in session
        $this->session->set_userdata('captcha_word', $captcha['word']);

        $data['captcha_image'] = $captcha['image'];
        
        $data['seo'] = (object) [
            'title' => 'Free CV Maker for Freshers | Create Professional Resume Online | SahajJobs',
            'description' => 'Build a professional resume online with our free CV maker. Easy-to-use templates designed for freshers and job seekers to create a job-ready CV quickly',
            'keywords' => 'cv maker, resume builder, free resume builder, cv for freshers, online cv maker, sahajjobs'
        ];

       $user_id = $this->session->userdata('user_id');

        if (!empty($user_id)) {
            $this->load->view('includes/login_header', $data);
            $this->load->view('cv_form', $data);
            $this->load->view('includes/footer');
        } else {
            $this->load->view('includes/header', $data);
            $this->load->view('cv_form', $data);
            $this->load->view('includes/footer');
        }
    }


    public function save()
    {

        header('Content-Type: application/json');
        // =========================
        // STEP 1 DATA
        // =========================
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $zip = $this->input->post('zip');
        $city = $this->input->post('city');

        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $nationality = $this->input->post('nationality');

        // =========================
        // STEP 2 DATA
        // =========================
        $objective = $this->input->post('objective');

        // ===== WORK EXPERIENCE =====
        $work_data = [];
        $job_titles = $this->input->post('job_title');

        if (!empty($job_titles)) {
            foreach ($job_titles as $i => $title) {
                $work_data[] = [
                    'job_title' => $title,
                    'job_city' => $this->input->post('job_city')[$i] ?? '',
                    'company' => $this->input->post('company')[$i] ?? '',
                    'start_month' => $this->input->post('start_month')[$i] ?? '',
                    'start_year' => $this->input->post('start_year')[$i] ?? '',
                    'end_month' => $this->input->post('end_month')[$i] ?? '',
                    'end_year' => $this->input->post('end_year')[$i] ?? '',
                    'job_desc' => $this->input->post('job_desc')[$i] ?? '',
                ];
            }
        }

        // ===== EDUCATION =====
        $edu_data = [];
        $degrees = $this->input->post('degree');

        if (!empty($degrees)) {
            foreach ($degrees as $i => $deg) {
                $edu_data[] = [
                    'degree' => $deg,
                    'city' => $this->input->post('edu_city')[$i] ?? '',
                    'school' => $this->input->post('school')[$i] ?? '',
                    'start_month' => $this->input->post('edu_start_month')[$i] ?? '',
                    'start_year' => $this->input->post('edu_start_year')[$i] ?? '',
                    'end_month' => $this->input->post('edu_end_month')[$i] ?? '',
                    'end_year' => $this->input->post('edu_end_year')[$i] ?? '',
                    'desc' => $this->input->post('edu_desc')[$i] ?? '',
                ];
            }
        }

        // ===== SKILLS =====
        $skills_data = $this->input->post('skills');

        // =========================
        // PROFILE IMAGE UPLOAD
        // =========================
        $profile_image_name = '';

        if (!empty($_FILES['profile_image']['name'])) {

            $config['upload_path'] = './ALL_UPLOADS/profile_photos/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_image')) {
                $upload_data = $this->upload->data();
                $profile_image_name = $upload_data['file_name'];
            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        // =========================
        // FINAL DATA ARRAY
        // =========================
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'zip' => $zip,
            'city' => $city,

            'dob' => $dob,
            'gender' => $gender,
            'nationality' => $nationality,

            'objective' => $objective,
            'profile_image' => $profile_image_name,
            'work_json' => json_encode($work_data),
            'education_json' => json_encode($edu_data),
            'skills' => $skills_data,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // ===== DUPLICATE CHECK =====
        // $recent = $this->CV_model->check_recent_duplicate($email);
        // if ($recent) {
        //     echo json_encode([
        //         'status' => 'success',
        //         'insert_id' => $recent->id
        //     ]);
        //     return;
        // }

        // ===== INSERT =====
        $insert_id = $this->CV_model->insert_cv($data);

        // ===== JSON RESPONSE =====
        echo json_encode([
            'status' => 'success',
            'insert_id' => $insert_id
        ]);
    }

    public function download($id)
    {
        $template = $this->input->get('template') ?? 'sample1';

        // get data from DB
        $cv = $this->CV_model->get_cv($id);

        if (!$cv) {
            show_error("CV not found");
        }

        // decode JSON
        $cv->work = json_decode($cv->work_json, true);
        $cv->education = json_decode($cv->education_json, true);

        // load selected template
        $this->load->view("cv_templates/$template", ['cv' => $cv]);
    }

}