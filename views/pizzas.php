<div class="center">
<?php
if(User::authAdmin()){
   echo '
   <h1>Pizze</h1>
   <a href="pizzas/showAll">Lista</a> | <a href="pizzas/add">Dodaj</a>
   ';
   include (!empty($_GET['action'])) ? 'views/pizzas/' . $_GET['action'] . '.php' : 'views/pizzas/showAll.php';
} else {
   displayLoginForm();
}
?>
</div>