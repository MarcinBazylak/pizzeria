<?php
if(User::authAdmin()){
   if(!empty($_GET['id'])) displayAlert($pizza->remove($_GET['id']));
   include 'views/pizzas/showAll.php';
} else {
   displayLoginForm();
}
?>