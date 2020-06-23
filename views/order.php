<div class="center">
<h1>Zamówienie</h1>

<?php

$order = new Order;

if($_GET['action'] === 'clear') {

   unset($_SESSION['basket']);
   unset($_SESSION['orderSaved']);
   unset($_SESSION['orderId']);
   displayAlert([1, 'Zamówienie zostało usunięte']);

}

if($_GET['action'] === 'checkstatus') {

   displayAlert($order->checkStatusByUser($_POST['orderId']));

}

if($_GET['action'] === 'removeItem') {

   $order->removeItem($_GET['id']);

}

if($_GET['action'] === 'confirm') {

   displayAlert($order->confirm($_GET['id']));

}

if($_SESSION['basket']) {

   if($_GET['action'] === 'create') {

      displayAlert($order->create($_POST));

   }

   if($_SESSION['orderSaved']) {

      include 'views/orders/orderConfirmedDetails.php';   
      echo '
      <p>Numer Twojego zamówienia to <span style="font-size: 2em;">' . $_SESSION['orderId'] . '</span>. Zanotuj go aby móc na bierząco sprawdzać jego status.</p>
      <p>Klikając w poniższy przycisk, przekażesz zamówienie do realizacji. Zapłacisz za nie przy odbiorze.</p>
      <a href="/order/confirm/' . $_SESSION['orderId'] . '"><button type="button">Zrealizuj zamówienie</button></a>';
   
   } else {
   
      include 'views/orders/orderDetails.php';   
      include 'views/forms/order.form.php';
   
   }

} else {

   echo '
   <div style="text-align: center;">
      <p>
         Twoje zamówienie jest puste. Przejdź do <a href="/menu">menu</a> aby coś zamówić.
      </p>
      <p>
         lub
      </p>
      <p>
         Sprawdź status zamówienia
      </p>
      <form action="/order/checkstatus" method="POST">
         <input type="number" placeholder="Wprowadź numer zamówienia" name="orderId" min="1" max="9999" required>
         <button type="submit">Sprawdź status</button>
      </form>
   </div>';

}

?>
</div>