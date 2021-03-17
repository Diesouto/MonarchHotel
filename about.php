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
            <h1>About us</h1>
        </div>
    </div>

    <div class="content">
        <div class="flex about">
            <div class="izquierda">
                <h3>Our History</h3>
                <p>Here in Monarch Hotels we have always been worried about offering the best possible services to our customers, and we are sure you will notice it right away. </p>
                <h5>Enjoy a teaser of what the hotel has to offer</h5>
            </div>
            <div id="foto">
                <img src="img/servicios/instalaciones.png">
            </div>
        </div>
    </div>
    
    <div id="fondo-testimonios">
        <h3>Testimonials</h3>
        <div id="testimonios" class="flex">
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/1.png">
                <p>"Beyond 5 stars! Stayed last week at this wonderful hotel and didn´t want to leave"</p>
            </div>
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/2.png">
                <p> Thank you for a truly amazing stay! Your hospitality is quite outstanding. Hope to be back soon.</p>
            </div>
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/3.png">
                <p>Everything was great, staff was very helpful and we were extremely happy with the meeting!</p>
            </div>
        </div>
    </div>

    <div class="content">
        <h3>Servicios</h3>
        <div id="contenedor-triple" class="flex">
            <img class="triple" src="img/servicios/gimnasio.png">
            <img class="triple" src="img/servicios/tumbonas.png">
            <img class="triple" src="img/servicios/masajes.png">
        </div>
    </div>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>