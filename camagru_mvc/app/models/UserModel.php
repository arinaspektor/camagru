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
                $hashed_passwd = password_hash($this->passwd, PASSWORD_DEFAULT);

                $token = new Token();
                $hashed_token = $token->getHash();
                $expiry_timestamp = time() + 60 * 60 * 24;

                $this->account_token = $token->getValue();

                $userdata = [
                    'username' => $this->username,
                    'user_email' => $this->user_email,
                    'hashed_password' => $hashed_passwd,
                    'token_hash' => $hashed_token,
                    'token_expires_at' => date('Y-m-d H:i:s', $expiry_timestamp)
                ];
                
                return Db::insert(self::$table, $userdata);
            }
            return false;
        }


        public function updateUser()
        {
            $this->validate_userdata($this->passwd);

            if (empty($this->errors)) {
                $userdata = [
                    'username' => $this->username,
                    'user_email' => $this->user_email,
                ];
                
                if ($this->passwd) {
                    $hashed_passwd = password_hash($this->passwd, PASSWORD_DEFAULT);

                    $userdata['hashed_password'] = $hashed_passwd;
                }
                
                return Db::update(self::$table, $userdata, $where = [ 'user_id' => $_SESSION['user_id' ]]);
            }
            return false;
        }


        static public function authenticate($email, $password)
        {
            $user = self::findByEmail($email);

            if ($user && $user->verified) {
                if (password_verify($password, $user->hashed_password)) {
                    return $user;
                } 
            }
            return false;
        }


        public function varify()
        {
            $data = [   'verified' => 1,
                        'token_hash' => NULL,
                        'token_expires_at' => NULL
            ];

            $where = [ 'user_id' =>  $this->user_id];

            return Db::update(self::$table, $data, $where);
        }


        public function validate_userdata($to_cahge_passwd = true)
        {
            $this->validate_name();
            $this->validate_email();

            if ($to_cahge_passwd) {
                $this->validate_passwd();
            }
        }


        public function validate_name()
        {
            if(!isset($this->username) || trim($this->username) == '') {
                $this->errors[] = 'Username is required';
            }

            if(strlen($this->username) < 6 || strlen($this->username) > 20) {
                $this->errors[] = 'Username must be min 6 and max 20 characters long';
            }

            if (! isset($_SESSION['user_id']) && 
                Db::alreadyExists(self::$table, $column="username", $this->username, self::$class_name)) {
                $this->errors[] = 'This username is already taken';
            }

        }


        public function validate_email()
        {
            if (filter_var($this->user_email, FILTER_VALIDATE_EMAIL) === false) {
                $this->errors[] = 'Invalid email';
            }

            if (! isset($_SESSION['user_id'])
                && Db::alreadyExists(self::$table, $column="user_email", $this->user_email, self::$class_name)) {
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


        public function sendAccountConfirm()
        {
            $url =  WWW_ROOT . "/getstarted" . "/" . $this->account_token;
            return Mail::confirmAccount($url);
        }



        public function sendPassReset()
        {
            $passwd_token = $this->setToken();

            if ($passwd_token) {
                $url =  WWW_ROOT . '/reset' . '/' . $passwd_token;
                return Mail::resetPassword($url);
            }
            return false;
        }


        public function resetPassword($data)
        {
            $this->passwd = $data['passwd'];
            $this->dup_passwd = $data['dup_passwd'];

            $this->validate_passwd();

            if (empty($this->errors)) {
                $hashed_passwd = password_hash($this->passwd, PASSWORD_DEFAULT);

                $data = [
                    'hashed_password' => $hashed_passwd,
                    'token_hash' => NULL,
                    'token_expires_at' => NULL
                ];

                $where = ['user_id' => $this->user_id];

                return Db::update(self::$table, $data, $where);
            }
            return false;
        }


        private function setToken()
        {
            $token = new Token();
            $hashed_token = $token->getHash();

            $expiry_timestamp = time() + 60 * 60 * 24;

            $data = [   'token_hash' => $hashed_token,
                        'token_expires_at' => date('Y-m-d H:i:s', $expiry_timestamp)
                    ];

            $where = ['user_id' => $this->user_id];

            if (Db::update(self::$table, $data, $where)) {
                return $token->getValue();
            }
            return false;
        }


        static public function findByToken($value)
        {
            $token = new Token($value);
            $hashed_token = $token->getHash();

            $user = Db::findByValue($table='Users', $column="token_hash", $hashed_token, $class='User');

            if ($user) {
                if (strtotime($user->token_expires_at) > time()) {
                    return $user;
                }
            }
        }


        static public function findById($id) {
            return Db::findByValue($table='Users', $column="user_id", $id, $class='User');
        }

       
        static public function findByEmail($email) {
            return Db::findByValue($table='Users', $column='user_email', $email, $class='User');
        }
    }

?>