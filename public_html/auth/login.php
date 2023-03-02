
<style><?php include '../assets/css/styles.css'; ?></style>
<?php  ?>
<body>
    <div class="login-cont">
        <!-- LINK TO HOMEPAGE AND ARROW ICON -->
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
                <form class="login-form-div">
                    <!-- registration form -->
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password">
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
                <div class="login-footer">
                    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a62f058421.js" crossorigin="anonymous"></script>
</body>
