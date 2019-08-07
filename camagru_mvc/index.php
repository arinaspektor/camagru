<?php

    // phpinfo();

    ini_set('display_errors', 1);
    ini_set('memory_limit', '25M');
    
    error_reporting(E_ALL);

    define('ROOT', realpath(dirname(__FILE__)));
    define('WWW_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));

    define('CORE', ROOT . '/core');
    define('UTIL', ROOT . '/utilities');
    define('MODELS', ROOT . '/app/models');\

    define('STORAGE_PATH',  ROOT . '/public/images/storage');
    define('MASKS_PATH', ROOT . '/public/images/masks');
    define('POSTS_PATH', STORAGE_PATH . '/posts');

    define('STYLES_PATH', WWW_ROOT . '/public/css');
    define('IMAGES_PATH', WWW_ROOT . '/public/images');
    define('SCRIPT_PATH', WWW_ROOT . '/public/js');

    define('MB', 1048576);

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
    require_once(MODELS . '/ImageModel.php');
    require_once(MODELS . '/ProfileImgModel.php');
    require_once(MODELS . '/PostModel.php');

    Session::start();

    $router = new Router();
    $router->run();
 ?>
