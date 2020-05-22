<?php
if($_GET['action'] == 'submit') displayAlert($user->changePassword($_POST));
?>
            <div class="center">
               <?php
               if(!User::authUser()) {
                  displayLoginForm();
               } else {
                  include 'views/forms/changePassword.form.php';
               }
               ?>               
            </div>