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
            View::generate('profile.php', 'main_template.php', $this->view_data);
        }


        public function actionSettings()
        {
            View::generate('settings.php', 'main_template.php', $this->view_data);
        }


        public function actionEdit()
        {
            if (isset($_POST['btn-edit'])) {

                if (! isset($_POST['be_notified'])) {
                    $_POST['be_notified'] = 0;
                }

                $new = new User($_POST);

                if ($new->updateUser()) {

                    $_SESSION['user_email'] = $new->user_email;

                    Flash::addMessage('Changes applied successfully');
                }

                $this->redirect('/settings');
            }

            $this->redirect('/');
        }


        public function actionUploadAva()
        {

            $this->requirePost($_POST, '/settings');

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


        private function getMasks()
        {
            $files = glob(MASKS_PATH . "/*.png");

            foreach ($files as $path) {
                $this->view_data['masks'][] = str_replace(ROOT, WWW_ROOT, $path);
            }
        }


        private function getPosts()
        {
            $posts = Post::getAllPostsById($this->user->user_id);

            for ($i=0; $i < sizeof($posts); $i++) {
                $this->view_data['posts'][$i]['src'] = $this->path . '/' . $posts[$i]['filename'];
                $this->view_data['posts'][$i]['id'] = $posts[$i]['post_id'];
            }

        }

    }

?>
