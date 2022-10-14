<?php include '../config/database.php' ?>
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
];

$sql = "INSERT INTO subjects (subjectCode, name, yearOfStudy, ESPB, mandatory) VALUES (?, ?, ?, ?, ?)";
$types = "sssss";

$subjectCreated = createUpdate($conn, $sql, $values, $types);

if(!$subjectCreated) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('subject', 'success');

header('Location: ../templates/subjects.php');
exit();


?>