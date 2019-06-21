<?php
    require_once(ROOT . '/app/models/UserModel.php');

    class UserController extends Controller
    {
        function __construct()
	    {
            parent::__construct();
        }
        
        public function actionLogin()
        {
            $this->view_data['page_title'] = 'Sign in';
            $this->view->generate('login.php', 'main_template.php', $this->view_data);
        }

    }
?>