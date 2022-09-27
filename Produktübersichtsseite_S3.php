<!DOCTYPE html>



<!-- Header-->
<html>
<head>

  <!--  Stylesheet, Schriftarten &  Sonderzeichen laden-->
  <link rel="stylesheet" href="Startseite.css">
  <link rel="stylesheet" href="Produktübersichtsseite.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <meta charset="utf-8">


  <!-- Datenbank & Funktionen laden (Datenbank wird in P_Ausgelagert geladen)-->
  <?php
      include('P_Ausgelagert.php');
      ?>

</head>



<!--  Start Inhalt Website (BODY)-->

<body>


  <!-- Header -->
    <div id="navbar">
      <a href="Startseite.html" id="logo">Out & About</a>
      <div id="navbar-right">
        <a href="Produktuebersichtseite.html">Cars</a>
        <a href="Cities.html">Cities</a>
        <a href="Meine_Buchungen.html">Meine Buchungen</a>
        <a href="login" class="icon" ><img src="Bilder/Homepage/Icon-Login.png"></a>
      </div>
    </div>


<?php

session_start();

$_SESSION['anzahl_ergebnisse'] = anzahlErgebnisse();

//Hier brauchen keine Fälle mehr unterschieden werden.
//Die maximale Ausgabenzahl beträgt 20, daher ist immer nur eine Zeile notwendig.
echo "<div class = 'ergebnisse1'>";
ausgabe8('16');

echo "<a class='S1' href='Produktübersichtsseite_S2.php'> <- Seite 2 </a>";
echo "<a class='zurueck' href='Produktübersichtsseite.php'> <- Zurück zum Filtern </a>";
  ?>


 </body>

 </html>
