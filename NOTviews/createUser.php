<?php require 'globals.php' ?>
<?php include '../config/database.php' ?>
<?php require 'queries.php'; ?>

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

$values = [
    $name = $_POST['name'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $hashedPassword = password_hash(sanitizeInput($_POST['password']), PASSWORD_DEFAULT),
    $role = $_POST['role'],
];

$sql = "INSERT INTO users (name, lastName, email, password, role) VALUES (?, ?, ?, ?, ?)";
$userCreated = createUpdate($conn, $sql, $values, 'sssss');

if(!$userCreated) {
    echo 'Error ' . mysqli_error($conn);
    return;
}

$_SESSION['flash_message'] = actionMessage('user', 'success');

header('Location: ../templates/users.php');

exit();

?>