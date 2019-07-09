CREATE DATABASE IF NOT EXISTS db_camagru;
USE db_camagru;

CREATE TABLE IF NOT EXISTS users (
    user_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    user_email VARCHAR(50) NOT NULL UNIQUE,
    verified tinyint(1) DEFAULT 0,
    hashed_password VARCHAR(255) NOT NULL,
    token_hash VARCHAR(255),
    token_expires_at DATETIME
    );

CREATE TABLE IF NOT EXISTS profileimg (
    id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) NOT NULL,
    status tinyint(1) DEFAULT 0
    );