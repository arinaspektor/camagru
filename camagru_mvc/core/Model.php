<?php

    class Model
    {
        protected $db;

        public function __construct()
        {
          $instance = Db::getInstance();
          $this->db = $instance->getConnection();
        }
    }


?>