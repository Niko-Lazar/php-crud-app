<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'Lazar');
define('DB_NAME', 'php-simple-crud');
define('DB_PASS', '123');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$connectionFailed = $conn->connect_error;

if($connectionFailed) {
    die('Connection Failed ' . $conn->connect_error);
}

?>