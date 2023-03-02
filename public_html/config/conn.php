<!-- connect to database --<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$link = mysqli_connect($dbhost, $dbuser, $dbpass, 'learnerd');

if (!$link) {
    die('Connection to DB Failed' . mysqli_error());
}

echo 'Connected successfully';
?>s