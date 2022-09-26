<?php include_once('header.php'); ?>
      <?php
        include('db_Log.php');
        $pdo = dbConnect();

        if(!isset($_GET['page'])) {

          $page_number = 1;
        }
        else {
          $page_number = $_GET['page'];
        }
        if ($page_number < 1) {
          $page_number = 1;
        }

      ?>
      <div class="content1">
        <div class="buchungen_background">
          <div class="meine_buchungen">MEINE BUCHUNGEN</div>
          <hr class="hr3">
          <?php

            $sql1 = "SELECT `booking_id` FROM `bookings` WHERE `user_id` = :user_id";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindValue(':user_id', $user_id);
            $stmt1->execute();
            $rowCount = $stmt1->rowCount();
            $startValue = 0;
            $numbersOfRows = 5;
            $pageURL = "";
            $total_pages = ceil($rowCount / $numbersOfRows);
            if ($page_number > $total_pages) {
              $page_number = $total_pages -1 ;
            }
            $startValue = ($page_number - 1) * $numbersOfRows;

            $sql2 = "SELECT
                  	`bt`.`booking_id`,
                    `bt`.`date_of_booking`,
                    `bt`.`startdate`,
                    `bt`.`enddate`,
                    `vt`.`vendor_name`,
                    `nt`.`name`
                      FROM
                  	  `bookings` as `bt`
                      JOIN `car` as `ct` ON `bt`.`car_id` = `ct`.`car_id`
                      JOIN `model` as `mt` ON `ct`.`model_id` = `mt`.`model_id`
                      JOIN `vendor` AS `vt` ON `mt`.`vendor_id` = `vt`.`vendor_id`
                      JOIN `name` AS `nt` ON `nt`.`name_id` = `mt`.`name_id`";
            $sql2 .= " WHERE `user_id` = $user_id";
            $sql2 .= " LIMIT $startValue, $numbersOfRows";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute();
            $result = $stmt2->fetchAll();

           ?>
           <?php
            echo '<div class="anzahl_buchungen">Anzahl der Buchungen:'?><?php echo $rowCount?></div>
            <?php

            echo '<table class="table">';
            ?>
            <tr>
              <th>BookingID</th>
              <th>Buchungsdatum</th>
              <th>Startdatum</th>
              <th>Enddatum</th>
              <th>Modell</th>
            </tr>
            <?php
            foreach($result as $row) {
           ?>
              <tr class="tr1">
                <td class="td1"><?=$row['booking_id']?></td>
                <td><?=$row['date_of_booking']?></td>
                <td><?=$row['startdate']?></td>
                <td><?=$row['enddate']?></td>
                <td class="td2"><?=$row['vendor_name']?>&nbsp<?=$row['name']?></td>

              </tr>
              <?php
                }
              ?>
            </table>
            <?php
            if($page_number>=2){
          echo "<a href='Meine_Buchungen.php?page=".($page_number-1)."'>  Prev </a>";
      }
          echo $pageURL;
      if($page_number<$total_pages){
          echo "<a href='Meine_Buchungen.php?page=".($page_number+1)."'>  Next </a>";
      }



             ?>
              <div class="book_again"><a href="#">Book again
                <div class="book_again1">>></div></a>
              </div>
        </div>
        <br>

        <div class="content_buchung"></div>
            <div class="buchungen_bild"></div>
            <div class="vertrauen">Vertrauen auch sie auf den meistgenutzen Autovermieter in ganz Deutschland.
                                  14 St&aumldte. &Uumlber 60 Modelle. Worauf wartest du?</div>
            <div class="service">In Service sind wir NR. 1.<br>Sagen &uumlber 10.000 zufriedene Kunden.</div>
              <div class="award"><img src="Bilder/Homepage/Award.png"></div>
              <div class="quality"><img src="Bilder/Homepage/Quality.png"></div>
        </div>
      <br>
<?php include_once('footer.php'); ?>
