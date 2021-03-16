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
        if (isset($_POST["enviar_correo"])) {
            enviar_email_contacto();
            $texto = "Correo enviado con éxito";
        }
    ?>

    <div id="cabeceraPag">
        <div id="contenido-cabecera">
            <h1>Contact</h1>
        </div>
    </div>

    <div class="content">

        <?php if (isset($texto)) {echo "<p class='button'>$texto</p>";}?>
        
        <div id="mapa">
            <h4>Find us</h4>
            <h3>Map</h3>
            <div id="map"></div>
        </div>

        <div>
            <h4>We hear you</h4>
            <h3>Contact</h3>
            <div class="flex">
                <div id="contenedor-contacto">
                    <form id="form-contacto" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                        <p>Send us an email</p>
                        <ul>
                            <li class="form-row">
                                <input name="nombre" class="borde" id="nombre" type="text" placeholder="Name">
                                <input name="email" class="borde" id="email" type="text" placeholder="Email">  
                            </li>
                            <li class="form-row">
                                <input name="asunto" class="borde" id="asunto" type="text" placeholder="Subject">
                            </li>
                            <li class="form-row">
                                <input name="mensaje" class="borde" id="mensaje" type="text" placeholder="Message">
                            </li>
                            <li class="form-row">
                                <input name="enviar_correo" class="button borde" type="submit" value="Send">
                            </li>
                        </ul>
                        
                    </form>


                </div>
                <div id="side">
                    <ul>
                        <li>
                            <p>IES Teis, Vigo</p>
                            <h5>Avenida Galicia 36860</h5>
                        </li>
                        <li>
                            <p>+34 986 234 623</p>
                            <h5>Lunes a Viernes, 08:00-20:00</h5>
                        </li>
                        <li>
                            <p>hotel@maravilla.es</p>
                            <h5>Resolvemos tus dudas</h5>
                        </li>
                        <li>
                            <ul id="social-contacto">
                                <li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter fa-2x"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>        
    </div>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>

    <script src="js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSQUPGLwbw5W-Grk1x_ytMWgmnO6dPJJQ&callback=initMap&libraries=&v=weekly" async></script>
</body>

</html>