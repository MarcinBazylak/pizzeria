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
         <h1><span style="font-size:8vh">FRANCESCO</span><br>NAJLEPSZA PIZZA W MIEŚCIE</h1>
         <nav>
            <ul>
               <li>
                  <a href="index.php">Strona główna</a>
               </li>
               <li>
                  <a href="order">Zamów pizzę</a>
               </li>
               <li>
                  <a href="contact">Kontakt</a>
               </li>
            </ul>
         </nav>
      </header>

      <aside>
         <div class="asideHead">MENU</div>
         <div class="asideContent">

<?php

         for($i = 1; $i < 15; $i++) {

         echo'
            <a href="zamow/1">
               <div class="pizza">
                  <div class="pizzaDesc">
                     <p>Margherita<br>
                        <span>
                           SOS, SER, SZYNKA, OREGANO
                        </span>
                     </p>
                  </div>
                  <div class="pizzaPrice">
                     20zł
                  </div>
               </div>
            </a>';
         }

?>

         </div>
      </aside>

      <main>
         <div class="mainContent">
            <h2>
               Witaj na stronie Pizzerii Francesco. Pizzerii, której szefem jest prawdziwy włoski kucharz Francesco Bartollini.
            </h2>
            <p>
               Zamów pizzę.
            </p>
         </div>
      </main>

   </div>

   <footer>
   <a href="regulamin">Regulamin strony</a><br>
   <a href="rodo">Polityka RODO</a><br>
      Copyright: Pizzeria Francesco. Wszelkie prawa zastrzeżone<br>
      Projekt i wykonanie <a href="http://marcinbazylak.com">Marcin Bazylak</a>.
   </footer>

</body>

</html>