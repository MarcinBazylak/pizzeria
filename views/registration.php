            <?php
            if($_GET['action'] == 'register' && $_POST['submit'] == 'submit') {
               displayAlert($user->create($_POST));
            }
            ?>

            <div class="register">
               <div class="register-left">

               <?php

               if($user->authAdmin()){
                  include 'views/registration.form.php';
               } else {

                  echo '
                  <div>
                  Tylko administrator może dodawać nowych pracowników
                  </div>
                  ';

               }

               ?>

               </div>
               <div class="register-right">
                  <h1>Zarejestruj nowego użytkownika</h1>
                  Wypełnij formularz aby dodać<br>nowego pracownika pizzerii<br>
                  <p>Pracownik będzie miał możliwość:</p>
                  <ul>
                     <li>Przeglądania zamówień</li>
                     <li>Zmiany statusu zamówień</li>
                     <li>dodawania nowych zamówień</li>
                  </ul>
               </div>
            </div>