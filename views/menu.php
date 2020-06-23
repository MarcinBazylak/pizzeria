<div class="center">
<h1 style="margin-bottom: 1em">Nasze menu</h1>

<?php
$pizza = new Pizza();
$result = $pizza->getAll() ?? '';
if ($result->num_rows > 0) {

   while($row = $result->fetch_assoc()) {

      echo '
      <div class="pizza-list-row">
         <div class="pizza-list-row-line">
            <div class="pizza-list-img">
               <img class="pizza-list" src="/photos/' . $row['image'] . '.jpg?' . time() . '">
            </div>
            <div class="pizza-list-txt">
               <h3>' . $row['name'] . '</h3>' . $row['toppings'] . '</br>' . $row['description'] . '<br>Cena: ' . $row['price'] . ' zł.
            </div>
         </div>
         <form id="add-item' . $row['id'] . '" action="/addItem.php" method="POST">
            <input type="hidden" id="id' . $row['id'] . '" name="id" value="' . $row['id'] . '">
            <input type="number" id="number' . $row['id'] . '" min="1" max="10" name="number' . $row['id'] . '" class="menuItem" maxlength="2" value="1" required> <button id="submit' . $row['id'] . '" type="submit" class="menuItemBtn">Dodaj do zamówienia</button>
            <span id="addItemSpn' . $row['id'] . '" class="addItemSpn"></span>
         </form>

         <script>
         $(function() {

            $("#add-item'.$row['id'].'").on("submit", function(e) {
         
               e.preventDefault();
         
               $.ajax({
                  type: "post",
                  url: "addItem.php",
                  data: {
                     id: $("#id'.$row['id'].'").val(),
                     number: $("#number'.$row['id'].'").val(),
                  },
                  success: function(data) {            
                     showAlert(data, '.$row['id'].');
                  }
               });

               

            });
         
         });
         
         function showAlert(alert, id) {
            if(alert != "") {
               document.getElementById("addItemSpn" + id).innerHTML = alert;
            }
         }
         </script>

      </div>    
      '; 
      
   }

} else {
   echo 'Brak wyników do wyświetlenia';
}
?>
</div>