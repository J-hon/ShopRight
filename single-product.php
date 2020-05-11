<?php

    require_once 'src/controllers/DB.php';
    include 'layouts/header.php';

    $db = new DB();

    // get id of selected product
    if (isset($_GET['product_id']))
    {

        $product_id = $_GET['product_id'];

        // select id from database
        $get_product = "SELECT * FROM products WHERE id='$product_id'";
        $run_product = $db->runQuery($get_product);
        $row_product = $db->fetchArray($run_product);

        if ($db->numRows($run_product) > 0)
        {
            $product_image = $row_product['image'];
            $product_name = $row_product['name'];
            $product_price = $row_product['price'];
        }
        else
        {

        ?>

<!--            Error 404 page if product id not found-->
            <div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h3>Oops! Page not found</h3>
                        <h1><span>4</span><span>0</span><span>4</span></h1>
                    </div>
                    <h2>we are sorry, but the page you requested was not found</h2>

                    <a href="index.php" style="color: #666666">
                        <i class="fa fa-angle-left"></i>
                        <i class="fa fa-angle-left"></i>
                        Go back home
                    </a>
                </div>
            </div>

        <?php

            exit();
        }

    }

?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="text-left">
                    <img src="assets/img/products/<?php echo $product_image; ?>" height="500px" width="500px">
                </div>
            </div>

            <div class="col-offset-2"></div>

            <div class="col-md-4">
                <br>
                <h1>
                    <?php echo $product_name; ?>

                </h1>

                <h3 class="font-weight-light">
                    <?php

                        echo $db->currency;
                        echo $product_price;

                    ?>
                </h3>

                <br><br>

                <div class="rate">
                    <div id="1" class="btn-1 rate-btn"></div>
                    <div id="2" class="btn-2 rate-btn"></div>
                    <div id="3" class="btn-3 rate-btn"></div>
                    <div id="4" class="btn-4 rate-btn"></div>
                    <div id="5" class="btn-5 rate-btn"></div>
                </div>

                <br><br>

                <div class="box-result">

                    <?php

                        // average ratings
                        $query = "SELECT * FROM ratings where product_id = '$product_id'";
                        $result = $db->fetchAssoc($query);

                        foreach($result as $data)
                        {
                            $rate_db[] = $data;
                            $sum_rates[] = $data['rate'];
                        }

                        if(@count($rate_db))
                        {
                            $rate_times = count($rate_db);
                            $sum_rates = array_sum($sum_rates);
                            $rate_value = $sum_rates / $rate_times;
                            $rate_bg = (($rate_value) / 5) * 100;
                        }
                        else
                        {
                            $rate_times = 0;
                            $rate_value = 0;
                            $rate_bg = 0;
                        }

                    ?>

                    <div class="result-container">
                        <div class="rate-bg" style="width: <?php echo $rate_bg; ?>%"></div>
                        <div class="rate-stars"></div>
                    </div>

                    <p class="rating">
                        Rated <strong><?php echo substr($rate_value,0,3); ?></strong>
                        out of <?php echo $rate_times; ?> Review(s)
                    </p>

                </div>
            </div>
        </div>
    </div>

<?php

    include('layouts/footer.php');

?>

<script type="text/javascript">

    $(document).ready(function ()
    {
        $('.rate-btn').hover(function ()
        {

            $('.rate-btn').removeClass('rate-btn-hover');
            var therate = $(this).attr('id');

            for (var i = therate; i >= 0; i--)
            {
                $('.btn-' + i).addClass('rate-btn-hover');
            }
        });

        $('.rate-btn').click(function ()
        {

            var therate = $(this).attr('id');
            var dataRate = 'act=rate&product_id=<?php echo $product_id; ?>&rate=' + therate;
            $('.rate-btn').removeClass('rate-btn-active');

            for (var i = therate; i >= 0; i--)
            {
                $('.btn-' + i).addClass('rate-btn-active');
            }

            $.ajax({
                type: "POST",
                url: "rating.php",
                data: dataRate,
                success: function (data)
                {
                    window.location.reload();
                },

                error: function()
                {
                    alert("Error");
                }
            });
        });
    });
</script>