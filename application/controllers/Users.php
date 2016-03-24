<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    /* Public views */
    
    public function index()
    {
        $this->users_model->redirect_all();
    }
    
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->users_model->login($username, $password);
    }
    
    public function logout()
    {
        $this->users_model->logout();
    }
    
    public function create()
    {
        $this->users_model->redirect_lin();
        $this->form_validation->set_rules('username', 'Vartotojo vardas', 
                'required|callback_username_exists');
        $this->form_validation->set_rules('password', 'Slaptažodis', 
                'required|callback_passwords_match['.$this->input->post('passconf').']');
        $this->form_validation->set_rules('passconf', 'Slaptažodžio pakartojimas',
                'required');
        $this->form_validation->set_rules('email', 'El. Paštas', 
                'required|callback_email_exists');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('users/create');
        }
        else
        {
            $this->load->view('users/created');
            $this->users_model->register($this->input->post('username'),
                    $this->input->post('password'), $this->input->post('email'));
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function activate($code)
    {
        $this->users_model->redirect_lin();
        $status = $this->users_model->activate($code);
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        $this->load->view('templates/header', $data);
        
        if($status)
        {
            $this->load->view('users/activated');
        }
        else
        {
            $this->load->view('users/not_activated');
        }
        
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function remind_password()
    {
        $this->users_model->redirect_lin();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('username', 'Vartotojo vardas', 
                'required|callback_check_remind_password');
        $this->form_validation->set_rules('email', 'El. Paštas', 
                'required|email');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('users/remind_password');
        }
        else
        {
            $this->users_model->remind_password($this->input->post('username'),
                    $this->input->post('email'));
            $this->load->view('users/password_reminded');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function restore_password($code = NULL)
    {
        if($code == NULL)
        {
            $this->users_model->redirect_all();
        }
        
        $this->users_model->redirect_lin();
        $temp_id = $this->users_model->recover_get_tempid($code);
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        $this->load->view('templates/header', $data);
        if($temp_id != "")
        {
            $data['recover_user_id'] = $temp_id;
            $this->users_model->remove_recovery_hash($temp_id);
            $this->load->view('users/remind_new_password', $data);
        }
        else
        {
            $this->load->view('users/remind_hash_not_found');
        }
        
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function recover_password()
    {
        $this->users_model->redirect_lin();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('password', 'Naujas slaptažodis', 
                'required|callback_passwords_match['.$this->input->post('passconf').']');
        $this->form_validation->set_rules('passconf', 'Naujo slaptažodžio pakartojimas',
                'required');
        $this->form_validation->set_rules('user_id', 'Vartotojo id', 'required');
        $data['recover_user_id'] = $this->input->post('user_id');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('users/remind_new_password', $data);
        }
        else
        {
            $this->users_model->recover_password($this->input->post('user_id'),
                    $this->input->post('password'));
            $this->load->view('users/password_changed');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function change_password()
    {
        $this->users_model->redirect_nlin();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('oldpassword', 'Dabartinis slaptažodis', 
                'required|callback_current_password');
        $this->form_validation->set_rules('password', 'Naujas slaptažodis', 
                'required|callback_passwords_match['.$this->input->post('passconf').']');
        $this->form_validation->set_rules('oldpassword', 'Naujo slaptažodžio '
                . 'pakartojimas', 'required');
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('users/change_password');
        }
        else
        {
            $this->users_model->change_password($this->input->post('password'));
            $this->load->view('users/password_changed');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }    
    
    /* Admin views */
    
    public function manage()
    {
        $this->users_model->redirect_na();
        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_users();
        $data = $this->template_data_model->get_data();
        
        $this->load->view('templates/header', $data);
        $this->load->view('users/list', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/footer');
    }
    
    public function delete($id)
    {
        $this->users_model->redirect_na();
        $this->users_model->delete_user($id);
    }
    
    public function admin_activate($id)
    {
        $this->users_model->redirect_na();
        $this->users_model->activate_user($id);
    }
    
    public function admin_deactivate($id)
    {
        $this->users_model->redirect_na();
        $this->users_model->deactivate_user($id);
    }
    
    /* Helpers */
    
    public function current_password($password)
    {
        if($this->users_model->check_password($password))
        {
            return true;
        }
        $this->form_validation->set_message('current_password', 'Neteisingas %s.');
        return false;
    }
    
    public static function get_username($id)
    {
        return $this->users_model->get_username($id);
    }
    
    public function check_remind_password($username)
    {
        $email = $this->input->post('email');
        if($this->users_model->check_username($username) && 
                $this->users_model->check_email($email))
        {
            return true;
        }
        $this->form_validation->set_message('check_remind_password', 
                'Neteisingi duomenys.');
        return false;
    }
    
    public function username_exists($username)    
    {
        if($this->users_model->check_username($username))
        {
            $this->form_validation->set_message('username_exists', 
                    '%s '.$username.' jau egzistuoja.');
            return false;
        }
        return true;
    }
    
    public function email_exists($email)    
    {
        if($this->users_model->check_email($email))
        {
            $this->form_validation->set_message('email_exists', 
                    '%s '.$email.' jau egzistuoja.');
            return false;
        }
        return true;
    }
    
    public function passwords_match($pw, $pw2)
    {
        if($pw !== $pw2)
        {
            $this->form_validation->set_message('passwords_match', 
                    'Slaptažodžiai nesutampa.');
            return false;
        }
        return true;
    }
}