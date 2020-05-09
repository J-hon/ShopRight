<?php

    $shipping_cost = 0;

    if (isset($_POST['radio-group'])) {
        $shipping_cost_value = $_POST['radio-group'];

        if ($shipping_cost_value == "5") {
            $shipping_cost = 5;
        }
    }