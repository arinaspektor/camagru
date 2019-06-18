<?php require_once(ROOT . '/app/views/MainView.php'); ?>

<?php

    class MainController
    {
        private $model;
        private $view;

        public function actionIndex()
        {
            if ($_SERVER['REQUEST_URI'] !== $_SERVER['SCRIPT_NAME']) {
                $this->view = new MainView;
            }

        }
    }

?>

