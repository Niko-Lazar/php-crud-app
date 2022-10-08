<?php include '../config/database.php' ?>
<?php require 'globals.php' ?>

<?php

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$indexNumber = $name = $parentsName = $lastName = $email = $phoneNumber = $yearOfStudy = $dateOfBirth = $IDnumber = '';
$indexNumberErr = $nameErr = $parentsNameErr = $lastNameErr = $emailErr = $phoneNumberErr = $yearOfStudyErr = $dateOfBirthErr = $IDnumberErr = '';

if(!isset($_POST['submit'])) {
    return;
}

if(!$_POST['indexNumber']) {
    $indexNumberErr = "Please enter a valid index number";
}
if(!$_POST['name'] || !hasOnlyLetters($_POST['name'])) {
    $nameErr = "Please enter a valid name";
}
if(!$_POST['parentsName'] || !hasOnlyLetters($_POST['parentsName'])) {
    $parentsNameErr = "Please enter a valid parent's name";
}
if(!$_POST['lastName'] || !hasOnlyLetters($_POST['lastName'])) {
    $lastNameErr = "Please enter a valid last name";
}
if(!$_POST['email']) {
    $emailErr = "Please enter a valid email adress";
}
if(!$_POST['phoneNumber'] || !hasOnlyNumbers($_POST['phoneNumber'])) {
    $phoneNumberErr = "Please enter a valid phone number";
}
if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
    $yearOfStudyErr = "Please enter a valid year of study";
}
if(!$_POST['dateOfBirth']) {
    $dateOfBirthErr = "Please enter a valid date of birth";
}
if(!$_POST['IDnumber'] || !is_numeric($_POST['IDnumber'])) {
    $IDnumberErr = "Please enter a valid ID number";
}

$allInputsAreValid = (!$indexNumberErr && !$nameErr && !$parentsNameErr && !$lastNameErr && !$emailErr && !$phoneNumberErr && !$yearOfStudyErr && !$dateOfBirthErr && !$IDnumberErr);


if(!$allInputsAreValid) {
    return;
}

$indexNumber = sanitizeInput($_POST['indexNumber']);
$name = $_POST['name'];
$parentsName = $_POST['parentsName'];
$lastName = $_POST['lastName'];
$email = sanitizeInput($_POST['email']);
$phoneNumber = $_POST['phoneNumber'];
$yearOfStudy = $_POST['yearOfStudy'];
$dateOfBirth = sanitizeInput($_POST['dateOfBirth']);
$IDnumber = $_POST['IDnumber'];

$password = "student${indexNumber}";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO students (indexNumber, name, parentsName, lastName, email, phoneNumber, yearOfStudy, dateOfBirth, IDnumber)" .
        "VALUES ('$indexNumber', '$name', '$parentsName', '$lastName', '$email', '$phoneNumber', '$yearOfStudy', '$dateOfBirth', '$IDnumber');";
$sql .= "INSERT INTO users (name, lastName, email, password, role)" .
        "VALUES ('$name', '$lastName', '$email', '$hashedPassword', 'student');";    


$queryIsSuccessful = $conn->multi_query($sql) === TRUE;


if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

header('Location: ../templates/students.php?student-action=0');
exit();


?>