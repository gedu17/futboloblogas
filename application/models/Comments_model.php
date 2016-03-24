<?php

class Comments_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    /* Admin actions */
    
    public function delete_comment($id, $user_id)
    {
        //$this->db->where('id', $id);
        //$this->db->delete('comments');
        $url = base_url()."/api/comments/delete/".$id;
        $data = array('userid' => $user_id);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }
    
    /* Public actions */
    public function get_comments($post_id)
    {        
        $api = base_url()."/api/comments/list/".$post_id;
        $data = file_get_contents($api);
        if(count($data) > 0)
        {
            return json_decode($data);
        }
        else
        {
            return array();
        }
    }
    
    public function post_comment($post_id, $user_id, $comment)
    {
        $url = base_url()."/api/comments/create/".$post_id;
        $data = array('userid' => $user_id, 'comment' => $comment);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }
    
    /* Helpers */
    
    public function check_comment($uid, $pid)
    {
        $check_user = $this->db->get_where('users', array('temp_id' => $uid));
        $check_post = $this->db->get_where('posts', array('id' => $pid));
        if(count($check_user->result()) > 0 && count($check_post->result()) > 0)
        {
            return true;
        }
        return false;
    }
}
