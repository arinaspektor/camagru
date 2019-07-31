<?php

    class Post extends Model
    {

        public function __construct($data)
        {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
        }


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