<?php

    class Db {

        static private function setDatabase($db) {
            try {
                $sql = file_get_contents('db.sql');
                $db->exec($sql);
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        static public function getConnection() {
            $data = include(ROOT . '/config/config.php');
            
            $db_dsn = "mysql:host={$data['host']};charset={$data['charset']}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $db = new PDO($db_dsn, $data['db_user'], $data['db_pass'], $options);
            self::setDatabase($db);

            return $db;
        }

    }

?>