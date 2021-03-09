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

    <?php
        comprobar_sesion();
    ?>

    <div id="cabeceraPag">
        <div id="contenido-cabecera">
            <h1>Tu cuenta</h1>
        </div>
        <ul>
            <li>Perfil</li>
            <li>Reservas activas</li>
            <li>Reservas realizadas</li>
        </ul>
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

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>