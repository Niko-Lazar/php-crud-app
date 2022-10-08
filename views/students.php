<?php include '../config/database.php' ?>
<?php require 'globals.php'; ?>

<?php 

$sql = "SELECT * FROM students";

$result = mysqli_query($conn, $sql);

if($result) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
}



?>