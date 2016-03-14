<?php

class Posts extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('posts_model');
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->helper('form');
    }
    
    public function index()
    {
        $data['posts'] = $this->posts_model->get_posts();
        //TODO: FIX CONSTNATS BELOW
        $data['title'] = "Futbolo blogas";
        $data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        
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
        $user_data['logged_in'] = true;
        //TODO: add userid to session !
        $user_data['user_id'] = "8J51xTADwwYCIVgaoFSWg5uLsiHGUPmJQJehMn81l7D097A6utDCFSmuHdE9";
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

