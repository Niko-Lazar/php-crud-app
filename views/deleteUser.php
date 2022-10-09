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

$userID = $_REQUEST['id'];


$sql = "DELETE FROM users WHERE id=${userID}";

$queryIsSuccessful = $conn->query($sql);

if(!$queryIsSuccessful) {
    echo "Error deleting user " . $conn->error;
}

header('Location: ../templates/users.php?user-action=2');
exit();


?>