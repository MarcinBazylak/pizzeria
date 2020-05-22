                  <h1>Zaloguj się</h1>
                  <p>Wypełnij formularz aby się zalogować</p>
                  <form action="<?php echo $redirect ?>/authenticate" method="POST">
                     <input type="text" name="tel" placeholder="Podaj numer telefonu"><br>
                     <input type="password" name="password" placeholder="Podaj Hasło"><br>
                     <button type="submit" name="submit" value="submit">Zaloguj</button>
                  </form>