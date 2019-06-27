<?php

    class MainController extends Controller
    {
        // public function __construct()
        // {
        //     $this->view_data['page_title'] = 'Welcome';
        // }

        public function actionIndex()
        {
            if (Auth::getUser()) {
                $this->redirect('/feed');
            } else {
                View::generate('welcome.php', 'welcome_template.php', $this->view_data);
            }
        }

    }

?>

