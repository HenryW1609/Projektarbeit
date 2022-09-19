<!DOCTYPE html>



<!-- LISTE DER PROBLEME-->


<!-- 1. Er zieht den Filter nicht in die Datenbank. Das Array bleibt leer.
 SUCHEN DAGEGEN FUNKTIONIERT?! Aber nur, wenn vorher nicht gefiltert wurde.-->
<!-- 2. Modellfilterung mit Checkbox ist nicht einbezogen, ebenso wie GPS & KLIMA (immer = 1). -->
<!-- 3. Ich kriege meinen ausgelagerten Code nicht zur Datenbank connected ohne eine Fehlermeldung. -->
<!-- 4. Bis jetzt kann man jedes Datum ab heute wählen, auch wenn Start vor Enddatum liegt.-->
<!-- 5. Ausgabe fehlt.-->



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
        include('db_Log.php');
        $pdo = dbConnect();
        // include 'P_Ausgelagert.php';

        print_r($_POST);
        ?>
</head>



<!--  Start Inhalt Website (BODY)-->
<body>

<!--  Alle Filteraspekte-->
  <?php
    // Zu Beginn starten wir mit dem Anlegen einer Session.
    session_start();

    // Zu Beginn werden alle Filterkriterien als Variablen angelegt.
    // Alle Variablen mit Ausnahme der Stadt und des Zeitraum bleiben unbefüllt
    // Als Stadt wird zu Beginn wie gefordert Hamburg und als Zeitraum heute und heute + 2 Tage genommen.
    $city = (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) ? $_REQUEST['city']:'';
    $Abholdatum = (isset($_REQUEST['Abholdatum']) && !empty($_REQUEST['Abholdatum'])) ? $_REQUEST['Abholdatum']:'';
    $Rückgabedatum = (isset($_REQUEST['Rückgabedatum']) && !empty($_REQUEST['Rückgabedatum'])) ? $_REQUEST['Rückgabedatum']:'';

    $stadt = (isset($_REQUEST['stadt']) && !empty($_REQUEST['stadt'])) ? $_REQUEST['stadt'] : 'Hamburg';
    $start = (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) ? $_REQUEST['start'] : date('Y-m-d');
    $ende = (isset($_REQUEST['ende']) && !empty($_REQUEST['ende'])) ? $_REQUEST['ende'] : date('Y-m-d', strtotime("+2 days"));
    $typ = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : null;
    $hersteller = (isset($_REQUEST['hersteller']) && !empty($_REQUEST['hersteller'])) ? $_REQUEST['hersteller'] : null;
    $sitze = (isset($_REQUEST['sitze']) && !empty($_REQUEST['sitze'])) ? $_REQUEST['sitze'] : null;
    $schaltung = (isset($_REQUEST['schaltung']) && !empty($_REQUEST['schaltung'])) ? $_REQUEST['schaltung'] : null;
    $tueren = (isset($_REQUEST['tueren']) && !empty($_REQUEST['tueren'])) ? $_REQUEST['tueren'] : null;
    $kofferraum = (isset($_REQUEST['kofferraum']) && !empty($_REQUEST['kofferraum'])) ? $_REQUEST['kofferraum'] : null;
    $mindestalter = (isset($_REQUEST['mindestalter']) && !empty($_REQUEST['mindestalter'])) ? $_REQUEST['mindestalter'] : null;
    $antrieb = (isset($_REQUEST['antrieb']) && !empty($_REQUEST['antrieb'])) ? $_REQUEST['antrieb'] : null;
    $preis = (isset($_REQUEST['preis']) && !empty($_REQUEST['preis'])) ? $_REQUEST['preis'] : null;
    $klima = (isset($_REQUEST['klima']) && !empty($_REQUEST['klima'])) ? $_REQUEST['klima'] : null;
    $gps = (isset($_REQUEST['gps']) && !empty($_REQUEST['gps'])) ? $_REQUEST['gps'] : null;
    $sortieren = (isset($_REQUEST['sortieren']) && !empty($_REQUEST['sortieren'])) ? $_REQUEST['sortieren'] : null;

    // Das Filter Array wird nun erstellt.
      // Hierzu wird aber erst abgefragt, ob der Filter schon existiert uns von dem User befüllt wurde.
    $filter = (isset($_SESSION['filter']) && !empty($_SESSION['filter'])) ? $_SESSION['filter'] : null;
    $absenden = (isset($_REQUEST['absenden']) && !empty($_REQUEST['absenden'])) ? $_REQUEST['absenden'] : null;

    // Nun alle Filtervariablen Werte wie oben definiert zugewiesen.
    if ($filter == null) {
    $filter = [
      'stadt' => $stadt,
      'start' => $start,
      'ende' => $ende,
      'type' => $typ,
      'hersteller' => $hersteller,
      'sitze' => $sitze,
      'schaltung' => $schaltung,
      'tueren' => $tueren,
      'kofferraum' => $kofferraum,
      'mindestalter' => $mindestalter,
      'antrieb' => $antrieb,
      'preis' => $preis,
      'klima' => $klima,
      'gps' => $gps,
      'sortieren' => $sortieren];

      $_SESSION['filter'] = $filter;}

      else{$filter == $_SESSION['filter'];}
    ?>





    <!-- PHP BEREICH ZU DEN VERSCHIEDEN BUTTONS-->
    <?php

    //Es ergeben sich vier Buttons, die man nach der Filterung anklicken kann.
    //SUCHEN / Gesamte Auswahl zurück setzten. / FILTERN /
    //Diese vier Fälle werden mit Hilfe einer if-else abfrage durchlaufen.

    if(isset($_REQUEST['absenden'])){
      //FALL 1: Der Button suchen wurde angeklickt. Filterung erfolgt nur auf Datum / Stadt.
      if ($absenden === 'SUCHEN') {
          $_SESSION['filter'] = [
            //Alle Variablen außer Stadt und Datum werden zurückgesetzt.
            'type' => "",
            'hersteller' => "",
            'sitze' => "",
            'schaltung' => "",
            'tueren' => "",
            'kofferraum' => "",
            'mindestalter' => "",
            'antrieb' => "",
            'preis' => "",
            'klima' => "",
            'gps' => "",
            'sortieren' => "",
            //Die drei ausgefüllten Variablen werden befüllt.
            'stadt' => $stadt,
            'start' => $start,
            'ende' => $ende
            ];

          }

      //FALL 2: Die Suche soll zurück gesetzt werden.
      // Hierzu leere ich das gesamte Array.
      else if ($absenden === 'Gesamte Auswahl zurück setzten.'){
          $_SESSION['filter'] = [
          'stadt' => 'Hamburg',
          'start' => date('Y-m-d'),
          'ende' => date('Y-m-d', strtotime("+2 days")),
          'type' => "",
          'hersteller' => "",
          'sitze' => "",
          'schaltung' => "",
          'tueren' => "",
          'kofferraum' => "",
          'mindestalter' => "",
          'antrieb' => "",
          'preis' => "",
          'klima' => "",
          'gps' => "",
          'sortieren' => "",];
          $filter = $_SESSION['filter'];

      }

      //FALL 3: Wir filtern alle Kathegorien.
      //Alle Variablen werden auf die neuen Werte gesetzt und überschrieben wie ganz zu Beginn.
      //Der Quelltext konnte daher von weiter oben kopiert werden.
      else if ($absenden === 'FILTERN'){
          $_SESSION ['filter'] = [
          'stadt' => $stadt,
          'start' => $start,
          'ende' => $ende,
          'type' => $typ,
          'hersteller' => $hersteller,
          'sitze' => $sitze,
          'schaltung' => $schaltung,
          'tueren' => $tueren,
          'kofferraum' => $kofferraum,
          'mindestalter' => $mindestalter,
          'antrieb' => $antrieb,
          'preis' => $preis,
          'klima' => $klima,
          'gps' => $gps,
          'sortieren' => $sortieren];
          $filter =   $_SESSION ['filter'] ;

          echo $_SESSION['filter']['preis'];
          echo $_SESSION['filter']['stadt'];}


      //FALL 4: Es werden alle Detail-Filter und die Sortierung zurückgesetzt.
      //Hierzu leeren wir erneut das array (Oberer Quelltext aus Fall 1 kopiert).
      else if ($absenden === 'Filter und Sortierung zurücksetzen.'){
        $_SESSION['filter'] = [
          //Alle Variablen außer Stadt und Datum werden zurückgesetzt.
          'type' => "",
          'hersteller' => "",
          'sitze' => "",
          'schaltung' => "",
          'tueren' => "",
          'kofferraum' => "",
          'mindestalter' => "",
          'antrieb' => "",
          'preis' => "",
          'klima' => "",
          'gps' => "",
          'sortieren' => "",
          'stadt' => $stadt,
          'start' => $start,
          'ende' => $ende
        ];
      }
    }
    ?>






