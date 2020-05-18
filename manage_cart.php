<?php

    include_once 'includes/autoloader.inc.php';

    $cart = new ShoppingCart();

        if (isset($_POST["product_code"]))
        {
            $cart->addProduct();
        }

        if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
        {
            $cart->removeProduct();
        }

        if(isset($_GET["update_quantity"]) && isset($_SESSION["products"]))
        {
            $cart->updateCartQuantity();
        }

        if (isset($_GET['action']))
        {
            if ($_GET['action'] == 'clear')
            {
                $cart->clearCart();
                header('Location: cart.php');
            }
        }
