<?php include_once('header.php'); ?>

    <div class="content2">
      <div class="back_produktdetail"></div>
        <div class="filter_back"><h4 class="Automodell">TOYOTA C HR HYBRID</h4>
          <img src="Bilder/Automodelle/Toyota.PNG" class="toyota">
          <div class="filter_front">
          </div>
            <div class="kalender">
              <img src="Bilder/Produktdetailseite/kalender.png"></div>
                <div class="datum_produktdetail">10.09.2022 - 16.09.2022</div>
                <hr class="hr2">
            <div class="marker">
              <img src="Bilder/Produktdetailseite/marker.png"></div>
                <div class="city_produktdetail">Hamburg</div>
                <hr class="hr1">
              <div class="vertical"></div>
                <div class="austattung">SUV<br><br><br>5 T&uumlren<br><br><br>Klimaanlage</div>
                <div class="austattung1">Manuell<br><br><br>5 Sitze<br><br><br>GPS</div>
                  <div class="preis">6 Tage á 76,40€</div>
                  <div class="gesamt">GESAMT: 458,40€</div>
        <div class="auswählen">
          <?php
            if ($username) {
              ?>
              <a href="Buchungsbestätigung.php">AUSWÄHLEN</a></div>
              <?php
            } else {
               ?>
               <a href="Login.php?">Login</a>
               <?php
            }
            ?>

      </div>
    </div>

    <?php include_once('footer.php'); ?>
