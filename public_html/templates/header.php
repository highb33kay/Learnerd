<?php

/** @noinspection ALL */
// check if user is not logged in else redirect them to login page\
require '../inc/auth.php';
require '../config/constants.php';
require '../config/conn.php';
$username = $_SESSION['username'];

// error reporting
ini_set('display_errors', 1);
ini_set('error_log', 'log.txt');

$query = " select * from image ";
$result = mysqli_query($link, $query);

while ($data = mysqli_fetch_assoc($result)) {
?>
    <img src="../assets/uploads/<?php echo $data['filename']; ?>" alt="Profile Picture">

<?php
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="site-title">
            <a href="../index.php"><?php echo $site_title; ?></a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['username'])) { ?>
                <!-- <div class="user-name"><?php echo $_SESSION['username']; ?></div> -->
                <div class="dropdown user-profile-dropdown">
                    <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" role="button" id="user-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-profile-pic me-2">
                            <?php
                            $result = mysqli_query($link, $query);

                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <img src="./image/<?php echo $data['filename']; ?>" alt="Profile Picture">

                            <?php
                            }
                            ?>
                        </div>
                        <span class="text-nowrap">Hello, <?php echo $_SESSION['username']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-profile-dropdown">
                        <li><a class="dropdown-item" href="edit-profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>