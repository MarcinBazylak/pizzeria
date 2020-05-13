<?php

error_reporting(0);

require_once 'includes/db.php';
require_once 'includes/autoload.php';

?>

<!DOCTYPE html>
<html lang="pl">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="css/style.css">
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

      <aside>

         <?php include 'views/home-left.php'; ?>

      </aside>

      <main>

         <?php include 'views/home-right.php'; ?>

      </main>

   </div>

</body>

</html>