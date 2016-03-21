<?php

class Posts extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    /* Public views */
    
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
    
    /* Admin views */
    
    public function create()
    {
        $this->users_model->redirect_na();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        $this->form_validation->set_rules('title', 'Pavadinimas', 'required');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('posts/create', $data);
        }
        else
        {
            $this->posts_model->add_post($this->input->post('title'), 
                    $this->input->post('text'));
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
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
        $post = $this->posts_model->get_post($id);
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();        
        $data['form_title'] = $post->title;
        $data['form_text'] = $post->text;
        $data['form_id'] = $id;
        $this->form_validation->set_rules('title', 'Pavadinimas', 'required');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('posts/edit', $data);
        }
        else
        {
            $this->posts_model->update_post($id, $this->input->post('title'), 
                    $this->input->post('text'));
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->posts_model->delete_post($id);
    }
    
    /* Helpers */
    
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

