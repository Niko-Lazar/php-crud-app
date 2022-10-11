<?php require '../config/database.php'; ?>
<?php require 'globals.php'; ?>

<?php

if(loggedIn()) {
    header('Location: students.php');
    exit();
}

$passwordIsReset = !empty($_REQUEST['password-change-success']) && $_REQUEST['password-change-success'] == 1;
$userNotFound = $_SERVER["REQUEST_METHOD"] != "GET" && !isset($user);

$email = $password = '';
$emailErr = $passwordErr = '';

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}
if(!isset($_POST["submit"])) {
    return;
}

if(!$_POST['email']) {
    $emailErr = "Please enter a valid email";
}
if(!$_POST['password']) {
    $passwordErr = "Plase enter a valid password";
}

$inputIsValid = empty($emailErr) && empty($passwordErr);

if(!$inputIsValid) {
    return;
}

$email = $_POST['email'];
$password = sanitizeInput($_POST['password']);

$sql = "SELECT * FROM users WHERE email='${email}'";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_array($result);

if(empty($user)) {
    return;
}

$passwordMatches = password_verify($password, $user['password']);

if($passwordMatches) {
    $_SESSION['loggedUser'] = $user;
    header('Location: users.php');
    exit();
}

?>