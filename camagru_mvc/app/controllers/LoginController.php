<?php

    class LoginController extends Controller {

        function __construct()
	    {
            $this->view_data['page_title'] = 'Sign in';
        }


        public function actionIndex()
        {
            View::generate('login.php', 'main_template.php', $this->view_data);
        }


        public function actionNew()
        {
            $user = User::authenticate($_POST['user_email'], $_POST['passwd']);

            if ($user) {
                $_SESSION['username'] = $user->username;

                Auth::login($user);

                Flash::addMessage('Login successfull');

                $this->redirect(Auth::getRequestedPage());
            } else {
                $this->view_data['user_email'] = $_POST['user_email'];
                $this->actionIndex();
            }
        }

        
        public function actionLogout()
        {
            Auth::logout();

            $this->redirect('/');
        }

    }
?>