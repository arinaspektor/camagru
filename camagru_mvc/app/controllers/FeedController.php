<?php

    class FeedController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Feed';
        }
        
        public function actionIndex()
        {
            View::generate('feed.php', 'main_template.php', $this->view_data);
        }
    }


?>