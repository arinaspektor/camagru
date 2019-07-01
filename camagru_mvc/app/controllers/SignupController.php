<?php

    class SignupController extends Controller
    {

        public function __construct()
        {
            $this->view_data['page_title'] = 'Sign up';
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
                    $this->redirect('/success');
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

                $to  = $_SESSION['user_email']; 

                $subject = "Account confirmation"; 

                $text = ' 
                Hello!

                Your email was provided for registration on Camagru and you were successfully registered.
                
                To confirm your email please follow the link <link>.
                
                After that, please, login into the system.
                
                If it was not you, just ignore this letter.
                
                Thank you for joining to Camagru!'; 

                $headers = 'From: noreply@camagru' . "\r\n"; 

                if (Mail::send($to, $subject, $text, $headers)) {
                    View::generate('success.php', 'main_template.php', $this->view_data);
                } else {
                    echo "some problems";
                }
            } else {
                $this->redirect('/');
            }
        }
    }


?>
