<?php

class Template_data_model extends CI_Model {
    public function __construct()
    {
        $this->load->database();
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->model('posts_model');
        $this->array = array();
        //TODO: FIX
        $this->array['title'] = "Futbolo blogas";
        $this->array['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        $this->array['return_to'] = current_url();
    }
    
    public function use_user()
    {
        $this->array['logged_in'] = isset($_SESSION['logged_in']);
        $this->array['username'] = $this->users_model->get_username();
        $this->array['user_level'] = $this->users_model->get_user_level();
        $this->array['user_id'] = "";
        if(isset($_SESSION['user_id']))
        {
            $this->array['user_id'] = $_SESSION['user_id'];
        }
        
    }
    
    public function use_users()
    {
        $this->array['users'] = $this->users_model->get_users();
        
    }
    
    public function use_register()
    {
        $this->array['username'] = $this->input->post('username');
        $this->array['email'] = $this->input->post('email');
    }
    
    public function use_posts()
    {
        $this->array['posts'] = $this->posts_model->get_posts();
    }
    
    public function use_post($id)
    {
        $this->array['post'] = $this->posts_model->get_post($id);
        $this->array['post_id'] = $id;
    }
    
    public function use_poll()
    {
        $this->array['poll_items'] = $this->poll_model->get_poll_answers();
        $this->array['poll_question'] = $this->poll_model->get_poll_question();
        $this->array['poll_voted'] = $this->poll_model->did_vote($this->users_model->get_uid());
        $this->array['poll_results'] = $this->poll_model->get_poll_results();
    }
    
    public function get_data()
    {
        return $this->array;
    }
}