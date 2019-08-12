<?php

    class Image extends Model
    {
        static private $allowed = ['jpg', 'jpeg', 'png'];
        public $custom_error = null;
        public $user_id;
        protected $extn;


        protected function validate_file_data($name)
        {
            if (! $name) {
                $this->custom_error = "You haven't chosen any file to upload";
            } else if (! in_array($this->extn, self::$allowed)) {
                $this->custom_error = "Files of $this->extn format are not allowed. Try another one";
            } else if ($this->error !== 0) {
                $this->custom_error = 'An error occured while uploading your file. Please, try again';
            } else if ($this->size > 5 * MB) {
                $this->custom_error = 'Your file is too big. Max size is 5Mb';
            }
        }


    }

?>