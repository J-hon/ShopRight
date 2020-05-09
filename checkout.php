<?php

    error_reporting(0);
    include 'views/components/header.php';

    require_once "controllers/DB.php";
    require_once "controllers/Checkout.php";

    $db = new DB();
    $checkout = new Checkout();

    if (($_SESSION['login']) == FALSE)
    {
        $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }

    if (isset($_POST['radioGroup'])) {
        $shipping_cost = $checkout->getShippingCost();
    }

?>

<div class="container">	
    <h3 style="text-align: center">Order Summary</h3>
    <br>
    <?php

        if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
            $cart_box = '';
            $user_id = $_SESSION['id'];

            $query0 = "SELECT * FROM `users` WHERE id ='$checkout->user_id'";
            $res = $checkout->db->runQuery($query0);
            $row = $checkout->db->fetchArray($res);
            $user_bal = $row['current_balance'];

            if ($_POST['ship_address']) {
                $address = "<p class='font-weight-light'>
                                Shipping address: ".$_POST['ship_address'].
                            "</p>";
            } else {
                $address = '';
            }
    ?>

    <table class="table table-striped" id="shopping-cart-results">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>

            <?php

                foreach($_SESSION["products"] as $product){
                    $product_name = $product["product_name"];
                    $product_qty = $product["product_qty"];
                    $product_price = $product["product_price"];
                    $product_code = $product["product_code"];

                    $item_price = sprintf("%01.2f",($product_price * $product_qty));
            ?>

            <tr>
                <td>
                    <?php echo $product_name; ?>
                </td>

                <td>
                    <?php echo $db->currency; echo sprintf("%01.2f", $product_price); ?>
                </td>

                <td>
                    <?php echo $product_qty; ?>
                </td>

                <td>
                    <?php echo $checkout->db->currency; echo sprintf("%01.2f", ($product_price * $product_qty)); ?>
                </td>

                <td>&nbsp;</td>
            </tr>

            <?php

                // calculate cost total of products.
                $checkout->getTotal($product_price, $product_qty, $shipping_cost);

            }

                // get remaining balance.
                $checkout->bal = $user_bal - $checkout->total;

                // allow transaction only if order total <= current balance
                $checkout->limit();

                // insert data into orders table
                $checkout->saveOrder();

                // update user current balance
                $checkout->updateBal();

                // display order details
                $shipping_cost = 'Shipping Cost '.$db->currency. sprintf("%01.2f", $shipping_cost).'<br />';
                $cart_box .= "<span>
                                  $shipping_cost
                                  <hr>
                                    Order total : $db->currency".sprintf("%01.2f", $checkout->total)."
                                    <br>
                                    Previous Balance : $db->currency".sprintf("%01.2f", $user_bal)."
                                    <br>
                                    Remaining Balance : $db->currency".sprintf("%01.2f", $checkout->bal)."
                              </span>";

            ?>

        </tbody>
        <tfoot>
            <tr>
                <td>
                    <br><br><br><br>
                    <?php echo $address; ?>
                    <br><br>
                    <a href="index.php" class="btn btn-warning">
                        <i class="fas fa-angle-left"></i>
                        Continue Shopping
                    </a>
                </td>

                <td>&nbsp;</td>
                <td>&nbsp;</td>

                <td class="text-center view-cart-total">
                    <strong><?php echo $cart_box; ?></strong>
                </td>

            </tr>

        </tfoot>

        <?php

            unset($_SESSION['products']);

            } else {
                echo "Your Cart is empty";
            }
        ?>

    </table>
</div>

<?php

    include('views/components/footer.php');

?>