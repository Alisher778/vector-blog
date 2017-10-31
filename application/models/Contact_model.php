<?php

class Contact_model extends CI_Model
{

    //input values
    public function input_values()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'message' => $this->input->post('message', true)
        );
        return $data;
    }

    //add contact message
    public function add_contact_message()
    {
        $data = $this->contact_model->input_values();
        return $this->db->insert('contacts', $data);
    }

    //get contact messages
    public function get_contact_messages()
    {
        $query = $this->db->get('contacts');
        return $query->result();
    }

    //get last contact messages
    public function get_last_contact_messages()
    {
        $this->db->limit(5);
        $query = $this->db->get('contacts');
        return $query->result();
    }

    //delete contact message
    public function delete_contact_message($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('contacts');
    }
}