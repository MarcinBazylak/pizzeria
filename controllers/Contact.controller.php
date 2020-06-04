<?php

class Contact {

   private static $name;
   private static $email;
   private static $to;
   private static $subject;
   private static $message;
   private static $headers;

   public static function sendEmail($data) {

      $data = Data::validate($data);

      if(!$data['tick']) {

         self::$name = $data['name'];
         self::$email = $data['email'];
         self::$message = $data['text'];
         
         self::$to = "pizzeria@pizzafrancesco.pl";   
         self::$subject = self::$name." wysłał wiadomość ze strony pizzafrancesco.pl.";
         self::$subject = "=?UTF-8?B?".base64_encode(self::$subject)."?=";
         
         self::$headers = 'From: Formularz strony francesco.pl <farmularz@pizzafrancesco.pl>' . "\r\n" . 'Reply-To: '. self::$email . '' . "\r\n" . 'Content-Type: text/plain; charset=UTF-8';
         mail(self::$to, self::$subject, self::$message, self::$headers);

         return [1, 'Wiadomość została pomyślnie wysłana'];

      }

   }

}

?>