<!-- Navigationsbar - später includieren mit PHP! -->

    <div id="navbar">
      <a href="Startseite.html" id="logo">Out & About</a>
      <div id="navbar-right">
        <a href="Produktuebersichtseite.php">Cars</a>
        <a href="Cities.php">Cities</a>
        <a href="Meine_Buchungen.html">Meine Buchungen</a>
      </div>
    </div>







    <div class="filterleiste">

    <div class="filter_box_umriss">

    <div class="filter_box">

    <div class="abstandhalter2"> </div>

      <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <!-- Filter auf die Stadt mits Icon davor -->
      <div class="icons">
        <div class="ortsfilter_left"></div>
        <select class= "ortsfilter_right" name="stadt" id="stadt">
            <option value="Hamburg">Hamburg</option>
            <option value="Berlin" <?php echo ($city=='Berlin') ? 'selected':''; ?>>Berlin </option>
            <option value="Bielefeld" <?php echo ($city=='Bielefeld') ? 'selected':''; ?>>Bielefeld </option>
            <option value="Bochum" <?php echo ($city=='Bochum') ? 'selected':''; ?>> Bochum </option>
            <option value="Bremen" <?php echo ($city=='Bremen') ? 'selected':''; ?>>Bremen</option>
            <option value="Dortmund" <?php echo ($city=='Dortmund') ? 'selected':''; ?>>Dortmund</option>
            <option value="Dresden" <?php echo ($city=='Dresden') ? 'selected':''; ?>>Dresden</option>
            <option value="Freiburg" <?php echo ($city=='Freiburg') ? 'selected':''; ?>>Freiburg</option>
            <option value="Köln" <?php echo ($city=='Köln') ? 'selected':''; ?>>Köln</option>
            <option value="Leipzig" <?php echo ($city=='Leipzig') ? 'selected':''; ?>>Leipzig</option>
            <option value="München" <?php echo ($city=='München') ? 'selected':''; ?>>München</option>
            <option value="Nürnberg" <?php echo ($city=='Nürnberg') ? 'selected':''; ?>>Nürnberg</option>
            <option value="Paderborn" <?php echo ($city=='Paderborn') ? 'selected':''; ?>>Paderborn</option>
            <option value="Rostock" <?php echo ($city=='Rostock') ? 'selected':''; ?>>Rohstock</option>
            <?php echo $_SESSION['filter']['stadt']; ?>
      </select>

      </div>

      <div class="abstandhalter2">
      </div>

      <!-- Filter auf den Zeitraum mit Icon davor-->
      <div class="icons">

        <div class="kalender_left">
        </div>
          <?php $date = strtotime("+2 day", time()); ?>
        <div class="kalender_right">
          <input class="kalender_startdatum" name = start type="date" value="<?php echo ($Abholdatum!='') ? $Abholdatum: date('Y-m-d'); ?>">
          <div class="bis"> bis </div>
          <input class="kalender_enddatum" name = ende type="date" value="<?php echo ($Rückgabedatum!='') ? $Rückgabedatum: date('Y-m-d', $date);?>">

        </div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter2"></div>

      <!-- Filterung auf die Autokathegorien -->
      <!-- Zuerst symbolische Icons-->
      <div class="icons_modelle_box">
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon1_coupe.png" ></div>
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon2_limousine.png" ></div>
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon3_suv.png" ></div>
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon4_mehrsitzer.png" ></div>
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon8_cabrio.png" ></div>
          <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon9_combi.png" ></div>
      </div>

      <!-- Kathegorie Bezeichnungen -->
      <div class="text_modelle_box">
        <div class = "text_modelle"> Coupe </div>
        <div class = "text_modelle"> Limousinen </div>
        <div class = "text_modelle"> SUVs </div>
        <div class = "text_modelle"> Mehrsitzer </div>
        <div class = "text_modelle"> Cabrio </div>
        <div class = "text_modelle"> Combi </div>
      </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter2"></div>

      <!-- Checkboxen für die Automodelle-->
      <div class="text_modelle_box">

        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="1" id="Coupe"></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="2" id="Limousine"></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="3" id="SUV"></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="4" id="Mehrsitzer"></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="5" id="Cabrio" ></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="6" id="Combi"></div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter2"></div>

      <!-- Alle weiteren Filter werden hier in Zweierpaaren nebeneinander untereinander aufgereiht-->

      <!-- Hersteller & Sitze -->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Hersteller </div>
        <div class = "text_filter"> Sitze </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Hersteller -->
        <select class= "filter_inhalt" name="hersteller">
            <option value="" <?php if ($_SESSION['filter']['hersteller'] === '') echo 'selected' ?>>Alle</option>
            <option value="BMW" <?php if ($_SESSION['filter']['hersteller'] === 'BMW') echo 'selected' ?>>BMW</option>
            <option value="Volkswagen" <?php if ($_SESSION['filter']['hersteller'] === 'Volkswagen') echo 'selected' ?>>Volkswagen</option>
            <option value="Audi" <?php if ($_SESSION['filter']['hersteller'] === 'Audi') echo 'selected' ?>>Audi</option>
            <option value="Mercedes-Benz" <?php if ($_SESSION['filter']['hersteller'] === 'Mercedes-Benz') echo 'selected' ?>>Mercedes-Benz</option>
            <option value="Ford" <?php if ($_SESSION['filter']['hersteller'] === 'Ford') echo 'selected' ?>>Ford</option>
            <option value="Range Rover" <?php if ($_SESSION['filter']['hersteller'] === 'Range Rover') echo 'selected' ?>>Range Rover</option>
            <option value="Mercedes-AMG" <?php if ($_SESSION['filter']['hersteller'] === 'Mercedes-AMG') echo 'selected' ?>>Mercedes-AMG</option>
            <option value="Opel" <?php if ($_SESSION['filter']['hersteller'] === 'Opel') echo 'selected' ?>>Opel</option>
            <option value="Jaguar" <?php if ($_SESSION['filter']['hersteller'] === 'Jaguar') echo 'selected' ?>>Jaguar</option>
            <option value="Maserati" <?php if ($_SESSION['filter']['hersteller'] === 'Maserati') echo 'selected' ?>>Maserati</option>
            <option value="Skoda" <?php if ($_SESSION['filter']['hersteller'] === 'Skoda') echo 'selected' ?>>Skoda</option>
        </select>

        <!-- Filterfeld Sitzanzahl -->
        <select class= "filter_inhalt" name="sitze">
          <option value="" <?php if ($_SESSION['filter']['sitze'] === '') echo 'selected' ?>>Alle</option>
          <option value="2" <?php if ($_SESSION['filter']['sitze'] === '2') echo 'selected' ?>>2</option>
          <option value="4" <?php if ($_SESSION['filter']['sitze'] === '4') echo 'selected' ?>>4</option>
          <option value="5" <?php if ($_SESSION['filter']['sitze'] === '5') echo 'selected' ?>>5</option>
          <option value="7" <?php if ($_SESSION['filter']['sitze'] === '7') echo 'selected' ?>>7</option>
          <option value="8" <?php if ($_SESSION['filter']['sitze'] === '8') echo 'selected' ?>>8</option>
          <option value="9" <?php if ($_SESSION['filter']['sitze'] === '9') echo 'selected' ?>>9</option>
        </select>

      </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter">
      </div>

      <!-- Schaltung & Tueren (Überscriften)-->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Schaltung </div>
        <div class = "text_filter"> Tueren </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Schaltung -->
        <select class= "filter_inhalt" name="schaltung" id="schaltung">
            <option value="" <?php if ($_SESSION['filter']['schaltung'] === '') echo 'selected' ?>>Alle</option>
            <option value="manually" <?php if ($_SESSION['filter']['schaltung'] === 'manually') echo 'selected' ?>>Manuell</option>
            <option value="automatic" <?php if ($_SESSION['filter']['schaltung'] === 'automatic') echo 'selected' ?>>Automatik</option>
        </select>

        <!-- Filterfeld Tueren -->
        <select class= "filter_inhalt" name="tueren" id="tueren">
            <option value="" <?php if ($_SESSION['filter']['tueren'] === '') echo 'selected' ?>>Alle</option>
            <option value="2" <?php if ($_SESSION['filter']['tueren'] === '2') echo 'selected' ?>>2</option>
            <option value="3" <?php if ($_SESSION['filter']['tueren'] === '3') echo 'selected' ?>>3</option>
            <option value="4" <?php if ($_SESSION['filter']['tueren'] === '4') echo 'selected' ?>>4</option>
            <option value="5" <?php if ($_SESSION['filter']['tueren'] === '5') echo 'selected' ?>>5</option>
        </select>

      </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter"></div>

      <!-- Motor & Mindestalter (Überschriften)-->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Koffer Platz </div>
        <div class = "text_filter"> Mindestalter </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Kofferraum -->
        <select class= "filter_inhalt" name="kofferraum" id="kofferraum">
          <option value="" <?php if ($_SESSION['filter']['kofferraum'] === '') echo 'selected' ?>>Alle</option>
          <option value="1" <?php if ($_SESSION['filter']['kofferraum'] === '1') echo 'selected' ?>>1</option>
          <option value="2" <?php if ($_SESSION['filter']['kofferraum'] === '2') echo 'selected' ?>>2</option>
          <option value="3" <?php if ($_SESSION['filter']['kofferraum'] === '3') echo 'selected' ?>>3</option>
          <option value="4" <?php if ($_SESSION['filter']['kofferraum'] === '4') echo 'selected' ?>>4</option>
        </select>

        <!-- Filterfeld Mindestalter -->
        <select class= "filter_inhalt" name="mindestalter" id="mindestalter">
          <option value=" " <?php if ($_SESSION['filter']['mindestalter'] === '') echo 'selected' ?>>Alle</option>
          <option value="18" <?php if ($_SESSION['filter']['mindestalter'] === '18') echo 'selected' ?>>18</option>
          <option value="21" <?php if ($_SESSION['filter']['mindestalter'] === '21') echo 'selected' ?>>21</option>
          <option value="25" <?php if ($_SESSION['filter']['mindestalter'] === '25') echo 'selected' ?>>25</option>
          </select>

      </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter"></div>

      <!-- Antrieb & Preis bis (Überschriften)-->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Antrieb </div>
        <div class = "text_filter"> Preis bis </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Antrieb -->
        <select class= "filter_inhalt" name="antrieb" id="antrieb">
          <option value= " " <?php if ($_SESSION['filter']['antrieb'] === '') echo 'selected' ?>>Alle</option>
          <option value= "Electic" <?php if ($_SESSION['filter']['antrieb'] === 'Electic') echo 'selected' ?>>Elektrisch</option>
          <option value="Combuster" <?php if ($_SESSION['filter']['antrieb'] === 'Combuster') echo 'selected' ?>>Verbrenner</option>
        </select>

        <!-- Filterfeld Preis -->
        <select class= "filter_inhalt" name="preis" id="preis">
          <option value= " " <?php if ($_SESSION['filter']['preis'] === '') echo 'selected' ?>>Alle</option>
          <option value= "100" <?php if ($_SESSION['filter']['preis'] === '100') echo 'selected' ?>>100.00€</option>
          <option value="200" <?php if ($_SESSION['filter']['preis'] === '200') echo 'selected' ?>>200.00€</option>
          <option value= "300" <?php if ($_SESSION['filter']['preis'] === '300') echo 'selected' ?>>300.00€</option>
          <option value="400" <?php if ($_SESSION['filter']['preis'] === '400') echo 'selected' ?>>400.00€</option>
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
          <input class="toggle__input" name="" type="radio" id="klima" <?php if ($_SESSION ['filter']['klima'] === '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

        <div class = "filter_gps_klima">GPS</div>
        <label class="toggle" for="gps">
          <input class="toggle__input" name="" type="radio" id="gps" <?php if ($_SESSION ['filter']['gps'] === '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

      </div>

    </div>

    <br>




<!-- ABSENDEN BEREICH-->
<!-- Die Buttons zum Abschicken der Suche und es zurücksetzens der Suche werden erstellt. -->
<input type="submit" class="suchen_button" value="SUCHEN" name="absenden">
<input type="submit" class="zurücksetzen_button" value="Gesamte Auswahl zurück setzten." name="absenden">


<!-- Linie zur optischen Trennung-->
<div class="optische_trennung"> </div>


<!-- Sortieren Feld-->
<select class= "sortieren" name="sortieren" id="sortieren">
    <option value= "Aufsteigend" <?php if ($_SESSION['filter']['sortieren'] === 'Aufsteigend') echo 'selected' ?>> Preis aufsteigend...</option>
    <option value="Absteigend" <?php if ($_SESSION['filter']['sortieren'] === 'Absteigend') echo 'selected' ?>>Preis absteigend...</option>
</select>


<!-- Die Buttons zum Abschicken der Filtern und es zurücksetzens der Filterung werden erstellt. -->
<input type="submit" class="filtern_button" value="FILTERN" name="absenden">
<input type="submit" class="filter_zuruecksetzen_button" value="Filter und Sortierung zurücksetzen." name="absenden">


<!-- Das Form und der Filterkasten wird geschlossen -->
  </form>
  </div>
</div>







<!-- Die Filterbox ist abgeschlossen.-->
<!-- Ab hier wird zum Produktteil der Seite weitergeleitet. -->

<!-- Wir unterscheiden hier den Anforderungen entsprechend in 3 Fälle:-->
<!-- FALL 1: Es gab noch nie eine Filterung. Es soll in diesem Fall ein Bild -->
<!-- anstelle von Produkten erscheinen. -->
<?php

//Nur vorrübergehend, damit keine Fehlermeldung erscheint.

$_SESSION['gefilterte_autos'] = "3";

if(!isset($_SESSION['gefilterte_autos'])){
  echo "<div class = 'keine_vorfilterung'> Noch keine Kriterien ausgewählt.";
  echo "</div>";}

// Fall 2: Es wurde zwar gefiltert aber es gibt keine passenden Ergebnisse.
if(empty($_SESSION['gefilterte_autos'])){
  echo "<div class = 'keine_ergebnisse'> Es wurden leider keine passenden Fahrzeuge gefunden.";
  echo "</div>";}

// FALL 3: Es wurde gefiltert und es gibt passende Autos.
if(!empty($_SESSION['gefilterte_autos'])){


  //Wenn Daten in dem Array liegen müssen wir diese mit der Datenbank verknüpfen.

  $sql = "SELECT `location_name` FROM `location`";

  $locationSQL = ($_SESSION['filter']['stadt'] == "")? '': "`location`.`location_name` = '".$_SESSION['filter']['stadt']."'";
  $startSQL = ($_SESSION['filter']['start'] == "") ? '' : " '".$_SESSION['filter']['start']."'";
  $endSQL = ($_SESSION['filter']['ende'] == "")    ? '' : " '".$_SESSION['filter']['ende']."'";
  $vendorSQL = ($_SESSION['filter']['hersteller'] == "")          ? '' : "AND `vendor`.`vendor_name` = '".$_SESSION['filter']['hersteller']."'";
  $driveSQL = ($_SESSION['filter']['antrieb'] == "")              ? '' : "AND `model`.`drive` = '".$_SESSION['filter']['antrieb']."'";
  $gearSQL = ($_SESSION['filter']['schaltung'] == "")              ? '' : "AND `model`.`gear` = '".$_SESSION['filter']['schaltung']."'";
  $gpsSQL = ($_SESSION['filter']['gps'] == "")                    ? '' : "AND `model`.`gps` = ".$_SESSION['filter']['gps'];
  $typeSQL = ($_SESSION['filter']['type'] == "")                   ? '' : "AND `type`.`type_name` = '".$_SESSION['filter']['type']."'";
  $seatsSQL = ($_SESSION['filter']['sitze'] == "")                ? '' : "AND `model`.`seats` = ".$_SESSION['filter']['sitze'];
  $doorsSQL = ($_SESSION['filter']['tueren'] == "")                ? '' : "AND `model`.`doors` = ".$_SESSION['filter']['tueren'];
  $air_conditionSQL = ($_SESSION['filter']['klima'] == "")        ? '' : "AND `model`.`air_condition` = ".$_SESSION['filter']['klima'];
  $ageSQL = ($_SESSION['filter']['mindestalter'] == "")                  ? '' : "AND `model`.`min_age` <='".$_SESSION['filter']['mindestalter']."'";
  $priceSQL = ($_SESSION['filter']['preis'] == "")                ? '' : "AND `model`.`price` <='".$_SESSION['filter']['preis']."'";
  $sortSQL = ($_SESSION['filter']['sortieren'] == "")            ? '' : "ORDER BY DESC";

  $sql = "SELECT
        `car`.`car_id` AS `car_id`,
        `location`.`location_name` AS `stadt`,
        `type`.`type_id` AS `type`,
        `vendor`.`vendor_name` AS `hersteller`,
        `name`.`name` AS `name`,
        `model`.`gear` AS `schaltung`,
        `model`.`drive` AS `antrieb`,
        `model`.`seats` AS `sitze`,
        `model`.`doors` AS `tueren`,
        `model`.`trunk` AS `kofferraumplatz`,
        `model`.`air_condition` AS `klima`,
        `model`.`gps` AS `gps`,
        `model`.`min_age` AS `mindestalter`,
        `model`.`price` AS `preis`,
        `model`.`img_file_name` AS `bild`
        FROM `model`
        JOIN `car` ON `car`.`car_id` = `car`.`car_id`
        JOIN `location` ON `car`.`location_id` = `location`.`location_id`
        JOIN `type` ON `type`.`type_name` = `type`.`type_name`
        JOIN `name` ON `model`.`name_id` = `name`.`name_id`
        JOIN `vendor` ON `model`.`vendor_id` = `vendor`.`vendor_id`
        WHERE $locationSQL $vendorSQL $driveSQL $gearSQL $gpsSQL $typeSQL $seatsSQL $doorsSQL $air_conditionSQL $ageSQL $priceSQL";

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  print_r($result);

    } ?>

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
