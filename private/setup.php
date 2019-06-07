<?php

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $conn = new PDO($db_dsn, $db_user, $db_pass, $options);

            $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
            $conn->exec($sql);
    
            $sql = "USE $db_name";
            $conn->exec($sql);
    
            $sql = "CREATE TABLE IF NOT EXISTS users (
                    user_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(20) NOT NULL UNIQUE,
                    email VARCHAR(50) NOT NULL,
                    hashed_password VARCHAR(255) NOT NULL
                    )";
            $conn->exec($sql);
        }
        catch(PDOException $e) {
            die($e->getMessage());
        }
   
    // $conn = null; - при окончании работы с бд
?>