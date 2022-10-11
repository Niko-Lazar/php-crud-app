<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP - Simple CRUD app</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">PHP - Simple CRUD app</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../templates/users.php"> Users <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../templates/students.php">Students</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../templates/subjects.php" tabindex="-1" aria-disabled="true">Subjects</a>
                    </li>
                </ul>
            </div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../templates/change-password.php">Cahnge password</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href=" tabindex="-1" aria-disabled="true">tab</a>
                    </li>
                </ul>
            </div>
            <a href="../views/logout.php" class="btn btn-primary">
                        <i class="fas fa-sign-out-alt"></i>
            </a>
        </nav>