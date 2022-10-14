<?php

function checkStudentFields() : array {

    $studentErrorFields = [];

    if(!$_POST['indexNumber'] || !hasOnlyLettersAndNumbers($_POST['indexNumber'])) {
        $studentErrorFields['indexNumber'] = "Please enter a valid index number";
    }
    if(!$_POST['name'] || !hasOnlyLetters($_POST['name'])) {
        $studentErrorFields['name'] = "Please enter a valid name";
    }
    if(!$_POST['parentsName'] || !hasOnlyLetters($_POST['parentsName'])) {
        $studentErrorFields['parentsName'] = "Please enter a valid parent's name";
    }
    if(!$_POST['lastName'] || !hasOnlyLetters($_POST['lastName'])) {
        $studentErrorFields['lastName'] = "Please enter a valid last name";
    }
    if(!$_POST['email']) {
        $studentErrorFields['email'] = "Please enter a valid email adress";
    }
    if(!$_POST['phoneNumber'] || !hasOnlyNumbers($_POST['phoneNumber'])) {
        $studentErrorFields['phoneNumber'] = "Please enter a valid phone number";
    }
    if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
        $studentErrorFields['yearOfStudy'] = "Please enter a valid year of study";
    }
    if(!$_POST['dateOfBirth']) {
        $studentErrorFields['dateOfBirth'] = "Please enter a valid date of birth";
    }
    if(!$_POST['IDnumber'] || !is_numeric($_POST['IDnumber'])) {
        $studentErrorFields['IDnumber'] = "Please enter a valid ID number";
    }

    return $studentErrorFields;
}

function checkSubjectFields() : array {
    $subjectErrorFields = [];

    if(!$_POST['subjectCode'] || !hasOnlyNumbers($_POST['subjectCode'])) {
        $subjectErrorFields['subjectCode'] = "Please enter a valid subject code";
    }
    if(!$_POST['name'] || !hasOnlyLettersAndNumbers($_POST['name'])) {
        $subjectErrorFields['name'] = "Please enter a valid subject name";
    }
    if(!$_POST['yearOfStudy'] || !is_numeric($_POST['yearOfStudy'])) {
        $subjectErrorFields['yearOfStudy'] = "Please enter a valid year of study";
    }
    if(!$_POST['ESPB'] || !is_numeric($_POST['ESPB'])) {
        $subjectErrorFields['ESPB'] = "Please enter a valid ESPB number";
    }
    if(!$_POST['mandatory'] && ($_POST['mandatory'] != 0 && $_POST['mandatory'] != 1)) {
        $subjectErrorFields['mandatory'] = "Please select a valid subject type";
    }

    return $subjectErrorFields;
}

function checkUserFields() : array {
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

    return $userErrorFields;
}


?>