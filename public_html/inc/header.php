<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <header>
        <h1>LearNerd</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">Courses</a></li>
                <li><a href="contact.php">FAQ</a></li>
                <li><a href="contact.php">Blog</a></li>
            </ul>

        </nav>
        <?php if (!isset($_SESSION['user_id'])) {
            echo '<a href="./auth/login.php"><button class="btn-header">Login</button></a>';
        } else {
            echo '<button class="btn-header">Logout</button>';
        } ?>
    </header>
