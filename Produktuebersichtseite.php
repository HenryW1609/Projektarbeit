<?php
  include_once('header.php');

$action = (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) ? $_REQUEST['action'] : '';
$location = (isset($_REQUEST['Stadt']) && !empty($_REQUEST['Stadt'])) ? $_REQUEST['Stadt'] : '';
// <!-- Definition der Variablen für die Kalenderbox "Datum" der Produktübersichtseite. -->
$von = (isset($_REQUEST['von']) && !empty($_REQUEST['von'])) ? $_REQUEST['von'] : '';
$bis = (isset($_REQUEST['bis']) && !empty($_REQUEST['bis'])) ? $_REQUEST['bis'] : '';
// <!-- Hilfswerte für die automatische Ausgabe von den folgenden zwei Tagen -->
$year = date("Y");
$month = date("m");
$day = date("d");
$today = $year.'-'.$month.'-'.$day;
$morgen = date("Y-m-d", strtotime($today) + (3600 * 24));
$übermorgen = date("Y-m-d", strtotime($today) + (3600 * 48));
// <!-- Definition der Variable für das Feld "Alter" im Filter der Produktübersichtseite. -->
$age = (isset($_REQUEST['age']) && !empty($_REQUEST['age'])) ? $_REQUEST['age'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Hersteller" der Produktübersichtseite. -->
$vendor = (isset($_REQUEST['hersteller']) && !empty($_REQUEST['hersteller'])) ? $_REQUEST['hersteller'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Typ" der Produktübersichtseite. -->
$type = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Getriebe" der Produktübersichtseite. -->
$gear = (isset($_REQUEST['schaltung']) && !empty($_REQUEST['schaltung'])) ? $_REQUEST['schaltung'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Antrieb" der Produktübersichtseite. -->
$drive = (isset($_REQUEST['antrieb']) && !empty($_REQUEST['antrieb'])) ? $_REQUEST['antrieb'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Sitze" der Produktübersichtseite. -->
$seats = (isset($_REQUEST['sitze']) && !empty($_REQUEST['sitze'])) ? $_REQUEST['sitze'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Türen" der Produktübersichtseite. -->
$doors = (isset($_REQUEST['tueren']) && !empty($_REQUEST['tueren'])) ? $_REQUEST['tueren'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Preis bis" der Produktübersichtseite. -->
$price = (isset($_REQUEST['preis']) && !empty($_REQUEST['preis'])) ? $_REQUEST['preis'] : '';
// <!-- Definition der Variable für die Checkbox "Klima" der Produktübersichtseite. -->
$ac = (isset($_REQUEST['ac']) && !empty($_REQUEST['ac'])) ? $_REQUEST['ac'] : '';
// <!-- Definition der Variable für die Checkbox "Klima" der Produktübersichtseite. -->
$gps = (isset($_REQUEST['gps']) && !empty($_REQUEST['gps'])) ? $_REQUEST['gps'] : '';
// <!-- Definition der Variable für die Dropdown Liste "Antrieb" der Produktübersichtseite. -->
$sortierung = (isset($_REQUEST['sortieren']) && !empty($_REQUEST['sortieren'])) ? $_REQUEST['sortieren'] : '';
// <!-- Definition der Datenbankvariablen für die "WHERE"-Conditions in der SQL-Abfrage der Produktübersichtseite. Wenn kein Filterwert ausgewählt wurde, wird als Dummy-Kondition "1=1 übergeben, damit keine Einschränkung der Werte stattfindet." -->
$location_sql = $location == "" ? " AND 1=1 " : " AND location.location_name='$location'";
$age_sql = $age == "" ? " AND 1=1 " : " AND model.min_age='$age'";
$vendor_sql = $vendor == "" ? " AND 1=1 " : " AND vendor.vendor_name='$vendor'";
$type_sql = $type == "" ? " AND 1=1 " : " AND type.type_name='$type'";
$gear_sql = $gear == "" ? " AND 1=1 " : " AND model.gear='$gear'";
$drive_sql = $drive == "" ? " AND 1=1 " : " AND model.drive='$drive'";
$seats_sql = $seats == "" ? " AND 1=1 " : " AND model.seats='$seats'";
$doors_sql = $doors == "" ? " AND 1=1 " : " AND model.doors='$doors'";
$price_sql = $price == "" ? " AND 1=1 " : " AND model.price='$price'";
$ac_sql = $ac == "" ? " AND 1=1 " : " AND model.air_condition='$ac'";
$gps_sql = $gps == "" ? " AND 1=1 " : " AND model.gps='$gps'";
$gesamtsuche = "$location_sql"."$age_sql"."$vendor_sql"."$type_sql"."$gear_sql"."$drive_sql"."$seats_sql"."$doors_sql"."$price_sql"."$ac_sql"."$gps_sql";


$search=false;

// Backend: Dies ist die SQL Abfrage welche mithilfe der vom User ausgewählten Filtereinstellungen die passenden Autos ausgibt

// Die Webseite wird mit der Datenbank verbunden
       include('db_Log.php');
       $pdo = dbConnect();

        $sql = "SELECT  car.car_id, location.location_name, vendor.vendor_name, model.price, model.img_file_name, type.type_name, name.name
                -- COUNT(location_id) as `Anzahl verfügbar:`
                FROM `model`
                JOIN `car`
                ON model.model_id=car.model_id
                JOIN `location`
                ON car.location_id=location.location_id
                JOIN `type`
                ON model.type_id=type.type_id
                JOIN `vendor`
                ON model.vendor_id=vendor.vendor_id
                JOIN `name`
                ON model.name_id=name.name_id

                $gesamtsuche
                GROUP BY car.car_id
                ORDER BY model.model_id";


// Hier wird die  werden die vier buttons im Filter
if (isset($_REQUEST['Search'])){

// Backend: Der Button mit dem Value search_value aktiviert diese If schleife welche das SQL Statment executed und dem PDO::FETCH_ASSOC übergibt

if ($_REQUEST['Search'] == "SUCHEN") {

  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  $search=true;

}

if ($_POST['Search'] == "Gesamte Auswahl zurücksetzten") {
  // Backend: Der Button mit dem Value back_value aktiviert diese If schleife welche die Werte für alle Filtereinstellungen zurücksetzt

  $location = '';
  $location_sql = '';
  $von = '';
  $bis = '';
  $age =  '';
  $age_sql = '';
  $vendor = '';
  $vendor_sql = '';
  $type =  '';
  $type_sql =  '';
  $gear = '';
  $gear_sql = '';
  $drive =  '';
  $drive_sql = '';
  $seats =  '';
  $seats_sql = '';
  $doors = '';
  $doors_sql = '';
  $price = '';
  $price_sql = '';
  $ac = '';
  $aircondition_sql = '';
  $gps =  '';
  $gps_sql = '';
  $sortierung =  '';
  $sortierung = '';
}

if ($_POST['Search'] == "Filter anwenden") {
  // Backend: Der Button mit dem Value filter_value aktiviert diese If schleife welche das SQL Statment executed und dem PDO::FETCH_ASSOC übergibt

  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $search=true;
}

if ($_POST['Search'] == "Filter Sortierung zurücksetzen") {
  // Backend: Der Button mit dem Value back_value aktiviert diese If schleife welche die Werte für alle Filtereinstellungen bis auf Startdatum Enddatum und Location zurücksetzt

  $vendor = '';
  $vendor_sql = '';
  $type =  '';
  $type_sql =  '';
  $gear = '';
  $gear_sql = '';
  $drive =  '';
  $drive_sql = '';
  $seats =  '';
  $seats_sql = '';
  $doors = '';
  $doors_sql = '';
  $price = '';
  $price_sql = '';
  $ac = '';
  $aircondition_sql = '';
  $gps =  '';
  $gps_sql = '';
  $sortierung =  '';
  $sortierung = '';
}

}
// Hier wird die Mietdauer aus den von und bis daten errechnet. Es wird +1 gerechnet, da man immer für ganze Tage mietet und somit bei einer Buchung vom bspw. 11.11.2022 bis zum 11.11.2022 schon einen Tag Mietdauer hat, die Funktion als Differenz aber 0 ausgibt
$von_date = new DateTime($von);
$bis_date = new DateTime($bis);
$mietlange = $von_date->diff($bis_date);
$tagedauer = $mietlange->d +1;
?>
<!DOCTYPE html>

<!-- Header-->
<html>
<!--  Start Inhalt Website (BODY)-->
<body>

    <div class="filterleiste">
      <?php print_r ($tagedauer) ?>
    <div class="filter_box_umriss">

    <div class="filter_box">

    <div class="abstandhalter2"> </div>

      <form method="post" action="">
      <!-- Filter auf die Stadt mits Icon davor -->
      <div class="icons">
        <div class="ortsfilter_left"></div>
        <select class= "ortsfilter_right" name="Stadt">
          <option  value=""  >Hamburg</option>
          <option  value="Berlin" <?php echo ($location=='Berlin') ? 'selected':''; ?>> Berlin </option>
          <option  value="Bielefeld" <?php echo ($location=='Bielefeld') ? 'selected':''; ?>>Bielefeld</option>
          <option  value="Bochum" <?php echo ($location=='Bochum') ? 'selected':''; ?>>Bochum</option>
          <option  value="Bremen" <?php echo ($location=='Bremen') ? 'selected':''; ?>>Bremen</option>
          <option  value="Dortmund" <?php echo ($location=='Dortmund') ? 'selected':''; ?>>Dortmund</option>
          <option  value="Dresden" <?php echo ($location=='Dresden') ? 'selected':''; ?>>Dresden</option>
          <option  value="Freiburg" <?php echo ($location=='Freiburg') ? 'selected':''; ?>>Freiburg</option>
          <option  value="Köln" <?php echo ($location=='Köln') ? 'selected':''; ?>>Köln</option>
          <option  value="Leipzig" <?php echo ($location=='Leipzig') ? 'selected':''; ?>>Leipzig</option>
          <option  value="München" <?php echo ($location=='München') ? 'selected':''; ?>>München</option>
          <option  value="Nürnberg" <?php echo ($location=='Nürnberg') ? 'selected':''; ?>>Nürnberg</option>
          <option  value="Paderborn" <?php echo ($location=='Paderborn') ? 'selected':''; ?>>Paderborn</option>
          <option  value="Rostock" <?php echo ($location=='Rostock') ? 'selected':''; ?>>Rostock</option>
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
          <input type="date" class="kalender_startdatum" name="von" id="Abholdatum" required value=<?php echo ($von!='') ? $von: $morgen ; ?>>
          <div class="bis"> bis </div>
          <input type="date" class="kalender_enddatum" name="bis" id="Rückgabedatum" required value=<?php echo ($bis!='') ? $bis:$übermorgen; ?>>

        </div>
      </div>

      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>
      <div class="linie"> </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter2"></div>


      <!-- Linie zur optischen Abtrennung der Filter auf der Website -->
      <br>

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
          <option value="" disabled selected>Alle</option>
          <option value="Audi" <?php echo ($vendor=='Audi') ? 'selected':''; ?>>Audi</option>
          <option value="BMW" <?php echo ($vendor=='BMW') ? 'selected':''; ?>>BMW</option>
          <option value="Ford" <?php echo ($vendor=='Ford') ? 'selected':''; ?>>Ford</option>
          <option value="Jaguar" <?php echo ($vendor=='Jaguar') ? 'selected':''; ?>>Jaguar</option>
          <option value="Maserati" <?php echo ($vendor=='Maserati') ? 'selected':''; ?>>Maserati</option>
          <option value="Mercedes-Benz" <?php echo ($vendor=='Mercedes-Benz') ? 'selected':''; ?>>Mercedes-Benz</option>
          <option value="Mercedes-AMG" <?php echo ($vendor=='Mercedes-AMG') ? 'selected':''; ?>>Mercedes-AMG</option>
          <option value="Opel" <?php echo ($vendor=='Opel') ? 'selected':''; ?>>Opel</option>
          <option value="Skoda" <?php echo ($vendor=='Skoda') ? 'selected':''; ?>>Skoda</option>
          <option value="Range Rover" <?php echo ($vendor=='Range Rover') ? 'selected':''; ?>>Range Rover</option>
          <option value="Volkswagen" <?php echo ($vendor=='Volkswagen') ? 'selected':''; ?>>Volkswagen</option>
        </select>

        <!-- Filterfeld Sitzanzahl -->
        <select class= "filter_inhalt" name="sitze">
          <option value="" disabled selected>Alle</option>
          <option value="2" <?php echo ($seats=='2') ? 'selected':''; ?>>2</option>
          <option value="4" <?php echo ($seats=='4') ? 'selected':''; ?>>4</option>
          <option value="5" <?php echo ($seats=='5') ? 'selected':''; ?>>5</option>
          <option value="7" <?php echo ($seats=='7') ? 'selected':''; ?>>7</option>
          <option value="8" <?php echo ($seats=='8') ? 'selected':''; ?>>8</option>
          <option value="9" <?php echo ($seats=='9') ? 'selected':''; ?>>9</option>
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
        <select class= "filter_inhalt" name="schaltung">
          <option  value="" disabled selected>Alle</option>
          <option  value="Manuell" <?php echo ($gear=='Manuell') ? 'selected':''; ?>>Manuell</option>
          <option  value="Automatik" <?php echo ($gear=='Automatik') ? 'selected':''; ?>>Automatik</option>
    </select>
        </select>

        <!-- Filterfeld Tueren -->
        <select class= "filter_inhalt" name="tueren">
          <option  value="" disabled selected>Alle</option>
          <option  value="2" <?php echo ($doors=='2') ? 'selected':''; ?>>2</option>
          <option  value="3" <?php echo ($doors=='3') ? 'selected':''; ?>>3</option>
          <option  value="4" <?php echo ($doors=='4') ? 'selected':''; ?>>4</option>
          <option  value="5" <?php echo ($doors=='5') ? 'selected':''; ?>>5</option>
        </select>

      </div>

      <!-- Optischer Platzhalter -->
      <div class="abstandhalter"></div>

      <!-- Motor & Mindestalter (Überschriften)-->
      <div class="ueberschrift_filter_box">
        <div class = "text_filter"> Kategorie </div>
        <div class = "text_filter"> Mindestalter </div>
      </div>

      <div class="allgemeine_filter_box">

        <!-- Filterfeld Kofferraum -->
        <select class= "filter_inhalt" name="type">
          <option  value="" disabled selected>Alle</option>
          <option  value="Cabrio" <?php echo ($type=='Cabrio') ? 'selected':''; ?>>Cabrio</option>
          <option  value="SUV" <?php echo ($type=='SUV') ? 'selected':''; ?>>SUV</option>
          <option  value="Limousine" <?php echo ($type=='Limousine') ? 'selected':''; ?>>Limousine</option>
          <option  value="Coupé" <?php echo ($type=='Coupé') ? 'selected':''; ?>>Coupé</option>
          <option  value="Mehrsitzer" <?php echo ($type=='Mehrsitzer') ? 'selected':''; ?>>Mehrsitzer</option>
          <option  value="Kombi" <?php echo ($type=='Kombi') ? 'selected':''; ?>>Kombi</option>
        </select>

        <!-- Filterfeld Mindestalter -->

          <select class= "filter_inhalt" name="age">
          <option  value="" disabled selected>Alle</option>
          <option  value="18" <?php echo ($age=='18') ? 'selected':''; ?>>18</option>
          <option  value="21" <?php echo ($age=='21') ? 'selected':''; ?>>21</option>
          <option  value="25" <?php echo ($age=='25') ? 'selected':''; ?>>25</option>
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
        <select class= "filter_inhalt" name="antrieb">
          <option  value="" disabled selected>Alle</option>
          <option  value="Verbrenner" <?php echo ($drive=='Verbrenner') ? 'selected':''; ?>>Verbrenner</option>
          <option  value="Elektro" <?php echo ($drive=='Elektro') ? 'selected':''; ?>>Elektro</option>
         </select>

        <!-- Filterfeld Preis -->
        <select class= "filter_inhalt" name="preis">
          <option  value="" disabled selected>Alle</option>
          <option  value="50-100€" <?php echo ($price=='50-100€') ? 'selected':''; ?>>50-100€</option>
          <option  value="100-200€" <?php echo ($price=='100-200€') ? 'selected':''; ?>>100-200€</option>
          <option  value="200-400€" <?php echo ($price=='200-400€') ? 'selected':''; ?>>200-400€</option>
          <option  value="400-600€" <?php echo ($price=='400-600€') ? 'selected':''; ?>>400-600€</option>
          <option  value=">600€" <?php echo ($price=='>600€') ? 'selected':''; ?>>>600€</option>
</select>
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
          <input class="toggle__input" name="ac" type="radio" id="klima" <?php if ($ac == '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

        <div class = "filter_gps_klima">GPS</div>
        <label class="toggle" for="gps">
          <input class="toggle__input" name="gps" type="radio" id="gps" <?php if ($gps == '1') echo 'checked' ?>>
          <div class="toggle__fill"></div>
        </label>

      </div>

    </div>

    <br>




<!-- ABSENDEN BEREICH-->
<!-- Die Buttons zum Abschicken der Suche und es zurücksetzens der Suche werden erstellt. -->
<button type="submit" class="suchen_button" value="SUCHEN" name="Search">SUCHEN</button>
<button type="submit" class="zurücksetzen_button" value="Gesamte Auswahl zurücksetzten" name="Search">Gesamte Auswahl zurücksetzen</button>

<!-- Linie zur optischen Trennung-->
<div class="optische_trennung"> </div>


<!-- Sortieren Feld-->
<select class= "sortieren" name="sortieren" id="sortieren">
  <option  value="Preis aufsteigend" <?php echo ($sortierung=='Preis aufsteigend') ? 'selected':''; ?>>Preis aufsteigend</option>
  <option  value="Preis absteigend" <?php echo ($sortierung=='Preis absteigend') ? 'selected':''; ?>>Preis absteigend</option>
</select>


<!-- Die Buttons zum Abschicken der Filtern und es zurücksetzens der Filterung werden erstellt. -->
<input type="submit" class="filtern_button" value="Filter anwenden" name="Search">
<button type="submit" class="filter_zuruecksetzen_button" value="Filter Sortierung zurücksetzen" name="Search">Filter und Sortierung zurücksetzen</button>


<!-- Das Form und der Filterkasten wird geschlossen -->
  </form>
  </div>
</div>


<div class="content_car">
  <div class="ergebnisinfos">
        <div class="ergebnisinfos_text">

        </div>
        <div class="ergebnisinfos_text">
            <a href="Produktuebersicht2.php" class="paging_button_produktubersicht">2. Seite </a>
        </div>
    </div>
<!--            Die div Klasse "car" beinhaltet jeweils ein Automodell-->
              <?php



                if ($search == true) {
                while ($row =   $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                  // Hier wird der Gesamtpreis mithilfe der Mietdauer für jedes Auto berechnet
                  $gesamtpreis = $row['price']*$tagedauer;
                echo "
                <div  class='car'>
                  <a href='Produktdetailseite.php' class='produktuebersicht_link'>
                  <div class='car_inside'>
                     <div class='autoname'>".$row['vendor_name']."&nbsp".$row['name']."</div>
                     <div class='autotyp'>".$row['type_name']."</div>
                     <div class='car_img'><img src=".$row['img_file_name']." class='car_img_img'></div>

                     <div class='ubersicht_preis'>".$row['price']."€/Tag</div>
                     <div class='ubersicht_gesamtpreis'>Gesamtpreis: ".$gesamtpreis."</div>
                   </div>
                   </a>
                 </div>";
                };};
                ?>


  <!-- Footer /-->

  <?php
    include_once('footer.php');
   ?>
