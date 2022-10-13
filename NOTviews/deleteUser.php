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

if(!loggedIn()) {
    header('Location: ../templates/login.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] != 'POST') {
    return;
}

$userID = $_GET['id'];
$userRole = $_GET['role'];

$isStudent = ($userRole == 'student')
    ? true
    : false;


if($isStudent) {

    $sql = "SELECT email FROM users WHERE id = ?";
    $userEmail = selectByCondition($conn, $sql, [$userID], ['s'])['email'];

    $sql = "DELETE FROM students WHERE email = ?";
    deleteByCondition($conn, $sql, [$userEmail], ['s']);
    
    delete($conn, 'users', $userID);
} else {
    delete($conn, 'users', $userID);
}

header('Location: ../templates/users.php?user-action=2');
exit();

?>