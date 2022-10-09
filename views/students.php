<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>

<?php

$msg = isset($_REQUEST['student-action']) ? $_REQUEST['student-action'] : "";
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


$sql = "SELECT * FROM students";

$result = mysqli_query($conn, $sql);

if($result) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
}



?>