<?php

  class Image extends Model
  {
    public $custom_error = null;
    public $user_id;
    public $src;
    static private $allowed = ['jpg', 'jpeg', 'png'];
    private $extn;


    public function __construct($data = [])
    {
      $this->user_id = $_SESSION['user_id'];

      foreach ($data as $key => $value) {
        $this->$key = $value;
      };
    }


    public function uploadProfileImg() {

      $prepare_extn = explode('.', $this->name);
      $this->extn = strtolower(end($prepare_extn));

      $this->validate_file_data();

      if (! $this->custom_error) {

        $fileNameNew = 'ava_' . $this->user_id . '.' . $this->extn;
        $this->src = STORAGE_PATH . '/profile' . '/' . $fileNameNew;

        if (!is_dir(STORAGE_PATH . '/profile')) {
            mkdir(STORAGE_PATH . '/profile');
        }

        if (! move_uploaded_file($this->tmp_name, $fileDestination)) {
          $this->custom_error = 'An error occured while uploading your file. Please, try again';
        }

      }

      return ! $this->custom_error;
    }


    private function validate_file_data()
    {
      if (! $this->name) {
        $this->custom_error = 'You have to choose the file';
      } else if (! in_array($this->extn, self::$allowed)) {
        $this->custom_error = "Files of $this->extn format are not allowed. Try another one";
      } else if ($this->error !== 0) {
        $this->custom_error = 'An error occured while uploading your file. Please, try again';
      } else if ($this->size > 2 * MB) {
        $this->custom_error = 'Your file is too big. Max size is 2Mb';
      }
    }


  }


?>
