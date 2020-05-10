<?php

    require_once 'src/controllers/DB.php';
    include 'components/header.php';

    $db = new DB();

?>

        <div class="container">
            <div class="row">

                <?php

                    // echo products from database
                    $sql_query = "SELECT * FROM products";
                    $result = $db->fetchAssoc($sql_query);

                    foreach($result as $row)
                    {

                ?>

                    <div class="col-md-3" id="box">
                        <form class="product-form">
                            <a href="views/single-product.php?product_id=<?php echo $row['id'] ?>">
                                <img class="product_image img-fluid" src="assets/img/products/<?php echo $row["image"]; ?>">
                            </a>

                            <div class="product-details">
                                <br>

                                <h6 class="text-center text-capitalize">
                                    <?php echo $row['name']; ?>
                                </h6>

                                <div class="text-center">
                                    <?php echo $db->currency; echo $row["price"]; ?>

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

    include('components/footer.php');

?>