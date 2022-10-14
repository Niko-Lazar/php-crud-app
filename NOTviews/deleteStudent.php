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

$sql = "SELECT email FROM students WHERE id = ?";
$studentEmail = selectByCondition($conn, $sql, $studentID, 's')['email'];

$sql = "DELETE FROM users WHERE email = ?";
deleteByCondition($conn, $sql, $studentEmail, 's');

delete($conn, 'students', $studentID);

$_SESSION['flash_message'] = actionMessage('student', 'danger');

header('Location: ../templates/students.php');
exit();

?>