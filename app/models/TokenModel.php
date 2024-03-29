<?php

    class Token
    {
        protected $token;

        public function __construct($token_value = null)
        {
            $this->token = $token_value ?? bin2hex(random_bytes(16));
        }


        public function getValue()
        {
            return $this->token;
        }


        public function getHash()
        {
            return hash_hmac('sha256', $this->token, "biakWXMJdQL3KNwgsXWbq9PuNjHRCINO");
        }
    }

?>