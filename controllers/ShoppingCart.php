<?php

/**
 * The shopping cart model
 */

require_once "DB.php";

setlocale(LC_MONETARY,"en_US");

class ShoppingCart
{
    public $product_name;
    public $product_price;
    public $product_image;
    public $db;
    public $user;

    public function __construct()
    {
        $this->db = new DB();

    }

    // Add product to cart
    public function addProduct()
    {
           foreach($_POST as $key => $value)
           {
               $product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
           }

           $statement = $this->db->conn->prepare("SELECT name, price, image FROM products WHERE code=? LIMIT 1");
           $statement->bind_param('s', $product['product_code']);
           $statement->execute();
           $statement->bind_result($this->product_name, $this->product_price, $this->product_image);

           while($statement->fetch())
           {
               $product["product_name"] = $this->product_name;
               $product["product_price"] = $this->product_price;
               $product["product_image"] = $this->product_image;

               if(isset($_SESSION["products"]))
               {
                   if(isset($_SESSION["products"][$product['product_code']]))
                   {
                       $_SESSION["products"][$product['product_code']]["product_qty"] = $_SESSION["products"][$product['product_code']]["product_qty"] + $_POST["product_qty"];
                   } else {
                       $_SESSION["products"][$product['product_code']] = $product;
                   }
               } else {
                   $_SESSION["products"][$product['product_code']] = $product;
               }
           }

           $total_product = count($_SESSION["products"]);

           die(json_encode(array('products'=>$total_product)));
    }

    public function removeProduct()
    {
        # Remove products from cart
        $product_code  = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING);

        if(isset($_SESSION["products"][$product_code]))	{
            unset($_SESSION["products"][$product_code]);
        }

        $total_product = count($_SESSION["products"]);
        die(json_encode(array('products'=>$total_product)));
    }

    public function updateCartQuantity()
    {
        # Update cart product quantity
        if(isset($_GET["quantity"]) && $_GET["quantity"] > 0) {
            $_SESSION["products"][$_GET["update_quantity"]]["product_qty"] = $_GET["quantity"];
        }

        $total_product = count($_SESSION["products"]);
        die(json_encode(['products' => $total_product]));
    }

    public function clearCart()
    {
        unset($_SESSION['products']);
    }


}