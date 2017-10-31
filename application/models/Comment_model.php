<?php

class Comment_model extends CI_Model
{

    //get input values
    public function input_values()
    {
        $data = array(
            'post_id' => $this->input->post('post_id', true),
            'user_id' => $this->input->post('user_id', true),
            'parent_id' => $this->input->post('parent_id', true),
            'comment' => $this->input->post('comment', true)
        );
        return $data;
    }

    //add comment
    public function add_comment()
    {
        $data = $this->comment_model->input_values();
        return $this->db->insert('comments', $data);
    }

    //get comment
    public function get_comment($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('comments');
        return $query->row();
    }

    //get comments
    public function get_comments($post_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->where('post_id', $post_id);
        $this->db->where('parent_id', 0);
        $this->db->select('comments.* , users.avatar as user_avatar, users.id as user_id, users.username as username');
        $this->db->order_by('comments.id');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get all comments
    public function get_all_comments()
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->join('posts', 'comments.post_id = posts.id');
        $this->db->select('comments.* , users.email as user_email, users.id as user_id, 
                            users.username as username, posts.title as post_title ');
        $this->db->order_by('comments.id');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get last comments
    public function get_last_comments()
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->select('comments.* , users.avatar as user_avatar, users.id as user_id, users.username as username');
        $this->db->order_by('comments.id', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get subcomments
    public function get_subcomments($comment_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->where('parent_id', $comment_id);
        $this->db->select('comments.* , users.avatar as user_avatar, users.id as user_id, users.username as username');
        $this->db->order_by('comments.id');
        $query = $this->db->get('comments');
        return $query->result();
    }

    //get post comment count
    public function get_post_comment_count($post_id)
    {
        $this->db->join('users', 'comments.user_id = users.id');
        $this->db->where('post_id', $post_id);
        $this->db->where('parent_id', 0);
        $this->db->select('comments.* , users.avatar as user_avatar');
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //get comment count
    public function get_comment_count()
    {
        $query = $this->db->get('comments');
        return $query->num_rows();
    }

    //delete comment
    public function delete_comment($id)
    {
        $subcomments = $this->get_subcomments($id);

        if (!empty($subcomments)) {

            foreach ($subcomments as $comment) {
                $this->db->where('id', $comment->id);
                $this->db->delete('comments');
            }
        }

        $this->db->where('id', $id);
        return $this->db->delete('comments');
    }
}