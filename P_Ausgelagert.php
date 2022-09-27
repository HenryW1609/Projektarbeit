<?php

include('db_Log.php');

function anzahlErgebnisse(){
  //Anzahl der gefilterten Ergebnisse werden ausgegeben.
  $result = Count(Ergebnisse());
  return $result;};


function Ergebnisse(){

//Zuweisung der Variablen zu SQL
$locationSQL = !($_SESSION['filter']['stadt'])? '': "`location`.`location_name` = '".$_SESSION['filter']['stadt']."'";
$startSQL = !($_SESSION['filter']['start']) ? '' : " '".$_SESSION['filter']['start']."'";
$endSQL = !($_SESSION['filter']['ende'])    ? '' : " '".$_SESSION['filter']['ende']."'";

$typeSQL = !($_SESSION['filter']['type'])                   ? '' : "AND `type`.`type_id` = '".$_SESSION['filter']['type']."'";
$vendorSQL = !($_SESSION['filter']['hersteller'])          ? '' : "AND `vendor`.`vendor_name` = '".$_SESSION['filter']['hersteller']."'";
$seatsSQL = !($_SESSION['filter']['sitze'])                ? '' : "AND `model`.`seats` = ".$_SESSION['filter']['sitze'];
$driveSQL = !($_SESSION['filter']['antrieb'])            ? '' : "AND `model`.`drive` = '".$_SESSION['filter']['antrieb']."'";
$doorsSQL = !($_SESSION['filter']['türen'])                ? '' : "AND `model`.`doors` = ".$_SESSION['filter']['türen'];
$trunkSQL = !($_SESSION['filter']['kofferraum'])                ? '' : "AND `model`.`trunk` = ".$_SESSION['filter']['kofferraum'];
$ageSQL = !($_SESSION['filter']['mindestalter'])                  ? '' : "AND `model`.`min_age` >='".$_SESSION['filter']['mindestalter']."'";
$gearSQL = !($_SESSION['filter']['schaltung'])              ? '' : "AND `model`.`gear` = '".$_SESSION['filter']['schaltung']."'";
$priceSQL = !($_SESSION['filter']['preis'])               ? '' : "AND `model`.`price` <='".$_SESSION['filter']['preis']."'";

$air_conditionSQL = !($_SESSION['filter']['klima'])        ? '' : "AND `model`.`air_condition` = ".$_SESSION['filter']['klima'];
$gpsSQL = !($_SESSION['filter']['gps'])                    ? '' : "AND `model`.`gps` = ".$_SESSION['filter']['gps'];

$sortSQL = $_SESSION['filter']['sortieren'];

//Die Suche in der Datenbank wird gestartet.
 $sql = "SELECT

       `car`.`car_id` AS `car_id`,

       `location`.`location_name` AS `stadt`,

       `type`.`type_id` AS `type`,
       `vendor`.`vendor_name` AS `hersteller`,
       `model`.`seats` AS `sitze`,
       `model`.`drive` AS `antrieb`,
       `model`.`doors` AS `türen`,
       `model`.`trunk` AS `kofferraum`,
       `model`.`min_age` AS `mindestalter`,
       `model`.`gear` AS `schaltung`,
       `model`.`price` AS `preis`,

       `model`.`air_condition` AS `klima`,
       `model`.`gps` AS `gps`,

       `name`.`name` AS `name`,
       `model`.`name_extension` AS `name_extension`

       FROM `car`

       JOIN `location` ON car.location_id = location.location_id
       JOIN `model` ON car.model_id = model.model_id

       JOIN `type` ON `model`.`type_id` = `type`.`type_id`
       JOIN `name` ON `model`.`name_id` = `name`.`name_id`
       JOIN `vendor` ON `model`.`vendor_id` = `vendor`.`vendor_id`

       WHERE $locationSQL $typeSQL $vendorSQL $seatsSQL $driveSQL $doorsSQL $trunkSQL $ageSQL $gearSQL $priceSQL $gpsSQL $air_conditionSQL
       GROUP BY car.model_id";

       $pdo = dbConnect();
       $stmt = $pdo->prepare($sql);
       $stmt->execute();
       $result = $stmt->fetchAll();;

       //Die Ergebnisse werden zurück gegeben.
       return $result;
};



function ausgabe8($mitgabewert){

    //Alle notwendigen Werte zu den Autos werden durch die Funktionen geholt.
    $ergebnisse = Ergebnisse();
    $anzahl_ergebnisse = anzahlErgebnisse();

    //Je nach dem, auf welcher Seite man sich befindet, läuft der Code unterschiedlich lang.
    //Hilsvariable $x sorgt dafür, dass die Schleife auf Seite 1 nur die ersten 8 Ausgaben ausgibt,
    //auf Seite 2 nur 8-16 und auf Seite 3 den Rest (max. 20 Modelle in Leipzig).

    //Außerdem wird die Hilfsvariable $j verwendet, damit man so auf Seite 2 und 3 die selben Autokästen
    //als divs verwenden kann (absolute Positionen).

    //Im mitgabewert wird festgehalten, ob es sich um die ersten 8 Fahrzeug,
    //Fahrzeug 8-16 oder die Fahrzeug-Ausgabe über 16 handelt.

    if ($mitgabewert < 8){$x = 8; $j = $mitgabewert;}
    else if ($mitgabewert < 16) {$x = 16; $j = $mitgabewert;}
    else if ($mitgabewert < 24) {$x = 24; $j = $mitgabewert - 8;}

      for ($i=$mitgabewert; $i < $anzahl_ergebnisse AND $i < $x; $i++){

        $klasse = "auto" . $j;

        //Der Links zur Produkdetailseite wird bei anklicken des Autos hinterlegt.
        echo "<a href='Produktdetailseite.php?id=".$ergebnisse[$i]['car_id']."'>";

        echo "<div class = $klasse>";
        echo "<br><br>";

        echo "<div> ".$ergebnisse[$i]['hersteller']."</div>";
        echo "<div class = autos_ueberschrift> ".$ergebnisse[$i]['name']." ".$ergebnisse[$i]['name_extension']."</div>";
        echo "<br><br>";

        echo "<img src='Bilder/Automodelle/" .$ergebnisse[$i]['type']. ".jpeg'>";
        echo "<br><br>";

        echo "<div> ".$ergebnisse[$i]['preis']." € pro Tag</div>";
        echo "<br>";

        echo "</div> </a>";

        $j = $j + 1;}
      };




 ?>
