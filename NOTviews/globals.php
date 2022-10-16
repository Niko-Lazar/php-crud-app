<?php

function sanitizeInput($input) : string {
    $input = trim($input);

    $input = stripslashes($input);

    $input = htmlspecialchars($input);

    return $input;
}

function hasOnlyLetters($input) : bool {
    $input = sanitizeInput($input);
    
    return !!preg_match("/^[a-zA-Z-']*$/", $input);
}

function hasOnlyNumbers($input) : bool {
    $input = sanitizeInput($input);
    
    return !!preg_match('/^\+?\d+$/' , $input);
}

function hasOnlyLettersAndNumbers($input) : bool {
    $input = sanitizeInput($input);
    
    return !!preg_match("/^[-a-zA-Z0-9 .]+$/" , $input);
}

function loggedIn() : bool {
    if(empty($_SESSION['loggedUser'])) {
        return false;
    }
    return true;
}

function userRole() : string {
    return $_SESSION['loggedUser']['role'];
}

function actionMessage(string $msgFor, string $msgType) : array {

    switch($msgType) {
        case 'success':
            $msgContent = "{$msgFor} created successfully";
            $msgType = "alert-success";
            break;
        case 'warning':
            $msgContent = "{$msgFor} info updated";
            $msgType = "alert-warning";
            break;
        case 'danger':
            $msgContent = "{$msgFor} has been deleted";
            $msgType = "alert-danger";
            break;
    
        default:
            $msgContent = "";
            $msgType = "";
            break;
    }

    if(!$msgType && !$msgContent) {
        return [];
    }

    return [
        "msgContent" => $msgContent,
        "msgType" => $msgType,
    ];
}

function gradeMessages(string $msgType) : array {

    switch($msgType) {
        case 'success':
            $msgContent = "Grade submited";
            $msgType = "text-success";
            break;
        case 'danger':
            $msgContent = "Error in submiting grade";
            $msgType = "text-danger";
            break;
        default:
            $msgContent = "";
            $msgType = "";
            break;
    }

    return [
        "msgContent" => $msgContent,
        "msgType" => $msgType,
    ];
}



?>