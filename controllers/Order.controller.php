<?php

class Order {

   public $orderId;

   public function create($data) {

      $this->orderId = '1';
      return [1, 'Zamówienie zostało zapisane'];
      

   }

   public function pay($orderId) {

      return [1, 'Zamówienie nr ' . $orderId . ' zostało opłacone'];

   }

}

?>