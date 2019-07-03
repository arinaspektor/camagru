<?php

    class PasswordController extends Controller
    {
        private $token;

        public function __construct($token = null)
        {
            $this->view_data['page_title'] = 'Reset';
            $this->token = $token;
        }

        public function actionForgot()
        {
            View::generate("request_reset.php", "main_template.php", $this->view_data);
        }

        public function actionRequestReset()
        {
            if (isset($_POST['uemail'])) {

                $_SESSION['user_email'] = $_POST['uemail'];
                
                if (User::sendPassReset()) {
                    $this->view_data['text'] = 'reset your password';
                    View::generate("success.php", "main_template.php", $this->view_data);
                } else {
                    $this->view_data['error'] = true;
                    $this->actionForgot();
                }

            } else {
              $this->redirect('/');
            }
        }


        public function actionReset()
        {
            $user = User::findByToken($this->token);

            if ($user) {
                View::generate("reset.php", "main_template.php", $this->view_data);
            } else {
                echo "some problems";
            }
        }


    }


?>
