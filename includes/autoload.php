<?php

spl_autoload_register('autoLoader');

function autoLoader($className) {

   $path = 'classes/';
   $ext = '.class.php';
   $fullPath = $path . $className . $ext;

   include_once $fullPath;

}

?>