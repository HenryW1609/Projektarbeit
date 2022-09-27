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

<!--  Alle Filteraspekte-->
  <?php
    // Zu Beginn starten wir mit dem Anlegen einer Session.
    session_start();

    // Zu Beginn werden alle Filterkriterien als Variablen angelegt.
    // Alle Variablen mit Ausnahme der Stadt und des Zeitraum bleiben unbefüllt
    // Als Stadt wird zu Beginn wie gefordert Hamburg und als Zeitraum heute und heute + 2 Tage genommen.
    $stadt = (isset($_REQUEST['stadt']) && !empty($_REQUEST['stadt'])) ? $_REQUEST['stadt'] : 'Hamburg';
    $start = (isset($_REQUEST['start']) && !empty($_REQUEST['start'])) ? $_REQUEST['start'] : date('Y-m-d');
    $ende = (isset($_REQUEST['ende']) && !empty($_REQUEST['ende'])) ? $_REQUEST['ende'] : date('Y-m-d', strtotime("+2 days"));
    $typ = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : null;
    $hersteller = (isset($_REQUEST['hersteller']) && !empty($_REQUEST['hersteller'])) ? $_REQUEST['hersteller'] : null;
    $sitze = (isset($_REQUEST['sitze']) && !empty($_REQUEST['sitze'])) ? $_REQUEST['sitze'] : null;
    $schaltung = (isset($_REQUEST['schaltung']) && !empty($_REQUEST['schaltung'])) ? $_REQUEST['schaltung'] : null;
    $türen = (isset($_REQUEST['türen']) && !empty($_REQUEST['türen'])) ? $_REQUEST['türen'] : null;
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
      'stadt' => $stadt, 'start' => $start, 'ende' => $ende,
      'type' => $typ, 'hersteller' => $hersteller,'sitze' => $sitze,
      'schaltung' => $schaltung,'türen' => $türen,'kofferraum' => $kofferraum,
      'mindestalter' => $mindestalter,'antrieb' => $antrieb,'preis' => $preis,
      'klima' => $klima,'gps' => $gps,'sortieren' => $sortieren];
      $_SESSION['filter'] = $filter;}

      else{$filter == $_SESSION['filter'];}
    ?>



    <!-- PHP BEREICH ZU DEN VERSCHIEDEN BUTTONS NACH "ABSENDEN"-->

    <?php

    //Es ergeben sich vier Buttons, die man nach der Filterung anklicken kann.
    // 1 - SUCHEN: Gesamte Auswahl zurück setzten.
    // 2 - FILTERN = SUCHEN
    // 3 - Gesamte Auswahl zurück setzten.

    //Diese vier Fälle werden mit Hilfe einer if-else Abfrage durchlaufen.

    if(isset($_REQUEST['absenden'])){

      //FALL 1: Der Button SUCHEN wurde angeklickt.
      //Alle in den Filter eingegebenen Werte werden in das Filterarray übertragen.

      if ($absenden === 'SUCHEN') {

            $_SESSION ['filter'] = [
            'stadt' => $stadt,'start' => $start,'ende' => $ende,
            'type' => $typ,'hersteller' => $hersteller,'sitze' => $sitze,
            'schaltung' => $schaltung, 'türen' => $türen,
            'kofferraum' => $kofferraum,'mindestalter' => $mindestalter, 'antrieb' => $antrieb,
            'preis' => $preis, 'klima' => $klima,'gps' => $gps, 'sortieren' => $sortieren,];

            $filter =   $_SESSION ['filter'] ;
            $_SESSION['ergebnisse'] = Ergebnisse();}


      //FALL 2: FILTERN (= Suchen, siehe Anforderungen)
      //Der Quelltext konnte daher kopiert werden.

      else if ($absenden === 'FILTERN'){

            $_SESSION ['filter'] = [

            'stadt' => $stadt,'start' => $start,'ende' => $ende,
            'type' => $typ,'hersteller' => $hersteller,'sitze' => $sitze,
            'schaltung' => $schaltung, 'türen' => $türen,
            'kofferraum' => $kofferraum,'mindestalter' => $mindestalter, 'antrieb' => $antrieb,
            'preis' => $preis, 'klima' => $klima,'gps' => $gps, 'sortieren' => $sortieren,];

            $filter =   $_SESSION ['filter'] ;
            $_SESSION['ergebnisse'] = Ergebnisse();}


      //FALL 3: Die Suche soll zurück gesetzt werden.
      // Hierzu leere ich das gesamte Array und gebe wieder die Standardwerte für Stadt und Datum aus.

      else if ($absenden === 'Gesamte Auswahl zurück setzten.'){

          $_SESSION['filter'] = [

            'stadt' => 'Hamburg','start' => date('Y-m-d'),
            'ende' => date('Y-m-d', strtotime("+2 days")),
            'type' => "", 'hersteller' => "", 'sitze' => "",
            'schaltung' => "",'türen' => "",'kofferraum' => "",
            'mindestalter' => "",'antrieb' => "",
            'preis' => "",'klima' => "",'gps' => "",'sortieren' => "",];

          $filter = $_SESSION['filter'];
          $_SESSION['ergebnisse'] = Ergebnisse();
      }


      //FALL 4: Es werden nur die Detail-Filter und die Sortierung zurückgesetzt.
      //Hierzu leeren wir erneut das array (Oberer Quelltext aus Fall 1 kopiert),
      //belassen aber Start- und Enddatum sowie Stadt.

      else if ($absenden === 'Filter und Sortierung zurücksetzen.'){

        $_SESSION['filter'] = [

          'stadt' => $stadt,'start' => $start,'ende' => $ende,

          //Alle Variablen außer Stadt und Datum werden zurückgesetzt.
          'type' => "", 'hersteller' => "",'sitze' => "",
          'schaltung' => "",'türen' => "",'kofferraum' => "",
          'mindestalter' => "",'antrieb' => "",'preis' => "",
          'klima' => "",'gps' => "",'sortieren' => ""];

        $filter = $_SESSION['filter'];
        $_SESSION['ergebnisse'] = Ergebnisse();
      }
    }
    ?>






