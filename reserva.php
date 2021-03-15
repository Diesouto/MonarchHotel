<html>

<head>
    <title>Monarch</title>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<body>
    <div id="header">
        <?php include "header.php" ?>
    </div>

    <div id="cabeceraPag">
        <div id="contenido-cabecera">
            <h1>Reserva</h1>
        </div>
    </div>

    <div id="contentfiltro" class="content fondo-oscuro">
        <h4>A tu gusto</h4>
        <h3>Filtrar</h3>

        <div id="contenedorfiltro" class="flex">
            <div id="habitaciones">
                <?php echo getHabitaciones()?>
            </div>

            <div id="filtro">
                <form>
                    <ul>
                        <li class="form-row"><p>Fecha</p></li>
                        <li class="form-row">
                            <input type="text" placeholder="Check In" onfocus="(this.type='date')">
                            <input type="text" placeholder="Check Out" onfocus="(this.type='date')">
                        </li>
                        <li id="spanTexto" class="form-row">
                            <p>Personas</p>
                            <p>Habitaciones</p>
                        </li>
                        <li class="form-row">
                            <input placeholder="Pax." type="number">
                            <input placeholder="Habitaciones" type="number">
                        </li>
                        <li class="form-row">
                            <div class="slidecontainer">
                                <p>Precio: <span id="demo"></span></p>
                                <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                            </div>
                        </li>
                        <li class="form-row">
                            <input class="button redondo" value="Comprobar disponibilidad" type="submit">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <div id="inforeserva">
        <form>
            <div><p>06 Abril - 09 Abril</p></div>
            <div><i class="fas fa-user"></i><p> x 2</p></div>
            <div><i class="fas fa-bed"></i><p> x 2</p></div>
            <div><p>Vistas al mar 400€</p></div>
            <input class="button" type="submit" value="Reservar">
        </form>
    </div>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>

    <script src="js/sliderPrecio.js"></script>
    
</body>

</html>