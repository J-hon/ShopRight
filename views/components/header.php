<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>ABC Shopping cart</title>

</head>

<body>

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
                        } else {
                            echo 0;
                        }

                    ?>

                </span>
            </a>
        </div>
    </nav>