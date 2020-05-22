
<div class="center">
<?php
if(User::authUser()){
   echo '
   <h1>Zamówienia</h1>
   ';
} else {
   displayLoginForm();
}
?>
</div>