<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

    include_once 'includes/autoloader.inc.php';
    $user = new Login;

    if ($user->get_session())
    {
        header('Location: index.php');
    }

    if (isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login = $user->login($username, $password);

        if ($login)
        {
            // Login successful to desired page
            header('Location:' . $_SESSION['redirectURL']);
        }
        else {
            // Login failed
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Invalid credentials!", "", "error");';
            echo '});</script>';
            header( "Refresh: 1; url = login.html", true, 303);
        }
    }