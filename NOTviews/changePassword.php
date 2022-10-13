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

if(!isset($_POST['submit'])) {
    return;
}

$oldPassword = $newPassword = $newPasswordRepeat = '';
$oldPasswordErr = $newPasswordErr = $newPasswordRepeatErr = $passwordMatchErr = '';

if(!$_POST['oldPassword']) {
    $oldPasswordErr = "Plase enter a valid password";
}

$passwordMatches = password_verify($_POST['oldPassword'], $_SESSION['loggedUser']['password']);

if(!$passwordMatches) {
    $oldPasswordErr = "Wrong password";
}

if(!$_POST['newPassword']) {
    $newPassword1Err = "Plase enter a valid password";
}

if(!$_POST['newPasswordRepeat']) {
    $newPasswordRepeatErr = "Plase enter a valid password";
}

if($_POST['newPassword'] != $_POST['newPasswordRepeat']) {
    $passwordMatchErr = "Passwords do not match";
}

$allInputsAreValid = (!$oldPasswordErr && !$newPasswordErr && !$newPasswordRepeatErr && !$passwordMatchErr);

if(!$allInputsAreValid) {
    return;
}

$oldPassword = sanitizeInput($_POST['oldPassword']);
$newPassword = sanitizeInput($_POST['newPassword']);
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password='$hashedPassword' WHERE id={$_SESSION['loggedUser']['id']}";

$queryIsSuccessful = mysqli_query($conn, $sql);

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

unset($_SESSION['loggedUser']);

$_SESSION['flash'] = "Password changed successfuly, please login again";

header('Location: ../templates/login.php');
exit();

?>
