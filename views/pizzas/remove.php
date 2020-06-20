<?php
if(User::authAdmin()){
   if(!empty($_GET['id']) && isset($_POST['y'])) {
      if(!empty($_GET['id'])) displayAlert($pizza->remove($_GET['id']));
   } elseif(!empty($_GET['id'])) {
      $result = $pizza->getOne($_GET['id']) ?? '';
      if($result->num_rows > 0) {
         $row = $result->fetch_assoc();
      }      
      $alert = '
      Czy na pewno chcesz usunąć pizzę ' . $row['name'] . ' ?
      <form id="delForm" method="POST" action="/pizzas/remove/' . $_GET['id'] . '">
      </form>    
      <button type="submit" name="y" form="delForm" class="y">TAK</button> <button type="submit" form="delForm" formaction="/pizzas" formmethod="GET" class="n">NIE</button>    
      ';
      displayAlert([1, $alert]);
   }
   include 'views/pizzas/showAll.php';
} else {
   displayLoginForm();
}
?>