<?php

  class Photo extends Model
  {
    public $custom_error;
    // private $extn;
    static private $allowed = ['jpg', 'jpeg', 'png'];

    public function __construct($data = [])
    {
        // $allowed = ['jpg', 'jpeg', 'png'];

        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }


    public function upload() {

      $extn = strtolower(end(explode('.', $this->name)));

      if (in_array($extn, self::$allowed)) {

        if ($this->error === 0) {

          if ($this->size <= 2 * MB) {

            $fileNameNew = uniqid('', true) . '.' . $extn;
            $fileDestination = STORAGE_PATH . '/' . $fileNameNew;

            if (!is_dir(STORAGE_PATH)) {
                mkdir(STORAGE_PATH);   // line 63
            }

            if (! move_uploaded_file($this->tmp_name, $fileDestination)) {
              $this->custom_error = 'There was an error uploading your file';
            }

          } else {
            $this->custom_error = 'Your file is too big. Max size is 2Mb';
          }

        } else {
          $this->custom_error = 'There was an error uploading your file';
        }

      } else {
        $this->custom_error = "Files of $this->extn format are not allowed. Try another one";
      }

      return ! isset($this->custom_error);

    }


  }


?>
