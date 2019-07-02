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
            if (isset($_POST['uemail']) && filter_var($this->uemail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['user_email'] = $_POST['uemail'];
                if (User::sendPassReset($_POST['uemail'])) {
                  $this->view_data['text'] = 'reset your password';
                  View::generate("success.php", "main_template.php", $this->view_data);
                }
            } else {
              $this->redirect('/');
            }
        }

    }


?>
