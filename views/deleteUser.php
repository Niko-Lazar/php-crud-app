<?php

if($_SERVER["REQUEST_METHOD"] == 'POST') {
    
    $userID = $_REQUEST['id'];
    
    $sql = "DELETE FROM users WHERE id=${userID}";

    $queryIsSuccessful = $conn->query($sql) === TRUE;
    
    if(!$queryIsSuccessful) {
        echo "Error deleting user " . $conn->error;
    }
    header('Location: korisnici.php');
    exit();
}




?>