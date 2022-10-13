<?php require '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php require 'queries.php'; ?>
<?php
session_start();

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] != 'POST') {
    return;
}

$studentID = $_GET['id'];

$deletor = new Deletor();
$selector = new Selector(); 

$sql = "SELECT email FROM students WHERE id = ?";
$studentEmail = selectByCondition($conn, $sql, [$studentID], ['s'])['email'];

$sql = "DELETE FROM students WHERE email = ?";
deleteByCondition($conn, $sql, [$studentEmail], ['s']);
    
delete($conn, 'users', $studentID);

header('Location: ../templates/students.php?student-action=2');
exit();

?>