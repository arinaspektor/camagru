<?php

    class Auth
    {

        static public function login($user)
        {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user->user_id;
        }


        static public function logout()
        {
            Session::destroy();
        }

        
        static public function rememberRequestedPage()
        {
            $_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
        }


        static public function getRequestedPage()
        {
            return $_SESSION['return_to'] ?? '/';
        }

        
        static public function getUser()
        {
            if (isset($_SESSION['user_id'])) {
                $user = new User;
                return User::findById($_SESSION['user_id']);
            }
        }

    }

?>