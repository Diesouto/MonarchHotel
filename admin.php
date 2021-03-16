<html>

<head>
    <title>Monarch</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<body>
    <div id="header"> 
        <?php include "header.php" ?>
    </div>

    <?php
        if(!isset($_SESSION['usuario'])){
            session_start();
        }
        comprobar_sesion();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['crearHabitacion']) {
                addHabitacion();
            } 
            else if($_POST['logout']) {
                logout();
            }   
        }

        //Cargar Reservas
        if (isset($_GET["reservas"])) {
            //echo getReservas();
        }
        //Cargar Reserva Manual
        elseif (isset($_GET["manual"])) {
            echo "<p> Revise usuario y contraseña</p>";
        }
        //Cargar Habitaciones
        else {
            ?>
            <div id="cabeceraPag">
                <div id="contenido-cabecera">
                    <h1>Panel administrador</h1>
                    <ul class="menuUsuario">
                        <li><a href="admin.php">Habitaciones</a></li>
                        <li><a href="admin.php?reservas=true">Reservas</a></li>
                        <li><a href="admin.php?manual=true">Reserva manual</a></li>
                    </ul>
                </div>
            </div>

            <div class="content">
                <div class="flex about">
                    <ul>
                        <li>
                        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                            <input id="logout" name="logout" class="form-row button danger" type="submit" value="Cerrar Sesión">
                        </form>
                        </li>
                    </ul>
                </div>

                <div id="loadContent" class="fondo-oscuro">
                    <h3>Añadir habitación</h3>
                    <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                        <ul>
                            <li><input name="m2" type="number" step="0.01" placeholder="Metros cuadrados"></li>
                            <li><input name="precio" type="number" step="0.01" placeholder="Precio"></li>
                            <li><label for="tipo">Tipo de habitación</label>
                                <select name="tipo">
                                <?php
                                    echo getTiposHabitacion();
                                ?>
                            </select></li>
                            <li><label for="ventana">Ventana</label>
                            <select name="ventana">
                                <option selected="selected">Si</option>
                                <option>No</option>
                            </select></li>
                            <label for="servicio_limpieza">Servicio de limpieza</label>
                            <select name="servicio_limpieza">
                                <option selected="selected">Si</option>
                                <option>No</option>
                            </select></li>
                            <li><label for="internet">Internet</label>
                            <select name="internet">
                                <option selected="selected">Si</option>
                                <option>No</option>
                            </select></li>
                            <label for="reservable">Reservable</label>
                            <select name="reservable">
                                <option selected="selected">Si</option>
                                <option>No</option>
                            </select></li>
                            <li><input name="crearHabitacion" class="button" type="submit" value="Crear habitación"></li>
                        </ul>
                    </form>
                </div>

                <div id="listadoHabitaciones">
                    <h3>Listado de habitaciones</h3>
                    <div id="habitaciones">
                        <?php echo getHabitaciones()?>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>