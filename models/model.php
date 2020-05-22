<?php

abstract class Model {

   private $mysqli;

   abstract public function create($data);

   public function __construct() {
      global $mysqli;
      $this->mysqli = $mysqli;
   }   

   //USERS

   protected function insert($table, $cols, $values) {

      $this->mysqli->query("INSERT INTO " . $table . " (" . $cols . ") VALUES(" . $values . ")");
      if($this->mysqli->affected_rows > 0) {
         return true;
      }

   }

   protected function select($cols, $table, $condition) {

      $result = $this->mysqli->query("SELECT " . $cols . " FROM " . $table . " " . $condition);
      if($this->mysqli->affected_rows > 0) {
         return $result;
      } else {
         return false;
      }

   }

   protected function update($table, $colsVals, $condition) {

      $this->mysqli->query("UPDATE " . $table . " SET " . $colsVals . " " . $condition);
      if($this->mysqli->affected_rows > 0) {
         return true;
      }

   }

   protected function delete($table, $condition) {

      $this->mysqli->query("DELETE FROM " . $table . " WHERE " . $condition);
      if($this->mysqli->affected_rows > 0) {
         return true;
      }

   }

}

?>