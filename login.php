<html>

<head>
    <title>Monarch</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<body>
    
    <?php
        include "gestorBBDD.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            login();
        }

        if (isset($_GET["redirigido"])) {
            echo "<p>Haga login para continuar</p>";
        }

        if (isset($_GET["error"])) {
            echo "<p> Revise usuario y contraseña</p>";
        }
    ?>

    <div id="login-contenedor flex" class="content">
        <div class="login">
            <h4>Bienvenido</h4>
            <h3>Inicia sesión</h3>
            <form id="login flex" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <input class="loginform form-row" id="email" name="email" placeholder="Email" type="text" value = "<?php if (isset($email)) echo $email; ?>" required>
                <input class="loginform form-row" id="password" name="password" placeholder="Contraseña" type="password" required>
                <input id="submit" class="form-row button redondo" type="submit" value="Iniciar Sesión">
                <a href="#">¿Has olvidado tu contraseña?</a>
                <a href="signin.php">¿Aún no tienes una cuenta?</a>
            </form>
        </div>        
    </div>
</body>

</html>