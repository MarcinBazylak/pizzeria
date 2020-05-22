<?php

class Data {

   public static function validate($data) {
      $data = array_map('strip_tags', $data);
      $data = array_map('trim', $data);
      return $data;
   }

}

?>