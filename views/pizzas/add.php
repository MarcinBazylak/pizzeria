<?php 

if($_GET['id'] == 'removePhoto') {
   Photo::removePhoto($_SESSION['photo']);
}
if($_POST['submit'] == 'submit') {
   displayAlert($pizza->create($_POST));
   include 'views/pizzas/showAll.php';
} else {
   include 'views/forms/addPizza.form.php';
}
//$lastId = $pizza->lastId;


?>