<html>

<head>
    <title>Monarch</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>

<body>

    <div id="header"> 
        <?php include "header.php" ?>
    </div>

    <?php
        comprobar_sesion();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['cambiaDatos']) {

            } 
            else if($_POST['logout']) {
                logout();
            }   
        }
    ?>

    <div id="cabeceraPag">
        <div id="contenido-cabecera">
            <h1>Tu cuenta</h1>
            <ul id="menuUsuario">
                <li>Perfil</li>
                <li>Reservas activas</li>
                <li>Reservas realizadas</li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h3>Tus datos</h3>
        <ul>
            <li>Nombre: <?php echo $_SESSION['usuario'][1]?></li>
            <li>Email: <?php echo $_SESSION['usuario'][2]?></li>
            <li>Teléfono: <?php echo $_SESSION['usuario'][3]?></li>
            <li>Dirección: <?php echo $_SESSION['usuario'][4]?></li>
            <li>
                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                    <input id="logout" name="logout" class="form-row button danger" type="submit" value="Cerrar Sesión">
                </form>
            </li>
        </ul>
    </div>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>