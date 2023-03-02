
<style><?php include '../assets/css/styles.css'; ?></style>
<?php include '/xampp/htdocs/Learnerd/public_html/inc/functions.php' ?>
<body>
    <div class="login-cont">
        <!-- LINK TO HOMEPAGE AND ARROW ICON -->
        <a href="../index.php">
            <i class="fas fa-arrow-left"></i>
            Home Page
        </a>
        <div class="login-sec">
            <div class='login-img'>
                <h3>Welcome  to LearNerd</h3>
                <p>Sign up to continue</p>
            </div>
            <div class='login-form'>
                <h3>
                    Register
                </h3>
                <p>Register in with your email and password</p>
                <form class="login-form-div" action="<?php echo htmlspecialchars(
                    $_SERVER['PHP_SELF']
                ); ?>" method="post">
                    <div class="form-group">
                        <?php echo !empty($username_err)
                            ? 'has-error'
                            : ''; ?>
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
                    <div class="form-group <?php echo !empty(
                        $confirm_password_err
                    )
                        ? 'has-error'
                        : ''; ?>">
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <button type="submit"class="btn-login">Register</button>
                </form>
                <div class="login-footer">
                    <p>I have an account? <a href="login.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a62f058421.js" crossorigin="anonymous"></script>
</body>

