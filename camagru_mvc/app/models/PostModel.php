<?php

    class Post extends Image
    {
        public $picture;
        public $name;
        private $fullpath;

        public function __construct($data)
        {
            self::$table = 'Posts';
            $this->user_id = $_SESSION['user_id'];

            foreach ($data as $key => $value) {
                $this->$key = $value;
            };

            $this->decodeImg($this->file);

            $this->extn = '.png';
        }


        public function savePost()
        {
            if ($this->preparePhoto()) {
                return $this->mergeImages();
            }

            return false;
    
        }
       

        private function mergeImages()
        {   
            $maskpath = str_replace(WWW_ROOT, ROOT, $this->mask);

            $dest = imagecreatefrompng($this->fullpath);

            $src = imagecreatefrompng($maskpath);

            $size = getimagesize($maskpath);
            // $src = imagescale($src, $this->width, $this->height);

            imagealphablending($src, false);
            imagesavealpha($src, true);

            $x = intval($this->x);
            $y = intval($this->y);

            imagecopy($dest, $src, $x, $y, 0, 0, $size[0], $size[1]);

            return imagepng($dest, $this->fullpath);
        }

        private function preparePhoto()
        {
            $this->name = uniqid() . $this->extn;
            $dir = POSTS_PATH . '/' .  $this->user_id;

            $this->fullpath = $dir . '/' . $this->name;

            if (! is_dir(POSTS_PATH)) {
                mkdir(POSTS_PATH);
            }

            if (! is_dir($dir)) {
                mkdir($dir);
            }
        
            return file_put_contents($this->fullpath, $this->picture);
        }


        private function decodeImg($url)
        {
            $data = explode(',', $url);

            $this->picture = base64_decode($data[1]);
        }
    }



?>