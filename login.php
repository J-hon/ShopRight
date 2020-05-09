<?php

    include_once 'controllers/Login.php';
    $user = new Login();

    if (isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = $user->check_login($username, $password);
        if ($login)
        {
            // Login successful to desired page
            header('Location:'.$_SESSION['redirectURL']);
        } else {
            // Login failed
            echo "<script type='text/javascript'>alert('Username Or Password Invalid!');</script>";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC_SC User login</title>
    <link rel="stylesheet" href="resources/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrap">
    <form class="login-form" action="login.php" method="post">
        <div class="form-header">
            <h3>Login Form</h3>
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-input">
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-input">
        </div>

        <!-- Login Button -->
        <div class="form-group">
            <button class="form-button" name="login" type="submit">
                Login
            </button>
        </div>

        <div class="form-footer">
            Don't have an account?
            <a href="register.php">
                Sign Up
            </a>
        </div>
    </form>
</div><!--/.wrap-->

</body>
</html>