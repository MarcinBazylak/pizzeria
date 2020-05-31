<div class="center">
<?php
if(User::authUser()){

   echo '
   <h1>Panel</h1>
   <p>
      <a href="/orders">Zamówienia</a> | 
      <a href="/changePassword">Zmiana Hasła</a> | 
      <a href="/home/logout">Wyloguj</a>
   </p>
   ';

} else {
   displayLoginForm();
}
?>
</div>