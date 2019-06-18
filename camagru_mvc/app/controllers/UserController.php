<?php

    require_once(ROOT . '/app/models/UserModel.php');
    require_once(ROOT . '/app/views/LoginView.php');
    require_once(ROOT . '/app/views/SignupView.php');

    class UserController {
      
        private $model;
        private $view;

        public function actionLogin()
        {
            $this->view = new LoginView;
            $this->view->generate();
        }

        public function actionRegister()
        {
            echo "sigup";
        }
    }
?>