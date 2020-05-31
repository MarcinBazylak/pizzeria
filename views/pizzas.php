<div class="center">
<?php

$pizza = new Pizza;

if(User::authAdmin()){
   
   echo '
   <h1>Pizze</h1>
   <p>
      <a href="pizzas/showAll">Lista</a> | <a href="pizzas/add">Dodaj</a>
   </p>
   ';
   
   include (!empty($_GET['action'])) ? 'views/pizzas/' . $_GET['action'] . '.php' : 'views/pizzas/showAll.php';
} else {
   displayLoginForm();
}
?>
</div>