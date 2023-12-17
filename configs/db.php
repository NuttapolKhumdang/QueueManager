<?php

//* database connect infomation
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "wings");

//* inital database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
$conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);

//* inital connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->query("SET NAMES utf8");


//* create table functions
function create_user(mysqli $conn)
{
    $conn->query("CREATE TABLE IF NOT EXISTS `user`(
        `ID` INT(8) AUTO_INCREMENT,
        `pname` VARCHAR(32),
        `name` VARCHAR(128),
        
        `email` VARCHAR(128) NOT NULL,
        `password` VARCHAR(128) NOT NULL,
        `level` VARCHAR(1) NOT NULL,
        
        PRIMARY KEY(`ID`)
    ) DEFAULT CHARSET=utf8");
}

function create_history(mysqli $conn)
{
    $conn->query("CREATE TABLE IF NOT EXISTS `history`(
        `ID` INT(8) AUTO_INCREMENT,
        `user` INT(8) NOT NULL,
        `number` INT(4) NOT NULL,

        `date` DATE NOT NULL,
        `start` TIME NOT NULL,
        `end` TIME NOT NULL,
        
        `purpose` VARCHAR(128),
        `duration` INT(3),

        PRIMARY KEY(`ID`)
    ) DEFAULT CHARSET=utf8");
}

function create_wconfig(mysqli $conn)
{
    $conn->query("CREATE TABLE IF NOT EXISTS `wconfig`(
        `key` VARCHAR(128) NOT NULL,
        `value` VARCHAR(128) NOT NULL
    ) DEFAULT CHARSET=utf8");
}

//* inital database table
try {
    $conn->query("SELECT * FROM user LIMIT 1");
} catch (Throwable $e) {
    create_user($conn);
}

try {
    $conn->query("SELECT * FROM history LIMIT 1");
} catch (Throwable $e) {
    create_history($conn);
}

try {
    $conn->query("SELECT * FROM wconfig LIMIT 1");
} catch (Throwable $e) {
    create_wconfig($conn);
}
