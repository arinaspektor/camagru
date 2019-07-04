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
            $user = User::authenticate($_POST['uemail'], $_POST['passwd']);

            if ($user) {
                $_SESSION['username'] = $user->username;

                Auth::login($user);

                Flash::addMessage('Login successfull');

                $this->redirect(Auth::getRequestedPage());
            } else {
                $this->view_data['uemail'] = $_POST['uemail'];
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