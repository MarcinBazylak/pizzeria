<?php

abstract class Model {

   protected static $mysqli;

   protected abstract function checkConn();

   public function __construct() {
      global $mysqli;
      self::$mysqli = $mysqli;
      User::checkConn();
   }   

   //USERS

   protected function insert($table, $cols, $values) {

      self::$mysqli->query("INSERT INTO " . $table . " (" . $cols . ") VALUES(" . $values . ")");

      if(self::$mysqli->affected_rows > 0) {
         return true;
      }

   }

   protected function select($cols, $table, $condition) {

      $result = self::$mysqli->query("SELECT " . $cols . " FROM " . $table . " " . $condition);
      if(self::$mysqli->affected_rows > 0) {
         return $result;
      } else {
         return false;
      }

   }

   protected function update($table, $colsVals, $condition) {

      self::$mysqli->query("UPDATE " . $table . " SET " . $colsVals . " " . $condition);

      if(self::$mysqli->affected_rows > 0) {
         return true;
      }

   }

   protected function delete($table, $condition) {

      self::$mysqli->query("DELETE FROM " . $table . " WHERE " . $condition);

      if(self::$mysqli->affected_rows > 0) {
         return true;
      }

   }

}

?>