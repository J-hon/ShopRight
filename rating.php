<?php

    require_once "controllers/Rating.php";
    $db = new Rating();

    if($_POST['act'] == 'rate') {
        $db->rate();
    }