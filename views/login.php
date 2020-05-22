            <div class="center">
               <?php
               if (User::authAdmin()) {
                  echo '
                  <div>
                     Jesteś już zalogowany.<br>
                     <a href="/adminPanel">Przejdź do panelu</a><br>
                     <a href="/home/logout">Wyloguj</a>
                  </div>';
               } elseif(User::authUser()) {
                  echo '
                  <div>
                     Jesteś już zalogowany.<br>
                     <a href="/panel">Przejdź do panelu</a><br>
                     <a href="/home/logout">Wyloguj</a>
                  </div>';
               } else {
                  displayLoginForm();
               }
               ?>
            </div>