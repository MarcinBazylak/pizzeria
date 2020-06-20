                  <h2>Dodaj pizzę</h2>
                  <p>Wypełnij formularz aby dodać pizzę</p>
                  <form id="form" enctype="multipart/form-data" action="/upload.php" method="POST">
                     <label>Wybierz zdjęcie</label><br>
                     <input id="image" type="file" name="photo" accept="image/jpeg">
                  </form>
                  <div class="progress">
                     <div class="bar"></div>
                     <div class="percent">0%</div >
                  </div>
                  <div id="status"></div>
                  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
                  <script src="/js/upload.js"></script>
                  <script src="/js/statusBar.js"></script>
                  
                  <form action="/pizzas/add" method="POST">
                     <input type="text" name="name" placeholder="Nazwa pizzy" value="<?php echo ($_POST['name']) ?? '' ?>" autocomplete="off"><br>
                     <input type="text" name="toppings" placeholder="Dodatki (oddzielone przecinkami)" value="<?php echo ($_POST['toppings']) ?? '' ?>" autocomplete="off"><br>
                     <textarea name="description" placeholder="Opis" cols="30" rows="7"><?php echo ($_POST['description']) ?? '' ?></textarea><br>
                     <input type="number" min="1" max="999" name="price" style="width: 6vh" placeholder="Cena" value="<?php echo ($_POST['price']) ?? '' ?>" autocomplete="off"> zł.<br>
                     <button type="submit" name="submit" value="submit">Zapisz</button>
                  </form>
                  