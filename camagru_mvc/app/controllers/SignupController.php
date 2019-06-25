<?php
    require_once(ROOT . '/app/models/UserModel.php');

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
                    $_SESSION['email'] = $this->view_data['user']->uemail;
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
            if (isset($_SESSION['email'])) {
                View::generate('success.php', 'main_template.php', $this->view_data);
            } else {
                $this->redirect('/');
            }
        }
    }


?>
