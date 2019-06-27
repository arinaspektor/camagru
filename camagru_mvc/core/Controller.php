<?php

    abstract class Controller
    {
        public $view_data = [];


        public function redirect($url)
        {
            header('Location: ' . WWW_ROOT . $url, true, 303);
            exit;
        }


        public function requireLogin()
        {
            if (!Auth::getUser()) {

                Auth::rememberRequestedPage();
                $this->redirect('/login');

            }
        }

    }

?>