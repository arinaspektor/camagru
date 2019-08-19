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
            if ($this->preparePhoto() &&
                $this->mergeImages() &&
                $this->saveToDb()) {
                    return $this->name;
              
            }

            return false;
        }

        
        private function saveToDb()
        {
            $data = [
                'user_id' => $this->user_id,
                'filename' => $this->name,
                'created_at' => date('Y-m-d H:i:s', time())
            ];

            return Db::insert(self::$table, $data);
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

                $offset_x = ($width - $size[0]) / 2;
                $offset_y = ($height - $size[1]) / 2;

                $dst_x -= $offset_x;
                $dst_y -= $offset_y;
            }

            if (! $this->upld) {
                imageflip($dest, IMG_FLIP_HORIZONTAL);
            }

            imagecopy($dest, $src, $dst_x, $dst_y, 0, 0, $width, $height);
            $res = imagepng($dest, $this->fullpath);

            imagedestroy($dest);
            imagedestroy($src);

            return $res;
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


        static public function getAllPostsById($user_id)
        {
            $sql = "SELECT `filename`";
            $sql .= " FROM `Posts`";
            $sql .= " WHERE `user_id` = $user_id";
            $sql .= " ORDER BY `created_at` DESC";

            return Db::findColumnByValue($sql);
        }


        static public function getAllPosts()
        {
            $sql = "SELECT *";
            $sql .= " FROM `Posts`";
            $sql .= " ORDER BY `created_at` DESC";

            return Db::findAllByValue($sql);
        }


        static public function findUsernameById($user_id)
        {
            $sql = "SELECT `username`";
            $sql .= " FROM `Users`";
            $sql .= " WHERE `user_id` = $user_id";
            $sql .= " LIMIT 1";

            return Db::findColumnByValue($sql);
        }


        static public function getAllComments($post_id)
        {
            $sql = "SELECT * ";
            $sql .= " FROM `Comments`";
            $sql .= " WHERE `post_id` = $post_id";

            return Db::findAllByValue($sql);
        }


        static public function countLikes($post_id)
        {
            $sql = "SELECT COUNT(*)";
            $sql .= " FROM `Likes`";
            $sql .= " WHERE `post_id` = $post_id";

            return Db::findAllByValue($sql);
        }


        static public function isLikedByUser($post_id, $user_id)
        {
            $sql = "SELECT `like_id`";
            $sql .= " FROM `Likes`";
            $sql .= " WHERE `post_id` = $post_id";
            $sql .= " AND `user_id` = $user_id";

            return Db::findColumnByValue($sql);
        }


        static public function deletePost($src)
        {
            $file = str_replace(WWW_ROOT, ROOT, $src);
           
            $s = explode('/', $src);
            $value = end($s);

            if (Db::deleteOne($table='Posts', $column='filename', $value)) {
                return unlink($file);
            }

            return false;
        }


        static public function addLike($post_id, $user_id)
        {
            $table = 'Likes';
            $data = ['post_id' => $post_id, 'user_id' => $user_id];

            return Db::insert($table, $data);
        }


        static public function removeLike($post_id, $user_id)
        {
            $table = 'Likes';

            $sql = "SELECT `like_id`";
            $sql .= " FROM $table";
            $sql .= " WHERE `post_id` = $post_id";
            $sql .= " AND `user_id` = $user_id";

            $like_id = implode(Db::findColumnByValue($sql));

            return Db::deleteOne($table, $column='like_id', $like_id);
        }


        static public function addComment($post_id, $text, $user_id)
        {
            $table = 'Comments';

            $data = ['text' => $text, 'post_id' => $post_id, 'user_id' => $user_id];

            return Db::insert($table, $data);
        }

    }



?>