<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://api.fontshare.com/v2/css?f[]=archivo@100,300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/login.css" />
</head>
<body>
<?php
session_start();

// Redirect to profile page if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: myprofile.php");
    exit();
}
?>
<div class="containerlogin" id="containerlogin">
    <div class="form-container sign-up">
        <form action="signup.php" method="post">
            <h1>Create Account</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <input type="text" placeholder="Name" name="name" required />
            <input type="email" placeholder="Email" name="email" required />
            <div class="input-container">
                <input type="password" placeholder="Password" id="signup-password" name="password" required />
                <span class="passs-icon" onclick="togglePasswordVisibility('signup-password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>
            <button class="btn">Sign Up</button>
        </form>
    </div>

    <div class="form-container sign-in">
        <form action="signin.php" method="post">
            <h1>Sign In</h1>
            <div class="social-icons">
                <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
            <span>or use your email and password</span>

            <!-- Display error message if any -->
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message" style="color: red;">
                    <?php
                    echo $_SESSION['error'];
                    // Clear the error after displaying it
                    $_SESSION['error'] = '';
                    ?>
                </div>
            <?php endif; ?>

            <input type="email" placeholder="Email" name="email" required />
            <div class="input-container">
                <input type="password" placeholder="Password" id="signin-password" name="password" required />
                <span class="passs-icon" onclick="togglePasswordVisibility('signin-password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>
            </div>
            <a href="#">Forget Password?</a>
            <button class="btn">Sign In</button>
        </form>
    </div>

    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Back to BookHub</h1>
                <p>Enter your personal details to buy books.</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Hello, Booklover</h1>
                <p>Register with your personal details to buy books.</p>
                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script src="src/login.js"></script>
<script src="src/main.js"></script>
</body>
</html>