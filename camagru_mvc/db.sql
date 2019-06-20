CREATE DATABASE IF NOT EXISTS db_camagru;
USE db_camagru;

CREATE TABLE IF NOT EXISTS users (
    user_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    user_email VARCHAR(50) NOT NULL UNIQUE,
    hashed_password VARCHAR(255) NOT NULL
    );