<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once '/xampp/htdocs/Learnerd/public_html/config/conn.php';


// registration form for users
$username = trim($_POST['username']); 
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm-password']);
$role =  trim($_POST['role']);
$username_err = $password_err = $confirm_password_err = $role = '';

// processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // validate username
    if (empty($username)) {
        $username_err = 'Please enter a username.';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $username_err =
            'Username can only contain letters, numbers, and underscores.';
    } else {

        if ($_POST[$role] === 'tutor') {
            $sql = 'SELECT id FROM tutor WHERE username = ?';
        } elseif ($role === 'student') {
            $sql = 'SELECT id FROM students WHERE username = ?';
        } else {
            return false;
        }
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $param_username);

            // set parameters
            $param_username = $username;

            // attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = 'This username is already taken.';
                } else {
                    $username = $username;
                }
            } else {
                echo 'Oops! Something went wrong. Please try again later.';
            }
            mysqli_stmt_close($stmt);
        };
    };

    // validate password
    if (empty($password)) {
        $password_err = 'Please enter a password.';
    } elseif (strlen($password) < 6) {
        $password_err = 'Password must have at least 6 characters.';
    } else {
        $password = $password;
    }

    // validate confirm password
    if (empty($confirm_password)) {
        $confirm_password_err = 'Please confirm password.';
    } else {
        $confirm_password = $confirm_password;
        if (empty($password_err) && $password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }

    // validate role
    if (empty($role)) {
        $role_err = 'Please select a role.';
    } else {
        $role = $role;
    }

    // check input errors before inserting in database
    if (
        empty($username_err) &&
        empty($password_err) &&
        empty($confirm_password_err) &&
        empty($role_err)
    ) {
        // prepare an insert statement
        if ($_POST[$role] === 'tutor') {
            $sql = 'INSERT INTO `tutor` (`username`, `password`, `role`) VALUES (?, ?, ?)';
        } elseif ($role === 'student') {
            $sql = 'INSERT INTO `student` (`username`, `password`, `role`) VALUES (?, ?, ?)';
        } else {
            return false;
        }
        // $sql = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param(
                $stmt,
                'sss',
                $param_username,
                $param_password,
                $param_role
            );

            // set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;

            // attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // redirect to login page
                header('location: login.php');
            } else {
                echo 'Something went wrong. Please try again later.';
            }
            mysqli_stmt_close($stmt);
        }
    }
    // close connection
    mysqli_close($link);
}
?>
