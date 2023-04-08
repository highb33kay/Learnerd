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

$user_id = $_SESSION['user_id'];
$sql = "SELECT filename FROM usermeta WHERE user_id = '$user_id'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
$filename = $row['filename'];

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<!-- the body -->

<body>
    <header>
        <div class="site-title">
            <a href="../index.php"><?php echo $site_title; ?></a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="dropdown user-profile-dropdown">
                    <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" role="button" id="user-profile-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-profile-pic me-2">
                            <img src="<?= '../assets/uploads/' . $filename; ?>" alt="Profile Picture">
                        </div>
                        <span class="text-nowrap">Hello, <?php echo $_SESSION['username']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-profile-dropdown">
                        <?php if ($_SESSION['user_type'] == 'tutor') : ?>
                            <li><a class="dropdown-item" href="../instructor/dash.php">Dashboard</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="../student/dash.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="../templates/edit-profile.php">Edit Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>