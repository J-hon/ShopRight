<?php

    require_once "src/controllers/Rating.php";
    require_once 'src/controllers/Login.php';

    $db = new Rating();
    $user = new Login();

    if($_POST['act'] == 'rate') {
        $db->rate();
    }