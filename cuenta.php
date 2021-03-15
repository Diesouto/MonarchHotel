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
            if ($_POST['cambiar']) {
                updateUsuario();
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
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <li>Nombre: <input name="nombre" type="text" required value="<?php echo $_SESSION['usuario'][1]?>"></li>
                <li>Email: <input name="email" type="text" required value="<?php echo $_SESSION['usuario'][2]?>"></li>
                <li>Teléfono: <input name="telf" type="number" required value="<?php echo $_SESSION['usuario'][3]?>"></li>
                <li>Dirección: <input name="direccion" type="text" required value="<?php echo $_SESSION['usuario'][4]?>"></li>
                <li>Contraseña: <input name="password" type="password" placeholder="Nueva contraseña"></li>
                <input id="cambiar" name="cambiar" class="form-row button" type="submit" value="Cambiar datos">
            </form>
            <li>
                <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                    <input id="logout" name="logout" class="form-row button danger" type="submit" value="Cerrar Sesión">
                </form>
            </li>
            <li>
                
            </li>
        </ul>
    </div>

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>