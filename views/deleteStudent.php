<?php require '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php
session_start();

if(!loggedIn()) {
    header('Location: ../templates/login.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] != 'POST') {
    return;
}

$studentID = $_REQUEST['id'];

$conn->autocommit(FALSE);

$conn->query("DELETE FROM users WHERE email = (SELECT email FROM students WHERE id=$studentID)");
$conn->query("DELETE FROM students WHERE id=${studentID}");

$conn->commit();
$conn -> close();

header('Location: ../templates/students.php?student-action=2');
exit();


?>