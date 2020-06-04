<div class="center">
<h1>Zamówienie</h1>

<?php
if($_GET['action'] == 'clear') {
   unset($_SESSION['basket']);
   displayAlert([1, 'Zamówienie zostało usunięte']);
}
if($_SESSION['basket']) {
   echo '
   <p>
   Poniżej znajdują się szczegóły Twojego zamówienia
   </p>
   ';
   $total = 0;
   foreach($_SESSION['basket'] as $item) {
      $subtotal = $item['prodPrice'] * $item['prodQuantity'];
      echo '<p><b>' . $item['prodName'] . '</b> ' . $item['prodQuantity'] . ' szt. x ' . $item['prodPrice'] . ' zł. = ' . $subtotal . ' zł</p>';
      $total += $subtotal;
   }
   echo 'Razem do zapłaty ' . $total . ' zł.
   <br><br>
   <a href="order/clear"><button type="submit" form="orderForm" formaction="order/clear">Wyczyść zamówienie</button></a> 
   <a href="order/pay"><button type="submit" form="orderForm" formaction="order/send">Przejdź do kasy</button></a>
   ';
} else {
   echo '
   <p>
   Twoje zamówienie jest puste. Przejdź do <a href="menu">menu</a> aby coś zamówić.
   </p>
   ';
}

?>
</div>