<?php 

    // phpinfo();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    define('ROOT', realpath(dirname(__FILE__)));
    define('WWW_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
    
    define('CORE', ROOT . '/core');
    define('UTIL', ROOT . '/utilities');
    define('MODELS', ROOT . '/app/models');
    
    define('STYLES_PATH', WWW_ROOT . '/public/css');
    define('IMAGES_PATH', WWW_ROOT . '/public/images');


    require_once(UTIL . '/Session.php');
    require_once(UTIL . '/Database.php');
    require_once(UTIL . '/Auth.php');
    require_once(UTIL . '/Flash.php');

    require_once(ROOT . '/setup.php');

    require_once(CORE . '/Router.php');
    require_once(CORE . '/Model.php');
    require_once(CORE . '/Controller.php');
    require_once(CORE . '/View.php');

    require_once(MODELS . '/UserModel.php');
    require_once(MODELS . '/MailModel.php');
    require_once(MODELS . '/TokenModel.php');
    
    Session::start();
    
    $router = new Router();
    $router->run();
 ?>