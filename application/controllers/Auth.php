<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->library('bcrypt');
    }


    /**
     * Login
     */
    public function login()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        $this->data['title'] = html_escape($this->lang->line("breadcrumb_login"));
        $this->data['description'] = html_escape($this->lang->line("breadcrumb_login"));

        $this->load->view('partials/_header', $this->data);
        $this->load->view('auth/login');
        $this->load->view('partials/_footer');
    }


    /**
     * Login Post
     */
    public function login_post()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        //validate inputs
        $this->form_validation->set_rules('username', $this->lang->line("form_username"), 'required|xss_clean|max_length[100]');
        $this->form_validation->set_rules('password', $this->lang->line("form_password"), 'required|xss_clean|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->login()) {
                //logged in
                redirect(base_url());
            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', $this->lang->line("login_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Register
     */
    public function register()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        $data['title'] = html_escape($this->lang->line("nav_register"));
        $data['description'] = html_escape($this->lang->line("nav_register"));

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/register');
        $this->load->view('partials/_footer');
    }


    /**
     * Register Post
     */
    public function register_post()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        //validate inputs
        $this->form_validation->set_rules('username', $this->lang->line("form_username"), 'required|xss_clean|min_length[4]|max_length[100]|is_unique[users.username]');
        $this->form_validation->set_rules('email', $this->lang->line("form_email"), 'required|xss_clean|max_length[200]|is_unique[users.email]');
        $this->form_validation->set_rules('password', $this->lang->line("form_password"), 'required|xss_clean|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('confirm_password', $this->lang->line("form_confirm_password"), 'required|xss_clean|matches[password]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //register
            if ($this->auth_model->register()) {
                $this->session->set_flashdata('success', $this->lang->line("message_register_success"));
                redirect('login');
            } else {
                //error
                $this->session->set_flashdata('form_data', $this->auth_model->input_values());
                $this->session->set_flashdata('error', $this->lang->line("message_register_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Users
     */
    public function users()
    {
        //check if admin
        if ($this->auth_model->is_admin() == false) {
            redirect('login');
        }

        $data['title'] = 'Users';
        $data['users'] = $this->auth_model->get_users();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Logout
     */
    public function logout()
    {
        $this->auth_model->logout();
        redirect('login');
    }


    /**
     * Update Profile
     */
    public function update_profile()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == false) {
            redirect('login');
        }

        $data['title'] = html_escape($this->lang->line("breadcrumb_update_profile"));
        $data['description'] = html_escape($this->lang->line("breadcrumb_update_profile"));

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/update_profile');
        $this->load->view('partials/_footer');
    }


    /**
     * Update Profile Post
     */
    public function update_profile_post()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == false) {
            redirect('login');
        }

        $this->form_validation->set_rules('email', html_escape($this->lang->line("form_email")), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->input_values());
            redirect($this->agent->referrer());
        } else {
            $email=$this->input->post('email', true);
            //is email unique
            if (!$this->auth_model->is_unique_email($email,user()->id)) {
                $this->session->set_flashdata('error', html_escape($this->lang->line("email_unique_error")));
                redirect($this->agent->referrer());
            }
            if ($this->auth_model->update_user(user()->id)) {
                $this->session->set_flashdata('success', html_escape($this->lang->line("message_profile")));
            }
            redirect($this->agent->referrer());
        }
    }


    /**
     * Change Password
     */
    public function change_password()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == false) {
            redirect('login');
        }

        $data['title'] = html_escape($this->lang->line("breadcrumb_change_password"));
        $data['description'] = html_escape($this->lang->line("breadcrumb_change_password"));

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/change_password');
        $this->load->view('partials/_footer');
    }


    /**
     * Change Password Post
     */
    public function change_password_post()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == false) {
            redirect('login');
        }

        $this->form_validation->set_rules('old_password', html_escape($this->lang->line("form_old_password")), 'required|xss_clean|max_length[30]');
        $this->form_validation->set_rules('password', html_escape($this->lang->line("form_password")), 'required|xss_clean|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('password_confirmation', html_escape($this->lang->line("form_confirm_password")), 'required|xss_clean|max_length[30]|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->auth_model->change_password_input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->change_password()) {
                $this->session->set_flashdata('success', html_escape($this->lang->line("message_change_password")));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', html_escape($this->lang->line("change_password_error")));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Reset Password
     */
    public function reset_password()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        $data['title'] = html_escape($this->lang->line("breadcrumb_reset_password"));
        $data['description'] = html_escape($this->lang->line("breadcrumb_reset_password"));

        $this->load->view('partials/_header', $data);
        $this->load->view('auth/reset_password');
        $this->load->view('partials/_footer');
    }


    /**
     * Reset Password Post
     */
    public function reset_password_post()
    {
        //check if logged in
        if ($this->auth_model->is_logged_in() == true) {
            redirect(base_url());
        }

        $email = $this->input->post('email', true);

        //get user
        $user = $this->auth_model->get_user_by_email($email);

        //if user not exists
        if (empty($user)) {
            $this->session->set_flashdata('error', html_escape($this->lang->line("reset_password_error")));
            redirect($this->agent->referrer());
        } else {
            //generate new password
            $new_password = $this->auth_model->reset_password($email);

            $subject = "Password Reset";
            $message = "Your password has been successfully reset! Your new password: <strong>" . $new_password . "</strong>";

            //send email
            if ($this->settings_model->send_email($email, $subject, $message)) {
                $this->session->set_flashdata('success', html_escape($this->lang->line("reset_password_success")));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Change User Role
     */
    public function change_user_role_post()
    {
        //check if admin
        if ($this->auth_model->is_admin() == false) {
            redirect('login');
        }

        $id = $this->input->post('user_id', true);
        $role = $this->input->post('role', true);

        $user = $this->auth_model->get_user($id);

        //check if exists
        if (empty($user)) {
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->change_user_role($id, $role)) {
                $this->session->set_flashdata('success', "User role changed successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', "There was a problem while changing the user role!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete User
     */
    public function delete_user_post()
    {
        //check if admin
        if ($this->auth_model->is_admin() == false) {
            redirect('login');
        }

        $id = $this->input->post('user_id');
        $user = $this->auth_model->get_user($id);

        //check if exists
        if (empty($user)) {
            redirect($this->agent->referrer());
        } else {
            if ($this->auth_model->delete_user($id)) {
                $this->session->set_flashdata('success', "User deleted successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', "There was a problem while deleting the user!");
                redirect($this->agent->referrer());
            }
        }
    }

}
