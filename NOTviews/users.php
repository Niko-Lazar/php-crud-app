<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php require 'queries.php'; ?>
<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}



$msg = isset($_REQUEST['user-action'])
    ? $_REQUEST['user-action']
    : "";
$msgType = '';

switch($msg) {
    case '0':
        $msg = "User created successfully";
        $msgType = "alert-success";
        break;
    case '1':
        $msg = "User info updated";
        $msgType = "alert-warning";
        break;
    case '2':
        $msg = "User has been deleted";
        $msgType = "alert-danger";
        break;

    default:
        $msg = "";
        $msgType = "";
        break;
}

if($_SERVER["REQUEST_METHOD"] != "GET") {
   return; 
}

$users = selectTable('users', $conn);

?>