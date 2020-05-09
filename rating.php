<?php

    require_once "controllers/Rating.php";
    require_once 'controllers/Login.php';

    $db = new Rating();
    $user = new Login();

    if($_POST['act'] == 'rate') {
        $db->rate();
    }