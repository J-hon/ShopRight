<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

    include_once 'controllers/Register.php';
    include_once 'controllers/Login.php';

    $login = new Login();
    $user = new Register();

    if ($login->get_session())
    {
        header('Location: index.php');
    }

    if (isset($_POST['register']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirm_password'];

        if ($password === $confirmPass)
        {
            if ($user->register($username, $password))
            {
                // registration successful
                header('Location: checkout.php');
            } else {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Please try again later!!", "", "error");';
                echo '});</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Passwords do not match!", "", "error");';
            echo '});</script>';
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC_SC Register User</title>
    <link rel="stylesheet" href="resources/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>

<div class="wrap">
    <form class="login-form" action="register.php" method="post">
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
        <div class="form-group">
            <label for="">Retype Password</label>
            <input type="password" name="confirm_password" class="form-input">
        </div>

        <!-- Login Button -->
        <div class="form-group">
            <button class="form-button" name="register" type="submit">
                Register
            </button>
        </div>

        <div class="form-footer">
            Registered? Click Here!
            <a href="login.php">
                Log in
            </a>
        </div>
    </form>
</div><!--/.wrap-->

</body>
</html>