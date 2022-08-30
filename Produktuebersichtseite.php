<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="Startseite.css">
    <link rel="stylesheet" href="Produktuebersichtseite.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
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

    <div class="abstandhalter3"></div>

    <div class="filter_box_umriss">

    <div class="filter_box">
      <br>

      <!-- Filter auf die Stadt mits Icon davor -->
      <div class="icons">
        <div class="ortsfilter_left"> </div>
        <div class="ortsfilter_right">
              <select name="stadt" id="stadt">
                  <option value="Berlin">Berlin</option>
                  <option value="Bielefeld">Bielefeld</option>
                  <option value="Bochum">Bochum</option>
                  <option value="Bremen">Bremen</option>
                  <option value="Dortmund">Dortmund</option>
                  <option value="Dresden">Dresden</option>
                  <option value="Freiburg">Freiburg</option>
                  <option value="Hamburg">Hamburg</option>
                  <option value="Koeln">Koeln</option>
                  <option value="Leipzig">Leipzig</option>
                  <option value="Muenchen">Muenchen</option>
                  <option value="Nuernberg">Nuernberg</option>
                  <option value="Paderborn">Paderborn</option>
                  <option value="Rohstock">Rohstock</option>
              </select>
            </div>
      </div>

      <div class="abstandhalter2">
      </div>

      <!-- Filter auf den Zeitraum mit Icon davor-->
      <div class="icons">

        <div class="kalender_left">
        </div>

        <div class="kalender_right">
          <form>
            <div class="kalender_startdatum">
                <input type="text" placeholder: "Startdatum">
            </div>
          </form>

        <div class="bis"> bis
        </div>

          <form>
            <div class="kalender_enddatum">
                <input type="text" placeholder: "Enddatum">
            </div>
          </form>
        </div>

      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <!-- Icons der Automodelle + Automodelle -->
      <div class="abstandhalter2">
      </div>

      <div class="icons_modelle_box">

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon1_coupe.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon2_limousine.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon3_suv.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon4_mehrsitzer.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon1_coupe.png" >
          </div>

          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon1_coupe.png" >
          </div>


      </div>

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

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <div class="abstandhalter2">
      </div>

      <!-- Alle weiteren Filter werden hier in Zweierpaaren nebeneinander untereinander aufgereiht.
      Da allerdings unterschiedliche Icons in die divs geladen werden wir hier kein php verwendet. -->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Hersteller
        </div>
        <div class = "text_filter"> Sitze
        </div>
      </div>

      <div class="allgemeine_filter_box">
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
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
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
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
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
        <div class = "filter_inhalt">
          <div class = "pfeil">
          </div>
        </div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>
      <br>

      <!-- Klima und GPS -->
      <div class="allgemeine_filter_box">

        <div class = "filter_gps_klima">Klima</div>

        <label class="toggle" for="klima">
          <input class="toggle__input" name="" type="checkbox" id="klima">
          <div class="toggle__fill"></div>
        </label>

        <div class = "filter_gps_klima">GPS</div>

        <label class="toggle" for="gps">
          <input class="toggle__input" name="" type="checkbox" id="gps">
          <div class="toggle__fill"></div>
        </label>

      </div>

    </div>

  </div>

</div>

<!-- Auflistung Automodelle -->

<?php for ($i=0; $i < 16; $i++){
    ?>

<div class="erster_Paragraph">

  <?php for ($j=0; $j < 4; $j++){
      ?>
  <div class = "autos">
  <h1> 1er BMW </h1>
  <p> ab 98.66 Euro / Tag </p>
  </div>
  <?php }
  ?>

</div>

<?php }
  ?>

  <!-- footer /-->
  <div class="footer">
    <div class="socials">Our Socials</div>
    <a href="haha"><img src="Bilder/Footer/Instagram.png"
    style="width: 32px; height: 32px;display: block;margin-left:46%;position:absolute;top: 45%"></a>
    <a href="haha"><img src="Bilder/Footer/icons8-facebook-25.png"
    style="width: 50px; height: 50px;display: block;margin-left:48.5%;position:absolute;top: 42%"></a>
    <a href="haha"><img src="Bilder/Footer/icons8-twitter-24.png"
    style="width: 32px; height: 32px;display: block;margin-left:52.5%;position:absolute;top: 45%"></a>
    <div class="AGB"><a href="haha">AGB</a>   |   <a href="haha">Impressum</a>   |   <a href="haha">Datenschutz</a></div>
  </div>
</body>

</html>
