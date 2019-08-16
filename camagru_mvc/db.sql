CREATE DATABASE IF NOT EXISTS db_camagru;
USE db_camagru;

CREATE TABLE IF NOT EXISTS users (
    user_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    user_email VARCHAR(50) NOT NULL UNIQUE,
    verified tinyint(1) DEFAULT 0,
    hashed_password VARCHAR(255) NOT NULL,
    token_hash VARCHAR(255),
    token_expires_at DATETIME,
    profile_img_src VARCHAR(255)
    );

CREATE TABLE IF NOT EXISTS posts (
    post_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(10) unsigned NOT NULL,
    filename VARCHAR(255) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS likes (
    like_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id INT(10) unsigned NOT NULL,
    user_id INT(10) unsigned NOT NULL
);

CREATE TABLE IF NOT EXISTS comments (
    comment_id INT(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(255) NOT NULL,
    post_id INT(10) unsigned NOT NULL,
    user_id INT(10) unsigned NOT NULL
);
