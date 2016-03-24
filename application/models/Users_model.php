<?php

class Users_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /* User actions */
    
    public function login($username, $password)
    {
        if($this->check_username($username))
        {
            $q = $this->db->get_where('users', array('username' => $username));
            $result = $q->result();
            if(password_verify($password, $result[0]->password))
            {
                $temp_id = $this->get_hash();
                $this->db->where('id', $result[0]->id);
                $this->db->update('users', array('temp_id' => $temp_id));
                $this->nativesession->set('logged_in', true);
                $this->nativesession->set('user_id', $temp_id);
            }
        }
        redirect(filter_input(INPUT_SERVER, 'HTTP_REFERER'), 'location');
    }
    
    public function logout()
    {
        $this->nativesession->delete('logged_in');
        $this->nativesession->delete('user_id');
        redirect(filter_input(INPUT_SERVER, 'HTTP_REFERER'), 'location');
    }
    
    public function create($username, $password, $email)
    {
        $act_code = $this->get_hash();
        $data = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'level' => 1,
                'activation_code' => $act_code,
                'temp_id' => $this->get_hash(),
                'active' => 0
        );
        $this->db->insert('users', $data);
        return $act_code;
    }
    
    public function change_password($password)
    {
        $this->db->where('temp_id', $this->nativesession->get('user_id'));
        $this->db->update('users', array('password' => 
            password_hash($password, PASSWORD_DEFAULT)));
    }
    
    public function activate($code)
    {
       $q = $this->db->get_where('users', array('activation_code' => $code));
       $res = $q->result();
       if(count($res) > 0 && $res[0]->active == 0)
       {
           $this->db->where('activation_code', $code);
           $this->db->update('users', array('active' => 1));
           return true;
       }
       else
       {
           return false;
       }
    }
    
    /* Checkers */
    
    public function check_username($str)
    {
        $q = $this->db->get_where('users', array('username' => $str));
        if(count($q->result()) > 0) 
        {
            return true;
        }
        return false;
    }
    
    public function check_password($password)
    {
        $q = $this->db->get_where('users', array('temp_id' => 
            $this->nativesession->get('user_id')));
        $res = $q->result();
        if(count($res) > 0 && password_verify($password, $res[0]->password))
        {
            return true;
        }
        return false;
    }
    
    public function check_email($str)
    {
        $q = $this->db->get_where('users', array('email' => $str));
        if(count($q->result()) > 0) 
        {
            return true;
        }
        return false;
    }   
    
    /* Recovery */
    
    public function set_recovery_hash($email)
    {
        $code = $this->get_hash();
        $this->db->where('email', $email);
        $this->db->update('users', array('password_recovery' => $code));
        return $code;
    }
    
    public function recover_password($uid, $password)
    {
        $this->db->where('temp_id', $uid);
        $this->db->update('users', array('password' => 
            password_hash($password, PASSWORD_DEFAULT)));
    }
    
    public function remove_recovery_hash($uid)
    {
        $this->db->where('temp_id', $uid);
        //TODO: add timer for next recovery?
        $this->db->update('users', array('password_recovery' => ''));
    }
    
    public function recover_get_tempid($code)
    {
        $q = $this->db->get_where('users', array("password_recovery" => $code));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->temp_id;
        }
        return "";
    }
    
    /* Getters */
    
    public function get_username()
    {
        if($this->nativesession->get('user_id') !== NULL)
        {
            $username = $this->db->get_where('users', array('temp_id' => 
            $this->nativesession->get('user_id')));
            $res = $username->result();
            if(count($res) > 0) {
                return $res[0]->username;
            }
        }
        return "";
    }
    
    public function get_uid()
    {
        if($this->nativesession->get('user_id') === NULL)
        {
            return 0;
        }
        $q = $this->db->get_where('users', array('temp_id' => 
            $this->nativesession->get('user_id')));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->id;
        }
    }
    
    public function get_user_level()
    {
        if($this->nativesession->get('user_id') === NULL)
        {
            return 1;
        }
        $q = $this->db->get_where('users', array('temp_id' => 
            $this->nativesession->get('user_id')));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->level;
        }
    }
    
    public function get_users()
    {
        $q = $this->db->get('users');
        return $q->result();
    }
    
    public function get_hash()
    {
        return bin2hex($this->encryption->create_key(32));
    }
    
    /* Admin actions */
    
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
        $this->redirect_manage();
    }
    
    public function activate_user($id)
    {
        $data = array('active' => 1);
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        $this->redirect_manage();
    }
    
    public function deactivate_user($id)
    {
        $data = array('active' => 0);
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        $this->redirect_manage();
    }
    
    /* Helpers */
    
    public function send_email($email, $title, $msg)
    {
        $this->email->from('no-reply@futboloblogas.lt', 'FutboloBlogas.lt');
        $this->email->to($email); 
        $this->email->subject($title);
        $this->email->message($msg);	
        $this->email->send();
    }
    
    public function register($username, $password, $email)
    {
        $act_code = $this->users_model->create($username, $password, $email);
            $msg = "Sveiki, ".$username.". \n\n".
                "Jūsų aktyvacijos nuoroda ".
                site_url('users/activate/'.$act_code);
            $this->users_model->send_email($email, 
                'Registracija puslapyje FutboloBlogas.lt', $msg);
    }
    
    public function remind_password($username, $email)
    {
        $code = $this->users_model->set_recovery_hash($email);
            $msg = "Sveiki, ".$username.". \n\n".
                "Jūsų slaptažodžio atstatymo nuoroda ".
                site_url('users/restore_password/'.$code)." \n".
                "Jeigu neprašėte slaptažodžio atstatymo, ignoruokite šį laišką.";
            $this->users_model->send_email($email, 
                'Slaptažodžio atstatymas puslapyje FutboloBlogas.lt', $msg);
    }
    
    /* Redirects */
    
    //Logged in user
    public function redirect_lin()
    {
        return $this->nativesession->get('logged_in') !== NULL ? 
                redirect(base_url(), 'location') : NULL;
    }
    //Not logged in user
    public function redirect_nlin()
    {
        return $this->nativesession->get('logged_in') === NULL ?
            redirect(base_url(), 'location') : NULL;
    }
    
    //User without admin privilleges
    public function redirect_na()
    {
        return $this->get_user_level() != 9 ? redirect(base_url(), 'location') 
                : NULL;
    }
    
    public function redirect_all()
    {
        redirect(base_url(), 'location');
    }
    
    public function redirect_manage()
    {
        redirect(site_url('admin/users/manage'), 'location');
    }
}
