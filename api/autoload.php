<?php

spl_autoload_register('autoLoader');

function autoloader($class)
{
    $parts = explode('\\', $class);
    require '../controllers/' . end($parts) . '.controller.php';
}

?>