<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start();
class Users extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }
    
    public function index()
    {
        /*$data['title'] = "PATAISYK MANE";
        $this->load->view('header', $data);
        $this->load->view('footer');*/
        //$this->session->set_userdata('logged_in', array('id' => 12));
        echo "vyksta";
        $data = $this->session->userdata('logged_in');
        print_r($data);
        echo "id = ".$data['id'];
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
    
    public function create()
    {
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
}