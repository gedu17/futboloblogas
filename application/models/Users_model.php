<?php

class Users_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
        //$this->load->session();
    }
    
    public function login($username, $password)
    {
        
        return false;
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
        $data = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'level' => 1,
                'activation_code' => password_hash(time()+"_"+$username+"_ach",
                        PASSWORD_DEFAULT),
                'temp_id' => '',
                'active' => 0
        );
        $this->db->insert('users', $data);
    }
}
