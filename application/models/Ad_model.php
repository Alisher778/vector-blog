<?php

class Ad_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'home_728' => $this->input->post('home_728', false),
            'home_468' => $this->input->post('home_468', false),
            'home_234' => $this->input->post('home_234', false),
            'post_728' => $this->input->post('post_728', false),
            'post_468' => $this->input->post('post_468', false),
            'post_234' => $this->input->post('post_234', false),
            'category_728' => $this->input->post('category_728', false),
            'category_468' => $this->input->post('category_468', false),
            'category_234' => $this->input->post('category_234', false),
            'tag_728' => $this->input->post('tag_728', false),
            'tag_468' => $this->input->post('tag_468', false),
            'tag_234' => $this->input->post('tag_234', false),
            'search_728' => $this->input->post('search_728', false),
            'search_468' => $this->input->post('search_468', false),
            'search_234' => $this->input->post('search_234', false),
            'sidebar_300' => $this->input->post('sidebar_300', false),
            'sidebar_234' => $this->input->post('sidebar_234', false)
        );
        return $data;
    }

    //add ads
    public function update_ads()
    {
        $this->db->where('id', 1);
        $data = $this->ad_model->input_values();
        return $this->db->update('ads', $data);
    }


    //get ads
    public function get_ads()
    {
        $query = $this->db->get_where('ads');
        return $query->row();
    }

}