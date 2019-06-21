<?php
    require_once(ROOT . '/app/models/UserModel.php');

    class SignupController extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->view_data['page_title'] = 'Sign up';
        }

        public function actionIndex()
        {
            $this->view->generate('signup.php', 'main_template.php', $this->view_data);
        }

        public function actionCreate()
        {
            if (isset($_POST['btn-signup'])) {

                $user = new User($_POST);

                if ($user->saveUser()) {
                    header('Location: ' . WWW_ROOT . '/');
                } else {
                    $this->view_data['errors'] = $user->errors;
                    $this->view->generate('signup.php', 'main_template.php', $this->view_data);
                }

            } else {
                header('Location: ' . WWW_ROOT . '/');
            }
            
        }
    }


?>
