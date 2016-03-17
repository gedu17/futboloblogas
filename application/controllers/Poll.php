<?php

class Poll extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('comments_model');
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->helper('form');
        $this->load->model('template_data_model');
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
        }
    }
    
    public function view()
    {
        $data = array();
        $data['poll_results'] = $this->poll_model->get_poll_results();
        $this->load->view('poll/view', $data);
    }
    
    public function create()
    {
        $this->users_model->redirect_na();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('name', 'Klausimas', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('poll/create', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->users_model->redirect_na();
            $poll_answers = array();
            for($i = 1; $i < $this->input->post('answersCount')+1; $i++)
            {
                array_push($poll_answers, $this->input->post('pollAnswer_'.$i));
            }
            $this->poll_model->add_poll($this->input->post('name'), $poll_answers);
            redirect(site_url('admin/poll/manage'), 'location');
        }
    }
    
    public function manage()
    {
        $this->users_model->redirect_na();
        $this->template_data_model->use_polls();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('poll/list', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function activate($id)
    {
        $this->users_model->redirect_na();
        $this->poll_model->activate($id);
        redirect(site_url('admin/poll/manage'), 'location');
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->poll_model->delete_poll($id);
        redirect(site_url('admin/poll/manage'), 'location');
    }
    
    public function edit($id)
    {
        $this->users_model->redirect_na();
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $data['poll_name'] = $this->poll_model->get_poll_name($id);
        $data['poll_answers'] = $this->poll_model->get_poll_answers($id);
        $data['poll_id'] = $id;
        
        $this->form_validation->set_rules('name', 'Pavadinimas', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('poll/edit', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->users_model->redirect_na();
            $poll_answers = array();
            foreach($this->input->post(NULL, TRUE) as $key => $value) {
                $tmpid = explode('_', $key);
                array_push($poll_answers, array('name' => $value, 'id' => 
                    $tmpid[count($tmpid)-1]));
            }
            $this->poll_model->update_poll($this->input->post('name'), 
                    $poll_answers, $id);
            redirect(site_url('admin/poll/manage'), 'location');
        }
    }
}
