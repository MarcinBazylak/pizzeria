<?php

   class User extends Model {

      private $alert = [];

      public function create($data) { //UTWORZENIE NOWEGO UŻYTKOWNIKA
         
         $data = Data::validate($data); // UŻYWA trim() I strip_tags() NA DANYCH Z FORMULARZA
         if(self::authAdmin()) { // SPRAWDZA CZY UŻYTKOWNIKA MA PRAWA ADMINA
            if($this->validateRegistrationData($data)) { // SPRAWDZA CZY WSZYSTKIE DANE ZOSTAŁY WPROWADZONE PRAWIDŁOWO
               $token = md5(time());
               $password = md5($data['pass1']);
               if($this->insert(
                  'users',
                  'token, tel, password, name',
                  '"' . $token . '", "' . $data['tel'] . '", "' . $password . '", "' . $data['name'] . '"'
               )) { // TWORZY POZYTYWNY ALERT JEŻELI UDAŁO SIĘ UTWORZYĆ UŻYTKOWNIKA
                  $this->alert = [1, 'Użytkownik ' . $data['name'] . ' został zarejestrowany'];
               } else { // TWORZY NEGATYWNY ALERT JEŻELI NIE UDAŁO SIĘ UTWORZYĆ UŻYTKOWNIKA
                  $this->alert = [0, 'Wystąpił błąd. Sprawdź wprowadzone dane i spróbuj ponownie'];
               }
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert; // ZWRACA ALERT POWODZENIA LUB NIEPOWODZENIA OPERACJI

      }

      public function giveAdminRights($userId) {

         if(self::authAdmin()) {
            $result = $this->select('name', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($this->update('users', 'admin = "1"', 'WHERE id = "' . $userId . '"')) {
               $this->alert = [1, 'Przyznano prawa administratora dla ' . $row['name']];
            } else {
               $this->alert = [0, 'Użytkownikowi ' . $row['name'] . ' nie można nadać praw administratora'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function revokeAdminRights($userId) {

         if(self::authAdmin()) {
            $result = $this->select('name', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($this->update('users', 'admin = "0"', 'WHERE id = "' . $userId . '"')) {
               $this->alert = [1, 'Odebrano prawa administratora dla ' . $row['name']];
            } else {
               $this->alert = [0, 'Użytkownik ' . $row['name'] . ' nie posiada praw administratora'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function remove($userId) {

         if(self::authAdmin()) {
            $result = $this->select('name', 'users', 'WHERE id = "' . $userId . '"');
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($this->delete('users', 'id = "' . $userId . '"')) {
               $this->alert = [1, 'Użytkownik ' . $row['name'] . ' został usunięty'];
            } else {
               $this->alert=[0, 'Nie można usunąć użytkownika. Taki użytkownik nie istnieje'];
            }
         } else {
            $this->alert = [0, 'Nie posiadasz uprawnień do wykonania tej operacji'];
         }
         return $this->alert;

      }

      public function login($data) {
         unset($_POST);
         $data = Data::validate($data);
         return ($this->validateLogin($data)) ? [1, 'Zostałeś poprawnie zalogowany'] : $this->alert;
      }

      public function logout() {

         if(self::authUser()) {
            $_SESSION = [];
            $this->alert = [1, 'poprawnie wylogowano'];
         } else {
            $this->alert = [0, 'Nie można wylogować niezalogowanego użytkownika'];
         }
         return $this->alert;

      }

      public function changePassword($data) {

         if(self::authUser()) {
            $data = Data::validate($data);
            $oldPass = md5($data['oldPass']);
            $newPass1 = md5($data['newPass1']);
            $newPass2 = md5($data['newPass2']);
            if($oldPass == $_SESSION['password']) {
               if($this->checkPasswords($newPass1, $newPass2)) {
                  if($this->update('users', 'password = "' . $newPass1 . '"', 'WHERE id = "' . $_SESSION['user_id'] . '"')) {
                     $_SESSION['password'] = $newPass1;
                     $this->alert = [1, 'Hasło zostało zmienione'];
                  } else {
                     $this->alert = [0, 'Wystąpił błąd'];
                  }
               }
            } else {
               $this->alert = [0, 'Obecne hasło, które podałeś jest nieprawidłowe'];
            }
         } else {
            $this->alert = [0, 'Musisz być zalogowany aby móc zmienić hasło'];
         }
         return $this->alert;
      }

      private function validateRegistrationData($data) {         
         return ($this->checkAllFieldsFilled($data) && $this->validateTelNo($data) && $this->checkUsernameFree($data) && $this->checkPasswords($data['pass1'], $data['pass2']));
      }

      private function checkAllFieldsFilled($data) {
         if(!empty($data['name']) && !empty($data['tel']) && !empty($data['pass1']) && !empty($data['pass2'])) {
            return true;
         } else {
            $this->alert = [0, 'Nie wszystkie pola zostały wypełnione'];
         }
      }

      private function validateTelNo($data) {
         if(is_numeric($data['tel'])) {
            return true;
         } else {
            $this->alert = [0, 'Numer telefonu może składać się jedynie z cyfr'];
         }
      }
      
      private function checkPasswords($pass1, $pass2) {
         if($pass1 == $pass2) {
            return true;
         } else {
            $this->alert = [0, 'Hasła które wprowadziłeś nie są jednakowe'];
         }
      }

      private function checkUsernameFree($data) {
         if(!$this->select('tel', 'users', 'WHERE tel = "' . $data['tel'] . '"')) {
            return true;
         } else {
            $this->alert = [0, 'Użytkownik o numerze ' . $data['tel'] . ' jest już zarejestrowany'];
         }
      }

      private function validateLogin($data) {

         $data = Data::validate($data);
         $tel = strip_tags($data['tel']);
         $password = md5(strip_tags($data['password']));
         $result = $this->select('*', 'users', 'WHERE tel = "' . $tel . '" && password = "' . $password . '"');
         if($result){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if($row['active'] == 1) {
               $date = date("Y-m-d G:i:s");
               $_SESSION['logged'] = 1;
               $_SESSION['admin'] = $row['admin'];
               $_SESSION['user_id'] = $row['id'];
               $_SESSION['user_name'] = $row['name'];
               $_SESSION['user_tel'] = $row['tel'];
               $_SESSION['password'] = $row['password'];
               $this->update('users', 'last_login = "' . $date . '"', 'WHERE id = "' . $row['id'] . '"');
               return true;
            } else {
               $this->alert = [0, 'Twoje konto jest nieaktywne. Skontaktuj się z administratorem'];
            }
         } else {
            $this->alert = [0, 'Podałeś niepoprawny numer telefonu lub hasło'];
         }

      }

      public static function authUser() {
         return ($_SESSION['logged'] == 1);
      }

      public static function authAdmin() {
         return ($_SESSION['admin'] == 1);
      }

   }

?>