<?php

    class User extends Model
    {
        public $errors = [];

        public function __construct($data)
        {
            parent::__construct();

            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
        }

        public function saveUser()
        {
            $this->validate();

            if (empty($this->errors)) {
                $passwd_hash = password_hash($this->passwd, PASSWORD_DEFAULT);

                $sql = 'INSERT INTO users (username, user_email, hashed_password) 
                        VALUES (:uname, :email, :passwd_hash)';
    
                $stmt = $this->db->prepare($sql);
    
                $stmt->bindValue(':uname', $this->username, PDO::PARAM_STR);
                $stmt->bindValue(':email', $this->uemail, PDO::PARAM_STR);
                $stmt->bindValue(':passwd_hash', $passwd_hash, PDO::PARAM_STR);
    
                return $stmt->execute();
            }
            return false;
        }


        public function validate()
        {
            $this->validate_name();
            $this->validate_email();
            $this->validate_passwd();
        }


        public function validate_name()
        {
            if(!isset($this->username) || trim($this->username) == '') {
                $this->errors[] = 'Username is required';
            }

            if(strlen($this->username) < 6) {
                $this->errors[] = 'Please, enter at least 6 characters for the username';
            }

            if(strlen($this->username) > 20) {
                $this->errors[] = 'Maximum length of username is 20 characters';
            }

            if ($this->isTaken("username", $this->username)) {
                $this->errors[] = 'This username is already taken';
            }

        }


        public function validate_email()
        {
            if (filter_var($this->uemail, FILTER_VALIDATE_EMAIL) === false) {
                $this->errors[] = 'Invalid email';
            }

            if ($this->isTaken("user_email", $this->uemail)) {
                $this->errors[] = 'This email is already taken';
            }
        }


        public function validate_passwd()
        {
            if(strlen($this->passwd) < 8) {
                $this->errors[] = 'Passwords must be at least 8 characters long';
            }

            if(strlen($this->passwd) > 20) {
                $this->errors[] = 'Maximum length of passwd is 20 characters';
            }

            if (!preg_match('/[a-z]/', $this->passwd)) {
               $this->errors[] = 'Password needs at least one lowercase letter';
            }

            if (!preg_match('/[AZ-z]/', $this->passwd)) {
                $this->errors[] = 'Password needs at least one uppercase letter';
             }

            if (!preg_match('/\d/', $this->passwd)) {
                $this->errors[] = 'Password needs at least one number';
            }

            if ($this->passwd !== $this->dup_passwd) {
                $this->errors[] = 'Password must match confirmation';
            }

        }

        
        protected function isTaken($column, $value)
        {
            $sql = "SELECT * FROM users WHERE $column = :val";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':val', $value, PDO::PARAM_STR);

            $stmt->execute();
            return $stmt->fetch() !== false;
        }

    }

?>