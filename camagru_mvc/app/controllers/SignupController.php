<?php
    require_once(ROOT . '/app/models/UserModel.php');

    class SignupController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function actionIndex()
        {
            $this->view->generate('signup.php', 'main_template.php', 'Sign up');
        }

        public function actionCreate()
        {
            if (isset($_POST['btn-signup'])) {

                $user = new User($_POST);

                if ($user->saveUser()){
                    header('Location: ' . WWW_ROOT . '/');
                } else {
                    var_dump($user->errors);
                }

            } else {
                header('Location: ' . WWW_ROOT . '/');
            }
            
        }
    }


?>
