<?php
class Recruiter_login_model extends CI_Model
{

    public function get_by_email($email)
    {
        // $this->db->where('email', $email);
        $this->db->where([
            'email' => $email,
            'email_verified' => 1
        ]);
        $query = $this->db->get('employer_register');
        return $query->row();
    }
    // For Google login: get user by email
    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('employer_register')->row_array();
    }

    public function save_password_reset_token($user_id, $token)
    {
        $data = [
            'password_reset_token' => $token,
            'is_password_email_verified' => 0
        ];
        $this->db->where('id', $user_id);
        return $this->db->update('employer_register', $data);
    }

    public function mark_password_email_verified($user_id)
    {
        $data = [
            'is_password_email_verified' => 1
        ];
        $this->db->where('id', $user_id);
        return $this->db->update('employer_register', $data);
    }

    // For session fetch by ID
    public function get_user_by_id($id)
    {
        return $this->db->where('id', $id)->get('employer_register')->row_array();
    }

    // Insert Google user
    public function insert_google_user($data)
    {
        $data = array_merge([
            'full_name' => '',
            'password' => '',           // Use '' not null
            'mobile_number' => null,
            'company' => null,          // since Google users won't supply
            'designation' => null,      // These can be updated later from profile
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ], $data);


        $this->db->insert('employer_register', $data);
        return $this->db->insert_id();
    }

    // Profile photo methods
    public function get_profile_photo($user_id)
    {
        // $result = $this->db->get_where('profile_photos', ['user_id' => $user_id])->row_array();
        // return $result ? 'assets/profile_photos/' . $result['file_name'] : null;

        $result = $this->db->get_where('profile_photos', ['user_id' => $user_id])->row_array();
        return $result ? './ALL_UPLOADS/profile_photos/' . $result['file_name'] : null;
    }

    public function save_profile_photo($user_id, $file_name)
    {
        $data = [
            'user_id' => $user_id,
            'file_name' => $file_name,
            'uploaded_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('profile_photos', $data);
    }

    public function update_profile_photo($user_id, $file_name)
    {
        $data = [
            'file_name' => $file_name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('user_id', $user_id)->update('profile_photos', $data);
        return $this->db->affected_rows() > 0;
    }

    // Verify email exists for password reset (case-insensitive)
    public function verify_email_for_reset($email)
    {
        $user = $this->db->where('LOWER(email)', strtolower(trim($email)))->get('employer_register')->row_array();
        return $user ? true : false;
    }


    public function update_password($user_id, $hashed_password)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('employer_register', ['password' => $hashed_password]);
    }

    public function reset_password_verification_flag($user_id)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('employer_register', ['is_password_email_verified' => 0, 'password_reset_token' => null, 'updated_at' => date('Y-m-d H:i:s')]);
    }
}
