<?php require '../config/database.php' ?>
<?php require 'globals.php' ?>

<?php

$userID = $_REQUEST['id'];

$sql = "SELECT * FROM users WHERE id=${userID}";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_array($result);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $lastName = $email = $password = $role = '';
    $nameErr = $lastNameErr = $emailErr = $passwordErr = $roleErr = '';

    if(isset($_POST['submit'])) {
        if(empty($_POST['name']) || hasOnlyLetters($_POST['name']) === false) {
            $nameErr = "Please enter a valid name";
        }
        if(empty($_POST['lastName']) || hasOnlyLetters($_POST['lastName']) === false) {
            $lastNameErr = "Plase enter a valid last name";
        }
        if(empty($_POST['email'])) {
            $emailErr = "Plase enter a valid email";
        }
        if(empty($_POST['password'])) {
            $passwordErr = "Plase enter a valid password";
        }
        if(empty($_POST['role']) || hasOnlyLetters($_POST['role']) === false) {
            $roleErr = "Plase select a role";
        }
    
        $allInputsAreValid = (empty($nameErr) && empty($lastNameErr) && empty($emailErr) && empty($passwordErr) && empty($roleErr));
    
        if($allInputsAreValid) {
            $name = $_POST['name'];
            $lastName = $_POST['lastName'];
            $email = testInput($_POST['email']);
            $password = testInput($_POST['password']);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = $_POST['role'];

            $sql = "UPDATE users SET name='$name', lastName='$lastName', email='$email', password='$hashedPassword', role='$role' WHERE id=$userID";
            
            $queryIsSuccessful = mysqli_query($conn, $sql);

            if(!$queryIsSuccessful) {
                echo 'Error ' . mysqli_error($conn);
            }
            header('Location: ../templates/users.php?user-action=1');
            exit();
        }
    }
}



?>