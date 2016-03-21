<?php

class Poll_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database();
    }
    
    /* Admin actions */
    
    public function add_poll($name, $answers)
    {
        $data = array('name' => $name, 'active' => 1);
        $this->db->update('polls', array('active' => 0));
        $this->db->insert('polls', $data);
        $q = $this->db->get_where('polls', array('active' => 1));
        $res = $q->result();
        
        for($i = 0; $i < count($answers); $i++)
        {
            $this->db->insert('poll_answers', array('name' => $answers[$i], 
                'poll' => $res[0]->id));
        }
        $this->redirect_manage();
    }
    
    public function update_poll($name, $answers, $id)
    {
        $data = array('name' => $name);
        $this->db->where('id', $id);
        $this->db->update('polls', $data);        
        for($i = 0; $i < count($answers); $i++)
        {
            $this->db->where('id', $answers[$i]['id']);
            $this->db->update('poll_answers', array('name' => 
                $answers[$i]['name']));
        }
        $this->redirect_manage();
    }
    
    public function delete_poll($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('polls');
        $this->db->where('poll', $id);
        $this->db->delete('poll_votes');
        $this->db->where('poll', $id);
        $this->db->delete('poll_answers');
        $this->redirect_manage();
    }
    
    public function activate($id)
    {
        $this->db->where('active', 1);
        $this->db->update('polls', array('active' => 0));
        $this->db->where('id', $id);
        $this->db->update('polls', array('active' => 1));
        $this->redirect_manage();
    }
    
    /* Public actions */
    
    public function vote($uid, $answer)
    {
        $poll = $this->get_current_poll();
        $data = array('poll' => $poll, 'uid' => $uid, 'answer' => $answer);
        $this->db->insert('poll_votes', $data);
    }
    
    /* Getters */
    
    public function get_poll_name($id)
    {
        $q = $this->db->get_where('polls', array('id' => $id));
        $res = $q->result();
        return $res[0]->name;
    }

    public function get_polls()
    {
        $q = $this->db->order_by('id', 'DESC')->get('polls');
        $res = $q->result();
        foreach($res as $item)
        {
            $tmp = $this->db->get_where('poll_answers', array('poll' => 
                $item->id));
            $item->answer_count = count($tmp->result());
        }
        return $res;
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
    
    public function get_poll_answers($id = NULL)
    {
        if($id)
        {
            $data = array();
            $ans = $this->db->get_where('poll_answers', array('poll' => $id));
            foreach($ans->result() as $item)
            {
                array_push($data, array('name' => $item->name, 'id' => 
                    $item->id));
            }
            return $data;
        }
        
        $q = $this->db->get_where('poll_answers', array('poll' => 
            $this->get_current_poll()));
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
        $answers = $this->db->get_where('poll_answers', array('poll' => 
            $this->get_current_poll()));
        $ansres = $answers->result();
        foreach($ansres as $item)
        {
            $tmpq = $this->db->get_where('poll_votes', array('poll' => 
                $this->get_current_poll(), 'answer' => $item->id));
            $tmpres = $tmpq->result();
            $data[$item->name] = count($tmpres);
        }
        return $data;
    }
    
    /* Helpers */
    
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
    
    public function redirect_manage()
    {
        redirect(site_url('admin/poll/manage'), 'location');
    }
}

