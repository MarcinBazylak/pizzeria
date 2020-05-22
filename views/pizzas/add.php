<?php 

$pizza = new Pizza;

if($_POST['submit'] == 'submit') displayAlert($pizza->create($_POST));
include 'views/forms/addPizza.form.php';
?>