<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php require 'queries.php'; ?>
<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] != "GET") {
   return; 
}

#$actionMsg = actionMessage('user');

$users = select($conn, 'users');

?>