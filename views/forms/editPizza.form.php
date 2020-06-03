                  <h2>Edytuj pizzę</h2>
                  <p>Wypełnij formularz aby zmienić nazwę, dodatki, opis lub cenę pizzy</p>
                  <form id="form" enctype="multipart/form-data" action="newPhoto.php" method="POST">
                     <input type="hidden" name="pizzaId" value="<?php echo ($row['id']) ?? '' ?>">
                     <input type="hidden" name="photoName" value="<?php echo ($row['image']) ?? '' ?>">                     
                     <br><label>Wybierz nowe zdjęcie</label><br>
                     <input id="image" type="file" name="photo" accept="image/jpeg">
                  </form>
                  <div class="progress">
                     <div class="bar"></div>
                     <div class="percent">0%</div >
                  </div>
                  <div id="status"></div>
                  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
                  <script src="js/upload.js"></script>
                  <script src="js/statusBar.js"></script>
                  <div id="oldImage"><img src="photos/<?php echo $row['image'] ?>.jpg?<?php echo time() ?>" style="max-width: 37vh;"></div>
                  
                  <form action="pizzas" method="POST">
                     <input type="hidden" name="action" value="edit">
                     <input type="hidden" name="id" value="<?php echo ($row['id']) ?? '' ?>">
                     <input type="hidden" name="photoName" value="<?php echo ($row['image']) ?? '' ?>">
                     <input type="text" name="name" placeholder="Nazwa pizzy" value="<?php echo ($row['name']) ?? '' ?>" autocomplete="off"><br>
                     <input type="text" name="toppings" placeholder="Dodatki (oddzielone przecinkami)" value="<?php echo ($row['toppings']) ?? '' ?>" autocomplete="off"><br>
                     <textarea name="description" placeholder="Opis" cols="30" rows="7"><?php echo ($row['description']) ?? '' ?></textarea><br>
                     <input type="number" min="1" max="999" name="price" style="width: 6vh" placeholder="Cena" value="<?php echo ($row['price']) ?? '' ?>" autocomplete="off"> zł.<br>
                     <button type="submit" name="submit" value="submit">Zapisz</button>
                  </form>