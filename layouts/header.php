<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="icon" type="image/png" sizes="512x512" href="assets/img/favicon.png">
    <title>ABC Shopping cart</title>

</head>

<body>

<?php

    include_once 'includes/autoloader.inc.php';
    $user = new Login();

    if ($user->get_session())
    {

?>

        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand" href="index.php">
                ABC SC
            </a>

            <div>
                <a href="cart.php">
                    <i class="fas fa-shopping-bag fa-2x"></i>
                    <span class='badge badge-warning' id='cart-container'>

                        <?php

                            if(isset($_SESSION["products"]))
                            {
                                echo count($_SESSION["products"]);
                            }
                            else {
                                echo 0;
                            }

                        ?>

                    </span>
                </a>
            </div>

            <?php
            
                $currentBalance = $user->showRemainingBalance();
                $currency = $user->getCurrency();

                if($currentBalance <= 30)
                {

            ?>

            <h6 class="font-weight-bolder" style="color: #C82333">
                Current balance:
                <?php echo $currency . $currentBalance; ?>
            </h6>

            <?php

                }
                else if ($currentBalance > 30 && $currentBalance <= 70) {

            ?>

            <h6 class="font-weight-bolder" style="color: #E0A800">
                Current balance:
                <?php echo $currency . $currentBalance; ?>
            </h6>

            <?php

                }
                else {

                    ?>

                    <h6 class="font-weight-bolder" style="color: #28A745">
                        Current balance:
                        <?php echo $currency . $currentBalance; ?>
                    </h6>

                    <?php
                }

            ?>


            <a href="logout.php" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </nav>

<?php

    }
    else {

?>

    <nav class="navbar navbar-light bg-light justify-content-between">
        <a class="navbar-brand" href="index.php">
            ABC SC
        </a>

        <div>
            <a href="cart.php">
                <i class="fas fa-shopping-bag fa-2x"></i>
                <span class='badge badge-warning' id='cart-container'>

                    <?php

                        $_SESSION['redirectURL'] = 'index.php';

                        if (isset($_SESSION["products"]))
                        {
                            echo count($_SESSION["products"]);
                        }
                        else {
                            echo 0;
                        }

                    ?>

                </span>
            </a>
        </div>

        <a href="login.html" class="btn btn-outline-success">
            <i class="fas fa-sign-in-alt"></i>
            Login
        </a>
    </nav>

<?php
    }
?>