<!-- Navigationsbar - später includieren mit PHP! -->

    <div id="navbar">
      <a href="Startseite.php" id="logo">Out & About</a>
      <div id="navbar-right">
        <a href="Produktübersichtsseite.php">Cars</a>
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
             <option value="Hamburg" <?php if ($_SESSION['filter']['stadt'] === 'Hamburg') echo 'selected' ?>>Hamburg </option>
             <option value="Berlin" <?php if ($_SESSION['filter']['stadt'] === 'Berlin') echo 'selected' ?>>Berlin </option>
             <option value="Bielefeld" <?php if ($_SESSION['filter']['stadt'] === 'Bielefeld') echo 'selected'?>>Bielefeld </option>
             <option value="Bochum" <?php if ($_SESSION['filter']['stadt'] === 'Bochum') echo 'selected' ?> > Bochum </option>
             <option value="Bremen" <?php if ($_SESSION['filter']['stadt'] === 'Bremen') echo 'selected' ?>>Bremen</option>
             <option value="Dortmund" <?php if ($_SESSION['filter']['stadt'] === 'Dortmund') echo 'selected' ?>>Dortmund</option>
             <option value="Dresden" <?php if ($_SESSION['filter']['stadt'] === 'Dresden') echo 'selected' ?>>Dresden</option>
             <option value="Freiburg" <?php if ($_SESSION['filter']['stadt'] === 'Freiburg') echo 'selected' ?>>Freiburg</option>
             <option value="Köln" <?php if ($_SESSION['filter']['stadt'] === 'Köln') echo 'selected' ?>>Köln</option>
             <option value="Leipzig" <?php if ($_SESSION['filter']['stadt'] === 'Leipzig') echo 'selected' ?>>Leipzig</option>
             <option value="München" <?php if ($_SESSION['filter']['stadt'] === 'München') echo 'selected' ?>>München</option>
             <option value="Nürnberg" <?php if ($_SESSION['filter']['stadt'] === 'Nürnberg') echo 'selected' ?>>Nürnberg</option>
             <option value="Paderborn" <?php if ($_SESSION['filter']['stadt'] === 'Paderborn') echo 'selected' ?>>Paderborn</option>
             <option value="Rostock" <?php if ($_SESSION['filter']['stadt'] === 'Rostock') echo 'selected' ?>>Rostock</option>
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
          <input class="kalender_startdatum" name = start type="date" value="<?php echo ($_SESSION['filter']['start']!='') ? $_SESSION['filter']['start']: date('Y-m-d'); ?>">
          <div class="bis"> bis </div>
          <input class="kalender_enddatum" name = ende type="date" value="<?php echo ($_SESSION['filter']['ende']!='') ? $_SESSION['filter']['ende']: date('Y-m-d');?>">

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
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_cabrio.png" ></div>
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_suv.png" ></div>
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_limousine.png" ></div>
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_combi.png" ></div>
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_mehrsitzer.png" ></div>
        <div class = "icons_modelle"> <img src="Bilder/Produktuebersichtseite/icon_coupe.png" ></div>
      </div>

      <!-- Kathegorie Bezeichnungen -->
      <div class="text_modelle_box">
        <div class = "text_modelle"> Cabrio </div>
        <div class = "text_modelle"> SUVs </div>
        <div class = "text_modelle"> Limousinen </div>
        <div class = "text_modelle"> Combi </div>
        <div class = "text_modelle"> Mehrsitzer </div>
        <div class = "text_modelle"> Coupe </div>
        </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter2"></div>

      <!-- Checkboxen für die Automodelle-->
      <div class="text_modelle_box">
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="1" id="Cabrio" <?php if ($filter['type'] === '1') echo 'checked'?>></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="2" id="SUV"<?php if ($filter['type'] === '2') echo 'checked'?>></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="3" id="Limousine" <?php if ($filter['type'] === '3') echo 'checked'?>></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="4" id="Combi" <?php if ($filter['type'] === '4') echo 'checked'?>></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="5" id="Mehrsitzer"<?php if ($filter['type'] === '5') echo 'checked'?>></div>
        <div class = "text_modelle"> <input class = "c_box" type="radio" name="type" value="6" id="Coupe" <?php if ($filter['type'] === '6') echo 'checked'?> ></div>
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
        <div class = "text_filter"> Türen </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Schaltung -->
        <select class= "filter_inhalt" name="schaltung" id="schaltung">
            <option value="" <?php if ($_SESSION['filter']['schaltung'] === '') echo 'selected' ?>>Alle</option>
            <option value="manually" <?php if ($_SESSION['filter']['schaltung'] === 'manually') echo 'selected' ?>>Manuell</option>
            <option value="automatic" <?php if ($_SESSION['filter']['schaltung'] === 'automatic') echo 'selected' ?>>Automatik</option>
        </select>

        <!-- Filterfeld Tueren -->
        <select class= "filter_inhalt" name="türen" id=türen>
            <option value="" <?php if ($_SESSION['filter']['türen'] === '') echo 'selected' ?>>Alle</option>
            <option value="2" <?php if ($_SESSION['filter']['türen'] === '2') echo 'selected' ?>>2</option>
            <option value="3" <?php if ($_SESSION['filter']['türen'] === '3') echo 'selected' ?>>3</option>
            <option value="4" <?php if ($_SESSION['filter']['türen'] === '4') echo 'selected' ?>>4</option>
            <option value="5" <?php if ($_SESSION['filter']['türen'] === '5') echo 'selected' ?>>5</option>
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
          <option value="" <?php if ($_SESSION['filter']['mindestalter'] === '') echo 'selected' ?>>Alle</option>
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
          <option value= "" <?php if ($_SESSION['filter']['antrieb'] === '') echo 'selected' ?>>Alle</option>
          <option value= "Electic" <?php if ($_SESSION['filter']['antrieb'] === 'Electic') echo 'selected' ?>>Elektrisch</option>
          <option value="Combuster" <?php if ($_SESSION['filter']['antrieb'] === 'Combuster') echo 'selected' ?>>Verbrenner</option>
        </select>

        <!-- Filterfeld Preis -->
        <select class= "filter_inhalt" name="preis" id="preis">
          <option value= "" <?php if ($_SESSION['filter']['preis'] === '') echo 'selected' ?>>Alle</option>
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
          <input class="toggle__input" name="klima" type="radio" value = "1" id="klima" <?php if ($_SESSION ['filter']['klima'] === '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

        <div class = "filter_gps_klima">GPS</div>
        <label class="toggle" for="gps">
          <input class="toggle__input" name="gps" type="radio" value = "1" id="gps" <?php if ($_SESSION ['filter']['gps'] === '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

      </div>

    </div>

    <br>




<!-- ABSENDEN BEREICH-->
<!-- Die Buttons zum Abschicken der Suche und des Zurücksetzens der Suche werden erstellt. -->
<input type="submit" class="suchen_button" value="SUCHEN" name="absenden">
<input type="submit" class="zurücksetzen_button" value="Gesamte Auswahl zurück setzten." name="absenden">


<!-- Linie zur optischen Trennung-->
<div class="optische_trennung"> </div>


<!-- Sortieren Feld-->
<select class= "sortieren" name="sortieren" id="sortieren">
  <option value= "ASC" <?php if ($_SESSION['filter']['sortieren'] === 'ASC') echo 'selected' ?>> Preis aufsteigend...</option>
  <option value="DESC" <?php if ($_SESSION['filter']['sortieren'] === 'DESC') echo 'selected' ?>>Preis absteigend...</option>
</select>


<!-- Die Buttons zum Abschicken der Filtern und des Zurücksetzens der Filterung werden erstellt. -->
<input type="submit" class="filtern_button" value="FILTERN" name="absenden">
<input type="submit" class="filter_zuruecksetzen_button" value="Filter und Sortierung zurücksetzen." name="absenden">


<!-- Das Form und der Filterkasten werden geschlossen -->
  </form>
  </div>
</div>







<!-- Die Filterbox ist abgeschlossen.-->
<!-- Ab hier wird zur Ausgabe der gefilterten Autos weitergeleitet. -->



<!-- Wir unterscheiden hier den Anforderungen entsprechend in 3 Fälle:-->

<?php

//FALL 1: Es gab noch nie eine Filterung. Es soll in diesem Fall ein Bild
//anstelle von Produkten erscheinen.

if(!isset($_SESSION['ergebnisse'])){
  echo "<div class = 'keine_vorfilterung'> <br> Noch keine Kriterien ausgewählt.";
  echo "<div class = 'bild_keine_vorfilterung'>";
  echo "</div>";
  echo "</div>";}

//Es ist schonmal eine Filterung erfolgt: Fälle 2 & 3
else if (isset($_SESSION['ergebnisse'])){

  //Es wird geschaut, wie viele Ausgaben es zu der Filterung / Suche gab.
  $_SESSION['anzahl_ergebnisse'] = anzahlErgebnisse();

    // Fall 2: Es wurde zwar gefiltert aber es gibt keine passenden Ergebnisse (0).
    if(empty($_SESSION['anzahl_ergebnisse'])){
      echo "<div class = 'keine_ergebnisse'> <br> Es wurden leider keine passenden Fahrzeuge gefunden. <br>";
      echo "<div class = 'smiley'>";
      echo "</div>";}


    // FALL 3: Es wurde gefiltert und es gibt passende Autos.
    //Maximal Ergebnisse = 21 (weil größter Standort 21 Autos hat)
    else if(!empty($_SESSION['anzahl_ergebnisse'])){

        //4 oder weniger Ergebnissen (eine Reihe erstellen)
        if ($_SESSION['anzahl_ergebnisse']<= 8 AND $_SESSION['anzahl_ergebnisse']<= 4)
        {echo "<div class = 'ergebnisse1'>";
        ausgabe8('0');}


        // 5 bis 8 Ergebnisse (nur eine benötigte Seite, zwei Reihen)
        else if ($_SESSION['anzahl_ergebnisse']<= 8 AND $_SESSION['anzahl_ergebnisse']>= 4)
        {echo "<div class = 'ergebnisse2'>";
          ausgabe8('0');}


        //Mehr Ergebnisse als 8: 2. oder 3. Seiten wird benötigt
        //Maximale Zahl: 3 Seiten (Standort Leipzig mit 20 Ergebnissen / Modellen)
        else if ($_SESSION['anzahl_ergebnisse']> 8)
          {echo "<div class = 'ergebnisse2'>";
            ausgabe8('0');

          //Weiterleitung zur 2. Seite
          echo "<a class='S2' href='Produktübersichtsseite_S2.php'> Seite 2 -> </a>";}

        }
}
 ?>



 </body>
 </html>
