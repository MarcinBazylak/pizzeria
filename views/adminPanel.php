<div class="center">
<?php

if(User::authAdmin()){
   echo '
   <h1>Panel Admin</h1>
   <a href="pizzas">Pizze</a> | <a href="changePassword">Zmiana Hasłą</a>
   ';
} else {
   displayLoginForm();
}

?>
</div>