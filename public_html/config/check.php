<?php
// check if logged in
if (isset($_SESSION['user_type'])) {
    header('location: ../index.php');
    exit();
}

// kill the session



ini_set('display_errors', 1);
ini_set('error_log', 'log.txt');

// Get the database connection
require_once 'conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the tutor table
    $tutor_query = "SELECT * FROM tutor WHERE tutor_email = '$email'";
    $tutor_result = mysqli_query($link, $tutor_query);

    // Query the student table if no result from tutor table
    if (mysqli_num_rows($tutor_result) === 0) {
        $student_query = "SELECT * FROM student WHERE student_email = '$email'";
        $student_result = mysqli_query($link, $student_query);

        // If there is a result in the student table, check the password
        if (mysqli_num_rows($student_result) > 0) {
            $student = mysqli_fetch_assoc($student_result);
            if (password_verify($password, $student['password'])) {
                // Log in the user
                session_start();
                $_SESSION['user_type'] = 'student';
                $_SESSION['email'] = $email;
                header('Location: student_dashboard.php');
                exit;
            }
        }
    } else {
        // If there is a result in the tutor table, check the password
        $tutor = mysqli_fetch_assoc($tutor_result);
        if (password_verify($password, $tutor['password'])) {
            // Log in the user
            session_start();
            $_SESSION['user_type'] = 'tutor';
            $_SESSION['email'] = $email;
            header('Location: tutor_dashboard.php');
            exit;
        }
    }

    // Display error message if no results in both tables
    echo "Invalid email or password.";
}
?>