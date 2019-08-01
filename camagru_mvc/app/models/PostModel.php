<?php

    class Post extends Model
    {
        public $picture;

        public function __construct($data)
        {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
        }


        // private function validate_file_data()
        // {
        //   if (! $this->name) {
        //     $this->custom_error = "You haven't chosen any file to upload";
        //   } else if (! in_array($this->extn, self::$allowed)) {
        //     $this->custom_error = "Files of $this->extn format are not allowed. Try another one";
        //   } else if ($this->error !== 0) {
        //     $this->custom_error = 'An error occured while uploading your file. Please, try again';
        //   } else if ($this->size > 2 * MB) {
        //     $this->custom_error = 'Your file is too big. Max size is 2Mb';
        //   }
        // }

        public function savePost()
        {
            $data = explode(',', $this->photo);
            $img = base64_decode($data[1]);
            $name = uniqid() . '.png';
            $dir = STORAGE_PATH . '/posts' . '/' .  $_SESSION['user_id'];

            if (! is_dir(STORAGE_PATH . '/posts')) {
                mkdir(STORAGE_PATH . '/posts');
            }

            if (! is_dir($dir)) {
                mkdir($dir);
            }

            $file = $dir . '/' . $name;

            file_put_contents($file, $img);

            return true;

            // $data = explode(',', $_POST['photo']);
            // $photo = base64_decode($data[1]);
    
            // $name = uniqid() . '.png';
            // $file = STORAGE_PATH . '/posts' . '/' . $name;
    
            // if (!is_dir(STORAGE_PATH . '/posts')) {
            //     mkdir(STORAGE_PATH . '/posts');
            // }
    
            // file_put_contents($file, $photo);
        }
       
    }



?>