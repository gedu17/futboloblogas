<?php

class Posts_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_posts($id = FALSE)
    {
        if($id === FALSE)
        {
            $query = $this->db->get_where('posts', array('active' => 1), 0, 15);
            $res = $query->result();
            foreach($res as $item) {
                $this->db->where('post_id', $item->id);
                $this->db->from('comments');
                $item->comments = $this->db->count_all_results();                 
            }
            return $res;
        }
        
        $query = $this->db->get_where('posts', array('active' => 1, 'id' => $id), 0, 1);
        $res = $query->result();
        $this->db->where('post_id', $res[0]->id);
        $this->db->from('comments');
        $res[0]->comments = $this->db->count_all_results();             
        return $res[0];
    }
}
