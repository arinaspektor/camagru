<?php

    class FeedController extends Controller
    {
        public function __construct()
        {
            $this->view_data['page_title'] = 'Feed';

            $this->view_data['posts'] = Post::getAllPosts();
            
            for ($i=0; $i < sizeof($this->view_data['posts']); $i++) {
                $user_id = $this->view_data['posts'][$i]['user_id'];
                $post_id = $this->view_data['posts'][$i]['post_id'];
                $likes = Post::countLikes($post_id);

                $this->view_data['posts'][$i]['author'] = implode(Post::findUsernameById($user_id));
                $this->view_data['posts'][$i]['likes'] =  implode($likes[0]);

                $this->view_data['posts'][$i]['liked'] = isset($_SESSION['user_id']) ?
                                                        Post::isLikedByUser($post_id, $_SESSION['user_id']) : false;

                $comments = Post::getAllComments($post_id);
            
                for ($j=0; $j < sizeof($comments); $j++) {
                    $this->view_data['posts'][$i]['comments'][$j]['text'] = $comments[$j]['text'];
                    $this->view_data['posts'][$i]['comments'][$j]['author'] = implode(Post::findUsernameById($comments[$j]['user_id']));
                }
            }

        }
        
        public function actionIndex()
        {
            View::generate('feed.php', 'main_template.php', $this->view_data);
        }
    }


?>