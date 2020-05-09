<?php

    include 'views/components/header.php';
    include("config.inc.php");
    require_once "controllers/DB.php";
    $db = new DB();

?>

<div class="container">	
    <h3 style="text-align: center">Order Summary</h3>
    <br>
    <?php

        if(isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
            $total = 0;
            $cart_box = '';
            $user_id = $_SESSION['id'];
            $no_of_items = count($_SESSION['products']);

            $query0 = "SELECT * FROM `users` WHERE id ='$user_id'";
            $res = $db->runQuery($query0);
            $row = $db->fetchArray($res);

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
                    <?php echo $product_price; ?>
                </td>

                <td>
                    <?php echo $product_qty; ?>
                </td>

                <td>
                    <?php echo $db->currency; echo sprintf("%01.2f", ($product_price * $product_qty)); ?>
                </td>

                <td>&nbsp;</td>
            </tr>

            <?php

                $subtotal = ($product_price * $product_qty);
                $total = $total + $subtotal;

            }

                $grand_total = $total + $shipping_cost;
                $rem_bal = $user_bal - $grand_total;

                $query = "INSERT INTO `orders` (`order_total`, `no_of_items`, `user_id`, `created_at`) 
                          VALUES ('$total', '$no_of_items', '$user_id');";
                $db->runQuery($query);

                $query2 = "UPDATE `users` SET `current_balance` = '$rem_bal' WHERE `users`.`id` = '$user_id'";
                $db->runQuery($query2);

            $shipping_cost = ($shipping_cost)?'Shipping Cost : '.$db->currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
                $cart_box .= "<span>
                                  $shipping_cost
                                  <hr>
                                    Order total : $db->currency".sprintf("%01.2f", $grand_total)."
                                    <br>
                                    Previous Balance : $db->currency".sprintf("%01.2f", $user_bal)."
                                    <br>
                                    Remaining Balance : $db->currency".sprintf("%01.2f", $rem_bal)."
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