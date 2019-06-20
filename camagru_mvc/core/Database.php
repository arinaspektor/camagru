<?php

    class Db {

        private static $instance = null;
        private $pdo;

        private function __construct () {
            $data = include(ROOT . '/config/config.php');
            $db_dsn = "mysql:host={$data['host']};charset={$data['charset']}";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->pdo = new PDO($db_dsn, $data['db_user'], $data['db_pass'], $options);
            self::setDatabase($this->pdo);
        }

        public static function getInstance()
        {
            if (self::$instance != null) {
                return self::$instance;
            }
            return new self();
        }

        private static function setDatabase($pdo)
        {
            try {
                $sql = file_get_contents('db.sql');
                $pdo->exec($sql);
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        public function getConnection()
        {
            return $this->pdo;
        }


       
        public function destroyConnection()
        {
            $this->pdo = null;
        }

    }

?>