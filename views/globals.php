<?php

function testInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function hasOnlyLetters($input) : bool {
    $input = testInput($input);
    if(!preg_match("/^[a-zA-Z-']*$/", $input)) {
        return false;
    }
    return true;
}

function loggedIn() : bool {
    if(empty($_SESSION['loggedUser'])) {
        return false;
    }
    return true;
}



?>