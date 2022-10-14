<?php include '../config/database.php' ?>
<?php require 'globals.php' ?>
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

$subjectErrorFields = [];

if(!$_POST['subjectCode'] || !hasOnlyNumbers($_POST['subjectCode'])) {
    $subjectErrorFields['subjectCode'] = "Please enter a valid subject code";
}
if(!$_POST['name'] || !hasOnlyLettersAndNumbers($_POST['name'])) {
    $subjectErrorFields['name'] = "Please enter a valid subject name";
}
if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
    $subjectErrorFields['yearOfStudy'] = "Please enter a valid year of study";
}
if(!$_POST['ESPB'] || !is_numeric($_POST['ESPB'])) {
    $subjectErrorFields['ESPB'] = "Please enter a valid ESPB number";
}
if(!$_POST['mandatory'] && ($_POST['mandatory'] != 0 && $_POST['mandatory'] != 1)) {
    $subjectErrorFields['mandatory'] = "Please select a valid subject type";
}

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

$subjectCreated = create($conn, $sql, $values, $types);

if(!$subjectCreated) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('subject', 'success');

header('Location: ../templates/subjects.php');
exit();


?>