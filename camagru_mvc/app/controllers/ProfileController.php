<?php

    class ProfileController extends Controller
    {
        public $user;

        public function __construct()
        {
            $this->view_data['page_title'] = 'Profile';

            $this->user = User::findById($_SESSION['user_id']);

            $this->view_data['user'] = $this->user;
        }

        public function actionIndex()
        {
            $this->requireLogin();

            View::generate('profile.php', 'main_template.php', $this->view_data);
        }


        public function actionSettings()
        {
            $this->requireLogin();

            View::generate('settings.php', 'main_template.php', $this->view_data);
        }


        public function actionEdit()
        {
            if (isset($_POST['btn-edit'])) {
                $notifications = $_POST['email_notes'];
                unset($_POST['email_notes']);

                if (isset($_POST['passwd']) && $this->user->resetPassword([ 'passwd' => $_POST['passwd'],
                'dup_passwd' => $_POST['dup_passwd'] ])) {
                        echo "ok!";
                } else {
                    $this->view_data['user'] = $user;
                    $this->actionSettings();
                }
            } else {
                $this->redirect('/');
            }
        }


    }

?>