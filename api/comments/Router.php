<?php
include "Authenticator.php";
class Router
{
    private $db;
    private $routes;
    private $auth;
    public function __construct($db)
    {
        $this->db = $db;
        $this->routes = array();
        $this->auth = new Authenticator($db);
    }
    
    public function addRoute($route, $func, $needAuth = false)
    {
        if(!$this->isRoute($route))
        {
            $this->routes[$route] = array('func' => $func, 'needAuth' => 
                $needAuth);
            return true;
        }
        return false;
    }
    
    public function isRoute($route)
    {
        return isset($this->routes[$route]);
    }
    
    public function route($route, $id, $userid = NULL)
    {
        if($this->routes[$route]['needAuth'] === TRUE)
        {
            $userid = $this->auth->authenticate($userid);
            if($userid != 0)
            {
                call_user_func($this->routes[$route]['func'], $id, $userid);
            }
            else
            {
                header('HTTP/1.1 401 Unauthorized');
            }
        }
        else
        {
            call_user_func($this->routes[$route]['func'], $id);
        }
    }
}
