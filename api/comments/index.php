<?php
include "Router.php";
include "Comments.php";
$db = new mysqli("localhost", "pinkpong_g", "KlegsmusPasiniauti", "pinkpong_g");

if (!$db->connect_errno)
{
    $router = new Router($db);
    $comments = new Comments($db);
    $router->addRoute("list", array($comments, "getList"));
    $router->addRoute("create", array($comments, "create"), true);
    $router->addRoute("delete", array($comments, "delete"), true);
    
    $method = filter_input(INPUT_GET, 'method', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $userid = filter_input(INPUT_POST, 'userid');
    if($router->isRoute($method))
    {
        $router->route($method, $id, $userid);
    }
    else
    {
        header('HTTP/1.1 404 Not Found');
    }
}
else
{
    header('HTTP/1.1 503 Service Unavailable');
}