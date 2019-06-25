<?php

    class MainController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Home';
        }

        public function actionIndex()
        {
            if (isset($_SESSION['user'])) {
                redirect('/feed');
            }
            View::generate('welcome.php', 'welcome_template.php', $this->view_data);
        }

    }

?>

