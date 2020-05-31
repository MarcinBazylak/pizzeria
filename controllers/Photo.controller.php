<?php

class Photo {

   private $alert = [];
   private $fileName;

   public function addPhoto($photo) {
      if ($this->validateForm($photo)) {
         $this->saveFile($photo['tmp_name']);
         return $this->fileName;
      } else {
         return $this->alert;
      }
   }

   public static function removePhoto($name) {
      $photoName = 'photos/' . $name;
      if(is_file($photoName)) {
         unlink($photoName);
         unset($_SESSION['photo']);
      }
   }

   public function editPhoto($file, $fileName, $pizzaId) {

      if ($this->validateForm($file)) {
         $fileName = $fileName . '.jpg';
         $this->removePhoto($fileName);
         $uploads_dir = 'photos/';
         move_uploaded_file($file['tmp_name'], $uploads_dir . $fileName);
         chmod($uploads_dir . $fileName, 0644);
         return $fileName;
      } else {
         return $this->alert;
      }

   }

   private function saveFile($file) { //ZMIENIĆ ZAPISYWANIE ORYGINALNEGO PLIKU NA RESIZING
      $uploads_dir = 'photos/';      
      $time = time();
      $this->fileName = md5($file . $time) . '.jpg';
      move_uploaded_file($file, $uploads_dir . $this->fileName);
      chmod($uploads_dir . $this->fileName, 0644);
   }

   private function validateForm($photo) : bool {     
       
      if($photo['size'] < 4194304) {
         if($photo['type'] == 'image/jpeg') {
            return true;
         } else {
            $this->alert = [0, 'Plik ' . $photo['name'] . ' musi być obrazkiem w formacie jpeg'];
            return false;
         }
      } else {
         $this->alert = [0, 'Plik ' . $photo['name'] . ' nie może przekraczać rozmiaru 4MB.']; 
         return false;         
      }      
   }

}

?>