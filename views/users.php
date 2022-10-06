<?php include '../config/database.php' ?>
<?php

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn, $sql);

    if($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

?>