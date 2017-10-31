<?php

class Seo_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'site_title' => $this->input->post('site_title', true),
            'home_title' => $this->input->post('home_title', true),
            'site_keywords' => $this->input->post('site_keywords', true),
            'google_analytics' => $this->input->post('google_analytics', false),
        );
        return $data;
    }

    //update seo tools
    public function update()
    {
        $data = $this->input_values();

        $this->db->where('id', 1);
        return $this->db->update('settings', $data);
    }
}