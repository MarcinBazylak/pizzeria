<?php
session_start();
error_reporting(~E_NOTICE); 

include 'includes/db.php';
include 'includes/functions.php';
require_once 'models/model.php';
require_once 'includes/autoload.php';

$user = new User;

if($_GET['action'] == 'logout') $alert = $user->logout();
if($_GET['action'] == 'authenticate') $alert = ($user->login($_POST));
?>
<!DOCTYPE html>
<html lang="pl">
   <head>
      <base href="/">
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="img/icon.png">
      <link rel="stylesheet" href="css/style.css?<?php echo time() ?>">
      <link rel="stylesheet" href="css/menu.css?<?php echo time() ?>">
      <link rel="stylesheet" href="css/forms.css?<?php echo time() ?>">
      <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Pizzeria Francesco - Najlepsza PIZZA w mieście</title>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="js/addItem.js"></script>
   </head>
   <body>
      <div class="container">
         <header>
            <div class="top"></div>
               <nav>
                  <label class="navigation-toggle" for="input-toggle">
                     <span></span>
                     <span></span>
                     <span></span>
                  </label>
                  <input type="checkbox" id="input-toggle">
                  <ul>
                     <li>
                        <a href="/">HOME</a>
                     </li>
                     <li>
                        <a href="menu">MENU</a>
                     </li>
                     <li>
                        <a href="order">ZAMÓW</a>
                     </li>
                     <li>
                        <a href="contact">KONTAKT</a>
                     </li>
                     <?php
                     if(User::authUser()) {
                        echo '
                     <li>
                        <a href="/orders"><span style="color: yellow">ZAMÓWIENIA</span></a>
                     </li>
                     <li>
                        <a href="/';
                        echo (User::authAdmin()) ? 'adminPanel' : 'user';                        
                        echo'"><span style="color: orangered">PANEL</span></a>
                     </li>';
                     }
                     if(User::authUser()) {
                        echo '
                     <li>
                        <a href="/home/logout"><span style="color: yellow">WYLOGUJ</span></a>
                     </li>';
                     }
                     ?>
                  </ul> 
               </nav>            
         </header>
         <main>
<?php

if(!empty($alert)) displayAlert($alert);

include (empty($_GET['page'])) ? 'views/home.php' : 'views/' . $_GET['page'] . '.php';

?>
         </main>
      </div>
      <script src="js/submitForm.js"></script>
   </body>
</html>
<?php $mysqli->close(); ?>