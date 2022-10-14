<?php require '../config/database.php' ?>
<?php require 'globals.php' ?>

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

$sql = "SELECT * FROM users WHERE id=${userID}";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_array($result);

if($user['role'] == 'student') {
    $oldEmail = $user['email'];
    $isStudent = true;
}


if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
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