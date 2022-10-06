<?php

function testInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function hasOnlyLetters($input) {
    $input = testInput($input);
    if(!preg_match("/^[a-zA-Z-']*$/", $input)) {
        return false;
    }
    return true;
}



?>