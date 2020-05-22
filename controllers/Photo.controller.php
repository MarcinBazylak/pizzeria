<?php

class Photo {

   private $alert = [];
   private $fileName;

   public function addPhoto($photo) {
       if ($this->validateForm($photo)) {
         $this->saveFile($photo['tmp_name']);
         return $this->fileName;
      } else {
         return $this->alert[1];
      }
   }

   public function removePhoto() {

   }

   private function saveFile($file) { //ZMIENIĆ ZAPISYWANIE ORYGINALNEGO PLIKU NA RESIZING
      $uploads_dir = 'photos/';      
      $time = time();
      $this->fileName = md5($file . $time) . '.jpg';
      move_uploaded_file($file, $uploads_dir . $this->fileName);
      chmod($uploads_dir . $this->fileName, 0644);
   }

   private function validateForm($photo) {     
       
      if($photo['size'] < 4194304) {
         if($photo['type'] == 'image/jpeg') {
            return true;
         } else {
            $this->alert = [0, 'Plik ' . $photo['name'] . ' musi być obrazkiem w formacie jpeg'];
         }
      } else {
         $this->alert = [0, 'Plik ' . $photo['name'] . ' nie może przekraczać rozmiaru 4MB.'];          
      }      
   }

}

?>