<?php

    class LoginView
    {

        function generate()
        {
            $page_title = 'Sign in';
            // include(ROOT . '/public/templates/header.php');
            include(ROOT . '/public/templates/login.php');
            // include(ROOT . '/public/templates/footer.php');
        }
    }
?>