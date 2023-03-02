<style>
    <?php include '../assets/css/styles.css'; ?>
</style>
<?php

ini_set('display_errors', 1);
ini_set('error_log', 'log.txt');

require_once '/xampp/htdocs/Learnerd/public_html/config/conn.php';

// registration form for users
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm-password']);
$role = trim($_POST['role']);
$username_err = $password_err = $confirm_password_err = $role_err = '';

// processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // validate username
    if (empty($username)) {
        $username_err = 'Please enter a username.';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $username_err = 'Username can only contain letters, numbers, and underscores.';
    } else {
        if ($role === 'tutor') {
            $sql = 'SELECT tutor_id FROM tutor WHERE username = ?';
        } elseif ($role === 'student') {
            $sql = 'SELECT student_id FROM student WHERE username = ?';
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
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {
        // prepare an insert statement
        if ($role === 'tutor') {
            $sql = 'INSERT INTO `tutor` (`username`, `password`) VALUES (?, ?)';
        } elseif ($role === 'student') {
            $sql = 'INSERT INTO `student` (`username`, `password`) VALUES (?, ?)';
        } else {
            return false;
        }

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ss', $param_username, $param_password);

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

<body class="reg_body">
    <div class="login-cont">
        <!-- LINK TO HOMEPAGE AND ARROW ICON -->
        <div class="linkeds">
            <a href="../index.php">
                <i class="fas fa-arrow-left"></i>
                Home Page
            </a>
        </div>
        <div class="login-sec">
            <div class='login-img'>
                <h3>Welcome to LearNerd</h3>
                <p>Sign up to continue</p>
            </div>
            <div class='login-form'>
                <h3>
                    Register
                </h3>
                <p>Register with your email and password</p>
                <form class="login-form-div" action="<?php echo htmlspecialchars(
                                                            $_SERVER['PHP_SELF']
                                                        ); ?>" method="post">
                    <div class="form-group
                        <?php echo !empty($username_err) ? 'has-error' : ''; ?>">
                        <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo $username; ?>" required>
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($role_err)
                                                ? 'has-error'
                                                : ''; ?>">
                        <select id="role" name="role" required>
                            <option value="">Select your role</option>
                            <option value="tutor" <?php echo $role == 'tutor'
                                                        ? 'selected'
                                                        : ''; ?>>Tutor</option>
                            <option value="student" <?php echo $role == 'student'
                                                        ? 'selected'
                                                        : ''; ?>>Student</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <input type="email" id="confirm-email" name="confirm-email" placeholder="Confirm your email address" required>
                    </div>
                    <div class="form-group <?php echo !empty($password_err)
                                                ? 'has-error'
                                                : ''; ?>">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($confirm_password_err)
                                                ? 'has-error'
                                                : ''; ?>">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <button type="submit" class="btn-login">Register</button>
                </form>
                <div class="login-footer">
                    <p>I have an account? <a href="login.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a62f058421.js" crossorigin="anonymous"></script>
</body>