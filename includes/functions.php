<?php

function displayAlert($alert) {

   if (isset($alert) && !empty($alert)) {
      if($alert[0] == 0) {
         echo '<div class="red">' . $alert[1] . '</div>';
      }
      if($alert[0] == 1) {
         echo '<div class="green">' . $alert[1] . '</div>';
      }
   }

}

function displayLoginForm() {

   $redirect = $_GET['page'];
   include 'views/forms/login.form.php';
   
}

?>