<?php

    class Db {

        static private $pdo;

        static public function setup() {
            $data = include(ROOT . '/config/config.php');
            $db_dsn = "mysql:host={$data['host']};charset={$data['charset']}";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            self::$pdo = new PDO($db_dsn, $data['db_user'], $data['db_pass'], $options);
            self::setDatabase(self::$pdo);
        }

        
        static private function setDatabase($pdo)
        {
            try {
                $sql = file_get_contents('db.sql');
                $pdo->exec($sql);
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        }


        static public function destroyConnection()
        {
            self::$pdo = null;
        }


        static public function insert($table, $data)
        {
            $sql = "INSERT INTO $table (";
            $sql .= join(', ', array_keys($data));
            $sql .= ") VALUES (:";
            $sql .= join(', :', array_keys($data));
            $sql .= ")";

            return self::bindValues($sql, $data);
        }


        static public function update($table, $data, $where)
        {
            $sql = "UPDATE $table SET ";
            
            $last = array_key_last($data);
            foreach (array_keys($data) as $key) {
                $sql .= $key  . " = :" . $key;
                if ($key !== $last) {
                    $sql .= ", ";
                }
            }
            $sql .= " WHERE " . key($where) . " = :" . key($where);
            return self::bindValues($sql, array_merge($data, $where));
        }


        static public function findByValue($table, $column, $value, $class)
        {
            $sql = "SELECT * FROM $table WHERE $column = :val";

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':val', $value, PDO::PARAM_STR);
            
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);

            $stmt->execute();

            return $stmt->fetch();
        }

        
        static public function alreadyExists($table, $column, $value, $class)
        {
            return (self::findByValue($table, $column, $value, $class) !== false);
        }


        static private function bindValues($sql, $data)
        {  
            $stmt = self::$pdo->prepare($sql);

            foreach ($data as $key => $value) {
                $param = ":$key";
                $stmt->bindValue($param, $value, PDO::PARAM_STR);
            }

            return $stmt->execute();
        }

    }

?>