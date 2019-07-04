<?php

    class ProfileController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Profile';

            $this->view_data['user' ]= User::findById($_SESSION['user_id']);
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


    }

?>