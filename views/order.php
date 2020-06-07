<div class="center">
<h1>Zamówienie</h1>

<?php

$order = new Order;

if($_GET['action'] == 'clear') {
   unset($_SESSION['basket']);
   displayAlert([1, 'Zamówienie zostało usunięte']);
}

if($_GET['action'] == 'create') {

   displayAlert($order->create($_POST));
   
   echo '
   <p>Numer Twojego zamówienia to <span style="font-size: 2em;">' . $order->orderId . '</span>. Zanotuj go aby móc na bierząco sprawdzać jego status.</p>
   <p>Klikając w poniższy przycisk, przekażesz zamówienie do realizacji. Zapłacisz za nie przy odbiorze.</p>
   <a href="order/pay/' . $order->orderId . '"><button type="button">Zrealizuj zamówienie</button></a>';

} elseif($_GET['action'] == 'pay') {

   displayAlert($order->pay($_GET['id']));

} else {

   if($_SESSION['basket']) {
      echo '
      <p>
      Poniżej znajdują się szczegóły Twojego zamówienia
      </p>
      ';
      $total = 0;
      foreach($_SESSION['basket'] as $item) {
         $subtotal = $item['prodPrice'] * $item['prodQuantity'];
         echo '
         <div class="orderRow">
            <div class="orderRowLeft">' . $item['prodQuantity'] . ' x <b>' . $item['prodName'] . '</b> (' . $item['prodPrice'] . ' zł.)</div>
            <div class="orderRowRight">' . $subtotal . ' zł <a href="order/removeItem/' . $item['prodId'] . '"><b>usuń</b></a></div>
         </div>
         ';
         $total += $subtotal;
      }
      echo '
      <div class="orderRow">
      <div class="orderRowLeft"></div>
      <div class="orderRowRight"><b>Razem do zapłaty ' . $total . ' zł.</b></div>
      </div>';

      include 'views/forms/order.form.php';

   } else {
      echo '
      <p>
         Twoje zamówienie jest puste. Przejdź do <a href="menu">menu</a> aby coś zamówić.
      </p>
      ';
   }

}

?>
</div>