<?php

class Category_model extends CI_Model
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
        $data = $this->category_model->input_values();
        return $this->db->insert('categories', $data);
    }

    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('categories');
        return $query->row();
    }

    //get categories
    public function get_categories()
    {
        $query = $this->db->get('categories');
        return $query->result();
    }

    //get category count
    public function get_category_count()
    {
        $query = $this->db->get('categories');
        return $query->num_rows();
    }

    //update category
    public function update_category($id)
    {
        $data = $this->category_model->input_values();

        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }


    //delete category
    public function delete_category($id)
    {
        $category = $this->get_category($id);
        if (!empty($category)) {
            $this->db->where('id', $id);
            return $this->db->delete('categories');
        }
        return false;
    }

}