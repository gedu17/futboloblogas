<?php

class Posts extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('posts_model');
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->model('template_data_model');
        $this->load->helper('form');
    }
    
    public function index()
    {
        $this->template_data_model->use_posts();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('posts/index', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($id = NULL)
    {
        $this->template_data_model->use_post($id);
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_comments($id);
        $data = $this->template_data_model->get_data();        

        $this->load->view('templates/header', $data);
        if($data['post']->active == 1)
        {
            $this->load->view('posts/post', $data);
            $this->load->view('posts/comments', $data);
            $this->load->view('posts/comment_form', $data);
        }
        else
        {
            $this->load->view('posts/not_found');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function create()
    {
        $this->users_model->redirect_na();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('title', 'Pavadinimas', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('posts/create', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->users_model->redirect_na();
            $this->posts_model->add_post($this->input->post('title'), $this->input->post('text'));
            redirect(site_url('admin/posts/manage'), 'location');
        }
    }
    
    public function manage()
    {
        $this->users_model->redirect_na();
        $this->template_data_model->use_posts();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('posts/list', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit($id)
    {
        $this->users_model->redirect_na();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $post = $this->posts_model->get_post($id);
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        $title = $this->input->post('title');
        $text = $this->input->post('text');
        
        $data['form_title'] = $post->title;
        $data['form_text'] = $post->text;
        $data['form_id'] = $id;
        
        $this->form_validation->set_rules('title', 'Pavadinimas', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('posts/edit', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->users_model->redirect_na();
            $this->posts_model->update_post($id, $title, $text);
            redirect(site_url('admin/posts/manage'), 'location');
        }
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->posts_model->delete_post($id);
        redirect(site_url('admin/posts/manage'), 'location');
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

