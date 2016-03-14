<?php

class Comments_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_comments($post_id, $offset, $limit)
    {        
        $query = $this->db->order_by('date', 'DESC')->
                get_where('comments', array('post_id' => $post_id), $offset, $limit);
        $res = $query->result();
        foreach ($res as $item)
        {
            $q = $this->db->get_where('users', array('id' => $item->user_id))->result();
            if(count($q) > 0)
            {
                $item->user = $q[0]->username;
            }
            else
            {
                $item->user = "Anonimas";
            }
        }
        
        return $res;
    }
    
    public function post_comment($post_id, $user_id, $comment)
    {
        $real_user_id = $this->db->get_where('users', array('temp_id' => $user_id));
        $tmp = $real_user_id->result();
        $data = array(
                'date' => time(),
                'text' => $comment,
                'user_id' => $tmp[0]->id,
                'post_id' => $post_id
        );
        $this->db->insert('comments', $data);
    }
}
