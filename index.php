<?php
session_start();
error_reporting(~E_NOTICE);

$page = strip_tags($_GET['page']);

include 'includes/db.php';
include 'includes/functions.php';
require_once 'models/model.php';
require_once 'includes/autoload.php';

$user = new User;

if($_GET['action'] == 'logout') $alert = $user->logout();

?>

<!DOCTYPE html>
<html lang="pl">
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="/css/style.css?<?php echo time() ?>">
      <link rel="stylesheet" href="/css/forms.css?<?php echo time() ?>">
      <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Pizzeria Francesco - Najlepsza PIZZA w mieście</title>
   </head>
   <body>
      <div class="container">
         <header>
            <div class="top">
            </div>
            <div class="navbar">
               <nav>
                  <ul>
                     <li>
                        <a href="/">HOME</a>
                     </li>
                     <li>
                        <a href="">MENU</a>
                     </li>
                     <li>
                        <a href="">ZAMÓW</a>
                     </li>
                     <li>
                        <a href="">KONTAKT</a>
                     </li>
                  </ul>
               </nav>
            </div>
         </header>
         <main>
<?php

if(isset($alert) && !empty($alert)) {
   displayAlert($alert);
}

if(isset($page) && !empty($page)) {
   include 'views/' . $page . '.php';
} else {
   include 'views/home.php';
}
?>

         </main>
      </div>
   </body>
</html>
<?php $mysqli->close(); ?>