<?php

if($_GET['action'] == 'authenticate') {
   $data = array_map('strip_tags', $_POST);
   if($_POST['submit'] == 'submit') displayAlert($user->login($data));
}

?>

            <div class="register">
               <div class="register-left">
<?php

if(!$_SESSION['logged']) {
   include 'views/login.form.php';
} else {
   echo '
                  <div>
                     Jesteś już zalogowany.<br>
                     <a href="/panel">Przejdź do panelu</a><br>
                     <a href="/home/logout">Wyloguj</a>
                  </div>';
}

?>

               </div>
               <div class="register-right">
                  <h1>Zaloguj się</h1>
                  Wypełnij formularz aby się zalogować<br>
                  <p>Jako zalogowany pracownik będziesz miał możliwość:</p>
                  <ul>
                     <li>Przeglądania zamówień</li>
                     <li>Zmiany statusu zamówień</li>
                     <li>dodawania nowych zamówień</li>
                  </ul>
                  <p>Ponadto, jako administrator będziesz mógł:</p>
                  <ul>
                     <li>Dodawać i usuwać pracowników</li>
                     <li>Usuwać zamówienia</li>
                     <li>Dodawać i usuwać pizze</li>
                  </ul>
               </div>
            </div>