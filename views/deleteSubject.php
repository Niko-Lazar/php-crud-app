<?php require '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php
session_start();

if($_SERVER["REQUEST_METHOD"] != 'POST') {
    return;
}

$subjectID = $_REQUEST['id'];


$sql = "DELETE FROM subjects WHERE id=${subjectID}";

$queryIsSuccessful = $conn->query($sql);

if(!$queryIsSuccessful) {
    echo "Error deleting subject " . $conn->error;
}

header('Location: ../templates/subjects.php?subject-action=2');
exit();

?>