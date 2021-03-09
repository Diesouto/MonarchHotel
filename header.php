<?php 
    include "gestorBBDD.php";
?>

<link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
<link rel="icon" href="img/empresa/logo.svg?v=<?php echo time(); ?>">

<meta charset="UTF-8">
<nav>
    <ul>
        <li><a href="index.php"><img src="img/empresa/banner.png"></a></li>
        <li><a href="reserva.php" class="warning">Reserva ahora</a></li>
        <li>
            <?php 
                session_start();
                if (!isset($_SESSION['usuario'])) {
                    echo '<a href="login.php">Inicia sesión</a>';
                }
                elseif ($_SESSION['usuario'][6] == 0) {
                    echo '<a href="admin.php">Administrar</a>';
                }
                else {
                    echo '<a href="cuenta.php">Tu Cuenta</a>';
                }
            ?>
        </li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="habitaciones.php">Habitaciones</a></li>
        <li><a href="about.php">Sobre Nosotros</a></li>
        <li><a href="index.php">Inicio</a></li>
    </ul>
</nav>