<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php require 'queries.php'; ?>

<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() == "student") {
    header('Location: student.php');
    exit();
}

$students = select($conn, 'students');

?>