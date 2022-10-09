<?php require 'globals.php' ?>
<?php include '../config/database.php' ?>

<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator") {
    header('Location: students.php');
    exit();
}

$name = $lastName = $email = $password = $role = '';
$nameErr = $lastNameErr = $emailErr = $passwordErr = $roleErr = '';

if(!isset($_POST['submit'])) {
    return;
}

if(!$_POST['name'] || !hasOnlyLetters($_POST['name'])) {
    $nameErr = "Please enter a valid name";
}
if(!$_POST['lastName'] || !hasOnlyLetters($_POST['lastName'])) {
    $lastNameErr = "Plase enter a valid last name";
}
if(!$_POST['email']) {
    $emailErr = "Plase enter a valid email";
}
if(!$_POST['password']) {
    $passwordErr = "Plase enter a valid password";
}
if(!$_POST['role'] || !hasOnlyLetters($_POST['role'])) {
    $roleErr = "Plase select a role";
}

$allInputsAreValid = (!$nameErr && !$lastNameErr && !$emailErr && !$passwordErr && !$roleErr);

if(!$allInputsAreValid) {
    return;
}

$name = $_POST['name'];
$lastName = $_POST['lastName'];
$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users (name, lastName, email, password, role)" .
"VALUES ('$name', '$lastName', '$email', '$hashedPassword', '$role')";

$queryIsSuccessful = mysqli_query($conn, $sql);

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}
header('Location: ../templates/users.php?user-action=0');
exit();


?>