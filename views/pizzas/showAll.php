<h2>Lista Pizz</h2>

<?php
if(User::authAdmin()){
   $result = $pizza->getAll() ?? '';
   if ($result->num_rows > 0) {

      while($row = $result->fetch_assoc()) {

         echo '<h3>' . $row['name'] . '</h3>' . $row['toppings'] . '</br>' . $row['description'] . '<br>Cena: ' . $row['price'] . ' zł.<br>
         <img class="pizza-list" src="photos/' . $row['image'] . '.jpg?' . time() . '"><br>
         <a href="pizzas/edit/' . $row['id'] . '">Edytuj</a> | <a href="pizzas/remove/' . $row['id'] . '">Usuń</a>'; 

      }

   } else {
      echo 'Brak wyników do wyświetlenia';
   }
} else {
   displayLoginForm();
}
?>