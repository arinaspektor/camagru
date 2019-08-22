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
            if (isset($_POST['user_email'])) {

                $_SESSION['user_email'] = $_POST['user_email'];
                
                $user = User::findByEmail($_SESSION['user_email']);

                if ($user) {

                    if (!$user->verified) {
                        Flash::addMessage('You need confirm your account at first. Check your email');
                    } else if ($user->sendPassReset()) {
                        $this->view_data['text'] = 'reset your password';
                        View::generate("success.php", "main_template.php", $this->view_data);
                    } else {
                        $this->view_data['error'] = true;
                        $this->actionForgot();
                    }
    
                }
            } else {
              $this->redirect('/');
            }
        }


        public function actionReset()
        {
            $user = User::findByToken($this->token);

            if ($user) {
                $_SESSION['token'] = $this->token;
                View::generate("reset.php", "main_template.php", $this->view_data);
            } else {
                View::generate("expired.php", "main_template.php", $this->view_data);
                exit ;
            }
        }


        public function actionPassReset()
        {
            if (isset($_SESSION['token'])) {
                $user = User::findByToken($_SESSION['token']);
                
                if($user->resetPassword($_POST)) {
                    unset($_SESSION['token']);

                    Flash::addMessage("Success. You can login with new password");

                    $this->redirect('/login');
                } else {
                    $this->view_data['user'] = $user;
                    View::generate("reset.php", "main_template.php", $this->view_data);
                }
            } else {
                $this->redirect('/');
            }
          
        }

    }


?>
