<?php require '../config/database.php' ?>
<?php require 'globals.php' ?>
<?php require 'inputChecks.php' ?>
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

$userID = $_GET['id'];

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

$userErrorFields = checkUserFields();

if(!!$userErrorFields) {
    return;
}

$userValues = [
    $name = $_POST['name'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $hashedPassword = password_hash(sanitizeInput($_POST['password']), PASSWORD_DEFAULT),
    $userID,
];

$studentValues = [
    $name = $_POST['name'],
    $lastName = $_POST['lastName'],
    $email = sanitizeInput($_POST['email']),
    $oldEmail,
];


if($isStudent) { 
    $sqlStudent = "UPDATE students SET name=?, lastName=?, email=? WHERE email=?";
    
    $studentResult = createUpdate($conn, $sqlStudent, $studentValues, 'ssss');

    $sqlUser = "UPDATE users SET name=?, lastName=?, email=?, password=? WHERE id=?";
    
    $userResult = createUpdate($conn, $sqlUser, $userValues, 'sssss');

    $queryIsSuccessful = $studentResult && $userResult;

} else {
    $sqlUser = "UPDATE users SET name=?, lastName=?, email=?, password=? WHERE id=?";
    
    $queryIsSuccessful = createUpdate($conn, $sqlStudent, $userValues, 'sssss');
}

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

$_SESSION['flash_message'] = actionMessage('user', 'warning');

header('Location: ../templates/users.php');
exit();

?>