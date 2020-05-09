<?php

    include_once 'controllers/Register.php';
    $user = new Register();

    if (isset($_POST['register']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
//        $confirmPass = $_POST['confirm_password'];


            if ($user->register($username, $password))
            {
                echo "<script>alert('Successful!');</script>";
                header('Location: index.php');
            } else {
                echo "<script>alert('Please, try again later!');</script>";
            }

    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC_SC User Register</title>
    <link rel="stylesheet" href="resources/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrap">
    <form class="login-form" action="login.php" method="post">
        <div class="form-header">
            <h3>Registration Form</h3>
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

        <!-- Password Input -->
<!--        <div class="form-group">-->
<!--            <label for="">Retype Password</label>-->
<!--            <input type="password" name="confirm_password" class="form-input">-->
<!--        </div>-->

        <!-- Login Button -->
        <div class="form-group">
            <button class="form-button" name="register" type="submit">
                Register
            </button>
        </div>

        <div class="form-footer">
            Already registered! Click Here!
            <a href="login.php">
                Log in
            </a>
        </div>
    </form>
</div><!--/.wrap-->

</body>
</html>