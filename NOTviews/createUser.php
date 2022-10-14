<?php include '../config/database.php' ?>
<?php require 'globals.php' ?>
<?php require 'inputChecks.php' ?>
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

$userErrorFields = checkUserFields();

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