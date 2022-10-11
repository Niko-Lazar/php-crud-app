<?php include '../config/database.php' ?>
<?php require 'globals.php' ?>

<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

$oldPassword = $newPassword1 = $newPassword2 = '';
$oldPasswordErr = $newPassword1Err = $newPassword2Err = $passwordMatchErr = '';

if(!isset($_POST['submit'])) {
    return;
}

if(!$_POST['oldPassword']) {
    $oldPasswordErr = "Plase enter a valid password";
}

$passwordMatches = password_verify($_POST['oldPassword'], $_SESSION['loggedUser']['password']);

if(!$passwordMatches) {
    $oldPasswordErr = "Wrong password";
}

if(!$_POST['newPassword1']) {
    $newPassword1Err = "Plase enter a valid password";
}

if(!$_POST['newPassword2']) {
    $newPassword2Err = "Plase enter a valid password";
}

if($_POST['newPassword1'] != $_POST['newPassword2']) {
    $passwordMatchErr = "Plase enter a valid password";
}

$allInputsAreValid = (!$oldPasswordErr && !$newPassword1Err && !$newPassword2Err && !$passwordMatchErr);

if(!$allInputsAreValid) {
    return;
}

$oldPassword = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];
$hashedPassword = password_hash($newPassword1, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password='$hashedPassword' WHERE id={$_SESSION['loggedUser']['id']}";

$queryIsSuccessful = mysqli_query($conn, $sql);

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

session_destroy();
header('Location: ../templates/login.php?password-change-success=1');
exit();

?>
