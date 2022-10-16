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

$studentID = $_GET['student'];
$subjectID = $_GET['subject'];

$values = [
    $studentID,
    $subjectID,
    
];

$sql = "DELETE FROM grades WHERE studentID = ? AND subjectID = ?";

$isDeleted = executeQuery($conn, $sql, $values, 'ss');

if(!$isDeleted) {
    echo 'Error';
}

header("Location: ../templates/student.php?id={$studentID}");
exit();


?>