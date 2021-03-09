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

    <div id="cabeceraIndex">
        <div id="contenido-cabecera">
            <h1>Servicio y discreción</h1>
            <hr>
            <p>Lorem ipsum dolor sit amet</p>
    
            <form id=form-cabecera>
                <input class="transparent" type="text" placeholder="Check In" onfocus="(this.type='date')">
                <input class="transparent" type="text" placeholder="Check Out" onfocus="(this.type='date')">
                <input class="transparent" placeholder="Habitaciones" type="number">
                <input class="transparent" placeholder="Pax." type="number">
                <input class="button" value="Comprobar disponibilidad" type="submit">
            </form>
        </div>
    </div>

    <div class="content">
        <div class="flex tarjeta">
            <div class="tarjeta-habitacion izquierda">
                <h3>Nuestras Habitaciones</h3>
                <p>Lorem ipsum dolor sit amet</p>
                <a href="#"><button class="button vermas">Ver más</button></a>
            </div>
            <div class="tarjeta-imagen1">
                <img src="img/habitaciones/doble.png">
            </div>
        </div>

        <div class="flex tarjeta">
            <div class="tarjeta-imagen2">
                <img src="img/servicios/piscina.png">
            </div>
    
            <div class="tarjeta-habitacion derecha">
                <h3>Nuestros Servicios</h3>
                <p>Lorem ipsum dolor sit amet</p>
                <a href="#"><button class="button vermas">Ver más</button></a>
            </div>
        </div>

        <h3>Vive la experiencia Monarch</h3>
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