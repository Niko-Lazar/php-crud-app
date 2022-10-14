<?php require '../config/database.php' ?>
<?php require 'globals.php' ?>
<?php require 'inputChecks.php' ?>
<?php require 'queries.php' ?>
<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}

$subjectID = $_GET['id'];

$sql = "SELECT * FROM subjects WHERE id=?";
$subject = selectByCondition($conn, $sql, $subjectID, 's');

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST['submit'])) {
    return;
}

$subjectErrorFields = checkSubjectFields();

if(!!$subjectErrorFields) {
    return;
}

$values = [
    $subjectCode = $_POST['subjectCode'],
    $name = $_POST['name'],
    $yearOfStudy = $_POST['yearOfStudy'],
    $ESPB = $_POST['ESPB'],
    $mandatory = sanitizeInput($_POST['mandatory']),
    $subjectID,
];

$sql = "UPDATE subjects SET subjectCode=?, name=?, yearOfStudy=?,ESPB=?, mandatory=? WHERE id=?";

$queryIsSuccessful = createUpdate($conn, $sql, $values, 'ssssss');

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
    exit();
}

$_SESSION['flash_message'] = actionMessage('subject', 'warning');

header('Location: ../templates/subjects.php');
exit();

?>