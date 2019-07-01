<?php

    class PasswordController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Reset';
        }

        public function actionForgot()
        {
            View::generate("reset.php", "main_template.php", $this->view_data);
        }

        public function actionReset()
        {
            User::sendPassReset($_POST['email']);
            // View::generate("reset.php", "main_template.php", $this->view_data);
        }

    }


?>