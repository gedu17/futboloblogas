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
        $this->load->model('template_data_model');
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
        $this->load->library('email');
        $this->users_model->redirect_lin();//loggedin_user();
        
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        //$data['title'] = "Futbolo blogas";
        //$data['slogan'] = "Futbolo blogas - apie futbolo pasaulį";
        
        $this->form_validation->set_rules('username', 'Vartotojo vardas', 'callback_username_exists');
        $this->form_validation->set_rules('password', 'Slaptažodis', 'matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Slaptažodžio pakartojimas', 'matches[password]');
        $this->form_validation->set_rules('email', 'El. Paštas', 'callback_email_exists');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        
        
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
            $act_code = $this->users_model->create($this->input->post('username'),
                    $this->input->post('password'), $this->input->post('email'));
            
            $this->email->from('no-reply@futboloblogas.lt', 'FutboloBlogas.lt');
            $this->email->to($this->input->post('email')); 
            //$this->email->cc('another@another-example.com'); 
            //$this->email->bcc('them@their-example.com'); 

            $this->email->subject('Registracija puslapyje FutboloBlogas.lt');
            $msg = "Sveiki, ".$this->input->post('username').". \n\n".
                    "Jūsų aktyvacijos nuoroda <a href=\"".
                    site_url('users/activate/'.$act_code)."\">".
                    site_url('users/activate/'.$act_code)."</a>";
            $this->email->message($msg);	

            $this->email->send();

            echo $this->email->print_debugger();
            /*$this->news_model->set_news();
            $this->load->view('news/success');*/
        }
    }
    
    public function activate($code)
    {
        echo "KODAS YRA ".$code;
    }
    
    public function remind_password()
    {
        $this->load->library('email');
        $this->users_model->redirect_lin();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $this->template_data_model->use_register();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('username', 'Vartotojo vardas', 'callback_check_remind_password');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('users/remind_password');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            
            //TODO: UNCOMMENT ME
            /*$code = password_hash(time()+"_"+$this->input->post('username')+"_"+
                    $this->input->post('email'), PASSWORD_DEFAULT);
            //TODO: add code to db
            $this->email->from('no-reply@futboloblogas.lt', 'FutboloBlogas.lt');
            $this->email->to($this->input->post('email')); 

            $this->email->subject('Registracija puslapyje FutboloBlogas.lt');
            $msg = "Sveiki, ".$this->input->post('username').". \n\n".
                    "Nuoroda slaptažodžio atstatymui yra <a href=\"".
                    site_url('users/restore_password/'.$code)."\">".
                    site_url('users/restore_password/'.$code)."</a>. \n".
                    "Jeigu neprašėte slaptažodžio atstatymo, ignoruokite šį laišką.";
            $this->email->message($msg);	

            $this->email->send();

            echo $this->email->print_debugger();*/
            
            $this->load->view('templates/header', $data);
            $this->load->view('users/password_reminded');
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/footer');
        }
    }
    
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
        redirect(site_url('admin/users/manage'), 'location');
        
    }
    
    public function admin_activate($id)
    {
        $this->users_model->redirect_na();
        $this->users_model->activate_user($id);
        redirect(site_url('admin/users/manage'), 'location');
    }
    
    public function admin_deactivate($id)
    {
        $this->users_model->redirect_na();
        $this->users_model->deactivate_user($id);
        redirect(site_url('admin/users/manage'), 'location');
    }
    
    public function change_password()
    {
        $this->users_model->redirect_nlin();
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->template_data_model->use_user();
        $this->template_data_model->use_poll();
        $data = $this->template_data_model->get_data();
        
        $this->form_validation->set_rules('oldpassword', 'Dabartinis slaptažodis', 'callback_current_password');
        $this->form_validation->set_rules('password', 'Naujas slaptažodis', 'matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Naujo slaptažodžio pakartojimas', 'matches[password]');
        
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
    //TODO: remove db to model
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
    
    public function check_remind_password($username)
    {
        $email = $this->input->post('email');
        if($this->users_model->check_username($username) && $this->users_model->check_email($email))
        {
            return true;
        }
        $this->form_validation->set_message('check_remind_password', 'Neteisingi duomenys.');
        return false;
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