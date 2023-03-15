<?php
// ini_set('display_errors', 0);
// ini_set('error_log', 'log.txt');
?>

<?php require '../config/check.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css?ver=<?php echo date('ymdhis'); ?>"  >
</head>

<body>
    <div class=" login-cont">
        <a href="../index.php">
            <i class="fas fa-arrow-left"></i>
            Home Page
        </a>
        <div class="login-sec">
            <div class='login-img'>
                <h3>Welcome Back to LearNerd</h3>
                <p>Sign in to continue</p>
            </div>
            <div class='login-form'>
                <h3>
                    Login
                </h3>
                <p>Sign in with your email and password</p>
                <form class="login-form-div" action="login.php" method="POST">

                    <div class="form-group <?php echo !empty($login_err) ? 'has-error' : ''; ?>">
                        <input type="email" name="email" id="email" placeholder="Email">
                        <span class="help-block"><?php echo $login_err; ?></span>
                    </div>
                    <div class="form-group <?php echo !empty($login_err) ? 'has-error' : ''; ?>">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <span class="help-block"><?php echo $login_err; ?></span>
                    </div>
                    <div class="form-row">
                        <label for="remember-me-checkbox">
                            <input type="checkbox" id="remember-me-checkbox" name="remember-me">
                            <span>Remember Me</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="btn-login">Login</button>
                    </div>
                </form>
                <div class="error-message">
                    <?php if (isset($_POST['email']) && isset($_POST['password']) && mysqli_num_rows($tutor_result) === 0 && mysqli_num_rows($student_result) === 0) : ?>
                        Invalid email or password.
                    <?php endif; ?>
                </div>
                <div class="login-footer">
                    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                </div>

            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a62f058421.js" crossorigin="anonymous"></script>
</body>

</html>