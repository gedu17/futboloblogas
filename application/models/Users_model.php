<?php

class Users_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
        $this->load->library('encryption');
    }
    
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
                return true;
            }
        }
        return false;
    }
    
    public function logout()
    {
        $this->nativesession->delete('logged_in');
        $this->nativesession->delete('user_id');
    }
    
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
        $q = $this->db->get_where('users', array('temp_id' => $this->nativesession->get('user_id')));
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
    
    public function create($username, $password, $email)
    {
        /*$act_code = password_hash(time()+"_"+$username+"_ach",
                        PASSWORD_DEFAULT);*/
        //$act_code = bin2hex($this->encryption->create_key(32));
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
    
    public function get_hash()
    {
        return bin2hex($this->encryption->create_key(32));
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
    
    public function recover_password($uid, $password)
    {
        $this->db->where('temp_id', $uid);
        $this->db->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
    }
    
    public function remove_recovery_hash($uid)
    {
        $this->db->where('temp_id', $uid);
        //TODO: add timer for next recovery?
        $this->db->update('users', array('password_recovery' => ''));
    }
    
    public function try_activate($code)
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
    
    public function set_recovery_hash($email)
    {
        $code = $this->get_hash();
        $this->db->where('email', $email);
        $this->db->update('users', array('password_recovery' => $code));
        return $code;
    }
    
    public function send_email($email, $title, $msg)
    {
        $this->load->library('email');
        $this->email->from('no-reply@futboloblogas.lt', 'FutboloBlogas.lt');
        $this->email->to($email); 

        $this->email->subject($title);
        $this->email->message($msg);	

        $this->email->send();
    }
    
    public function change_password($password)
    {
        $this->db->where('temp_id', $this->nativesession->get('user_id'));
        $this->db->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
    }
    
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
        $q = $this->db->get_where('users', array('temp_id' => $this->nativesession->get('user_id')));
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
        $q = $this->db->get_where('users', array('temp_id' => $this->nativesession->get('user_id')));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->level;
        }
    }
    
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
    
    public function activate_user($id)
    {
        $data = array('active' => 1);
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    
    public function deactivate_user($id)
    {
        $data = array('active' => 0);
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    
    public function get_users()
    {
        $q = $this->db->get('users');
        return $q->result();
        
    }
    
    //Logged in user
    public function redirect_lin()
    {
        if($this->nativesession->get('logged_in') !== NULL)
        {
            
            redirect(base_url(), 'location');
        }
    }
    //Not logged in user
    public function redirect_nlin()
    {
        if($this->nativesession->get('logged_in') === NULL)
        {
            redirect(base_url(), 'location');
        }
    }
    
    //User without admin privilleges
    public function redirect_na()
    {
        if($this->get_user_level() != 9)
        {
            redirect(base_url(), 'location');
        }
    }
}
