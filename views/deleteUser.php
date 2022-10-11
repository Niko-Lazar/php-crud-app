<?php require '../config/database.php' ?>
<?php require 'globals.php'; ?>
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

$userID = $_REQUEST['id'];
$userRole = $_REQUEST['role'];

$isStudent = ($userRole == 'student')
    ? true
    : false;

if($isStudent) {
    $conn->autocommit(FALSE);

    $conn->query("DELETE FROM students WHERE email = (SELECT email FROM users WHERE id=$userID)");
    $conn->query("DELETE FROM users WHERE id=${userID}");

    $conn->commit();
} else {
    $conn->query("DELETE FROM users WHERE id=${userID}");
    $conn->commit();
}
$conn -> close();

header('Location: ../templates/users.php?user-action=2');
exit();


?>