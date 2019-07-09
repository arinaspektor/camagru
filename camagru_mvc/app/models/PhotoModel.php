<?php

  class Photo extends Model
  {
    public $custom_error = null;
    public $user_id;
    static private $allowed = ['jpg', 'jpeg', 'png'];
    private $extn;


    public function __construct($data = [])
    {
      // self::$class_name = 'Photo';
      self::$table = 'Profileimg';
      $this->user_id = $_SESSION['user_id'];

      foreach ($data as $key => $value) {
        $this->$key = $value;
      };
    }


    public function upload() {

      $prepare_extn = explode('.', $this->name);
      $this->extn = strtolower(end($prepare_extn));

      $this->validate_file_data();

      if (! $this->custom_error) {

        $fileNameNew = 'ava_' . $this->user_id . '.' . $this->extn;
        $fileDestination = STORAGE_PATH . '/profile' . '/' . $fileNameNew;

        if (!is_dir(STORAGE_PATH . '/profile')) {
            mkdir(STORAGE_PATH . '/profile');
        }

        if (! move_uploaded_file($this->tmp_name, $fileDestination)) {
          $this->custom_error = 'An error occured while uploading your file. Please, try again';
        } else {
          $this->savePhoto($fileNameNew);
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


    public function savePhoto($file)
    {
      $data = [
        'user_id' => $this->user_id,
        'status' => 1
      ];
  
      return Db::insert(self::$table, $data);
    }

    
  }


?>
