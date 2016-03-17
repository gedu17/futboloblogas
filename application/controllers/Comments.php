<?php

class Comments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->model('users_model');
        $this->load->helper('form');
    }
    
    
    public function create($id)
    {
        $uid = "";
        if(isset($_SESSION['user_id']))
        {
            $uid = $_SESSION['user_id'];
        }
        
        $comment = $this->input->post('comment');
        if($this->comments_model->check_comment($uid, $id))
        {
            $this->comments_model->post_comment($id, $uid, $comment);
            redirect($_SERVER['HTTP_REFERER']."#comments", 'location');
        }
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->comments_model->delete_comment($id);
        redirect($_SERVER['HTTP_REFERER']."#comments", 'location');
    }
}
