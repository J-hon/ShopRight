<?php

    include_once 'includes/autoloader.inc.php';

    $cart = new ShoppingCart();

    // add product to cart
    if (isset($_POST["product_code"]))
    {
        $cart->addProduct();
    }

    // remove product from cart
    if(isset($_GET["remove_code"]) && isset($_SESSION["products"]))
    {
        $cart->removeProduct();
    }

    // update quantity of products in cart
    if(isset($_GET["update_quantity"]) && isset($_SESSION["products"]))
    {
        $cart->updateCartQuantity();
    }

    // clear products in cart
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == 'clear')
        {
            $cart->clearCart();
            header('Location: cart.php');
        }
    }