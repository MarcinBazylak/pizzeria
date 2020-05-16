<?php

   class User extends Model {

      private $alert = [];
   
      protected function checkConn() {

         $mysqli = parent::$mysqli;

         if ($mysqli -> connect_errno) {         
            echo "Nie udało się połączyć z bazą danych: " . $mysqli -> connect_error;
            exit();
         }

      }

      public function create($data) {
         
         $data = $this->validateData($data);
         if($this->authAdmin()) {
            if($this->validateRegistrationData($data)) {
               $token = md5(time());
               $password = md5($data['pass1']);
               if(parent::insert(
                  'users',
                  'token, email, password, name',
                  '"' . $token . '", "' . $data['email'] . '", "' . $password . '", "' . $data['name'] . '"'
               )) {
                  $this->alert = [1, 'Użytkownik ' . $data['name'] . ' został zarejestrowany'];
               } else {
                  $this->alert = [0, 'Wystąpił błąd. Sprawdź wprowadzone dane i spróbuj ponownie'];
               }
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function giveAdminRights($userId) {

         if($this->authAdmin()) {
            $result = parent::select('email', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if(parent::update('users', 'admin = "1"', 'WHERE id = "' . $userId . '"')) {
               $this->alert = [1, 'Przyznano prawa administratora dla ' . $row['email']];
            } else {
               $this->alert = [0, 'Użytkownikowi ' . $row['email'] . ' nie można nadać praw administratora'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function revokeAdminRights($userId) {

         if($this->authAdmin()) {
            $result = parent::select('email', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if(parent::update('users', 'admin = "0"', 'WHERE id = "' . $userId . '"')) {
               $this->alert = [1, 'Odebrano prawa administratora dla ' . $row['email']];
            } else {
               $this->alert = [0, 'Użytkownik ' . $row['email'] . ' nie posiada praw administratora'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function remove($userId) {

         if($this->authAdmin()) {
            $result = parent::select('email', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if(parent::delete('users', 'id = "' . $userId . '"')) {
               $this->alert = [1, 'Użytkownik ' . $row['email'] . ' został usunięty'];
            } else {
               $this->alert=[0, 'Nie można usunąć użytkownika. Taki użytkownik nie istnieje'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function login($data) {
         $data = $this->validateData($data);
         return ($this->validateLogin($data)) ? [1, 'Zostałeś poprawnie zalogowany'] : $this->alert;
      }

      public function logout() {

         if($this->authUser()) {
            $_SESSION = [];
            $this->alert = [1, 'poprawnie wylogowano'];
         } else {
            $this->alert = [0, 'Nie można wylogować niezalogowanego użytkownika'];
         }
         return $this->alert;

      }

      private function validateRegistrationData($data) {
         
         $fields = ['name', 'email', 'pass1', 'pass2'];         
         foreach($fields as $field) {
            if(!array_key_exists($field, $data)) {
               trigger_error("Nie wypełniłeś wszystkich pól");
               return;
            }
         }
         return ($this->checkAllFieldsFilled($data) && $this->validateEmail($data) && $this->checkUsernameFree($data) && $this->checkPasswords($data));
         
      }

      private function checkAllFieldsFilled($data) {
         if(!empty($data['name']) && !empty($data['email']) && !empty($data['pass1']) && !empty($data['pass2'])) {
            return true;
         } else {
            $this->alert = [0, 'Nie wszystkie pola zostały wypełnione'];
         }
      }

      private function validateEmail($data) {
         if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return true;
         } else {
            $this->alert = [0, 'Adres email jest nieprawidlowy'];
         }
      }
      
      private function checkPasswords($data) {
         if($data['pass1'] == $data['pass2']) {
            return true;
         } else {
            $this->alert = [0, 'Hasła które wprowadziłeś nie są jednakowe'];
         }
      }

      private function checkUsernameFree($data) {
         if(!parent::select('email', 'users', 'WHERE email = "' . $data['email'] . '"')) {
            return true;
         } else {
            $this->alert = [0, 'Aadres ' . $data['email'] . ' jest już zarejestrowany'];
         }
      }

      private function validateLogin($data) {

         $data = $this->validateData($data);
         $email = strip_tags($data['email']);
         $password = md5(strip_tags($data['password']));
         $result = parent::select('*', 'users', 'WHERE email = "' . $email . '"');

         if($result){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['password'] == $password) {
               if($row['active'] == 1) {
                  $date = date("Y-m-d G:i:s");
                  $_SESSION['logged'] = 1;
                  $_SESSION['admin'] = $row['admin'];
                  $_SESSION['user_id'] = $row['id'];
                  $_SESSION['user_name'] = $row['name'];
                  $_SESSION['user_email'] = $row['email'];
                  $_SESSION['password'] = $row['password'];
                  parent::update('users', 'last_login = "' . $date . '"', 'WHERE id = "' . $row['id'] . '"');
                  return true;
               } else {
                  $this->alert = [0, 'Twoje konto jest nieaktywne. Skontaktuj się z administratorem'];
               }
            } else {
               $this->alert = [0, 'Podałeś niepoprawny email lub hasło'];
            }
         }

      }

      public function authUser() {
         return ($_SESSION['logged'] == 1);
      }

      public function authAdmin() {
         return ($_SESSION['admin'] == 1);
      }

      public function validateData($data) {
         $data = array_map('strip_tags', $data);
         $data = array_map('trim', $data);
         return $data;
      }

   }

?>