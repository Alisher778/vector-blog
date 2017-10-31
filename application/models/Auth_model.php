<?php

class Auth_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'username' => $this->input->post('username', true),
            'email' => $this->input->post('email', true),
            'password' => $this->input->post('password', true)
        );
        return $data;
    }

    //change password input values
    public function change_password_input_values()
    {
        $data = array(
            'old_password' => $this->input->post('old_password', true),
            'password' => $this->input->post('password', true),
            'password_confirmation' => $this->input->post('password_confirmation', true)
        );
        return $data;
    }

    //login
    public function login()
    {
        $data = $this->auth_model->input_values();

        $this->db->where('username', $data['username']);
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {

            //password does not match stored password.
            if (!$this->bcrypt->check_password($data['password'], $result->row()->password)) {
                return false;
            }

            //set user data
            $user_data = array(
                'id' => $result->row()->id,
                'username' => $result->row()->username,
                'email' => $result->row()->email,
                'role' => $result->row()->role,
                'logged_in' => true,
                'app_key' => $this->config->item('app_key'),
            );

            $this->session->set_userdata($user_data);
            return true;

        } else {
            return false;
        }
    }

    //register
    public function register()
    {
        $data = $this->auth_model->input_values();
        //secure password
        $data['password'] = $this->bcrypt->hash_password($data['password']);
        return $this->db->insert('users', $data);
    }

    //logout
    public function logout()
    {
        //unset user data
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('app_key');
    }

    //update user
    public function update_user($id)
    {
        $user = $this->auth_model->get_user($id);
        $data = array(
            'email' => $this->input->post('email', true)
        );

        //get file
        $file = $_FILES['file'];
        if (!empty($file['name'])) {

            //delete old
            delete_image_from_server($user->avatar);
            //upload new
            $data["avatar"] = $this->upload_model->avatar_upload($id, $file);
        }

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    //change password
    public function change_password()
    {
        $this->db->where('id', $this->get_user_id());
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {

            $data = $this->auth_model->change_password_input_values();

            //password does not match stored password.
            if (!$this->bcrypt->check_password($data['old_password'], $result->row()->password)) {
                $this->session->set_flashdata('error', html_escape($this->lang->line("wrong_password_error")));
                $this->session->set_flashdata('form_data', $this->auth_model->change_password_input_values());
                redirect($this->agent->referrer());
            }

            $data = array(
                'password' => $this->bcrypt->hash_password($data['password'])
            );

            $this->db->where('id', $this->get_user_id());
            return $this->db->update('users', $data);

        } else {
            return false;
        }
    }

    //reset password
    public function reset_password($email)
    {
        //generate new password
        $new_password = bin2hex(openssl_random_pseudo_bytes(3));

        $data = array(
            'password' => $this->bcrypt->hash_password($new_password)
        );

        //change password
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        return $new_password;
    }

    //change user role
    public function change_user_role($id, $role)
    {
        $data = array(
            'role' => $role
        );

        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    //delete user
    public function delete_user($id)
    {
        $user = $this->get_user($id);

        if (!empty($user)) {
            delete_image_from_server($user->avatar);
            $this->db->where('id', $id);
            return $this->db->delete('users');
        }
        return false;
    }

    //is logged in
    public function is_logged_in()
    {
        //check if user logged in
        if ($this->session->userdata('logged_in') == true && $this->session->userdata('app_key') == $this->config->item('app_key')) {
            return true;
        } else {
            return false;
        }
    }

    //is admin
    public function is_admin()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if ($this->session->userdata('role') == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    //is editor
    public function is_editor()
    {
        //check logged in
        if (!$this->is_logged_in()) {
            return false;
        }

        //check role
        if ($this->session->userdata('role') == 'editor') {
            return true;
        } else {
            return false;
        }
    }

    //function get user
    public function get_logged_user()
    {
        if ($this->session->userdata('logged_in') == true) {
            $query = $this->db->get_where('users', array('id' => $this->get_user_id()));
            return $query->row();
        }
    }

    //get user by id
    public function get_user($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }

    //get user by email
    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row();
    }

    //get users
    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    //get last users
    public function get_last_users()
    {
        $this->db->limit(5);
        $query = $this->db->get('users');
        return $query->result();
    }

    //get logged user id
    public function get_user_id()
    {
        if ($this->session->userdata('logged_in') == true) {
            return $this->session->userdata('id');
        }
    }

    //get logged username
    public function get_username()
    {
        if ($this->session->userdata('logged_in') == true) {
            return $this->session->userdata('username');
        }
    }

    //user count
    public function get_user_count()
    {
        $query = $this->db->get('users');
        return $query->num_rows();
    }


    //check if email is unique
    public function is_unique_email($email, $user_id = 0)
    {
        $user = $this->auth_model->get_user_by_email($email);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //email taken
                return false;
            } else {
                return true;
            }
        }
    }


}