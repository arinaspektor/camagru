<?php

    class FeedController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Feed';

            $this->view_data['posts'] = Post::getAllPosts();
            
            for ($i=0; $i < sizeof($this->view_data['posts']); $i++) {

                $id = $this->view_data['posts'][$i]['user_id'];
                $this->view_data['posts'][$i]['author'] = implode(Post::findUsernameById($id));
            }
        }
        
        public function actionIndex()
        {
            View::generate('feed.php', 'main_template.php', $this->view_data);
        }
    }


?>