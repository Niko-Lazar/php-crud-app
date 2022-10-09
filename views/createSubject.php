<?php include '../config/database.php' ?>
<?php require 'globals.php' ?>

<?php

$subjectCode = $name = $yearOfStudy = $ESPB = $mandatory = '';
$subjectCodeErr = $nameErr = $yearOfStudyErr = $ESPBErr = $mandatoryErr = '';

if(!isset($_POST['submit'])) {
    return;
}

if(!$_POST['subjectCode'] || !hasOnlyNumbers($_POST['subjectCode'])) {
    $subjectCodeErr = "Please enter a valid subject code";
}
if(!$_POST['name'] || !hasOnlyLettersAndNumbers($_POST['name'])) {
    $nameErr = "Please enter a valid subject name";
}
if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
    $yearOfStudyErr = "Please enter a valid year of study";
}
if(!$_POST['ESPB'] || !is_numeric($_POST['ESPB'])) {
    $ESPBErr = "Please enter a valid ESPB number";
}
if(!$_POST['mandatory'] && ($_POST['mandatory'] != 0 && $_POST['mandatory'] != 1)) {
    $mandatoryErr = "Please select a valid subject type";
}

$allInputsAreValid = !$subjectCodeErr && !$nameErr && !$yearOfStudyErr && !$ESPBErr && !$mandatoryErr;

if(!$allInputsAreValid) {
    return;
}

$subjectCode = $_POST['subjectCode'];
$name = $_POST['name'];
$yearOfStudy = $_POST['yearOfStudy'];
$ESPB = $_POST['ESPB'];
$mandatory = sanitizeInput($_POST['mandatory']);

$sql = "INSERT INTO subjects (subjectCode, name, yearOfStudy, ESPB, mandatory)";
$sql .= "VALUES ('$subjectCode', '$name', '$yearOfStudy', '$ESPB', '$mandatory')";

$queryIsSuccessful = mysqli_query($conn, $sql);

if(!$queryIsSuccessful) {
    echo 'Error ' . mysqli_error($conn);
}

header('Location: ../templates/subjects.php?subject-action=0');
exit();

?>