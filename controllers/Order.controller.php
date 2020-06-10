<?php

class Order extends Model{

   public $orderId;
   private $alert = [];

   public function create($data) {

      $data = Data::validate($data);

      if ($this->checkFormFields($data)) {

         $this->insertOrderDetails($data);

      }

      return $this->alert;

   }

   private function insertOrderDetails($data) {

      $this->orderId = $this->insert(
         'orders',
         'message, client_name, client_tel, delivery_address_1, delivery_address_2, city, total_paid',
         '"' . $data['info'] . '", "' . $data['name'] . '", "' . $data['tel'] . '", "' . $data['address1'] . '", "' . $data['address2'] . '", "' . $data['city'] . '", "' . $_SESSION['total'] . '"'
      );
      if($this->orderId) {

         $this->insertOrderItems($_SESSION['basket'], $this->orderId);
   
      } else {

         $this->alert = [0, 'Zamówienie nie zostało zapisane'];

      }

   }   

   private function insertOrderItems($data, $orderId) {

      foreach($data as $item) {

         $this->insert(
            'order_items',
            'order_id, item_id, item_name, item_price, item_quantity, subtotal',
            '"' . $orderId . '", "' . $item['prodId'] . '", "' . $item['prodName'] . '", "' . $item['prodPrice'] . '", "' . $item['prodQuantity'] . '", "' . $item['prodPrice'] * $item['prodQuantity'] . '"'
         );
         $_SESSION['orderSaved']  = 1;
         $_SESSION['orderId']  = $orderId;

      }

      $this->alert = [1, 'Zamówienie nr ' . $orderId . ' zostało zapisane'];

   }

   public function confirm($orderId) {

      if($this->checkStatus($orderId) == 'nowe niepotwierdzone') {

         if ($this->updateStatus($orderId, 'nowe potwierdzone')) {
            
            $this->alert = [1, 'Zamówienie nr ' . $orderId . ' zostało przekazane do realizacji'];
            unset($_SESSION['basket']);
            unset($_SESSION['total']);
            unset($_SESSION['orderSaved']);
            unset($_SESSION['orderId']);

         } else {

            $this->alert = [0, 'Zamówienie zostało już potwierdzone'];

         }         

      } else {

         $this->alert = [0, 'Zamówienie zostało już potwierdzone'];

      }

      return $this->alert;

   }

   public function checkStatusByUser($orderId) {

      $result =  $this->select('status, total_paid', 'orders', 'WHERE id = "' . $orderId . '"');

      if($result->num_rows > 0) {

         $row = $result->fetch_assoc();

         switch($row['status']) {
            case 'nowe niepotwierdzone':
               $this->alert = [1, 'Status Twojego zamówienia to NOWE NIEPOTWIERDZONE. Oznacza to, że Twoje zamówienie nie zostało jeszcze przez Ciebie potwierdzone. Przejdź do zakładki ZAMÓW i potwierdź zamówienie'];
            break;
            case 'nowe potwierdzone':
               $this->alert = [1, 'Status Twojego zamówienia to NOWE POTWIERDZONE. Oznacza to, że Twoje zamówienie zostało przez Ciebie potwierdzone i za chwilę zajmiemy się jego realizacją'];
            break;
            case 'w trakcie realizacji':
               $this->alert = [1, 'Status Twojego zamówienia to W TRAKCIE REALIZACJI. Oznacza to, że Twoje zamówienie jest przygotowywane przez naszego kucharza i wkrótce wyruszy w drogę do Ciebie'];
            break;
            case 'w drodze':
               $this->alert = [1, 'Status Twojego zamówienia to W DRODZE. Oznacza to, że Twoje zamówienie już od nas wyjechało i wkrótce dotrze do Ciebie. Przygotuj ' . $row['total_paid'] . ' zł dla naszego kierowcy.'];
            break;
         }         

      } else {

         $this->alert = [0, 'Zamówienie o takim numerze nie zostało znalezione'];

      }

      return $this->alert;

   }

   private function checkStatus($orderId) {

      $result = $this->select('status', 'orders', 'WHERE id = "' . $orderId . '"');

      if($result->num_rows > 0) {

         $row = $result->fetch_assoc();
         return $row['status'];

      }

   }

   private function updateStatus($orderId, $newStatus) {

      return $this->update(
         'orders', 
         'status = "' . $newStatus . '"', 
         'WHERE id = "' . $orderId . '"'
      );

   }

   private function checkFormFields($data) : bool {

      if($data['name'] && $data['tel'] && $data['address1'] && $data['city']) {

         if(is_numeric($data['tel'])) {

            if($data['city'] === 'elk') {

               return true;

            } else {

               $this->alert = [0, 'Zamówienia są realizowane tylko na terenia miasta Ełk'];
               return false;

            }            

         } else {

            $this->alert = [0, 'Numer telefonu może składać się tylko z cyfr'];
            return false;

         }         

      } else {

         $this->alert = [0, 'Imię i nazwisko, nr telefonu, adres i miasto są polami obowiązkowymi'];
         return false;

      }

   }

}

?>