<?php

    include_once 'includes/autoloader.inc.php';
    include 'layouts/header.php';

    $db = new DB();

?>

        <div class="container">
            <div class="row">

                <?php

                    // display products from database
                    $query = "SELECT * FROM products";
                    $result = $db->dsn->query($query);

                    foreach($result as $row)
                    {

                ?>

                    <div class="col-md-3" id="box">
                        <form class="product-form">
                            <a href="single-product.php?product_id=<?php echo $row['id'] ?>">
                                <img class="product_image img-fluid" src="assets/img/products/<?php echo $row["image"]; ?>">
                            </a>

                            <div class="product-details">
                                <br>

                                <h6 class="text-center text-capitalize">
                                    <?php echo $row['name']; ?>
                                </h6>

                                <div class="text-center">
                                    <?php echo $db->getCurrency(); echo $row["price"]; ?>

                                    <div class="form-group col-sm-9 col-md-4 col-lg-4 cart-quantity" id="quantity">
                                        <input type="number" min="1" class="form-control in" name="product_qty" value="1">
                                    </div>

                                    <br>

                                    <input name="product_code" type="hidden" value="<?php echo $row["code"]; ?>">

                                    <button type="submit" class="btn btn-primary btn-labeled">
                                        <span class="btn-label">
                                            <i class="fa fa-shopping-cart"></i>
                                        </span>Add to cart
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
              <?php } ?>
            </div>
        </div>

<?php

    include('layouts/footer.php');

?>