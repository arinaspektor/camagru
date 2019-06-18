<?php 

    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    define('ROOT', realpath(dirname(__FILE__)));
    define('WWW_ROOT', dirname($_SERVER['SCRIPT_NAME']));
    
    define('STYLES_PATH', WWW_ROOT . '/public/css');
    define('IMAGES_PATH', WWW_ROOT . '/public/images');

    require_once(ROOT . '/components/Router.php');
    require_once('setup.php');
    
    $router = new Router();
    $router->run();
    
 ?>