<?php include '../config/database.php' ?>
<?php

$msg = isset($_REQUEST['user-action']) ? $_REQUEST['user-action'] : "";
$msgType = '';

switch($msg) {
    case '0':
        $msg = "User created successfully";
        $msgType = "alert-success";
        break;
    case '1':
        $msg = "User has been deleted";
        $msgType = "alert-danger";
        break;
    case '2':
        $msg = "User info updated";
        $msgType = "alert-warning";
        break;
    default:
        $msg = "";
        $msgType = "";
        break;
}

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn, $sql);

    if($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}



?>