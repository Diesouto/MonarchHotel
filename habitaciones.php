<html>

<head>
    <title>Monarch</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<body>
    <div id="header">
      <?php include "header.php" ?>
    </div>

    <div id="cabeceraPag">
        <div id="contenido-cabecera">
            <h1>Rooms</h1>
        </div>
    </div>

    <div class="content">
        <h4>Enjoy your stay</h4>
        <h3>Our rooms</h3>
        <div class="slideshow-container">
            <div class="mySlides fade">
              <img src="img/habitaciones/simple.png">
            </div>
            
            <div class="mySlides fade">
              <img src="img/habitaciones/doble.png">
            </div>
            
            <div class="mySlides fade">
              <img src="img/habitaciones/suite.png">
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <h4>Best price</h4>
        <h3>Promotions</h3>
        <div class="slideshow-container">
            <div class="mySlides fade">
              <img src="img/habitaciones/simple.png">
              <div class="text">Caption Text</div>
            </div>
            
            <div class="mySlides fade">
              <img src="img/habitaciones/doble.png">
              <div class="text">Caption Two</div>
            </div>
            
            <div class="mySlides fade">
              <img src="img/habitaciones/suite.png">
              <div class="text">Caption Three</div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </div>

    <div id="footer">
      <?php include "footer.php" ?>
    </div>
    <script src="js/carousel.js"></script>
</body>

</html>