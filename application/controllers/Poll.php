<?php

class Poll extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    /* Public views */
    
    public function vote()
    {
        $uid = $this->users_model->get_uid();
        if($this->nativesession->get('logged_in') !== NULL && $uid > 0)
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
    
    /* Admin views */
    
    public function create()
    {
        $this->users_model->redirect_na();     
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        $this->form_validation->set_rules('name', 'Klausimas', 'required');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('poll/create', $data);
        }
        else
        {
            $poll_answers = array();
            for($i = 1; $i < $this->input->post('answersCount')+1; $i++)
            {
                array_push($poll_answers, $this->input->post('pollAnswer_'.$i));
            }
            $this->poll_model->add_poll($this->input->post('name'), $poll_answers);
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
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
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->poll_model->delete_poll($id);
    }
    
    public function edit($id)
    {
        $this->users_model->redirect_na();        
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        $data['poll_name'] = $this->poll_model->get_poll_name($id);
        $data['poll_answers'] = $this->poll_model->get_poll_answers($id);
        $data['poll_id'] = $id;
        $this->form_validation->set_rules('name', 'Pavadinimas', 'required');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('poll/edit', $data);
        }
        else
        {
            $poll_answers = array();
            foreach($this->input->post(NULL, TRUE) as $key => $value) {
                $tmpid = explode('_', $key);
                array_push($poll_answers, array('name' => $value, 'id' => 
                    $tmpid[count($tmpid)-1]));
            }
            $this->poll_model->update_poll($this->input->post('name'), 
                    $poll_answers, $id);
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
}
