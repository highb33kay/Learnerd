<?php
// check if user is not logged in else redirect them to login page\
include '../inc/auth.php';
include_once '../config/constants.php';
$username = $_SESSION['username'];

// Get the database connection
ini_set('display_errors', 1);
ini_set('error_log', 'log.txt');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/dash.css">
</head>

<body>
    <header>
        <div class="site-title">
            <a href="index.php"><?php echo $site_title; ?></a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="user-name"><?php echo $_SESSION['username']; ?></div>
                <div class="user-profile-dropdown">
                    <a href="edit_prof.php"> Hello
                        <div class="user-profile-pic">
                            <img src="<?php echo $_SESSION['user_profile_pic']; ?>" alt="Profile Picture">
                        </div>
                    </a>
                    <div class="dropdown-content">
                        <a href="edit-profile.php">Edit Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </header>