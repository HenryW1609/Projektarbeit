<!DOCTYPE html>
<html>

<head>
  <!-- Laden der benötigten Style Sheets / Schriftarten -->
  <link rel="stylesheet" href="Startseite.css">
  <link rel="stylesheet" href="Cities.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

  <?php $stadt = array("Berlin", "Bielefeld","Bochum","Bremen","Dortmund","Dresden","Freiburg","Hamburg","Koeln","Leipzig","Muenchen","Nuernberg","Paderborn","Rohstock"); ?>

</head>

<body>

<!-- Header -->
  <div id="navbar">
    <a href="Startseite.html" id="logo">Out & About</a>
    <div id="navbar-right">
      <a href="Produktuebersichtseite.php">Cars</a>
      <a href="Cities.php">Cities</a>
      <a href="Meine_Buchungen.html">Meine Buchungen</a>
      <a href="login" class="icon" ><img src="Bilder/Homepage/Icon-Login.png"></a>
    </div>
  </div>

<!-- Beginn Content -->
<div class="aufmacher">
  </div>

<div class="staedte_filter">

  <div class="hilfsbox1">

    <div class="lupe">
    </div>

    <input type="text" class="eingabe_feld" placeholder = "NACH EINER STADT SUCHEN"/>

    <div class="suchen_button">SUCHEN
    </div>

  </div>
</div>

<?php for ($i=0; $i < 14; $i++){
    ?>
    <div class="absatz_gruen">
      <div class="hilfskasten">

        <div class="box">
          <?php echo "<img src = 'Bilder/Cities/bild" .$i.".png'>";
          ?>
        </div>

        <div class="box"> <h1> <?php echo $stadt[$i]  ?> </h1>
          <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna al. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna al.</p>
          <a href ="Produktuebersichtseite.php" class="links"><img src="Bilder/Cities/icon_pfeil_weiß.png">ZUR AUSWAHL</a>
        </div>

      </div>
    </div>

  <?php
    $i = $i + 1; ?>

  <div class="absatz_weiß">
    <div class="hilfskasten">

      <div class="box" > <h1> <?php echo $stadt[$i]  ?> </h1>
        <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna al. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna al.</p>
        <a href ="Produktuebersichtseite.php" class="links"><img src="Bilder/Cities/icon_pfeil_gruen.png">ZUR AUSWAHL</a>
      </div>

      <div class="box">
        <?php echo "<img src = 'Bilder/Cities/bild" .$i.".png'>";
        ?>

      </div>
      </div>
    </div>

  <?php }
    ?>

<!-- Footer -->
<div class="footer">
  <div class="socials">Our Socials</div>
    <a href="haha"><img src="Bilder/Footer/Instagram.png" class="instagram"></a>
    <a href="haha"><img src="Bilder/Footer/icons8-facebook-25.png" class="facebook"></a>
    <a href="haha"><img src="Bilder/Footer/icons8-twitter-24.png" class="twitter"></a>
  <div class="AGB"><a href="haha">AGB</a>   |   <a href="haha">Impressum</a>   |   <a href="haha">Datenschutz</a></div>
</div>

</body>
</html>
