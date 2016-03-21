<?php

class Authenticator
{
    private $authorized;
    private $db;
    
    public function __construct($db) {
        $this->authorized = false;
        $this->db = $db;
    }
    
    public function authenticate($userid)
    {
        $q = $this->db->prepare("SELECT * FROM `users` WHERE `temp_id` = ?");
        $q->bind_param("s", $userid);
        $q->execute();
        $tmp = $q->get_result();
        if($tmp->num_rows == 1)
        {
            $data = $tmp->fetch_assoc();
            return $data['id'];
        }
        return 0;        
    }
    
}

