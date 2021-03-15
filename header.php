<?php 
    include "gestorBBDD.php";
?>

<link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
<link rel="icon" href="img/empresa/logo.svg?v=<?php echo time(); ?>">

<meta charset="UTF-8">
<nav>
    <ul>
        <li><a href="index.php"><img src="img/empresa/banner.png"></a></li>
        <li><a href="reserva.php" class="warning">Book now</a></li>
        <li>
            <?php 
                session_start();
                if (!isset($_SESSION['usuario'])) {
                    echo '<a href="login.php">Log in</a>';
                }
                elseif ($_SESSION['usuario'][6] == 0) {
                    echo '<a href="admin.php">Admin panel</a>';
                }
                else {
                    echo '<a href="cuenta.php">Your account</a>';
                }
            ?>
        </li>
        <li><a href="contacto.php">Contact</a></li>
        <li><a href="habitaciones.php">Rooms</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>