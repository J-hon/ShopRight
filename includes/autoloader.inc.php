<?php

    spl_autoload_register('autoLoader');

    function autoloader($className)
    {
        $extension = '.php';

        // splits the class name up if it contains backslashes.
        $classNameParts = explode('\\', $className);

        // the last piece of the array will be the class name.
        $className = end($classNameParts);

        // require the class.
        require_once 'src/controllers/' . $className . $extension;
    }