<div class="center">
<?php

if(User::authAdmin()){
   echo '
   <a href="/orders">Zobacz zamówienia</a><br>
   <a href="/change-password">Zmień hasło</a><br>
   <a href="/home/logout">Wyloguj</a>
   ';
} else {
   displayLoginForm();
}
?>
</div>