<?php

    class User extends Model
    {
        public $errors = [];

        public function __construct($data = [])
        {
            self::$class_name = 'User';
            self::$table = 'Users';

            foreach ($data as $key => $value) {
                $this->$key = $value;
            };
        }

        public function saveUser()
        {
            $this->validate_userdata();

            if (empty($this->errors)) {
                $userdata = [];
                $userdata['username'] = $this->username;
                $userdata['user_email'] = $this->uemail;
                $userdata['hashed_password'] = password_hash($this->passwd, PASSWORD_DEFAULT);

                return Db::insertData(self::$table, $userdata);
            }
            return false;
        }


        public function validate_userdata()
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

            if(strlen($this->username) < 6 || strlen($this->username) > 20) {
                $this->errors[] = 'Username must be min 6 and max 20 characters long';
            }

            if (Db::alreadyExists(self::$table, $column="username", $this->username, self::$class_name)) {
                $this->errors[] = 'This username is already taken';
            }

        }


        public function validate_email()
        {
            if (filter_var($this->uemail, FILTER_VALIDATE_EMAIL) === false) {
                $this->errors[] = 'Invalid email';
            }

            if (Db::alreadyExists(self::$table, $column="user_email", $this->uemail, self::$class_name)) {
                $this->errors[] = 'This email is already taken';
            }
        }


        public function validate_passwd()
        {
            if(strlen($this->passwd) < 8 || strlen($this->passwd) > 20) {
                $this->errors[] = 'Passwords must be min 8 and max 20 characters long';
            }

            if (!preg_match('/[a-z]/', $this->passwd)) {
               $this->errors[] = 'Password needs at least one lowercase letter';
            }

            if (!preg_match('/[A-Z]/', $this->passwd)) {
                $this->errors[] = 'Password needs at least one uppercase letter';
             }

            if (!preg_match('/\d/', $this->passwd)) {
                $this->errors[] = 'Password needs at least one number';
            }

            if ($this->passwd !== $this->dup_passwd) {
                $this->errors[] = 'Password must match confirmation';
            }

        }

        
        static public function authenticate($email, $password)
        {
            $user = new self;
            $user = Db::findByValue(self::$table, 'user_email', $email, self::$class_name);

            if ($user) {
                if (password_verify($password, $user->hashed_password)) {
                    return $user;
                }
            }
            return false;
        }

    }

?>