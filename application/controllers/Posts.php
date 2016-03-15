<?php

class Posts extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('posts_model');
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->helper('form');
    }
    
    public function index()
    {
        //print_r($this->session->all_userdata());
        $data['posts'] = $this->posts_model->get_posts();
        //TODO: FIX CONSTNATS BELOW
        $data['title'] = "Futbolo blogas";
        $data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        $data['logged_in'] = isset($_SESSION['logged_in']);
        $data['username'] = $this->users_model->get_username();
        $data['poll_items'] = $this->poll_model->get_poll_answers();
        $data['poll_question'] = $this->poll_model->get_poll_question();
        $data['poll_voted'] = $this->poll_model->did_vote($this->users_model->get_uid());
        $data['poll_results'] = $this->poll_model->get_poll_results();
        $data['user_level'] = $this->users_model->get_user_level();
        
        $this->load->view('templates/header', $data);
        $this->load->view('posts/index', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($id = NULL)
    {
        
        $data['post'] = $this->posts_model->get_posts($id);
        //TODO: FIX CONSTNATS BELOW
        $data['title'] = "Futbolo blogas";
        $data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        
        $data['username'] = $this->users_model->get_username();
        $data['logged_in'] = isset($_SESSION['logged_in']);
        $data['poll_items'] = $this->poll_model->get_poll_answers();
        $data['poll_question'] = $this->poll_model->get_poll_question();
        $data['poll_voted'] = $this->poll_model->did_vote($this->users_model->get_uid());
        $data['poll_results'] = $this->poll_model->get_poll_results();
        $data['user_level'] = $this->users_model->get_user_level();
        
        $user_data['user_id'] = isset($_SESSION['user_id']);
        $user_data['post_id'] = $id;
        $user_data['return_to'] = current_url();

        $comments['comments'] = $this->comments_model->get_comments($id, 0, 15);

        $this->load->view('templates/header', $data);

        $this->load->view('posts/post', $data);
        $this->load->view('posts/comments', $comments);
        $this->load->view('posts/comment_form', $user_data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public static function get_comment_text($number)
    {
        $digit = substr($number, -1);
        if(strlen($number) > 2)
        {
            $number = substr($number, (strlen($number)-2));
        }
        
        if($number > 20)
        {
            if($digit == 0)
            {
                return "komentarų";
            }
            else if($digit == 1)
            {
                return "komentaras";
            }
            else
            {
                return "komentarai";
            }
        }
        else
        {
            if($digit == 0 || ($number > 10 && $number < 20))
            {
                return "komentarų";
            }
            else if($number == 1)
            {
                return "komentaras";
            }
            else 
            {
                return "komentarai";
            }
        }
    }
}

