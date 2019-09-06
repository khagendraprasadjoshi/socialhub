<?php

spl_autoload_register('autoloadclass');

function autoloadclass($className)
{
    $path = 'classes/';

    include $path.$className.'.php';
}

?>