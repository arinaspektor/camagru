<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    define('ROOT', realpath(dirname(__FILE__)));
    define('WWW_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
    define('CORE', ROOT . '/core');
    
    define('STYLES_PATH', WWW_ROOT . '/public/css');
    define('IMAGES_PATH', WWW_ROOT . '/public/images');

    require_once(CORE . '/Session.php');
    require_once(CORE . '/Database.php');
    require_once(ROOT . '/setup.php');
    require_once(CORE . '/Router.php');
    require_once(CORE . '/Model.php');
    require_once(CORE . '/Controller.php');
    require_once(CORE . '/View.php');
    
    Session::start();
    
    $router = new Router();
    $router->run();
 ?>