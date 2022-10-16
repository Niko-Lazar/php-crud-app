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

$gradesErrorFields = checkGradingFields();

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

if(!$studentGraded) {
    $_SESSION['flash_message'] = gradeMessages('danger');

    return;
}

// calc espb & gpa
$sqlESPB = "SELECT SUM(espb) AS ESPB FROM subjects WHERE id IN (SELECT subjectID FROM grades WHERE studentID=?)";

$ESPBresult = selectByCondition($conn, $sqlESPB, $studentID, 's');

$sqlGPA = "SELECT AVG(grade) AS GPA FROM grades WHERE studentID=?";

$GPAresult = selectByCondition($conn, $sqlGPA, $studentID, 's');

$sqlUpdateStudent = "UPDATE students SET GPA=?, ESPB=? WHERE id = ?";

$updateStudentValues = [
    $GPAresult['GPA'],
    $ESPBresult['ESPB'],
    $studentID,
];

$updateStudentResult = createUpdate($conn, $sqlUpdateStudent, $updateStudentValues, "sss");

if(!$updateStudentResult) {
    return;
}

$_SESSION['flash_message'] = gradeMessages('success');

header("Location: ../templates/student.php?id={$studentID}");
exit();


?>