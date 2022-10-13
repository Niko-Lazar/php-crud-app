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

function actionMessage(string $msgFor) : array {

    $msgContent = $_GET["{$msgFor}-action"] ?? '';

    $msgType = '';

    switch($msgContent) {
        case '0':
            $msgContent = "{$msgFor} created successfully";
            $msgType = "alert-success";
            break;
        case '1':
            $msgContent = "{$msgFor} info updated";
            $msgType = "alert-warning";
            break;
        case '2':
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
        'msgType' => $msgType,
    ];
}

?>