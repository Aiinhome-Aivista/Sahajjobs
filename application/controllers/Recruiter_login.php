<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recruiter_login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruiter_login_model');
        $this->load->library('session');
        $this->load->model('Menu_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('EmailService');
        $this->load->model('admin/Seo_model');
    }

    // Show Login Page
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
        $data['seo'] = $this->Seo_model->get_details_seo();

        $this->load->view('recruiter_login', $data);
    }

    // Handle Login Form Submission
    public function submit()
    {
        $userCaptcha = trim($this->input->post('captcha'));
        $storedCaptcha = $this->session->userdata('captcha_word');

        if (empty($userCaptcha) || strcasecmp($userCaptcha, $storedCaptcha) !== 0) {
            $this->session->set_flashdata('error', 'Invalid CAPTCHA. Please try again.');
            redirect(base_url('recruiter_login'));
            return;
        }
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $recruiter = $this->Recruiter_login_model->get_by_email($email);

        if ($recruiter && password_verify($password, $recruiter->password)) {
            // set session
            $this->session->set_userdata(array(
                'recruiter_id' => $recruiter->id,
                'user_role' => 'recruiter',
                'recruiter_name' => $recruiter->full_name,
                'recruiter_email' => $recruiter->email,
                'logged_in' => TRUE
            ));
            // echo "Employer Login successful!";
            redirect(base_url('employer_dashboard'));

        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect(base_url('recruiter_login'));

        }
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('recruiter_login');
    }
    public function google_callback()
    {
        $json = file_get_contents('php://input');
        $userData = json_decode($json, true);

        if (!$userData || !isset($userData['email'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }


        // Define upload path for profile photos
        // $upload_path = FCPATH . 'assets/profile_photos/';
        $upload_path = FCPATH . './ALL_UPLOADS/profile_photos/';
        // Download and save Google profile picture locally
        $picture_url = $userData['picture'];
        $image_info = pathinfo($picture_url);
        $ext = isset($image_info['extension']) ? $image_info['extension'] : 'jpg'; // default to jpg if no ext

        // Generate unique filename
        $file_name = uniqid('profile_', true) . '.' . $ext;
        $file_path = $upload_path . $file_name;

        // Download image
        $image_content = @file_get_contents($picture_url);

        if ($image_content !== false) {
            // Save image locally
            file_put_contents($file_path, $image_content);
        } else {
            // If download fails, fallback to empty string or default image
            $file_name = '';
        }

        $ip = $this->input->ip_address();
        // Check if user exists
        $user = $this->Recruiter_login_model->get_user_by_email($userData['email']);

        // If not, create user
        if (!$user) {
            $first_name = explode(' ', trim($userData['full_name']))[0];
            $plainPassword = $first_name . '@123';
            $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
            $user_id = $this->Recruiter_login_model->insert_google_user([
                'uid' => $userData['uid'],
                'email' => $userData['email'],
                'ip_address' => $ip,
                'full_name' => $userData['full_name'],
                'picture' => $file_name,
                'provider' => $userData['provider'],
                'password' => $hashedPassword,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $this->Recruiter_login_model->save_profile_photo($user_id, $file_name); // <--- Add this line
            $user = $this->Recruiter_login_model->get_user_by_id($user_id);

            $emailSent = $this->emailservice->sendWelcomeEmail($user['email'], $user['full_name'], $plainPassword, 'recruiter_welcome_email');
            if ($emailSent) {
                $this->session->set_flashdata('success', 'Registration successful! A welcome email has been sent to your email address.');
            } else {
                $this->session->set_flashdata('success', 'Registration successful! However, we could not send the welcome email.');
            }
        } else {
            // Update profile photo if new one downloaded successfully
            if ($file_name) {
                // Get existing photo filename for cleanup
                $existing_photo = $this->Recruiter_login_model->get_profile_photo($user['id']);

                if ($existing_photo && file_exists($upload_path . $existing_photo)) {
                    unlink($upload_path . $existing_photo);
                }

                $this->Recruiter_login_model->update_profile_photo($user['id'], $file_name);

                // Update user's picture field in user data for session
                $user['picture'] = $file_name;
            }
        }


        // Set session
        $this->session->set_userdata([
            'recruiter_id' => $user['id'],
            'user_name' => $user['full_name'],
            'user_email' => $user['email'],
            'user_picture' => $user['picture'],
            'logged_in' => TRUE
        ]);

        echo json_encode(['success' => true]);
    }

    public function forgot()
    {
        $data['menu'] = $this->Menu_model->get_menu();
        $this->load->view('employer_forgot_password_view', $data);
    }

   public function verify_email()
    {
        $email = $this->input->post('email');
        $user = $this->Recruiter_login_model->get_user_by_email($email);

        if (!$user) {
            $response = ['success' => false, 'message' => 'Email not found.'];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        // Generate verification token
        $verification_token = bin2hex(random_bytes(32));

        // Save token and set is_password_email_verified = 0
        $this->Recruiter_login_model->save_password_reset_token($user['id'], $verification_token);

        // Create verification link
        $reset_link = base_url('employer_login/forgot?email=' . urlencode($email) . '&token=' . $verification_token);

        // Load email template
        $emailContent = $this->load->view('emails/recruiter_password_reset_email', [
            'full_name' => $user['full_name'],
            'reset_link' => $reset_link
        ], TRUE);

        // Send email
        if ($this->emailservice->sendEmail($email, 'Password Reset Request', $emailContent)) {
            $response = ['success' => true, 'message' => 'Verification email sent. Please check your inbox.'];
        } else {
            $response = ['success' => false, 'message' => 'Failed to send verification email. Please try again.'];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }


    public function verify_password_reset_token()
    {
        $email = $this->input->get('email', true);
        $token = $this->input->get('token', true);

        if (empty($email) || empty($token)) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Missing email or token.']));
            } else {
                $this->session->set_flashdata('error', 'Invalid password reset link (missing parameters).');
                redirect(base_url('employer_login/forgot'));
            }
            return;
        }

        $token = trim(urldecode($token));

        $user = $this->Recruiter_login_model->get_user_by_email($email);


        // Validate user and token
        if (!$user || empty($user['password_reset_token']) || !hash_equals((string) $user['password_reset_token'], (string) $token)) {
            // token mismatch
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['success' => false, 'message' => 'Invalid password reset link.']));
            } else {
                $this->session->set_flashdata('error', 'Invalid password reset link.');
                redirect(base_url('employer_login/forgot'));
            }
            return;
        }

        $this->Recruiter_login_model->mark_password_email_verified($user['id']);

        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => true, 'message' => 'Link verified. You may reset your password now.']));
        } else {
            redirect(base_url('employer_login/forgot?email=' . urlencode($email)));
        }
    }


    public function update_password()
    {
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $user = $this->Recruiter_login_model->get_user_by_email($email);

        if (!$user || $user['is_password_email_verified'] != 1) {
            $response = ['success' => false, 'message' => 'Email verification not completed.'];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            return;
        }

        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $this->Recruiter_login_model->update_password($user['id'], $hashed_password);

        // Clear verification flag
        $this->Recruiter_login_model->reset_password_verification_flag($user['id']);

        $response = ['success' => true, 'message' => 'Password updated successfully.'];
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
