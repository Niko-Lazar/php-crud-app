<?php

function sanitizeInput($input) {
    $input = trim($input);

    $input = stripslashes($input);

    $input = htmlspecialchars($input);

    return $input;
}

function hasOnlyLetters($input) : bool {
    $input = sanitizeInput($input);
    
    return !!preg_match("/^[a-zA-Z-']*$/", $input);
}

function loggedIn() : bool {
    if(empty($_SESSION['loggedUser'])) {
        return false;
    }
    return true;
}



?>