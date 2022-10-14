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

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST['submit'])) {
    return;
}

$studentErrorFields = checkStudentFields();

if(!!$studentErrorFields) {
    return;
}

$valuesStudent = [
    $indexNumber = sanitizeInput($_POST['indexNumber']),
    $name = $_POST['name'],
    $parentsName = $_POST['parentsName'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $phoneNumber = $_POST['phoneNumber'],
    $yearOfStudy = $_POST['yearOfStudy'],
    $dateOfBirth = sanitizeInput($_POST['dateOfBirth']),
    $IDnumber = $_POST['IDnumber'],
];

$password = "student${indexNumber}";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$valuesUser = [
    $name = $_POST['name'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $hashedPassword,
    'student',
];

$sqlStudent = "INSERT INTO students (indexNumber, name, parentsName, lastName, email, phoneNumber, yearOfStudy, dateOfBirth, IDnumber)";
$sqlStudent .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

$typesStudent = "sssssssss";

$sqlUser = "INSERT INTO users (name, lastName, email, password, role) VALUES (?, ?, ?, ?, ?);";    
$tyepsUser = "sssss";

$studentCreated = createUpdate($conn, $sqlStudent, $valuesStudent, $typesStudent);

$userCreated = createUpdate($conn, $sqlUser, $valuesUser, $tyepsUser);

if(!$studentCreated || !$userCreated) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('student', 'success');

header('Location: ../templates/students.php');
exit();


?>