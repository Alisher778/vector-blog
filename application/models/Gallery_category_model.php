<?php

class Gallery_category_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'name' => $this->input->post('name', true)
        );
        return $data;
    }

    //add category
    public function add_category()
    {
        $data = $this->gallery_category_model->input_values();
        return $this->db->insert('gallery_categories', $data);
    }

    //get gallery categories
    public function get_categories()
    {
        $query = $this->db->get('gallery_categories');
        return $query->result();
    }

    //get category count
    public function get_category_count()
    {
        $query = $this->db->get('gallery_categories');
        return $query->num_rows();
    }

    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('gallery_categories');
        return $query->row();
    }

    //update category
    public function update_category($id)
    {
        $data = $this->gallery_category_model->input_values();

        $this->db->where('id', $id);
        return $this->db->update('gallery_categories', $data);
    }

    //delete category
    public function delete_category($id)
    {
        $category = $this->get_category($id);
        if (!empty($category)) {
            $this->db->where('id', $id);
            return $this->db->delete('gallery_categories');
        }
        return false;
    }


}