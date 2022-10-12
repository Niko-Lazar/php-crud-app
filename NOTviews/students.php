<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>
<?php require 'queries.php'; ?>

<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() == "student") {
    header('Location: student.php');
    exit();
}

$msg = isset($_REQUEST['student-action'])
    ? $_REQUEST['student-action']
    : "";
    
$msgType = '';

switch($msg) {
    case '0':
        $msg = "Student created successfully";
        $msgType = "alert-success";
        break;
    case '1':
        $msg = "Student info updated";
        $msgType = "alert-warning";
        break;
    case '2':
        $msg = "Student has been deleted";
        $msgType = "alert-danger";
        break;

    default:
        $msg = "";
        $msgType = "";
        break;
}


$students = selectTable('students', $conn);

?>