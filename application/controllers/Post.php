<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MY_Controller
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
     * Add Post
     */
    public function add_post()
    {
        $data['title'] = "Add New Post";
        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/add_post', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Add Post Post
     */
    public function add_post_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', "Title", 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', "Summary", 'xss_clean|max_length[1000]');
        $this->form_validation->set_rules('category_id', "Category", 'required');
        $this->form_validation->set_rules('optional_url', "Optional Url", 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->post_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //if post added
            if ($this->post_model->add_post()) {
                //last id
                $last_id = $this->db->insert_id();
                //insert post image
                $this->post_model->add_post_image($last_id);
                //insert post additional images
                $this->post_image_model->add_post_images($last_id);
                //insert post tags
                $this->tag_model->add_post_tags($last_id);

                $this->session->set_flashdata('success', "Post added successfully!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->post_model->input_values());
                $this->session->set_flashdata('error', "There was a problem while adding the post!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Posts
     */
    public function posts()
    {
        $data['title'] = 'Posts';

        //get posts
        $data["posts"] = $this->post_model->get_posts();

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/posts', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Post
     */
    public function update_post($id)
    {
        $data['title'] = 'Update Post';

        //get post
        $data['post'] = $this->post_model->get_post($id);

        if (empty($data['post'])) {
            redirect($this->agent->referrer());
        }
        //combine post tags
        $tags = "";
        $count = 0;
        $tags_array = $this->tag_model->get_post_tags($id);
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item->tag;
            $count++;
        }

        $data['tags'] = $tags;
        $data['post_images'] = $this->post_image_model->get_post_images($id);

        $this->load->view('admin/_header', $data);
        $this->load->view('admin/update_post', $data);
        $this->load->view('admin/_footer');
    }


    /**
     * Update Post Post
     */
    public function update_post_post()
    {
        //validate inputs
        $this->form_validation->set_rules('title', "Title", 'required|xss_clean|max_length[500]');
        $this->form_validation->set_rules('summary', "Summary", 'xss_clean|max_length[1000]');
        $this->form_validation->set_rules('category_id', "Category", 'required');
        $this->form_validation->set_rules('optional_url', "Optional Url", 'xss_clean|max_length[1000]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->post_model->input_update_values());
            redirect($this->agent->referrer());
        } else {
            //post id
            $post_id = $this->input->post('id', true);
            //if post added
            if ($this->post_model->update_post($post_id)) {
                //update post image
                $this->post_model->update_post_image($post_id);
                //update post additional images
                $this->post_image_model->add_post_images($post_id);
                //update post tags
                $this->tag_model->update_post_tags($post_id);

                $this->session->set_flashdata('success', "Post updated successfully!");
                redirect('admin/posts');
            } else {
                $this->session->set_flashdata('form_data', $this->post_model->input_update_values());
                $this->session->set_flashdata('error', "There was a problem while updating the post!");
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Upload Ck Editor Images Post
     */
    public function upload_ckimage_post()
    {
        if ('yfDnzj985hf7AdyfgjfH6ufhg' == $this->input->get('key', true)) {
            //get file
            $file = $_FILES['upload'];
            $path = $this->upload_model->ck_image_upload($file);
            $url = base_url() . $path;

            //return ck editor message and image url
            $msg = 'Successfully Uploaded';
            $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
            $output = '<html><body><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $CKEditorFuncNum . ', "' . $url . '","' . $msg . '");</script></body></html>';
            echo $output;
        }
    }


    /**
     * Delete Post Image
     */
    public function delete_post_image_post()
    {
        $id = $this->input->post('id', true);
        //delete image
        $this->post_image_model->delete_post_image($id);

    }


    /**
     * Save Post Slider Order
     */
    public function post_slider_order_post()
    {
        $post_id = $this->input->post('id', true);
        $slider_order = $this->input->post('slider_order', true);

        $this->post_model->save_post_slider_order($post_id, $slider_order);
        redirect($this->agent->referrer());
    }


    /**
     * Delete Post
     */
    public function post_options_post()
    {
        $option = $this->input->post('option', true);
        $id = $this->input->post('post_id', true);

        //if option add delete from slider
        if ($option == 'add_delete_slider') {
            $result = $this->post_model->post_add_delete_slider($id);

            if ($result == "removed") {
                $this->session->set_flashdata('success', "Post removed from slider!");
                redirect($this->agent->referrer());
            }
            if ($result == "added") {
                $this->session->set_flashdata('success', "Post added to slider!");
                redirect($this->agent->referrer());
            }
        }

        //if option delete
        if ($option == 'delete') {
            $data["post"] = $this->post_model->get_post($id);

            //check if exists
            if (empty($data['post'])) {
                redirect($this->agent->referrer());
            } else {
                if ($this->post_model->delete_post($id)) {
                    //delete post tags
                    $this->tag_model->delete_post_tags($id);
                    //delete post images
                    $this->post_image_model->delete_post_images($id);

                    $this->session->set_flashdata('success', "Post deleted successfully!");
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('error', "There was a problem while deleting the post!");
                    redirect($this->agent->referrer());
                }
            }
        }
    }
}
