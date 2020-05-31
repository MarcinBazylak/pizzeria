<?php
session_start();
include_once 'includes/db.php';
include 'includes/autoload.php';
require_once 'models/model.php';

$photo = new Photo;

if(!empty($_FILES['photo']['name'])) {
   $image = $photo->addPhoto($_FILES['photo']);
   if(!is_array($photo)) {
      $_SESSION['photo'] = $image;
      echo '<img src="photos/' . $_SESSION['photo'] . '" style="max-width: 37vh;"><br>
      <a href="pizzas/add/removePhoto">usuń</a>';
   } else {
      echo $image[1];
   }
}

?>