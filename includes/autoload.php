<?php

spl_autoload_register('autoLoader');

function autoLoader($className) {

   $fullPath = 'controllers/' . $className . '.controller.php';

   include_once $fullPath;

}

?>