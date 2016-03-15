<?php

class Poll_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    public function did_vote($uid)
    {
        $poll = $this->get_current_poll();
        $voted = $this->db->get_where('poll_votes', array('poll' => 
                $poll, 'uid' => $uid));
        if(count($voted->result()) > 0)
        {
            return true;
        }
        return false;
    }
    
    public function get_current_poll()
    {
        $q = $this->db->get_where('polls', array('active' => 1));
        $res = $q->result();
        if(count($res) > 0)
        {
            return $res[0]->id;
        }
        return 0;
    }
    
    public function vote($uid, $answer)
    {
        $poll = $this->get_current_poll();
        $data = array('poll' => $poll, 'uid' => $uid, 'answer' => $answer);
        $this->db->insert('poll_votes', $data);
    }
    
    public function get_poll_answers()
    {
        $q = $this->db->get_where('poll_answers', array('poll' => $this->get_current_poll()));
        return $q->result();
    }
    
    public function get_poll_question()
    {
        $q = $this->db->get_where('polls', array('active' => 1));
        return $q->result()[0]->name;
    }
    
    public function get_poll_results()
    {
        $data = array();
        $answers = $this->db->get_where('poll_answers', array('poll' => $this->get_current_poll()));
        $ansres = $answers->result();
        foreach($ansres as $item)
        {
            $tmpq = $this->db->get_where('poll_votes', array('poll' => $this->get_current_poll(), 
                'answer' => $item->id));
            $tmpres = $tmpq->result();
            $data[$item->name] = count($tmpres);
        }
        return $data;
    }
}

