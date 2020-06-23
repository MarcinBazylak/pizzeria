<p>
Poniżej znajdują się szczegóły Twojego zamówienia
</p>

<?php
$total = 0;
foreach($_SESSION['basket'] as $item) {
   $subtotal = $item['prodPrice'] * $item['prodQuantity'];
   echo '
   <div class="orderRow">
      <div class="orderRowLeft">' . $item['prodQuantity'] . ' x <b>' . $item['prodName'] . '</b> (' . $item['prodPrice'] . ' zł)</div>
      <div class="orderRowRight">' . $subtotal . ' zł.</div>
   </div>
   ';
   $total += $subtotal;
}
$_SESSION['total'] = $total;
?>

<div class="orderRow">
<div class="orderRowLeft"></div>
<div class="orderRowRight"><b>Razem do zapłaty <?php echo $total ?> zł.</b></div>
</div>