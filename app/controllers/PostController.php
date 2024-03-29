<?php


    class PostController extends Controller
    {
        public $post_id;
        private $postpath;

        public function __construct($post_id = null)
        {
            $this->requireLogin();
            
            $this->user = User::findById($_SESSION['user_id']);

            foreach ($this->user as $key => $value) {
                $this->$key = $value;
            };

            $this->post_id = $post_id;

            $this->postpath = POSTS_WWW_PATH . '/' . $this->user_id;
        }


        public function actionIndex()
        {
            if ($this->post_id) {
                $this->view_data['page_title'] = 'Post';

                $this->view_data['post'] = Post::getAllInfo($this->post_id, $this->user_id);

                $src = implode(Post::getPostFilename($this->post_id));

                if (! $src) {
                    $this->redirect('/profile');
                }

                $this->view_data['post']['src'] = $this->postpath . '/' . $src;
                $this->view_data['post']['post_id'] = $this->post_id;
                $this->view_data['post']['author'] = $this->username;


                View::generate('post.php', 'main_template.php', $this->view_data);
            } else {
                $this->redirect('/profile');
            }
        }


        public function actionGetPostInfo()
        {
            if ($this->post_id) {
                $data = Post::getAllInfo($this->post_id, $this->user_id);
                
                echo json_encode($data);
            }
        }


        public function actionNewPhoto()
        {
            $this->requirePost($_POST, '/profile');
            
            $decoded = json_decode($_POST['data'], true);

            $post = new Post($decoded);

            $filename = $post->savePost();

            if ($filename) {
                $url =  $this->postpath . '/' . $filename;
                $id = implode(Post::getPostIdByFilename($filename));

                $encoded = json_encode( ["src" => $url, "id" => $id] );

                echo $encoded;
            }
        }


        public function actionDeletePost()
        {
            $this->requirePost($_POST, '/profile');

            if (! Post::deletePost($_POST['post_id'], $_POST['src'])) {
                Flash::addMessage('Something went wrong. Please, try again!');
                echo 'error';
            }
        }



        public function actionAddComment()
        {
            $this->requirePost($_POST, '/profile');

            if (! ($comment = trim($_POST['text']))
                || $comment == ''
                || strlen($comment) > 200
                || ! Post::addComment($_POST['post_id'], $comment, $this->user_id))
            {
                Flash::addMessage('Something went wrong. Please, try again!');

                $arr = array("error" => "true");
            } else {
                $addressee = User::findUserByPost($_POST['post_id']);

                if ($addressee->be_notified) {
                    $addressee->sendNotification($this->username, $_POST['post_id']);
                }
               
                $arr = array("comment" => strval($comment) , "author" => strval($this->username), "error" => "false");
            }
            
            echo json_encode($arr);

        }


        public function actionAddLike()
        {
            $this->requirePost($_POST, '/profile');

            if ($_POST['like'] == 'true') {
                $success = Post::addLike($_POST['post_id'], $this->user_id);
            } else {
                $success = Post::removeLike($_POST['post_id'], $this->user_id);
            }

            if (! $success) {
                Flash::addMessage('Something went wrong. Please, try again!');
                echo 'error';
            } else {
                $likes = Post::countLikes($_POST['post_id']);
                echo implode($likes[0]);
            }
            
        }



    }



?>
