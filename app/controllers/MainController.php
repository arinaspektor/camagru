<?php

    class MainController extends Controller
    {
        
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

