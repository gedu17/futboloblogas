<?php

class Posts_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function get_posts()
    {
        $query = $this->db->order_by('date', 'DESC')->get_where('posts', array('active' => 1), 0, 15);
        $res = $query->result();
        foreach($res as $item) {
            $this->db->where('post_id', $item->id);
            $this->db->from('comments');
            $item->comments = $this->db->count_all_results();                 
        }
        return $res;
    }
    
    public function get_post($id)
    {
        $query = $this->db->get_where('posts', array('active' => 1, 'id' => $id), 0, 1);
        $res = $query->result();
        if(count($res) > 0){
            $this->db->where('post_id', $res[0]->id);
            $this->db->from('comments');
            $res[0]->comments = $this->db->count_all_results();             
            return $res[0];
        }
        return (object) array('id' => '', 'title' => '', 'date' => 0, 'text' => '', 
            'active' => 0, 'comments' => 0);
    }
    
    public function add_post($title, $text)
    {
        $data = array(
                'title' => $title,
                'text'  => $text,
                'date'  => time(),
                'active' => 1
        );
        $this->db->insert('posts', $data);
    }
    
    public function update_post($id, $title, $text)
    {
        $data = array(
                'title' => $title,
                'text'  => $text
        );
        $this->db->where('id', $id);
        $this->db->update('posts', $data);
    }
    
    public function delete_post($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('posts');
    }
}
