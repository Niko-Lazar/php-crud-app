<?php require '../config/database.php'; ?>
<?php require 'globals.php'; ?>

<?php

if(loggedIn()) {
    header('Location: students.php');
    exit();
}

$loginErrors = [];

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST["submit"])) {
    return;
}

if(!$_POST['email']) {
    $loginErrors['email'] = "Please enter a valid email";
}

if(!$_POST['password']) {
    $loginErrors['password'] = "Plase enter a valid password";
}


if(!!$loginErrors) {
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