<?php
session_start();
include_once 'includes/db.php';
include 'includes/autoload.php';
require_once 'models/model.php';

$photo = new Photo;

if(!empty($_FILES['photo']['name'])) {
   $_SESSION['photo'] = $photo->addPhoto($_FILES['photo']);
   echo '<img src="photos/' . $_SESSION['photo'] . '" style="max-width: 37vh;">';   
}

?>