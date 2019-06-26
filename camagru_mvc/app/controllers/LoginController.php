<?php

    require_once(ROOT . '/app/models/UserModel.php');

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
                Session::pushData('user_id', $user->user_id);
                $this->redirect('/feed');
            } else {
                $this->view_data['uemail'] = $_POST['uemail'];
                $this->actionIndex();
            }
        }

        public function actionLogout()
        {
            Session::destroy();
            $this->redirect('/');
        }

    }
?>