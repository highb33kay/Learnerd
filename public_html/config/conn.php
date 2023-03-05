<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'learnerd';
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$link) {
    die('Connection to DB Failed: ' . mysqli_connect_error());
}

// echo 'Connected successfully';
