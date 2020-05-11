<?php

    require_once "src/controllers/Rating.php";

    $db = new Rating();

    if($_POST['act'] == 'rate')
    {
        $db->rate();
    }