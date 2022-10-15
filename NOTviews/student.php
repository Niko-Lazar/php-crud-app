<?php require '../config/database.php' ?>
<?php require 'globals.php' ?>
<?php require 'inputChecks.php' ?>
<?php require 'queries.php' ?>



<?php

if(!loggedIn()) {
    header('Location: login.php');
    exit();
}

if(userRole() != "administrator" && userRole() != 'profesor') {
    header('Location: students.php');
    exit();
}

$studentID = $_GET['id'];

$sql = "SELECT * FROM students WHERE id=?";
$student = selectByCondition($conn, $sql, $studentID, 's');

$subjects = select($conn, 'subjects');

if($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}

if(!isset($_POST['submit'])) {
    return;
}

$gradesErrorFields = [];

if(!$_POST['subjectID'] || !is_numeric($_POST['subjectID'])) {
    $gradesErrorFields['subjectID'] = "Please select a valid subject";
}

if(!$_POST['grade'] || !is_numeric($_POST['grade'])) {
    $gradesErrorFields['grade'] = "Please enter a valid grade";
}

if(!$_POST['date']) {
    $gradesErrorFields['date'] = "Please select a valid date";
}

if(!!$gradesErrorFields) {
    return;
}

$studentID = $_GET['id'];

$gradeValues = [
    $studentID,
    $_POST['subjectID'],
    $_POST['grade'],
    $_POST['date'],
];

$sqlGrade = "INSERT INTO grades (studentID, subjectID, grade, date) VALUES (?, ?, ?, ?)";

$studentGraded = createUpdate($conn, $sqlGrade, $gradeValues, 'ssss');


var_dump($gradesErrorFields);

if(!$studentGraded) {
    echo 'Error ' . mysqli_error($conn);
}

header("Location: ../templates/student.php?id={$studentID}");

exit();

?>