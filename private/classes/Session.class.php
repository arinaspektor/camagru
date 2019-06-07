<?php
    class Session {

        private $userid;
        public $username;
        private $lastlogin;

        public const MAX_LOGIN_AGE = 60*60*24;

        public function __construct() {
            session_start();
            // $this->check_stored_login();
        }
    }
?>