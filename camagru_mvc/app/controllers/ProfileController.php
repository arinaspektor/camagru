<?php

    class ProfileController extends Controller
    {
        public $user;

        public function __construct($user = null)
        {
            $this->view_data['page_title'] = 'Profile';

            $this->user = $user ?? User::findById($_SESSION['user_id']);

            $this->view_data['user'] = $this->user;

            $this->view_data['user']->profile_img_src =  $this->user->profile_img_src ?
                                            IMAGES_PATH . '/storage/profile/' . $this->user->profile_img_src :
                                            IMAGES_PATH . '/pikachu_ava.svg';

            $this->view_data['masks'] = $this->getMasks();

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


        private function getMasks()
        {
            $dir =  ROOT . '/public/images/masks';
            $files = glob($dir . "/*.png");

            foreach ($files as $path) {
                $masks[] = str_replace(ROOT, WWW_ROOT, $path);
            }

            return $masks;
        }


    }

?>
