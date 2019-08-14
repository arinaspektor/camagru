<?php

    class ProfileController extends Controller
    {
        public $user;
        private $folder;

        public function __construct($user = null)
        {
            $this->requireLogin();
            
            $this->user = $user ?? User::findById($_SESSION['user_id']);

            $this->view_data['page_title'] = 'Profile';
            $this->view_data['user'] = $this->user;
            $this->view_data['user']->profile_img_src =  $this->user->profile_img_src ?
                                            IMAGES_PATH . '/storage/profile/' . $this->user->profile_img_src :
                                            IMAGES_PATH . '/pikachu_ava.svg';

            $this->path = POSTS_WWW_PATH . '/' . $this->user->user_id;

            $this->getMasks();
            $this->getPosts();
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


        public function actionEdit()
        {
            if (isset($_POST['btn-edit'])) {

                $notifications = $_POST['email_notes'];
                unset($_POST['email_notes']);

                $new = new User($_POST);

                if ($new->updateUser()) {

                    $_SESSION['user_email'] = $new->user_email;

                    Flash::addMessage('Changes applied successfully');

                    $this->redirect('/profile');
                }

                $this->view_data['user'] = $new;
                $this->actionSettings();

            } else {
                $this->redirect('/');
            }
        }


        public function actionUploadAva()
        {

            if (! isset($_POST)) {
                $this->redirect('/');
            } else {

                $ava = new ProfileImage($_FILES['ava']);

                if (isset($_POST['submit'])) {

                    if ($ava->uploadProfileImg($_FILES['ava'])) {
                        Flash::addMessage('Your profile photo has changed successfully');
                    } else {
                        Flash::addMessage($ava->custom_error);
                    }

                } else if (isset($_POST['delete'])) {

                    if (strstr($this->user->profile_img_src, "pikachu")) {
                        Flash::addMessage('Nothing to delete');
                    } else if ($ava->deleteProfileImg()) {
                        Flash::addMessage('Your profile photo is deleted');
                    } else {
                        Flash::addMessage('Something went wrong. Try again a bit later');
                    }

                }

                $this->redirect('/settings');
            }

        }


        public function actionNewPhoto()
        {
            if (! isset($_POST)) {
                $this->redirect('/profile');
            }
            
            $decoded = json_decode($_POST['data'], true);

            $post = new Post($decoded);

            $filename = $post->savePost();

            if ($filename) {
                $url = $this->path . '/' . $filename;
                echo $url;
            } else {
                echo 'error';
            }
        }


        public function actionDeletePost()
        {
            if (! isset($_POST)) {
                $this->redirect('/profile');
            }

            if (! Post::deletePost($_POST['src'])) {
                Flash::addMessage('Something went wrong. Please, try again!');
                echo 'error';
            }
            
        }


        private function getMasks()
        {
            $files = glob(MASKS_PATH . "/*.png");

            foreach ($files as $path) {
                $this->view_data['masks'][] = str_replace(ROOT, WWW_ROOT, $path);
            }
        }


        private function getPosts()
        {
            $posts = Post::getAllPosts($this->user->user_id);

            foreach ($posts as $name) {
                $this->view_data['posts'][] = $this->path . '/' . $name;
            }
        }

    }

?>
