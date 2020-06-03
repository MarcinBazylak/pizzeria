<?php

class Pizza extends Model {

   private $alert = [];
   public $lastId;
   
   public function create($data) : array {

      if(User::authAdmin()) {
         $data = Data::validate($data);
         if($this->checkPhotoLoaded() && $this->validateFormData($data) && !$this->nameExist($data['name']) && $this->checkPriceIsNumeric($data['price'])) {
            $this->lastId = $this->insert(
               'pizzas',
               'name, toppings, description, price, image',
               '"' . $data['name'] . '", "' . $data['toppings'] . '", "' . $data['description'] . '", "' . $data['price'] . '", "' . $_SESSION['photo'] . '"'
            );
            if($this->lastId) {
               unset($_SESSION['photo']);
               unset($_POST);
               $this->alert = [1, 'Pizza ' . $data['name'] . ' została dodana'];            
            } else {
               $this->alert = [0, 'Pizza ' . $data['name'] . ' nie ostała dodana'];
            }
         }
      } else {
         $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
      }
      return $this->alert;

   }

   public function getOne($id) {
      return $this->select('*', 'pizzas', 'WHERE id = "' . $id . '"');
   }

   public function getAll() {
      return $this->select('*', 'pizzas', '');
   }

   public function edit($data) : array {
      if(User::authAdmin()) {
         if($this->validateFormData($data) && $this->idExist($data['id']) && $this->checkPriceIsNumeric($data['price'])) {
            $this->update(
               'pizzas', 
               'name = "' . $data['name'] . '", toppings = "' . $data['toppings'] . '", description = "' . $data['description'] . '", price = "' . $data['price'] . '"', 
               'WHERE id = "' . $data['id'] . '"'
               );
            $this->alert = [1, 'Pizza ' . $data['name'] . ' została zmieniona'];
         }
      } else {
         $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
      }
      return $this->alert;
   }

   public function remove($id) : array {     
      if(User::authAdmin()) {
         if($this->idExist($id)) {
            $result = $this->select('name, image', 'pizzas', 'WHERE id = "' . $id . '"');
            $row = $result->fetch_assoc();
            $image = 'photos/' . $row['image'] . '.jpg';
            $this->delete('pizzas', 'id = "' . $id .'"');
            if(is_file($image)) {
               unlink($image);
            }
            $this->alert = [1, 'Pizza ' . $row['name'] . ' została usunięta'];
         } else {
            $this->alert = [0, 'Nie możesz usunąć pizzy, której nie ma na liście'];
         }
      } else {
         $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
      }
      return $this->alert;
   }

   private function nameExist($name) : bool {
      if($this->select('name', 'pizzas', 'WHERE name = "' . $name . '"')) {
         $this->alert = [0,'Pizza ' . $name . ' już istnieje'];
         return true;
      } else {
         return false;
      }
   }

   private function idExist($id) : bool {
      return ($this->select('id', 'pizzas', 'WHERE id = "' . $id . '"')) ? true : false;
    }

   private function validateFormData($data) : bool {
      if(!empty($data['name']) && !empty($data['toppings']) && !empty($data['description']) && !empty($data['price'])) {
         return true;
      } else {
         $this->alert = [0, 'Nie wszystkie pola zostały wypełnione'];
         return false;
      }
   }

   private function checkPriceIsNumeric($price) : bool {
      if(is_numeric($price)) {
         return true;
      } else {
         $this->alert = [0,'Cena może składać się wyłącznie z cyfr'];
         return false;
      }
   }

   private function checkPhotoLoaded() : bool {
      if(!empty($_SESSION['photo'])) {
         return true;
      } else {
         $this->alert = [0, 'Najpierw musisz załadować zdjęcie'];
         return false;
      }
   }

}

?>