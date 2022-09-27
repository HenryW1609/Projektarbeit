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
        <a href="Produktübersichtsseite.css">Cars</a>
        <a href="Cities.php">Cities</a>
        <a href="Meine_Buchungen.html">Meine Buchungen</a>
        <a href="login" class="icon" ><img src="Bilder/Homepage/Icon-Login.png"></a>
      </div>
    </div>

<?php

session_start();

echo "<a class='S1' href='Produktübersichtsseite.php'> <- Seite 1 </a>";

$_SESSION['anzahl_ergebnisse'] = anzahlErgebnisse();

//Im Fall von 8-12 Ergebnissen (eine Reihe)
if ($_SESSION['anzahl_ergebnisse']<= 12 AND $_SESSION['anzahl_ergebnisse']>= 8)
{echo "<div class = 'ergebnisse1'>";
ausgabe8('8');}


//Im Fall von 12 oder mehr Ergebnissen, aber nur einer benötigten Seite (weniger als 16 Ergebnisse)
//2 Reihen untereinander
else if ($_SESSION['anzahl_ergebnisse']<= 16 AND $_SESSION['anzahl_ergebnisse']>= 12)
{echo "<div class = 'ergebnisse2'>";
ausgabe8('8');}


//Im Fall 3 Seiten benötigt werden
else if ($_SESSION['anzahl_ergebnisse']> 16)
{echo "<div class = 'ergebnisse2'>";
ausgabe8('8');
echo "<a class='S3' href='Produktübersichtsseite_S3.php'> Seite 3 -> </a>";}

  ?>


 </body>

 </html>
