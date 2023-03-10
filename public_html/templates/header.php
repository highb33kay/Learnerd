<?php
// check if user is not logged in else redirect them to login page\
include '../inc/auth.php';
include_once '../config/constants.php';
$username = $_SESSION['username'];
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
            <?php if (isset($_SESSION['user_id'])) { ?>
                <div class="user-name"><?php echo $_SESSION['user_name']; ?></div>
                <div class="user-profile-pic">
                    <img src="<?php echo $_SESSION['user_profile_pic']; ?>" alt="Profile Picture">
                </div>
                <div class="log-out">
                    <a href="logout.php">Log Out</a>
                </div>
                <!-- drop down here -->
            <?php } ?>
        </div>
    </header>
    <div class="main">
        <div class="side-bar">
            <div>
                <i></i>
                <a href="">Dashboard</a>
            </div>
            <div>
                <i></i>
                <a href="">Courses</a>
            </div>
            <div>
                <i></i>
                <a href="">Assignments</a>
            </div>
            <div>
                <i></i>
                <a href="">Grades</a>
            </div>
        </div>
        <div class="main">

        </div>
    </div>