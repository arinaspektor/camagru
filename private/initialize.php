<?php
    ini_set('display_errors', 1);

    $public_start = strpos($_SERVER['SCRIPT_NAME'], '/public');
    $public_end = $public_start + 7;
    $project_name = substr($_SERVER['SCRIPT_NAME'], 0, $public_start);
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);

    define("WWW_ROOT", $doc_root);
    define('ROOT_FOLDER', $project_name);
    define('PRIVATE_PATH', ROOT_FOLDER . '/private');
    define('SHARED_PATH', PRIVATE_PATH . '/shared');
    define('STYLES_PATH', WWW_ROOT . '/styles');
    define('IMAGES_PATH', WWW_ROOT . '/images');

    require_once('config.php');
    require_once('setup.php');
    require_once('functions.php');
    require_once('validation_functions.php');

    // require_once('classes/DatabaseObject.class.php');
    require_once('classes/User.class.php');
    // require_once('classes/Session.class.php');

    // DatabaseObject::set_database($conn);

    // $session = new Session;
    session_start();
    $user = new User($conn);
?>
