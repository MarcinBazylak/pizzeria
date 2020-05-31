<?php 

if($_GET['id'] == 'removePhoto') {
   Photo::removePhoto($_SESSION['photo']);
}
if($_POST['submit'] == 'submit') displayAlert($pizza->create($_POST));
$lastId = $pizza->lastId;
include 'views/forms/addPizza.form.php';
?>