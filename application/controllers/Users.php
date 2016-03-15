<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('poll_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');    
    }
    
    public function index()
    {
        /*$data['title'] = "PATAISYK MANE";
        $this->load->view('header', $data);
        $this->load->view('footer');*/
        //$this->session->unset_userdata('logged_in');
        //$data = $this->session->userdata('logged_in');
        //echo "loggedin = ".$data;
        echo "TODO: ENCAPSULATE ME";
    }
    
    public function logout()
    {
        $this->users_model->logout();
        redirect($_SERVER['HTTP_REFERER'], 'location');
    }
    
    
    public function login()
    {
        $this->check_login();
        redirect($_SERVER['HTTP_REFERER'], 'location');
    }
    
    public function create()
    {
        $this->users_model->redirect_lin();//loggedin_user();
        
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = "Futbolo blogas";
        $data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        
        $this->form_validation->set_rules('username', 'Vartotojo vardas', 'callback_username_exists');
        $this->form_validation->set_rules('password', 'Slaptažodis', 'matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Slaptažodžio pakartojimas', 'matches[password]');
        $this->form_validation->set_rules('email', 'El. Paštas', 'callback_email_exists');

        $data['username'] = $this->input->post('username');
        $data['email'] = $this->input->post('email');
        $data['logged_in'] = isset($_SESSION['logged_in']);
        $data['poll_items'] = $this->poll_model->get_poll_answers();
        $data['poll_question'] = $this->poll_model->get_poll_question();
        $data['poll_voted'] = $this->poll_model->did_vote($this->users_model->get_uid());
        $data['poll_results'] = $this->poll_model->get_poll_results();
        $data['user_level'] = $this->users_model->get_user_level();
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/created');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
            $this->users_model->create($this->input->post('username'),
                    $this->input->post('password'), $this->input->post('email'));
            /*$this->news_model->set_news();
            $this->load->view('news/success');*/
        }
    }
    
    public function change_password()
    {
        $this->users_model->redirect_nlin();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = "Futbolo blogas";
        $data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        
        $this->form_validation->set_rules('oldpassword', 'Dabartinis slaptažodis', 'callback_current_password');
        $this->form_validation->set_rules('password', 'Naujas slaptažodis', 'matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Naujo slaptažodžio pakartojimas', 'matches[password]');

        $data['logged_in'] = isset($_SESSION['logged_in']);
        $data['username'] = $this->users_model->get_username();
        $data['poll_items'] = $this->poll_model->get_poll_answers();
        $data['poll_question'] = $this->poll_model->get_poll_question();
        $data['poll_voted'] = $this->poll_model->did_vote($this->users_model->get_uid());
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/change_password');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->users_model->change_password($this->input->post('password'));
            
            $this->load->view('templates/header', $data);
            $this->load->view('users/password_changed');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        
    }    
    
    public function current_password($password)
    {
        $q = $this->db->get_where('users', array('temp_id' => $_SESSION['user_id']));
        $res = $q->result();
        if(count($res) > 0 && password_verify($password, $res[0]->password))
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
    
    public function username_exists($username)    
    {
        if($this->users_model->check_username($username))
        {
            $this->form_validation->set_message('username_exists', '%s '.$username.' jau egzistuoja.');
            return false;
        }
        return true;
    }
    
    public function email_exists($email)    
    {
        if($this->users_model->check_email($email))
        {
            $this->form_validation->set_message('email_exists', '%s '.$email.' jau egzistuoja.');
            return false;
        }
        return true;
    }
    
    public function check_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        return $this->users_model->login($username, $password);
    }
}