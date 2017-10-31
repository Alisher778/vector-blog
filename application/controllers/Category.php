<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
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
     * Categories
     */
    public function categories()
    {
        $data['title'] = "Categories";
        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/categories', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Add Category Post
     */
    public function add_category_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', "Category Name", 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->category_model->add_category()) {
                $this->session->set_flashdata('success', "Category added successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while adding the category!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Category
     */
    public function update_category($id)
    {
        $data['title'] = 'Update Category';

        //get category
        $data['category'] = $this->category_model->get_category($id);

        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/update_category', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Category Post
     */
    public function update_category_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', "Category Name", 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->category_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('category_id', true);
            if ($this->category_model->update_category($id)) {
                $this->session->set_flashdata('success', "Category updated successfully!");
                redirect('admin/categories');
            } else {
                $this->session->set_flashdata('form_data', $this->category_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while updating the category!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Category Post
     */
    public function delete_category_post()
    {
        $id = $this->input->post('category_id', true);

        //check if category has posts
        if ($this->post_model->get_category_post_count($id) > 0) {
            $this->session->set_flashdata('error', "Please delete the posts belonging to this category!");
            redirect($this->agent->referrer());
        }

        if ($this->category_model->delete_category($id)) {
            $this->session->set_flashdata('success', "Category deleted successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while deleting the category!");
            redirect($this->agent->referrer());
        }
    }


    /**
     * Gallery Category
     */
    public function gallery_categories()
    {
        prevent_editor();

        $data['title'] = "Gallery Categories";
        $data['categories'] = $this->gallery_category_model->get_categories();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/gallery_categories', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Add Gallery Category Post
     */
    public function add_gallery_category_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('name', "Category Name", 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_category_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_category_model->add_category()) {
                $this->session->set_flashdata('success', "Category added successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_category_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while adding the category!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Gallery Category
     */
    public function update_gallery_category($id)
    {
        prevent_editor();

        $data['title'] = 'Update Gallery Category';

        //get category
        $data['category'] = $this->gallery_category_model->get_category($id);

        if (empty($data['category'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/update_gallery_category', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Gallery Category Post
     */
    public function update_gallery_category_post()
    {
        prevent_editor();

        //validate inputs
        $this->form_validation->set_rules('name', "Category Name", 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_category_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //category id
            $id = $this->input->post('category_id', true);
            if ($this->gallery_category_model->update_category($id)) {
                $this->session->set_flashdata('success', "Category updated successfully!");
                redirect('admin/gallery-categories');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_category_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while updating the category!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Gallery Category Post
     */
    public function delete_gallery_category_post()
    {
        prevent_editor();

        $id = $this->input->post('category_id', true);

        //check if category has posts
        if ($this->gallery_image_model->get_category_image_count($id) > 0) {
            $this->session->set_flashdata('error', "To delete this category, please delete the images belonging to this category!");
            redirect($this->agent->referrer());
        }

        if ($this->gallery_category_model->delete_category($id)) {
            $this->session->set_flashdata('success', "Category deleted successfully!");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', "There was a problem while deleting the category!");
            redirect($this->agent->referrer());
        }
    }






}
