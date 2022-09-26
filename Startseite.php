<?php include_once('header.php'); ?>
    <div class="content">
      <div class="background">
        <div class="filter1">
          <?php $dr = $_SERVER['DOCUMENT_ROOT']; ?>
          <?php
            $location = (isset($_POST['Stadt']) && !empty($_POST['Stadt'])) ? $_POST['Stadt']:'';
            $Abholdatum = (isset($_POST['Abholdatum']) && !empty($_POST['Abholdatum'])) ? $_POST['Abholdatum']:'';
            $Rückgabedatum = (isset($_POST['Rückgabedatum']) && !empty($_POST['Rückgabedatum'])) ? $_POST['Rückgabedatum']:'';

            if ($location != '') {
            $stadt = [
              'location' => $location,
            ];
            $_SESSION['stadt'] =$stadt;
          }
          ?>

                <div>
                  <div>
                  <form action="Produktuebersichtseite.php" method="post">
                      <div>
                          <select class="select1" name="Stadt">
                            <option value="Hamburg">Hamburg</option>
                            <option value="Bielefeld">Bielefeld</option>
                            <option value="Bochum">Bochum</option>
                            <option value="Bremen">Bremen</option>
                            <option value="Dortmund">Dortmund</option>
                            <option value="Dresden">Dresden</option>
                            <option value="Freiburg">Freiburg</option>
                            <option value="Berlin">Berlin</option>
                            <option value="Köln">Köln</option>
                            <option value="Leipzig">Leipzig</option>
                            <option value="München">München</option>
                            <option value="Nürnberg">Nürnberg</option>
                            <option value="Paderborn">Paderborn</option>
                            <option value="Rohstock">Rostock</option>
                          </select>
                      </div>
                      <?php $date = strtotime("+2 day", time()); ?>
                      <div>
                          <input type="submit" name="Stadt" value="AUSWAHL ANZEIGEN" class="input1">
                      </div>
                      <div class="starttime">
                        <input type="date" name="Abholdatum" value="<?php echo date('Y-m-d'); ?>">
                      </div>

                      <div class="endtime">
                        <input type="date" name="Rückgabedatum" value="<?php echo date('Y-m-d', $date); ?>">
                      </div>
                  </form>
                  </div>
                </div>
          <div><h4 class="filter_city_title">Von wo startest du?</h4>
            <img src="Bilder/Homepage/location1.png" class="filter_city_img">

          <hr class="line">
          </div>
          <div class="filter_time"><h4 class="filter_time_title">Abholdatum/Rückgabedatum</h4>
            <img src="Bilder/Homepage/calendar1.png" class="filter_time_img">
            <div class="vl">|</div>
            <hr class="line1">
          </div>
          </div>
        </div>
            <div class="slogan">Pick yours<br>and get out there</div>
            <div class="box1">
              <img src="Bilder/Homepage/trophy.png" class="trophy"><br><br><br><br><br>
              Ausgezeichnet mit 1,0 von Testsieger
              </div>
            <div class="box2">
              <img src="Bilder/Homepage/euro.png" class="euro"><br><br><br><br><br>
              Durchschnittlich 8% günstiger als die Konkurrenz</div>
            <div class="box3">
              <img src="Bilder/Homepage/badge.png" class="badge">
            </div>
            <div class="box4">
              <img src="Bilder/Homepage/prozess.png" class="prozess">
            </div>
      </div>

        <div class="slideshow-background">
          <div class="slideshow-container">

            <div class="mySlides fade">
              <div class="numbertext">1 / 2</div>
            <a href ="#" class="firstpic"><img src="Bilder/Automodelle/SUV.png"></a>
            <a href="#" class="secondpic"><img src="Bilder/Automodelle/Transporter.png"></a>
            <a href="#" class="thirdpic"><img src="Bilder/Automodelle/Cabrios.png"></a>
              <div class="text">SUVs</div><div class="text2">Transporter</div><div class="text3">Cabrios</div>
            </div>
            <div class="mySlides fade">
              <div class="numbertext">2 / 2</div>
              <a href="#" class="forthpic"><img src="Bilder/Automodelle/Kombi.png"></a>
              <a href="#" class="fifthpic"><img src="Bilder/Automodelle/Limousine.png"></a>
              <a href="#" class="sixthpic"><img src="Bilder/Automodelle/Coupe.png"></a>
              <div class="text">Kombi</div><div class="text2">Limousine</div><div class="text3">Coupe</div>
            </div>

            <a class="prev" onclick="plusSlides(-1)"><</a>
            <a class="next" onclick="plusSlides(1)">></a>
        </div>
      </div>
                <div class="werbung_background">
                  <div class="werbung">Lorem ipsum dolor sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                    dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusamtempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accu.</div>
                    <div class="werbung_image"><img src="Bilder/Homepage/werbung.png"></div>
                </div>
                      <div class="map_background">
                        <div class="map_title">Immer in deiner N&aumlhe verf&uumlgbar</div>

                        <iframe src="https://www.google.com/maps/d/embed?mid=13gLTaGbR1bKKek_wdXnqPLC9L7pWiSA&ehbc=2E312F"
                        class="maps" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                  </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
          showSlides(slideIndex += n);
        }

        function currentSlide(n) {
          showSlides(slideIndex = n);
        }

        function showSlides(n) {
          let i;
          let slides = document.getElementsByClassName("mySlides");
          let dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";
          dots[slideIndex-1].className += " active";
        }
      </script>

    </body>
<?php include_once('footer.php'); ?>
