<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
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
    }


    /**
     * Index Page
     */
    public function index()
    {
        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $config['base_url'] = base_url();
        $config['total_rows'] = $this->post_model->get_post_count();
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        $data['page'] = $this->page_model->get_page('index');

        //check page auth
        $this->checkPageAuth($data['page']);


        $data['title'] = $this->settings_model->get_settings()->home_title;
        $data['description'] = $data['page']->page_description;
        $data['slider_posts'] = $this->post_model->get_slider_posts();
        $data['posts'] = $this->post_model->get_paginated_posts($config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('index', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Gallery Page
     */
    public function gallery()
    {
        $data['page'] = $this->page_model->get_page('gallery');
        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->page_active == 0) {
            $data['title'] = "Page Not Found";
            $data['description'] = "Page Not Found";
            $this->load->view('partials/_header', $data);
            $this->load->view('errors/error_404', $data);
            $this->load->view('partials/_footer');
        }

        $data['title'] = html_escape($this->lang->line("breadcrumb_gallery"));
        $data['description'] = $data['page']->page_description;

        //get gallery categories
        $data['gallery_categories'] = $this->gallery_category_model->get_categories();
        //get gallery images
        $data['gallery_images'] = $this->gallery_image_model->get_images();

        $this->load->view('partials/_header', $data);
        $this->load->view('gallery', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Contact Page
     */
    public function contact()
    {
        $data['page'] = $this->page_model->get_page('contact');
        //check page auth
        $this->checkPageAuth($data['page']);

        if ($data['page']->page_active == 0) {
            $data['title'] = "Page Not Found";
            $data['description'] = "Page Not Found";
            $this->load->view('partials/_header', $data);
            $this->load->view('errors/error_404', $data);
            $this->load->view('partials/_footer');
        }

        $data['title'] = html_escape($this->lang->line("breadcrumb_contact"));
        $data['description'] = $data['page']->page_description;

        $this->load->view('partials/_header', $data);
        $this->load->view('contact', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Contact Page Post
     */
    public function contact_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', $this->lang->line("placeholder_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('email', $this->lang->line("placeholder_email"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('message', $this->lang->line("placeholder_message"), 'required|xss_clean|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->contact_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->contact_model->add_contact_message()) {
                $this->session->set_flashdata('success', $this->lang->line("message_contact_success"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                $this->session->set_flashdata('error', $this->lang->line("message_contact_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Category Page
     */
    public function category($slug, $category_id)
    {
        $slug = $this->security->xss_clean($slug);
        $category_id = $this->security->xss_clean($category_id);

        $data['category'] = $this->category_model->get_category($category_id);

        //check category exists
        if (empty($data['category'])) {
            redirect(base_url());
        }

        $data['title'] = $data['category']->name;
        $data['description'] = html_escape($this->lang->line("page_title_category")) . ': ' . $data['category']->name;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = base_url() . '/category/' . $slug . '/' . $category_id;
        $config['total_rows'] = $this->post_model->get_category_post_count($category_id);
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_category_posts($category_id, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('category', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Tag Page
     */
    public function tag($tag_slug)
    {
        $tag_slug = $this->security->xss_clean($tag_slug);

        $data['tag'] = $this->tag_model->get_tag($tag_slug);

        //check tag exists
        if (empty($data['tag'])) {
            redirect(base_url());
        }

        $data['title'] = $data['tag']->tag;
        $data['description'] = html_escape($this->lang->line("page_title_tag")) . ': ' . $data['tag']->tag;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }

        $config['base_url'] = base_url() . '/tag/' . $tag_slug;
        $config['total_rows'] = $this->post_model->get_tag_post_count($tag_slug);
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_tag_posts($tag_slug, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('tag', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Reading List Page
     */
    public function reading_list()
    {
        $data['title'] = html_escape($this->lang->line("breadcrumb_reading_list"));
        $data['description'] = html_escape($this->lang->line("breadcrumb_reading_list"));

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->reading_list_model->get_reading_list_count();

        $config['base_url'] = base_url() . '/reading-list';
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->reading_list_model->get_paginated_reading_list($config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('reading_list', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Search Page
     */
    public function search()
    {
        $q = $this->input->get('q', TRUE);

        $data['q'] = $q;
        $data['title'] = html_escape($this->lang->line("breadcrumb_search")) . ': ' . $q;
        $data['description'] = html_escape($this->lang->line("breadcrumb_search")) . ': ' . $q;

        //initialize pagination
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }

        if ($page != 0) {
            $page = $page - 1;
        }
        $data['post_count'] = $this->post_model->get_search_post_count($q);

        $config['base_url'] = base_url() . '/search?q=' . $q;
        $config['total_rows'] = $data['post_count'];
        $config['per_page'] = 6;
        $this->pagination->initialize($config);

        //get posts
        $data['posts'] = $this->post_model->get_paginated_search_posts($q, $config['per_page'], $page * $config['per_page']);

        $this->load->view('partials/_header', $data);
        $this->load->view('search', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Post Page
     */
    public function post($slug, $id)
    {
        $id = $this->security->xss_clean($id);
        $slug = $this->security->xss_clean($slug);

        $data['post'] = $this->post_model->get_post($id);

        if (!auth_check() && $data['post']->need_auth == 1) {
            $this->session->set_flashdata('error', $this->lang->line("message_post_auth"));
            redirect(base_url() . 'login');
        }

        //check if post exists
        if (empty($data['post'])) {
            redirect(base_url());
        }

        //check visibility
        if ($data['post']->visibility != 1) {
            redirect(base_url());
        }

        $data['title'] = $data['post']->title;
        $data['description'] = $data['post']->title;
        $data['post_image_count'] = $this->post_image_model->get_post_image_count($id);
        $data['post_images'] = $this->post_image_model->get_post_images($id);
        $data['post_tags'] = $this->tag_model->get_post_tags($id);
        $data['related_posts'] = $this->post_model->get_related_posts($data['post']->category_id, $id);
        $data['comments'] = $this->comment_model->get_comments($id);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($id);

        $data['is_reading_list'] = $this->reading_list_model->is_post_in_reading_list($id);


        $this->load->view('partials/_header', $data);
        $this->load->view('post', $data);
        $this->load->view('partials/_footer');

        //increase post hit
        $this->load->helper('cookie');
        $this->post_model->increase_post_hit($id);

    }


    /**
     * Dynamic Page by Name Slug
     */
    public function get_page($slug)
    {
        $slug = $this->security->xss_clean($slug);

        //index page
        if (empty($slug)) {
            redirect(base_url());
        }

        $data['page'] = $this->page_model->get_page($slug);
        //check page auth
        $this->checkPageAuth($data['page']);

        //if not exists
        if (empty($data['page']) || $data['page'] == null) {
            $data['title'] = "Page Not Found";
            $data['description'] = "Page Not Found";
            $this->load->view('partials/_header', $data);
            $this->load->view('errors/error_404', $data);
            $this->load->view('partials/_footer');
        } //check if page disable
        else if ($data['page']->page_active == 0) {
            $data['title'] = "Page Not Found";
            $data['description'] = "Page Not Found";
            $this->load->view('partials/_header', $data);
            $this->load->view('errors/error_404', $data);
            $this->load->view('partials/_footer');
        } else {
            $data['title'] = $data['page']->title;
            $data['description'] = $data['page']->page_description;

            $this->load->view('partials/_header', $data);
            $this->load->view('page', $data);
            $this->load->view('partials/_footer');

        }
    }


    /**
     * Add or Delete from Reading List
     */
    public function add_delete_from_reading_list_post()
    {
        $post_id = $this->input->post('post_id');

        if (empty($post_id)) {
            redirect($this->agent->referrer());
        }

        $is_post_in_reading_list = $this->reading_list_model->is_post_in_reading_list($post_id);

        //delete from list
        if ($is_post_in_reading_list == true) {
            $this->reading_list_model->delete_from_reading_list($post_id);
        } else {
            //add to list
            $this->reading_list_model->add_to_reading_list($post_id);
        }

        redirect($this->agent->referrer());
    }


    /**
     * Add Comment
     */
    public function add_comment_post()
    {
        //input values
        $data = $this->comment_model->input_values();

        if ($data['post_id'] && $data['user_id'] && $data['comment']) {
            $this->comment_model->add_comment();
        }

        $data['comments'] = $this->comment_model->get_comments($data['post_id']);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($data['post_id']);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Delete Comment
     */
    public function delete_comment_post()
    {
        $id = $this->input->post('id', true);

        $comment = $this->comment_model->get_comment($id);
        $post_id = 0;
        //if comment exists
        if (!empty($comment)) {
            $post_id = $comment->post_id;
            $this->comment_model->delete_comment($id);
        }

        $data['comments'] = $this->comment_model->get_comments($post_id);
        $data['comment_count'] = $this->comment_model->get_post_comment_count($post_id);
        $this->load->view('partials/_comments', $data);
    }


    /**
     * Add to Newsletter
     */
    public function add_to_newsletter()
    {
        //input values
        $email = $this->input->post('email', true);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('news_error', $this->lang->line("message_invalid_email"));
        } else {
            if ($email) {
                //check if email exists
                if (empty($this->newsletter_model->get_newsletter($email))) {
                    //addd
                    if ($this->newsletter_model->add_to_newsletter($email)) {
                        $this->session->set_flashdata('news_success', $this->lang->line("message_newsletter_success"));
                    }
                } else {
                    $this->session->set_flashdata('news_error', $this->lang->line("message_newsletter_error"));
                }
            }

        }

        redirect($this->agent->referrer() . "#newsletter");
    }

    /**
     * Get Gallery Photos by Category
     */
    public function gallery_get_images_post()
    {
        $data['selected_id'] = $this->input->post('id', true);

        if ($data['selected_id'] == 0) {
            $data['images'] = $this->gallery_image_model->get_images();
        } else {
            $data['images'] = $this->gallery_image_model->get_images_by_category($data['selected_id']);
        }

        $data['categories'] = $this->gallery_category_model->get_categories();
        $this->load->view('partials/_get_photos', $data);
    }

    public function checkPageAuth($page)
    {
        if (!empty($page)) {
            if (!auth_check() && $page->need_auth == 1) {
                $this->session->set_flashdata('error', $this->lang->line("message_page_auth"));
                redirect(base_url() . 'login');
            }
        }
    }

    public function error_404()
    {
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";

        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }


}
