<?php

    spl_autoload_register('autoLoader');

    function autoLoader($className)
    {
        $path = 'src/controllers/';
        $extension = '.php';
        $fullPath = $path . $className . $extension;

        include_once $fullPath;
    }
