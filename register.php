<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

    include_once 'includes/autoloader.inc.php';

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

        // check if password and confirm password match
        if ($password === $confirmPass)
        {
            if ($user->registerUser($username, $password))
            {
                // registration successful
                header('Location: login.html');
            }
        // passwords failed check
        }
        else {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Passwords do not match!", "", "error");';
            echo '});</script>';
            header( "Refresh: 1; url = register.html", true, 303);
        }
    }