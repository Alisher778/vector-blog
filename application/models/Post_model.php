<?php

class Post_model extends CI_Model
{

    //input values
    public function input_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'title_slug' => $this->input->post('title_slug', true),
            'summary' => $this->input->post('summary', true),
            'content' => $this->input->post('content', false),
            'category_id' => $this->input->post('category_id', true),
            'image_big' => $this->input->post('image_big', true),
            'image_mid' => $this->input->post('image_mid', true),
            'image_small' => $this->input->post('image_small', true),
            'image_slider' => $this->input->post('image_slider', true),
            'is_slider' => $this->input->post('is_slider', true),
            'slider_order' => $this->input->post('slider_order', true),
            'optional_url' => $this->input->post('optional_url', true),
            'visibility' => $this->input->post('visibility', true),
            'need_auth' => $this->input->post('need_auth', true)
        );
        return $data;
    }

    //input update values
    public function input_update_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'title_slug' => $this->input->post('title_slug', true),
            'summary' => $this->input->post('summary', true),
            'content' => $this->input->post('content', false),
            'category_id' => $this->input->post('category_id', true),
            'is_slider' => $this->input->post('is_slider', true),
            'optional_url' => $this->input->post('optional_url', true),
            'visibility' => $this->input->post('visibility', true),
            'need_auth' => $this->input->post('need_auth', true)
        );
        return $data;
    }

    //add post
    public function add_post()
    {
        $data = $this->post_model->input_values();

        //slug for title
        $data["title_slug"] = str_slug($data["title"]);
        $data["slider_order"] = 0;
        if (!$data["is_slider"]) {
            $data["is_slider"] = 0;
        }

        return $this->db->insert('posts', $data);
    }

    //update post
    public function update_post($id)
    {
        $data = $this->post_model->input_update_values();

        //slug for title
        $data["title_slug"] = str_slug($data["title"]);
        if (!$data["is_slider"]) {
            $data["is_slider"] = 0;
        }

        $this->db->where('id', $id);
        return $this->db->update('posts', $data);
    }

    //add post image
    public function add_post_image($post_id)
    {
        //get file
        $file = $_FILES['file'];
        if ($file) {
            //upload images
            $data["image_big"] = $this->upload_model->post_big_image_upload($post_id, $file);
            $data["image_mid"] = $this->upload_model->post_mid_image_upload($post_id, $file);
            $data["image_small"] = $this->upload_model->post_small_image_upload($post_id, $file);
            $data["image_slider"] = $this->upload_model->post_slider_image_upload($post_id, $file);

            $this->db->where('id', $post_id);
            return $this->db->update('posts', $data);
        }
    }

    //update post image
    public function update_post_image($post_id)
    {
        //get file
        $file = $_FILES['file'];

        if (!empty($file['name'])) {
            //delete old image
            $post = $this->post_model->get_post($post_id);

            //delete images
            delete_image_from_server($post->image_big);
            delete_image_from_server($post->image_mid);
            delete_image_from_server($post->image_small);
            delete_image_from_server($post->image_slider);

            //upload new image
            $data["image_big"] = $this->upload_model->post_big_image_upload($post_id, $file);
            $data["image_mid"] = $this->upload_model->post_mid_image_upload($post_id, $file);
            $data["image_small"] = $this->upload_model->post_small_image_upload($post_id, $file);
            $data["image_slider"] = $this->upload_model->post_slider_image_upload($post_id, $file);

            $this->db->where('id', $post_id);
            return $this->db->update('posts', $data);
        }
    }

    //get posts
    public function get_posts()
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->order_by('posts.id', 'DESC');
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get post
    public function get_post($id)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.id', $id);
        $query = $this->db->get('posts');
        return $query->row();
    }

    //get related posts
    public function get_related_posts($category_id, $post_id)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('category_id', $category_id);
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.id !=', $post_id);
        $this->db->order_by('rand()');
        $this->db->limit(3);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated posts
    public function get_paginated_posts($per_page, $offset)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated category posts
    public function get_paginated_category_posts($category_id, $per_page, $offset)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.category_id', $category_id);
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get slider posts
    public function get_slider_posts()
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->where('is_slider', 1);
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.slider_order');
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get random slider posts
    public function get_random_slider_posts()
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where("posts.image_slider != ''");
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get footer random posts
    public function get_footer_random_posts()
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('rand()');
        $this->db->limit(3);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get post count
    public function get_post_count()
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.id', 'DESC');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get category post count
    public function get_category_post_count($category_id)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->where('posts.category_id', $category_id);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get posts by tag
    public function get_tag_posts($tag_slug)
    {
        $this->db->join('tags', 'posts.id = tags.post_id');
        $this->db->select('posts.*', 'tags.id as tag_id');
        $this->db->where('posts.visibility', 1);
        $this->db->where('tags.tag_slug', $tag_slug);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get paginated posts by tag
    public function get_paginated_tag_posts($tag_slug, $per_page, $offset)
    {
        $this->db->join('tags', 'posts.id = tags.post_id');
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.*, tags.id as tag_id, categories.name as category_name');
        $this->db->where('posts.visibility', 1);
        $this->db->where('tags.tag_slug', $tag_slug);
        $this->db->order_by('posts.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get tag post count
    public function get_tag_post_count($tag_slug)
    {
        $this->db->join('tags', 'posts.id = tags.post_id');
        $this->db->select('posts.*', 'tags.id as tag_id');
        $this->db->where('posts.visibility', 1);
        $this->db->where('tags.tag_slug', $tag_slug);
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get search post count
    public function get_paginated_search_posts($q, $per_page, $offset)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->like('title', $q);
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.id', 'DESC');
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //get search post count
    public function get_search_post_count($q)
    {
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->select('posts.* , categories.name as category_name');
        $this->db->like('title', $q);
        $this->db->where('posts.visibility', 1);
        $this->db->order_by('posts.id', 'DESC');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    //get popular posts
    public function get_popular_posts()
    {
        $this->db->order_by('posts.hit', 'DESC');
        $this->db->where('posts.visibility', 1);
        $this->db->limit(6);
        $query = $this->db->get('posts');
        return $query->result();
    }

    //add or delete post from slider
    public function post_add_delete_slider($id)
    {
        //get post
        $post = $this->post_model->get_post($id);

        if ($post) {
            $result = "";
            if ($post->is_slider == 1) {
                //remove from slider
                $data = array(
                    'is_slider' => 0,
                );
                $result = "removed";
            } else {
                //add to slider
                $data = array(
                    'is_slider' => 1,
                );
                $result = "added";
            }

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
            return $result;
        }
    }

    //save post slider order
    public function save_post_slider_order($id, $order)
    {
        //get post
        $post = $this->post_model->get_post($id);

        if ($post) {
            $data = array(
                'slider_order' => $order,
            );
            $this->db->where('id', $id);
            $this->db->update('posts', $data);
        }
    }

    //increase post hit
    public function increase_post_hit($id)
    {
        //get post
        $post = $this->post_model->get_post($id);

        if (get_cookie('inf_post_' . $id) != 1) {
            //increase hit
            set_cookie('inf_post_' . $id, '1', time() + 9889899);
            $data = array(
                'hit' => $post->hit + 1
            );

            $this->db->where('id', $id);
            $this->db->update('posts', $data);
        }

    }

    //delete post
    public function delete_post($id)
    {
        $post = $this->post_model->get_post($id);

        if (!empty($post)) {
            //delete images
            delete_image_from_server($post->image_big);
            delete_image_from_server($post->image_mid);
            delete_image_from_server($post->image_small);
            delete_image_from_server($post->image_slider);

            $this->db->where('id', $id);
            return $this->db->delete('posts');
        } else {
            return false;
        }

    }
}