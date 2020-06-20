                  <h1>Zarejestruj nowego użytkownika</h1>
                  <p>Wypełnij formularz aby dodać nowego pracownika pizzerii</p>
                  <form action="/registration/register" method="POST">
                     <input type="text" name="name" placeholder="Imię i Nazwisko Pracownika" value="<?php echo ($_POST['name']) ?? '' ?>" autocomplete="off" required><br>
                     <input type="text" name="tel" placeholder="Numer tel. Pracownika" value="<?php echo ($_POST['tel']) ?? '' ?>" autocomplete="off" required><br>
                     <input type="password" name="pass1" placeholder="Hasło" autocomplete="new-password" required><br>
                     <input type="password" name="pass2" placeholder="Powtórz Hasło" autocomplete="new-password" required><br>
                     <button type="submit" name="submit" value="submit">Zapisz</button>
                  </form>