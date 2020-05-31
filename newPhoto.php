<?php
session_start();
include_once 'includes/db.php';
include 'includes/autoload.php';
require_once 'models/model.php';

$photo = new Photo;

if(!empty($_FILES['photo']['name'])) {
   $image = $photo->editPhoto($_FILES['photo'], $_POST['photoName'], $_POST['pizzaId']);
   if(!is_array($image)) {
      echo '<img src="photos/' . $_POST['photoName'] . '.jpg?' . time() . '" style="max-width: 37vh;"><br>';
   } else {
      echo $image[1];
   }
   
}

?>