<?php

class Page_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'title' => $this->input->post('title', true),
            'slug' => $this->input->post('slug', true),
            'page_description' => $this->input->post('page_description', true),
            'page_content' => $this->input->post('page_content', false),
            'page_order' => $this->input->post('page_order', true),
            'page_active' => $this->input->post('page_active', true),
            'title_active' => $this->input->post('title_active', true),
            'breadcrumb_active' => $this->input->post('breadcrumb_active', true),
            'right_column_active' => $this->input->post('right_column_active', true),
            'location' => $this->input->post('location', true),
            'need_auth' => $this->input->post('need_auth', true)
        );
        return $data;
    }

    //add page
    public function add_page()
    {
        $data = $this->page_model->input_values();
        //slug for title
        $data["slug"] = str_slug($data["title"]);
        $data['page_order'] = 5;
        $data['page_active'] = 1;
        $data['title_active'] = 1;
        $data['breadcrumb_active'] = 1;
        $data['right_column_active'] = 1;

        return $this->db->insert('pages', $data);
    }

    //update page
    public function update_page()
    {
        //get id
        $id = $this->input->post('id', true);
        //set values
        $data = $this->page_model->input_values();

        $update_data['page_description'] = $data['page_description'];
        $update_data['page_order'] = $data['page_order'];

        if (!is_null($data["title"])) {
            //slug for title
            $update_data["title"] = $data["title"];
            $update_data["slug"] = str_slug($data["title"]);
        }
        if (!is_null($data["page_content"])) {
            $update_data["page_content"] = $data["page_content"];
        }
        if (!is_null($data["page_active"])) {
            $update_data["page_active"] = $data["page_active"];
        }
        if (!is_null($data["title_active"])) {
            $update_data["title_active"] = $data["title_active"];
        }
        if (!is_null($data["breadcrumb_active"])) {
            $update_data["breadcrumb_active"] = $data["breadcrumb_active"];
        }
        if (!is_null($data["right_column_active"])) {
            $update_data["right_column_active"] = $data["right_column_active"];
        }
        if (!is_null($data["need_auth"])) {
            $update_data["need_auth"] = $data["need_auth"];
        }

        $update_data["location"] = $data["location"];
        $this->db->where('id', $id);
        return $this->db->update('pages', $update_data);
    }

    //get pages
    public function get_pages()
    {
        $this->db->order_by('page_order');
        $query = $this->db->get('pages');
        return $query->result();
    }

    //get header pages
    public function get_header_pages()
    {
        $this->db->order_by('page_order');
        $this->db->where('location', 'header');
        $query = $this->db->get('pages');
        return $query->result();
    }

    //get footer pages
    public function get_footer_pages()
    {
        $this->db->order_by('page_order');
        $this->db->where('location', 'footer');
        $query = $this->db->get('pages');
        return $query->result();
    }

    //get page
    public function get_page($slug)
    {
        $this->db->where('slug', $slug);
        $query = $this->db->get('pages');
        return $query->row();
    }

    //get page by id
    public function get_page_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('pages');
        return $query->row();
    }

    //delete page
    public function delete_page($id)
    {
        $page = $this->get_page_by_id($id);
        if (!empty($page)) {
            $this->db->where('id', $id);
            return $this->db->delete('pages');
        }
        return false;
    }
}