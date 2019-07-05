<?php

    class SignupController extends Controller
    {
        private $token;

        public function __construct($token = null)
        {
            $this->view_data['page_title'] = 'Sign up';
            $this->token = $token;
        }

        
        public function actionIndex()
        {
            View::generate('signup.php', 'main_template.php', $this->view_data);
        }

        
        public function actionCreate()
        {
            if (isset($_POST['btn-signup'])) {

                $user = new User($_POST);
                $this->view_data['user'] = $user;

                if ($user->saveUser()) {
                    $_SESSION['user_email'] = $this->view_data['user']->uemail;
                    if ($user->sendAccountConfirm()) {
                        $this->redirect('/success');
                    } else {
                        echo "some problems";
                    }
                } else {
                    View::generate('signup.php', 'main_template.php', $this->view_data);
                }
            } else {
                $this->redirect('/');
            }
        }


        public function actionSuccess()
        {
            if (isset($_SESSION['user_email'])) {
                    View::generate('success.php', 'main_template.php', $this->view_data);
            }  else {
                $this->redirect('/');
            }
        }


        public function actionConfirm()
        {
            $user = User::findByToken($this->token);

            if ($user) {
                $user->varify($this->token);

                Flash::addMessage("Your account is successfully verified");

                $this->redirect('/login');
            } else {
                View::generate("expired.php", "main_template.php", $this->view_data);
                exit ;
            }
        }

        public function actionRequestConfirm()
        {
            View::generate('request_confirm.php', 'main_template.php', $this->view_data);
        }

        public function actionReConfirm()
        {
            if (isset($_POST['uemail'])) {
                $user = User::findByEmail($_POST['uemail']);

                if ($user) {
                    if ($user->verified) {

                        Flash::addMessage("Your account is verified already");

                        $this->redirect('/login');
                    } else {
                        if ($user->sendAccountConfirm()) {
                            $this->redirect('/success');
                        }
                    }
                } else {
                    Flash::addMessage("Sign up first");

                    $this->redirect('/signup');
                }
            }
        }

    }


?>
