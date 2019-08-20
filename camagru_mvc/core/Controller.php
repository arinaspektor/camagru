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

                Flash::addMessage('Please login to access that page');
                
                Auth::rememberRequestedPage();
                $this->redirect('/login');

            }
        }


        public function requirePost($arr, $redirect_to)
        {
            if (! isset($arr) || empty($arr)) {
                $this->redirect($redirect_to);
            } 

        }

    }

?>