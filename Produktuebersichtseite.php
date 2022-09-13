<!DOCTYPE html>

<!-- Header-->
<html>
<head>

  <!--  Stylesheet, Schriftarten &  Sonderzeichen laden-->
  <link rel="stylesheet" href="Startseite.css">
    <link rel="stylesheet" href="Produktuebersichtseite.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <meta charset="utf-8">

  <!-- Datenbank Laden-->
  <?php
        include('_db_team.php');
        $pdo = dbConnect(); ?>

</head>

<body>

<!--  Alle Filteraspekte-->
  <?php
    $stadt = (isset($_REQUEST['stadt']) && !empty($_REQUEST['stadt'])) ? $_REQUEST['stadt'] : null;
    $start = (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) ? $_REQUEST['start'] : null;
    $ende = (isset($_REQUEST['ende']) && !empty($_REQUEST['ende'])) ? $_REQUEST['ende'] : null;
    $hersteller = (isset($_REQUEST['hersteller']) && !empty($_REQUEST['hersteller'])) ? $_REQUEST['hersteller'] : null;
    $sitze = (isset($_REQUEST['sitze']) && !empty($_REQUEST['sitze'])) ? $_REQUEST['sitze'] : null;
    $schaltung = (isset($_REQUEST['schaltung']) && !empty($_REQUEST['schaltung'])) ? $_REQUEST['schaltung'] : null;
    $tueren = (isset($_REQUEST['tueren']) && !empty($_REQUEST['tueren'])) ? $_REQUEST['tueren'] : null;
    $motor = (isset($_REQUEST['motor']) && !empty($_REQUEST['motor'])) ? $_REQUEST['motor'] : null;
    $mindestalter = (isset($_REQUEST['mindestalter']) && !empty($_REQUEST['mindestalter'])) ? $_REQUEST['mindestalter'] : null;
    $antrieb = (isset($_REQUEST['antrieb']) && !empty($_REQUEST['antrieb'])) ? $_REQUEST['antrieb'] : null;
    $preis = (isset($_REQUEST['preis']) && !empty($_REQUEST['preis'])) ? $_REQUEST['preis'] : null;
    $klima = (isset($_REQUEST['klima']) && !empty($_REQUEST['klima'])) ? $_REQUEST['klima'] : null;
    $gps = (isset($_REQUEST['gps']) && !empty($_REQUEST['gps'])) ? $_REQUEST['gps'] : null;

    $filter = [
      'stadt' => $stadt,
      'start' => $start,
      'ende' => $ende,
      'hersteller' => $hersteller,
      'sitze' => $sitze,
      'schaltung' => $schaltung,
      'tueren' => $tueren,
      'motor' => $motor,
      'mindestalter' => $mindestalter,
      'antrieb' => $antrieb,
      'preis' => $preis,
      'klima' => $klima,
      'gps' => $gps
    ];
  ?>


    <div id="navbar">
      <a href="Startseite.html" id="logo">Out & About</a>
      <div id="navbar-right">
        <a href="Produktuebersichtseite.php">Cars</a>
        <a href="Cities.php">Cities</a>
        <a href="Meine_Buchungen.html">Meine Buchungen</a>
        <a href="login" class="icon" ><img src="Bilder/Homepage/Icon-Login.png"></a>
      </div>
    </div>


    <div class="filterleiste">

    <div class="filter_box_umriss">

    <div class="filter_box">

    <div class="abstandhalter2"> </div>

      <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <!-- Filter auf die Stadt mits Icon davor -->
      <div class="icons">
        <div class="ortsfilter_left"> </div>
        <select class= "ortsfilter_right" name="stadt" id="stadt">
            <option value="Hamburg"> <?php if ($filter['stadt'] === 'Hamburg') echo 'selected' ?>Hamburg</option>
            <option value="Berlin"><?php if ($filter['stadt'] === 'Berlin') echo 'selected' ?>Berlin</option>
            <option value="Bielefeld"><?php if ($filter['stadt'] === 'Bielefeld') echo 'selected' ?>Bielefeld</option>
            <option value="Bochum"><?php if ($filter['stadt'] === 'Bochum') echo 'selected' ?>Bochum</option>
            <option value="Bremen"><?php if ($filter['stadt'] === 'Bremen') echo 'selected' ?>Bremen</option>
            <option value="Dortmund"><?php if ($filter['stadt'] === 'Dortmund') echo 'selected' ?>Dortmund</option>
            <option value="Dresden"><?php if ($filter['stadt'] === 'Dresden') echo 'selected' ?>Dresden</option>
            <option value="Freiburg"><?php if ($filter['stadt'] === 'Freiburg') echo 'selected' ?>Freiburg</option>
            <option value="Köln"><?php if ($filter['stadt'] === 'Köln') echo 'selected' ?>Köln</option>
            <option value="Leipzig"><?php if ($filter['stadt'] === 'Leipzig') echo 'selected' ?>Leipzig</option>
            <option value="München"><?php if ($filter['stadt'] === 'München') echo 'selected' ?>München</option>
            <option value="Nürnberg"><?php if ($filter['stadt'] === 'Nürnberg') echo 'selected' ?>Nürnberg</option>
            <option value="Paderborn"><?php if ($filter['stadt'] === 'Paderborn') echo 'selected' ?>Paderborn</option>
            <option value="Rohstock"><?php if ($filter['stadt'] === 'Rohstock') echo 'selected' ?>Rohstock</option>
      </select>
      </div>

      <div class="abstandhalter2">
      </div>

      <!-- Filter auf den Zeitraum mit Icon davor-->
      <div class="icons">

        <div class="kalender_left">
        </div>

        <div class="kalender_right">

          <input class="kalender_startdatum" type="date" id="start" value="<?= $filter['start'] ?>">

          <div class="bis"> bis
          </div>

          <input class="kalender_enddatum" type="date" id="ende" value="<?= $filter['ende'] ?>">

        </div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <!-- Icons der Automodelle + Automodelle -->
      <div class="abstandhalter2">
      </div>

      <!-- Filterung auf die Autokathegorien -->
      <!-- Zuerst symbolische Icons-->
      <div class="icons_modelle_box">

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon1_coupe.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon2_limousine.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon3_suv.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon4_mehrsitzer.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon8_cabrio.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon9_combi.png" >
          </div>

      </div>

      <!-- Kathegorie Bezeichnungen -->
      <div class="text_modelle_box">

        <div class = "text_modelle"> Coupe
        </div>
        <div class = "text_modelle"> Limosinen
        </div>
        <div class = "text_modelle"> SUVs
        </div>
        <div class = "text_modelle"> Mehrsitzer
        </div>
        <div class = "text_modelle"> Cabrio
        </div>
        <div class = "text_modelle"> Combi
        </div>

      </div>

      <div class="abstandhalter2">
      </div>

      <!-- Checkboxen für die Automodelle-->
      <div class="text_modelle_box">

        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="Coupé">
        </div>
        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="Limosine">
        </div>
        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="SUV">
        </div>
        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="Mehrsitzer">
        </div>
        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="Cabrio" >
        </div>
        <div class = "text_modelle"> <input class = "c_box" type="checkbox" name="type" id="Combi">
        </div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <div class="abstandhalter2">
      </div>

      <!-- Alle weiteren Filter werden hier in Zweierpaaren nebeneinander untereinander aufgereiht-->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Hersteller
        </div>
        <div class = "text_filter"> Sitze
        </div>
      </div>

      <div class="allgemeine_filter_box">

        <select class= "filter_inhalt" name="hersteller" id="hersteller">
            <option value="Alle"> <?php if ($filter['hersteller'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

        <select class= "filter_inhalt" name="sitze" id="sitze">
            <option value="Alle"> <?php if ($filter['sitze'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

      </div>

      <div class="abstandhalter">
      </div>


      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Schaltung
        </div>
        <div class = "text_filter"> Tueren
        </div>
      </div>

      <div class="allgemeine_filter_box">

        <select class= "filter_inhalt" name="schaltung" id="schaltung">
            <option value="Alle"> <?php if ($filter['schaltung'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

        <select class= "filter_inhalt" name="tueren" id="tueren">
            <option value="Alle"> <?php if ($filter['tueren'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

      </div>

      <div class="abstandhalter">
      </div>

      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Motor
        </div>
        <div class = "text_filter"> Mindestalter
        </div>
      </div>

      <div class="allgemeine_filter_box">

        <select class= "filter_inhalt" name="motor" id="motor">
            <option value="Alle"> <?php if ($filter['motor'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

        <select class= "filter_inhalt" name="mindestalter" id="mindestalter">
            <option value="Alle"> <?php if ($filter['mindestalter'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

      </div>

      <div class="abstandhalter">
      </div>

      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Antrieb
        </div>
        <div class = "text_filter"> Preis bis
        </div>
      </div>

      <div class="allgemeine_filter_box">

        <select class= "filter_inhalt" name="antrieb" id="antrieb">
            <option value="Alle"> <?php if ($filter['antrieb'] === 'Alle') echo 'selected' ?>Alle</option>
            <option value="Elektro"> <?php if ($filter['antrieb'] === 'Electric') echo 'selected' ?>Elektro</option>
            <option value="Verbrenner"> <?php if ($filter['antrieb'] === 'Combuster') echo 'selected' ?>Verbrenner</option>
        </select>

        <select class= "filter_inhalt" name="preis" id="preis">
            <option value="Alle"> <?php if ($filter['preis'] === 'Alle') echo 'selected' ?>Alle</option>
        </select>

      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>
      <br>

      <!-- Klima und GPS Schalter -->
      <div class="allgemeine_filter_box">

        <div class = "filter_gps_klima">Klima</div>
        <label class="toggle" for="klima">
          <input class="toggle__input" name="" type="checkbox" id="klima" value= "1" <?php if ($filter['klima'] === '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

        <div class = "filter_gps_klima">GPS</div>
        <label class="toggle" for="gps">
          <input class="toggle__input" name="" type="checkbox" id="gps">
          <div class="toggle__fill"></div>
        </label>

      </div>

    </div>

    <br>

<!-- Filter Eingaben werden abgeschickt-->

<div class ="lets_go">
<input type="submit" class="absenden" value="Let's Go">
</div>

<!-- Das Form und der Filterkasten wird geschlossen -->
  </form>
  </div>

</div>








<!-- Auflistung der gefilterten Automodelle, zum Start: Hamburg + 2 Tage-->

<?php for ($i=0; $i < 2; $i++){
    ?>

<!-- Unterteilung in Viererreihen-->
<div class="erster_Paragraph">

  <?php for ($j=0; $j < 4; $j++){
      ?>
  <div class = "autos">

  <!-- Marke + Name + ggf. Name Erweiterung-->
  <h1> 1er BMW </h1>
  <br><br>

  <!-- Richtiges Bild (nach Autotyp laden)-->
  <img src="Bilder/Produktuebersichtseite/coupe.png">
  <br><br>

  <!-- Preis-->
  <p> ab 98.66 Euro / Tag </p>
  </div>

  <?php }
  ?>

</div>

<?php }
  ?>



  <!-- Footer /-->

      <div class="footer">
          <div class="oft_besucht"><h4>Oft Besucht</h4></div>
            <div class="footer_startseite">
            <a href="Startseite.html">Startseite</a></div>
            <div class="footer_cars">
            <a href="Produktuebersichtseite.html">Cars</a></div>
            <div class="footer_cities">
            <a href="Cities.html">Cities</a>
          </div>
        <div class="legal"><h4>Legal</h4>
          <div class="footer_datenschutz">
            <a href="#">Datenschutz</a></div>
          <div class="footer_agb">
            <a href="#">AGB & Rechtliches</a></div>
          <div class="footer_impressum">
            <a href="#">Impressum</a></div>
        </div>
        <div class="about"><h4>About us</h4></div>
          <div class="footer_team">
            <a href="Teamseite_Henry.php">Das Team</a></div>
        <div class="copyright">Copyright 2022</div>
          <a href="haha"><img src="Bilder/Footer/instagram.png" class="instagram"></a>
          <a href="haha"><img src="Bilder/Footer/facebook.png" class="facebook"></a>
          <a href="haha"><img src="Bilder/Footer/twitter.png" class="twitter"></a>
      </div>
</body>

</html>
