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
            <h1>Panel administrador</h1>
        </div>
    </div>

    <div class="content">
        <div class="flex about">
            <ul>
                <li>Habitaciones</li>
                <li>Clientes</li>
                <li>Reservas</li>
            </ul>
        </div>

        <div id="loadContent">
            
        </div>
    </div>
    
    

    <div id="footer">
        <?php include "footer.php" ?>
    </div>
</body>

</html>