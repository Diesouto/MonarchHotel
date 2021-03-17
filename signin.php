<html>

<head>
    <title>Monarch</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<?php
    include "gestorBBDD.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        signin();
    }
?>

<body>
    <div class="content flex">
        <div class="signin">
            <h4>Bienvenido</h4>
            <h3>Regístrate</h3>
            <form id="signin flex" class="signin-form" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
                <input id="nombre" class="form-row loginform" name="nombre" placeholder="Nombre" type="text">
                <input id="nombre" class="form-row loginform" name="telefono" placeholder="Telefono" type="number">
                <input id="email" class="form-row loginform" name="email" placeholder="Email" type="text">
                <input id="direccion" class="form-row loginform" name="direccion" placeholder="Dirección" type="text">
                <input id="password" class="form-row loginform" name="password" placeholder="Contraseña" type="password">
                <input id="confpassword" class="form-row loginform" name="confpassword" placeholder="Confirmar contraseña" type="password">
                <input id="submit" class="form-row button redondo" type="submit" value="Crear cuenta">
            </form>
        </div>     
        <div id="foto" class="signin">
            <img src="img/signin.png">
        </div>   
    </div>
</body>

</html>