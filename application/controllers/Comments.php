<?php

class Comments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->helper('form');
    }
    
    
    public function create()
    {
        //TODO: JAVASCRIPT VALIDATION ON COMMENT!
        $uid = $this->input->post('user_id');
        $pid = $this->input->post('post_id');
        $comment = $this->input->post('comment');
        $return_to = $this->input->post('return_to');
        
        $check_user = $this->db->get_where('users', array('temp_id' => $uid));
        $check_post = $this->db->get_where('posts', array('id' => $pid));
        if(count($check_user->result()) > 0 && count($check_post->result()) > 0)
        {
            $this->comments_model->post_comment($pid, $uid, $comment);
            redirect($return_to, 'location');
        }
    }
}
