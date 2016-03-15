<?php

class Poll extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->helper('form');
    }
    
    public function vote()
    {
        $uid = $this->users_model->get_uid();
        if(isset($_SESSION['logged_in']) && $uid > 0)
        {
            $voted = $this->poll_model->did_vote($uid);
            if(!$voted)
            {
                $this->poll_model->vote($uid, $this->input->post('poll'));
            }
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }
    }
}
