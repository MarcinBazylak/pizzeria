<?php

   class User extends Model {
   
      protected function checkConn() {

         $mysqli = parent::$mysqli;

         if ($mysqli -> connect_errno) {         
            echo "Nie udało się połączyć z bazą danych: " . $mysqli -> connect_error;
            exit();
         }

      }

      public function create($data) { // DOKOŃCZYĆ - AUTENTYKACJA ADMINA
         
         if($this->validateRegistrationData($data)) {
            $token = md5(time());
            $password = md5($data['password']);
            if(parent::insert(
               'users',
               'token, email, password, name',
               '"' . $token . '", "' . $data['email'] . '", "' . $password . '", "' . $data['name'] . '"'
            )) {
               $result = [1, 'Nowy użytkownik został zarejestrowany'];
            } else {
               $result = [0, 'Wystąpił błąd. Sprawdź wprowadzone dane i spróbuj ponownie'];
            }
         } else {
            $result = [0, 'Wystąpił błąd. Sprawdź wprowadzone dane i spróbuj ponownie'];
         }
         return $result;

      }

      public function giveAdminRights($userId) { // DOKOŃCZYĆ - AUTENTYKACJA ADMINA

         $result = parent::select('email', 'users', 'WHERE id = "' . $userId . '"');
         $row = $result->fetch_array(MYSQLI_ASSOC);

         if(parent::update('users', 'admin = "1"', 'WHERE id = "' . $userId . '"')) {
            return [1, 'Przyznano prawa administratora dla ' . $row['email']];
         } else {
            return [0, 'Użytkownikowi ' . $row['email'] . ' nie można nadać praw administratora'];
         }

      }

      public function revokeAdminRights($userId) { // DOKOŃCZYĆ - AUTENTYKACJA ADMINA

         $result = parent::select('email', 'users', 'WHERE id = "' . $userId . '"');
         $row = $result->fetch_array(MYSQLI_ASSOC);

         if(parent::update('users', 'admin = "0"', 'WHERE id = "' . $userId . '"')) {
            return [1, 'Odebrano prawa administratora dla ' . $row['email']];
         } else {
            return [0, 'Użytkownik ' . $row['email'] . ' nie posiada praw administratora'];
         }

      }

      public function remove($userId) { // DOKOŃCZYĆ - AUTENTYKACJA ADMINA

         if(parent::delete('users', 'id = "' . $userId . '"')) {
            return true;
         }

      }

      public function login($data) {

         return ($this->validateLogin($data)) ? [1, 'Zostałeś poprawnie zalogowany'] : [0, 'Adres email i hasło nie zostały rozpoznane'];
         
      }

      public function logout() {

         if($this->authUser()) {
            $_SESSION = [];
            $result = [1, 'poprawnie wylogowano'];
         } else {
            $result = [0, 'Nie można wylogować niezalogowanego użytkownika'];
         }
         return $result;

      }

      private function validateRegistrationData($data) {// DOKOŃCZYĆ
         
         return true;         

      }

      private function validateLogin($data) {

         $email = strip_tags($data['email']);
         $password = md5(strip_tags($data['password']));
         $result = parent::select('*', 'users', 'WHERE email = "' . $email . '"');

         if($result){
            $row = $result->fetch_array(MYSQLI_ASSOC);            
            if($row['password'] == $password) {
               $_SESSION['logged'] = 1;
               $_SESSION['admin'] = $row['admin'];
               $_SESSION['user_id'] = $row['id'];
               $_SESSION['user_name'] = $row['name'];
               $_SESSION['user_email'] = $row['email'];
               $_SESSION['password'] = $row['password'];
               return true;
            } else {
               return false;
            }
         }

      }

      private function checkUsernameFree($username) {
         if(!parent::select('email', 'users', 'WHERE email = "' . $username . '"')){
            return true;
         }
      }

      public function authUser() {
         return ($_SESSION['logged'] == 1) ? true : false;
      }

      public function authAdmin() {
         return ($_SESSION['admin'] == 1) ? true : false;
      }

   }

?>