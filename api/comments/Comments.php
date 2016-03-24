<?php

class Comments
{
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getList($id)
    {
        header('HTTP/1.1 200 OK');
        $return = array();
        $q = $this->db->prepare("SELECT comments.id,comments.date,comments.text,"
                . "users.username FROM `comments` INNER JOIN `users` ON "
                . "comments.user_id = users.id WHERE `post_id` = ? ORDER BY date DESC");
        $q->bind_param("s", $id);
        $q->execute();
        $data = $q->get_result();
        while($tmp = $data->fetch_assoc())
        {
            array_push($return, array('date' => $tmp['date'], 'text' => 
                $tmp['text'], 'user' => $tmp['username'], 'id' => $tmp['id']));
        }
        if(count($return) !== 0)
        {
            echo json_encode($return);    
        }
    }
    
    public function create($id, $userid)
    {
        $comment = filter_input(INPUT_POST, "comment");
        if(!empty($comment))
        {
            $q = $this->db->prepare("INSERT INTO `comments` VALUES('', ?, ?, ?, ?)");

            $q->bind_param("isii", time(), $comment,$id, $userid);
            $q->execute();
            header('HTTP/1.1 201 Created');
        }
        else
        {
            header('HTTP/1.1 400 Bad Request');
        }
    }
    
    public function delete($id)
    {
        if(!empty($id) && $id !== 0)
        {
            $q = $this->db->prepare("DELETE FROM `comments` WHERE `id` = ? LIMIT 1");
            $q->bind_param("i", $id);
            $q->execute();
            header('HTTP/1.1 200 OK');
        }
        else
        {
            header('HTTP/1.1 400 Bad Request');
        }
    }
}
