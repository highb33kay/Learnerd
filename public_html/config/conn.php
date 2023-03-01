<!-- connect to database --<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'learnerd');

if (!$conn) {
    die('Connection to DB Failed' . mysqli_error());
}

echo 'Connected successfully';
?>s