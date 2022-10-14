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

$userID = $_REQUEST['id'];

$sql = "SELECT * FROM users WHERE id=?";

$user = selectByCondition($conn, $sql, $userID, 's');

if($user['role'] == 'student') {
    $oldEmail = $user['email'];
    $isStudent = true;
}


if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST['submit'])) {
    return;
}

$userErrorFields = [];

if(!$_POST['name'] || !hasOnlyLetters($_POST['name'])) {
    $userErrorFields['name'] = "Please enter a valid name";
}
if(!$_POST['lastName'] || !hasOnlyLetters($_POST['lastName'])) {
    $userErrorFields['lastName'] = "Plase enter a valid last name";
}
if(!$_POST['email']) {
    $userErrorFields['email'] = "Plase enter a valid email";
}
if(!$_POST['password']) {
    $userErrorFields['password'] = "Plase enter a valid password";
}
if(!$_POST['role'] || !hasOnlyLetters($_POST['role'])) {
    $userErrorFields['role'] = "Plase select a role";
}

if(!!$userErrorFields) {
    return;
}

$name = $_POST['name'];
$lastName = $_POST['lastName'];
$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = $_POST['role'];

if($isStudent) {
    $conn->autocommit(FALSE);
    
    $conn->query("UPDATE students SET name='$name', lastName='$lastName', email='$email' WHERE email='$oldEmail'");
    $conn->query("UPDATE users SET name='$name', lastName='$lastName', email='$email', password='$hashedPassword', role='student' WHERE id=$userID");

    $queryIsSuccessful = $conn->commit();
    $conn -> close();

} else {
    $sql = "UPDATE users SET name='$name', lastName='$lastName', email='$email', password='$hashedPassword', role='$role' WHERE id=$userID";

    $queryIsSuccessful = mysqli_query($conn, $sql);
}

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('user', 'warning');

header('Location: ../templates/users.php');
exit();

?>