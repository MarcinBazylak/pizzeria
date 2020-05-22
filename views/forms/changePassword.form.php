                  <h1>Zmień hasło</h1>
                  <p>Wypełnij formularz aby zmienić swoje hasło</p>
                  <form action="changePassword/submit" method="POST">
                     <input type="password" name="oldPass" placeholder="Podaj obecne Hasło" required><br>
                     <input type="password" name="newPass1" placeholder="Podaj nowe Hasło" required><br>
                     <input type="password" name="newPass2" placeholder="Powtórz nowe Hasło" required><br>
                     <button type="submit" name="submit" value="submit">Zmień hasło</button>
                  </form>