<?php

    include_once 'controllers/Login.php';

    $user = new Login();
    $id = $_SESSION['id'];

    if (!$user->get_session())
    {
        header("Location: index.php");
    }

    if (isset($_GET['q']))
    {
        $user->user_logout();
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC_SC User logout</title>
    <link rel="stylesheet" href="resources/css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
</head>
<body>

    <div class="wrap">

        <!-- Login Button -->
        <div class="form-group">
            <h1>
                Goodbye <?php $user->get_username($id); ?>
            </h1>

            <a href="login.php?q=logout">
                Logout
            </a>
        </div>
    </div>

</body>
</html>