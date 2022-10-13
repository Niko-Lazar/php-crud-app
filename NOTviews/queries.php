<?php

function select(object $conn, string $tableName) : array {
    $tableName = $conn->real_escape_string($tableName);
    
    $sql = "SELECT * FROM {$tableName}";

    $result = $conn->query($sql);

    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

function selectByCondition(object $conn, string $query, array $conditions, array $types) : array {

    $query = $conn->real_escape_string($query);

    $queryCondtions = implode(',', $conditions);
    $queryTypes = implode(',', $types);
    
    $queryCondtions = $conn->real_escape_string($queryCondtions);

    $statement = $conn->prepare($query);

    $statement->bind_param($queryTypes, ...$conditions);

    $statement->execute();

    $result = $statement->get_result();

    $data = $result->fetch_assoc();

    return $data;
}


function delete(object $conn, string $tableName, int $id) : bool {
    $tableName = $conn->real_escape_string($tableName);

    $sql = "DELETE FROM {$tableName} WHERE id = ?";

    $statement = $conn->prepare($sql);

    $statement->bind_param('i', $id);

    $result = $statement->execute();

    return $result;
}

function deleteByCondition(object $conn, string $query, array $conditions, array $types) : bool {
    $query = $conn->real_escape_string($query);

    $queryCondtions = implode(',', $conditions);
    $queryTypes = implode(',', $types);

    $queryCondtions = $conn->real_escape_string($queryCondtions);

    $statement = $conn->prepare($query);

    $statement->bind_param($queryTypes, ...$conditions);

    $result = $statement->execute();

    return $result;
}




?>