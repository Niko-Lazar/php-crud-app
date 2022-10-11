<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>

<?php 

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}


$msg = isset($_REQUEST['subject-action'])
    ? $_REQUEST['subject-action']
    : "";
    
$msgType = '';

switch($msg) {
    case '0':
        $msg = "Subject created successfully";
        $msgType = "alert-success";
        break;
    case '1':
         $msg = "Subject info updated";
         $msgType = "alert-warning";
         break;
    case '2':
        $msg = "Subject has been deleted";
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
 
 $sql = "SELECT * FROM subjects";
 
 $result = mysqli_query($conn, $sql);
 
 if($result) {
    $subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);
 }


?>