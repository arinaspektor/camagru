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
                // add to db

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
            $dst_size = getimagesize($this->fullpath);
    
            $width = $size[0] * floatval($this->scale);
            $height = $size[1] * floatval($this->scale);

            imagealphablending($src, false);
            imagesavealpha($src, true);

            $dst_x = $dst_size[0] * floatval($this->x);
            $dst_y = $dst_size[1] * floatval($this->y);

            if ($this->scale !== 1) {
                $tmp = imagescale($src, $width, $height);
                imagedestroy($src);
                $src = $tmp;

                // $offset_x = $size[0] / floatval($this->scale);
                // $offset_y = $size[1] / floatval($this->scale);

                // $offset_y = ;
            }

            imagecopy($dest, $src, $dst_x, $dst_y, 0, 0, $width, $height);

            $res = imagepng($dest, $this->fullpath);

            imagedestroy($dest);
            imagedestroy($src);

            $arr = array($this->x, $this->y, $this->scale, $height, $width, $dst_x, $dst_y);

            // return $res;
            return $arr;
        }

//  До увеличения 500
// После 1,6 скейла стало 800
// чтобы получить -300 нужно 

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