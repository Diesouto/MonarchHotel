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
            <h1>Sobre nosotros</h1>
        </div>
    </div>

    <div class="content">
        <div class="flex about">
            <div class="izquierda">
                <h3>Nuestra Historia</h3>
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Integer Ante Mi, Maximus At Elit Consectetur, Facilisis Porttitor Quam. Etiam Iaculis At Urna Nec Blandit. Donec Porta Accumsan Venenatis. Donec Ullamcorper, Orci Et Dictum Euismod, Nisl Nulla Aliquam Arcu, Nec Rutrum Metus Magna Venenatis Libero. </p>
                <h5>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Integer Ante Mi, Maximus At Elit Consectetur</h5>
            </div>
            <div id="foto">
                <img src="img/servicios/instalaciones.png">
            </div>
        </div>
    </div>
    
    <div id="fondo-testimonios">
        <h3>Testimonios</h3>
        <div id="testimonios" class="flex">
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/1.png">
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Integer Ante Mi, Maximus At Elit Consectetur</p>
            </div>
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/2.png">
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Integer Ante Mi, Maximus At Elit Consectetur</p>
            </div>
            <div class="tarjeta-testimonio">
                <img src="img/testimonios/3.png">
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit. Integer Ante Mi, Maximus At Elit Consectetur</p>
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