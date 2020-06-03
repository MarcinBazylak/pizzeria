<?php
if($_POST['action'] == 'edit') displayAlert($pizza->edit($_POST));
?>

<h2>Lista Pizz</h2>

<?php
if(User::authAdmin()){
   $result = $pizza->getAll() ?? '';
   if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {

         echo '
         <div class="pizza-list-row">
            <div class="pizza-list-row-line">
               <div class="pizza-list-img">
                  <img class="pizza-list" src="photos/' . $row['image'] . '.jpg?' . time() . '">
               </div>
               <div class="pizza-list-txt">
                  <h3>' . $row['name'] . '</h3>' . $row['toppings'] . '</br>' . $row['description'] . '<br>Cena: ' . $row['price'] . ' zł.
               </div>
            </div>
            <a href="pizzas/edit/' . $row['id'] . '">Edytuj</a> | <a href="pizzas/remove/' . $row['id'] . '">Usuń</a>
         </div>    
         '; 
         
      }

   } else {
      echo 'Brak wyników do wyświetlenia';
   }
} else {
   displayLoginForm();
}
?>