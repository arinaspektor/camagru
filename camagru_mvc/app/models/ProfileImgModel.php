<?php

  class ProfileImage extends Image
  {
    public $new_name;

    public function __construct($data = null)
    {
      self::$table = 'Users';
      $this->user_id = $_SESSION['user_id'];

      foreach ($data as $key => $value) {
        $this->$key = $value;
      };

      $this->extn = 'png';
    }


    public function uploadProfileImg()
    {

      $prepare_extn = explode('.', $this->name);
      $this->extn = strtolower(end($prepare_extn));

      $this->validate_file_data($this->name);

      if (! $this->custom_error) {

        $this->new_name = 'ava_' . $this->user_id . $this->extn;
        $dest = STORAGE_PATH . '/profile' . '/' . $this->new_name;

        if (!is_dir(STORAGE_PATH . '/profile')) {
            mkdir(STORAGE_PATH . '/profile');
        }

        if (! move_uploaded_file($this->tmp_name, $dest) || ! $this->saveProfileImg()) {
          $this->custom_error = 'An error occured while uploading your file. Please, try again';
        }

      }

      return ! $this->custom_error;
    }


    private function saveProfileImg()
    {
      $data = [ 'profile_img_src' =>  $this->new_name ];
      $where = [ 'user_id' =>  $this->user_id ];

      return Db::update(self::$table, $data, $where);
    }


    public function deleteProfileImg()
    {
      $file_pattern = STORAGE_PATH . '/profile/ava_' . $this->user_id . '.' . '*';

      foreach (glob($file_pattern) as $file) {
        unlink($file);
      }

      $data = [ 'profile_img_src' =>  NULL ];
      $where = [ 'user_id' =>  $this->user_id ];

      return Db::update(self::$table, $data, $where);

    }

  }


?>
