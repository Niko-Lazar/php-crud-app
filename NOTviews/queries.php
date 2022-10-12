<?php


function selectTable(string $tableName, object $conn){
    $sql = "SELECT * FROM {$tableName}";

    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return;
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>