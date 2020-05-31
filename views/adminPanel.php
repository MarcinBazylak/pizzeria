<div class="center">
<?php

if(User::authAdmin()){
   echo '
   <h1>Panel Admin</h1>
   <p>
      <a href="/orders">Zamówienia</a> | 
      <a href="/pizzas">Pizze</a> | 
      <a href="/users">Pracownicy</a> | 
      <a href="/changePassword">Zmiana Hasłą</a> | 
      <a href="/home/logout">Wyloguj</a>
   </p>
   ';
} else {
   displayLoginForm();
}

?>
</div>