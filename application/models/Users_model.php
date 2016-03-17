<?php

class Users_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function login($username, $password)
    {
        if($this->check_username($username))
        {
            $q = $this->db->get_where('users', array('username' => $username));
            $result = $q->result();
            if(password_verify($password, $result[0]->password))
            {
                $temp_id = password_hash(time()+"_"+$username+"_userid", PASSWORD_DEFAULT);
                $this->db->where('id', $result[0]->id);
                $this->db->update('users', array('temp_id' => $temp_id));
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $temp_id;
                //$this->session->set_userdata('logged_in', true);
                //$this->session->set_userdata('user_id', $temp_id);
                return true;
            }
        }
        return false;
    }
    
    public function logout()
    {
        //$this->session->unset_userdata('logged_in');
        //$this->session->unset_userdata('user_id');
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_id']);
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
        $q = $this->db->get_where('users', array('temp_id' => $_SESSION['user_id']));
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
        $act_code = password_hash(time()+"_"+$username+"_ach",
                        PASSWORD_DEFAULT);
        $data = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'level' => 1,
                'activation_code' => $act_code,
                'temp_id' => '',
                'active' => 0
        );
        $this->db->insert('users', $data);
        return $act_code;
    }
    
    public function change_password($password)
    {
        $this->db->where('temp_id', $_SESSION['user_id']);
        $this->db->update('users', array('password' => password_hash($password, PASSWORD_DEFAULT)));
    }
    
    public function get_username()
    {
        //$this->session->userdata('user_id')
        if(isset($_SESSION['user_id']))
        {
            $username = $this->db->get_where('users', array('temp_id' => 
            $_SESSION['user_id']));
            $res = $username->result();
            if(count($res) > 0) {
                return $res[0]->username;
            }
        }
        return "";
    }
    
    public function get_uid()
    {
        if(!isset($_SESSION['user_id']))
        {
            return 0;
        }
        $q = $this->db->get_where('users', array('temp_id' => $_SESSION['user_id']));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->id;
        }
    }
    
    public function get_user_level()
    {
        if(!isset($_SESSION['user_id']))
        {
            return 1;
        }
        $q = $this->db->get_where('users', array('temp_id' => $_SESSION['user_id']));
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
    public function redirect_lin()//loggedin_user()
    {
        if(isset($_SESSION['logged_in']))
        {
            redirect(base_url(), 'location');
        }
    }
    //Not logged in user
    public function redirect_nlin()
    {
        if(!isset($_SESSION['logged_in']))
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
