<?php

    include_once 'includes/autoloader.inc.php';

    $db = new Rating();

    if($_POST['act'] == 'rate')
    {
        $db->rate();
    }