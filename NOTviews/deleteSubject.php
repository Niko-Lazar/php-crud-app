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

$deleteSubject = delete($conn, "subjects", (int)$_GET['id']);

if(!$deleteSubject) {
    echo "Error deleting subject " . $conn->error;
}

header('Location: ../templates/subjects.php?subject-action=2');
exit();

?>