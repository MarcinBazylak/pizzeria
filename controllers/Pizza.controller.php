<?php

class Pizza extends Model {

   private $alert = [];
   
   public function create($data) {

      $data = Data::validate($data);

      if($this->checkPhotoLoaded() && !$this->checkIfExist($data['name']) && $this->checkPriceIsNumeric($data['price'])) {
         if($this->insert(
            'pizzas',
            'name, toppings, description, price, image',
            '"' . $data['name'] . '", "' . $data['toppings'] . '", "' . $data['description'] . '", "' . $data['price'] . '", "' . $_SESSION['photo'] . '"'
         )) {
            unset($_SESSION['photo']);
            unset($_POST);
            $this->alert = [1, 'Pizza ' . $data['name'] . ' została dodana'];            
         } else {
            $this->alert = [0, 'Pizza ' . $data['name'] . ' nie ostała dodana'];
         }
      }
      return $this->alert;

   }

   public function edit() {

   }

   public function remove($id) {
      if($this->checkIfExist($name)) {
         //LECIMY Z USUWANIEM
      }
   }

   private function checkIfExist($name) : bool {

      if($this->select('id', 'pizzas', 'WHERE name = "' . $name . '"')) {
         return true;
      } else {
         $this->alert = [0,'Pizza o tej nazwie już istnieje'];
         return false;
      }

   }

   private function validateFormData($data) {

   }

   private function checkAllFieldsFilled($data) : bool {

   }

   private function checkPriceIsNumeric($price) : bool {
      if(is_numeric($price)) {
         return true;
      } else {
         $this->alert = [0,'Cena musi składać się wyłącznie z cyfr'];
         return false;
      }
   }

   private function checkPhotoLoaded() : bool {
      if(!empty($_SESSION['photo'])) {
         return true;
      } else {
         $this->alert = [0, 'Najpier musisz załadować zdjęcie'];
         return false;
      }
   }

}


?>