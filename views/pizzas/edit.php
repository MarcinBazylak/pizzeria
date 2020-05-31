<?php 

if($_GET['id'] == 'removePhoto') {
   Photo::removePhoto($_SESSION['photo']);
}
if($_POST['submit'] == 'submit') displayAlert($pizza->edit($_POST));

if(!empty($_GET['id'])) $result = $pizza->getOne($_GET['id']);

$row = $result->fetch_assoc();

include 'views/forms/editPizza.form.php';
?>