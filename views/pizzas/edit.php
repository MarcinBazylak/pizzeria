<?php 

$result = $pizza->getOne($_GET['id']) ?? '';

if ($result->num_rows > 0) {

   $row = $result->fetch_assoc();
   include 'views/forms/editPizza.form.php';

} else {

   echo 'Taka pizza nie istnieje';

}

?>