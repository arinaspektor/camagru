<?php 

    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    define('ROOT', realpath(dirname(__FILE__)));

    require_once(ROOT . '/components/Router.php');
    require_once('setup.php');
    
    $router = new Router();
    $router->run();
    
 ?>