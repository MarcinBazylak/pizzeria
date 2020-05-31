<?php

abstract class Model {

   private $mysqli;

   abstract public function create($data);

   public function __construct() {
      global $mysqli;
      $this->mysqli = $mysqli;
   }   

   //USERS

   protected function insert($table, $cols, $values) : ?int {

      $this->mysqli->query("INSERT INTO " . $table . " (" . $cols . ") VALUES(" . $values . ")");
      $lastId = $this->mysqli->insert_id;
      return ($this->mysqli->affected_rows > 0) ? $lastId : null;

   }

   protected function select($cols, $table, $condition) : ?object {

      $result = $this->mysqli->query("SELECT " . $cols . " FROM " . $table . " " . $condition);
      return ($this->mysqli->affected_rows > 0) ? $result : null;

   }

   protected function update($table, $colsVals, $condition) : bool {

      $this->mysqli->query("UPDATE " . $table . " SET " . $colsVals . " " . $condition);
      return ($this->mysqli->affected_rows > 0);

   }

   protected function delete($table, $condition) : bool {

      $this->mysqli->query("DELETE FROM " . $table . " WHERE " . $condition);
      return ($this->mysqli->affected_rows > 0);

   }

}

?>