<?php require '../config/database.php' ?>
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

$studentID = $_GET['id'];

$sql = "SELECT * FROM students WHERE id=?";
$student = selectByCondition($conn, $sql, $studentID, 's');

$oldEmail = $student['email'];

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST['submit'])) {
    return;
}

$studentErrorFields = [];

if(!$_POST['indexNumber'] || !hasOnlyLettersAndNumbers($_POST['indexNumber'])) {
    $studentErrorFields['indexNumber'] = "Please enter a valid index number";
}
if(!$_POST['name'] || !hasOnlyLetters($_POST['name'])) {
    $studentErrorFields['name'] = "Please enter a valid name";
}
if(!$_POST['parentsName'] || !hasOnlyLetters($_POST['parentsName'])) {
    $studentErrorFields['parentsName'] = "Please enter a valid parent's name";
}
if(!$_POST['lastName'] || !hasOnlyLetters($_POST['lastName'])) {
    $studentErrorFields['lastName'] = "Please enter a valid last name";
}
if(!$_POST['email']) {
    $studentErrorFields['email'] = "Please enter a valid email adress";
}
if(!$_POST['phoneNumber'] || !hasOnlyNumbers($_POST['phoneNumber'])) {
    $studentErrorFields['phoneNumber'] = "Please enter a valid phone number";
}
if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
    $studentErrorFields['yearOfStudy'] = "Please enter a valid year of study";
}
if(!$_POST['dateOfBirth']) {
    $studentErrorFields['dateOfBirth'] = "Please enter a valid date of birth";
}
if(!$_POST['IDnumber'] || !is_numeric($_POST['IDnumber'])) {
    $studentErrorFields['IDnumber'] = "Please enter a valid ID number";
}

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
    $studentID,
];

$valuesUser = [
    $name = $_POST['name'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $oldEmail,
];


$sqlStudent = "UPDATE students SET indexNumber=?, name=?, parentsName=?, lastName=?, email=?, phoneNumber=?, yearOfStudy=?, dateOfBirth=?, IDnumber =? WHERE id=?";

$studentUpdated = createUpdate($conn, $sqlStudent, $valuesStudent, 'ssssssssss');

$sqlUser = "UPDATE users SET name=?, lastName=?, email=? WHERE email =?";

$userUpdate = createUpdate($conn, $sqlUser, $valuesUser, 'ssss');

$updateSuccesful = $studentUpdated && $userUpdate;

if(!$updateSuccesful) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('student', 'warning');

header('Location: ../templates/students.php');
exit();
?>