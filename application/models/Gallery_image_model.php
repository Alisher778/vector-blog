<?php

class Gallery_image_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'category_id' => $this->input->post('category_id', true),
            'path_big' => $this->input->post('path_big', true),
            'path_small' => $this->input->post('path_small', true)
        );
        return $data;
    }

    //add image
    public function add_image()
    {
        $data = $this->gallery_image_model->input_values();

        //get file
        $file = $_FILES['file'];
        if (!empty($file['name'])) {
            //upload images
            $data["path_big"] = $this->upload_model->gallery_big_image_upload($file);
            $data["path_small"] = $this->upload_model->gallery_small_image_upload($file);
        } else {
            $data['path_big'] = "";
            $data['path_small'] = "";
        }

        return $this->db->insert('photos', $data);
    }

    //get gallery images
    public function get_images()
    {
        $this->db->join('gallery_categories', 'photos.category_id = gallery_categories.id');
        $this->db->select('photos.* , gallery_categories.name as category_name');
        $this->db->order_by('photos.id', 'DESC');
        $query = $this->db->get('photos');
        return $query->result();
    }

    //get gallery images by category
    public function get_images_by_category($category_id)
    {
        $this->db->join('gallery_categories', 'photos.category_id = gallery_categories.id');
        $this->db->select('photos.* , gallery_categories.name as category_name');
        $this->db->where('category_id',$category_id);
        $this->db->order_by('photos.id', 'DESC');
        $query = $this->db->get('photos');
        return $query->result();
    }

    //get category image count
    public function get_category_image_count($category_id)
    {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('photos');
        return $query->num_rows();
    }

    //get image
    public function get_image($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('photos');
        return $query->row();
    }

    //delete image
    public function delete_image($id)
    {
        $image = $this->gallery_image_model->get_image($id);

        if ($image) {
            //delete image
            delete_image_from_server($image->path_big);
            delete_image_from_server($image->path_small);

            $this->db->where('id', $id);
            return $this->db->delete('photos');
        }

    }
}