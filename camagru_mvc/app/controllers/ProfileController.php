<?php

    class ProfileController extends Controller
    {
        public $user;

        public function __construct($user = null)
        {
            $this->view_data['page_title'] = 'Profile';

            $this->user = $user ?? User::findById($_SESSION['user_id']);

            $this->view_data['user'] = $this->user;
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

            if (isset($_POST['submit'])) {
              $ava = new Photo($_FILES['ava']);

              if ($ava->upload($_FILES['ava'])) {
                
                Flash::addMessage('Your profile photo has changed successfully');
              } else {
                Flash::addMessage($ava->custom_error);
              }
              $this->redirect('/settings');
            } else {
              $this->redirect('/');
            }

        }


    }

?>
