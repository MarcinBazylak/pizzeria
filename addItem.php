<?php
session_start();
include_once 'includes/db.php';
include 'includes/autoload.php';
require_once 'models/model.php';

//echo 'Dodano do zamówienia' . $_POST['id'] . ' ' . $_POST['number'];

$pizza = new Pizza();
$result = $pizza->getOne($_POST['id']) ?? '';

if ($result->num_rows > 0) {

   $row = $result->fetch_assoc();
   if($_SESSION['basket'][$row['id']]) {
      $_SESSION['basket'][$row['id']]['prodQuantity'] += $_POST['number'];
   } else {
      $_SESSION['basket'][$row['id']] = [
         'prodId' => $row['id'],
         'prodName' => $row['name'],
         'prodPrice' => $row['price'],
         'prodQuantity' => $_POST['number']
      ];
   }
   echo 'dodano do zamówienia ' . $_POST['number'] . ' szt. ' . $row['name'];
} else {

   echo 'Taka pizza nie istnieje';

}

?>