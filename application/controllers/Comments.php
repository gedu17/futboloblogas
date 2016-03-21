<?php

class Comments extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create($id)
    {
        $uid = "";
        if($this->nativesession->get('user_id') !== NULL)
        {
            $uid = $this->nativesession->get('user_id');
        }
        
        $comment = $this->input->post('comment');
        if($this->comments_model->check_comment($uid, $id))
        {
            $this->comments_model->post_comment($id, $uid, $comment);
            redirect(filter_input(INPUT_SERVER, 'HTTP_REFERER')."#comments", 'location');
        }
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $uid = "";
        if($this->nativesession->get('user_id') !== NULL)
        {
            $uid = $this->nativesession->get('user_id');
        }
        $this->comments_model->delete_comment($id, $uid);
        redirect(filter_input(INPUT_SERVER, 'HTTP_REFERER')."#comments", 'location');
    }
}
