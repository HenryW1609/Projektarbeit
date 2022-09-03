<!DOCTYPE html>
<html>
<head>
  <title> Out & About</title>
    <link rel="stylesheet" href="Startseite.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
</head>
  <body>
    <div id="navbar">
      <a href="Startseite.php" id="logo">Out & About</a>
      <div id="navbar-right">
        <a href="Produktuebersichtseite.html">Cars</a>
        <a href="haha">Cities</a>
        <a href="Meine_Buchungen.html">Meine Buchungen</a>
        <a href="login" class="icon" ><img src="Bilder/Homepage/Icon-Login.png"></a>
      </div>
    </div>

    <div class="content">
      <div class="background">
        <div class="filter">

          <?php $dr = $_SERVER['DOCUMENT_ROOT']; ?>
          <?php
            session_start();
            $city = (isset($_REQUEST['city']) && !empty($_REQUEST['city'])) ? $_REQUEST['city']:'';

            if ($city != '') {
            $stadt = [
              'city' => $city,
            ];

            $_SESSION['stadt'] =$stadt;

          }
          ?>

                <div>
                  <div>
                  <form action="test.php" method="post">
                      <div>
                          <select class="select1" name="city" id="city">
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
                      <div>
                          <input type="submit" name="Stadt" value="AUSWAHL ANZEIGEN" class="input1">
                      </div>
                      <div class="starttime">
                        <input type="date" name="Abholdatum" value="">
                      </div>
                      <div class="endtime">
                        <input type="date" name="Rückgabedatum" value="">
                      </div>
                  </form>
                  </div>
                </div>
          <div><h4 class="filter_city_title">Von wo startest du?</h4>
            <img src="Bilder/Homepage/location1.png" class="filter_city_img">

          <hr class="line">
          </div>
          <div class="filter_time"><h4 class="filter_time_title">Abholdatum/R&uumlckgabedatum</h4>
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
              Durchschnittlich 8% g&uumlnstiger als die Konkurrenz</div>
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
          <a href="Datenschutz.html">Datenschutz</a></div>
        <div class="footer_agb">
          <a href="AGB.html">AGB & Rechtliches</a></div>
        <div class="footer_impressum">
          <a href="Impressum.html">Impressum</a></div>
      </div>
      <div class="about"><h4>About us</h4></div>
        <div class="footer_team">
          <a href="Team.html">Das Team</a></div>
      <div class="copyright">Copyright 2022</div>
        <a href="haha"><img src="Bilder/Footer/instagram.png" class="instagram"></a>
        <a href="haha"><img src="Bilder/Footer/facebook.png" class="facebook"></a>
        <a href="haha"><img src="Bilder/Footer/twitter.png" class="twitter"></a>
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
</html>
