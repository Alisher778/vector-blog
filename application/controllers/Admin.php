<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
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

        //check auth
        if (!is_admin() && !is_editor()) {
            redirect('login');
        }
    }


    /**
     * Index Page
     */
    public function index()
    {
        $data['title'] = "Index";

        $data['post_count'] = $this->post_model->get_post_count();
        $data['category_count'] = $this->category_model->get_category_count();
        $data['comment_count'] = $this->comment_model->get_comment_count();
        $data['user_count'] = $this->auth_model->get_user_count();
        $data['last_comments'] = $this->comment_model->get_last_comments();
        $data['last_contacts'] = $this->contact_model->get_last_contact_messages();
        $data['last_users'] = $this->auth_model->get_last_users();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Add Page
     */
    public function add_page()
    {
        prevent_editor();

        $data['title'] = "Add New Page";
        $this->load->view('admin/_header', $data);
        $this->load->view('admin/add_page', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Add Page Post
     */
    public function add_page_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('title', "Page Title", 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('page_description', "Page Description", 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('page_content', "Page Content", 'required');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->page_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->page_model->add_page()) {
                $this->session->set_flashdata('success', "Page added successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->page_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while adding the page!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Page
     */
    public function update_page($id)
    {
        prevent_editor();

        $data['title'] = "Update Page";

        //find page
        $data['page'] = $this->page_model->get_page_by_id($id);

        //page not found
        if (empty($data['page'])) {
            redirect(base_url() . 'admin');
        }

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/update_page', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Page Post
     */
    public function update_page_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('title', "Page Title", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('page_description', "Page Description", 'xss_clean|max_length[500]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->page_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->page_model->update_page()) {
                $this->session->set_flashdata('success', "Page updated successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->page_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while updating the page!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Page Post
     */
    public function delete_page_post()
    {
        prevent_editor();

        $id = $this->input->post('id', true);
        $data["page"] = $this->page_model->get_page_by_id($id);

        //check if exists
        if (empty($data['page'])) {
            redirect($this->agent->referrer());
        } else {
            if ($this->page_model->delete_page($id)) {
                return true;
            } else {
                return false;
            }
        }
    }


    /**
     * Comments
     */
    public function comments()
    {
        prevent_editor();

        $data['title'] = "Comments";

        $data['comments'] = $this->comment_model->get_all_comments();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/comments', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Delete Comment Post
     */
    public function delete_comment_post()
    {
        prevent_editor();

        $id = $this->input->post('id', true);

        if ($this->comment_model->delete_comment($id)) {
            $this->session->set_flashdata('success', "Comment deleted successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while deleting the comment!");
            redirect($this->agent->referrer());
        }
    }


    /**
     * Contact Messages
     */
    public function contact_messages()
    {
        prevent_editor();

        $data['title'] = "Contact Messages";

        $data['messages'] = $this->contact_model->get_contact_messages();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/contact_messages', $data);
        $this->load->view('admin/_footer');
    }

    /**
     * Delete Contact Message Post
     */
    public function delete_contact_message_post()
    {
        prevent_editor();

        $id = $this->input->post('id', true);

        if ($this->contact_model->delete_contact_message($id)) {
            $this->session->set_flashdata('success', "Message deleted successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while deleting the message!");
            redirect($this->agent->referrer());
        }
    }


    /**
     * Ads
     */
    public function ads()
    {
        prevent_editor();

        $data['title'] = "Ads";

        $data['ads'] = $this->ad_model->get_ads();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/ad_spaces', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Ads Post
     */
    public function ads_post()
    {
        prevent_editor();

        if ($this->ad_model->update_ads()) {
            $this->session->set_flashdata('success', "Ads updated successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while updating the ads!");
            redirect($this->agent->referrer());
        }
    }


    /**
     * Settings
     */
    public function settings()
    {
        prevent_editor();

        $data['title'] = "Settings";

        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Settings Post
     */
    public function settings_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('facebook_url', "Facebook Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('twitter_url', "Twitter Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('google_url', "Google Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('instagram_url', "Instagram Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('pinterest_url', "Pinterest Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('linkedin_url', "Linkedin Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('vk_url', "Vk Url", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('about_footer', "About Footer", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('contact_address', "Contact Address", 'xss_clean|max_length[500]');
        $this->form_validation->set_rules('contact_email', "Contact Email", 'xss_clean|max_length[200]');
        $this->form_validation->set_rules('contact_phone', "About Phone", 'xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->settings_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->settings_model->update_settings()) {
                $this->session->set_flashdata('success', "Settings updated successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->settings_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while updating the settings!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Seo Tools
     */
    public function seo_tools()
    {
        prevent_editor();

        $data['title'] = "Seo Tools";

        $data['settings'] = $this->settings_model->get_settings();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/seo_tools', $data);
        $this->load->view('admin/_footer');
    }

    /**
     * Seo Tools Post
     */
    public function seo_tools_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('site_title', "Site Title", 'xss_clean|max_length[255]');
        $this->form_validation->set_rules('home_title', "Home Title", 'xss_clean|max_length[255]');
        $this->form_validation->set_rules('site_keywords', "Site Keywords", 'xss_clean|max_length[400]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->seo_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->seo_model->update()) {
                $this->session->set_flashdata('success', "Seo options updated successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->seo_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while updating the seo options!");
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Font Options
     */
    public function font_options()
    {
        prevent_editor();

        $data['title'] = "Font Options";
        $data['fonts']=$this->config->item('fonts_array');

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/font_options', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Font Options Post
     */
    public function font_options_post()
    {
        prevent_editor();

        if ($this->font_options_model->update()) {
            $this->session->set_flashdata('success', "Fonts updated successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('form_data', $this->font_options_model->input_values());
            $this->session->set_flashdata('error', "There was a problem while updating the fonts!");
            redirect($this->agent->referrer());
        }

    }




    /**
     * Newsletter
     */
    public function newsletter()
    {
        prevent_editor();

        $data['title'] = "Newsletter";

        $data['newsletter'] = $this->newsletter_model->get_newsletters();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/newsletter', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Delete Newsletter Post
     */
    public function delete_newsletter_post()
    {
        prevent_editor();

        $id = $this->input->post('id', true);

        $data['newsletter'] = $this->newsletter_model->get_newsletter_by_id($id);

        if (empty($data['newsletter'])) {
            redirect($this->agent->referrer());
        }

        if ($this->newsletter_model->delete_from_newsletter($id)) {
            $this->session->set_flashdata('success', "Email deleted successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while deleting the email!");
            redirect($this->agent->referrer());
        }
    }

    /**
     * Newsletter Send Email Post
     */
    public function newsletter_send_email_post()
    {
        prevent_editor();

        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', false);

        $data['newsletter'] = $this->newsletter_model->get_newsletters();

        foreach ($data['newsletter'] as $item) {
            //send email
            $this->settings_model->send_email($item->email, $subject, $message);
        }

        $this->session->set_flashdata('success', "Email sent successfully!");
        redirect($this->agent->referrer());
    }


}