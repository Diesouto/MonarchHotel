<html>

<head>
    <title>Monarch</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
    <link rel="stylesheet" href="css/payment.css">
    <link rel="icon" href="img/empresa/logo.svg">
</head>

<body>
    
    <?php
        include "gestorBBDD.php";

        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['addReserva'])){
              //addReserva();
            }
        }
    ?>

<div class="form_holder">
<form id="msform">
  <ul id="progressbar">
    <li class="active">Booking info</li>
    <li>User data</li>
    <li>Payment</li>
  </ul>
  <fieldset>
    <h2 class="fs-title">Your stay</h2>
    <input type="text" name="tipo_habitacion" readonly value="<?php if(isset($_POST["precio"])){echo $_POST["tipo_de_habitacion"];}?>" />
    <input type="text" name="precio" readonly value="<?php if(isset($_POST["precio"])){echo $_POST["precio"];}?>" />
    <input type="text" name="checkin" placeholder="Check In" onfocus="(this.type='date')"/>
    <input type="text" name="checkout" type="text" placeholder="Check Out" onfocus="(this.type='date')"/>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Your data</h2>
    <input type="text" name="nombre" placeholder="Nombre" value="<?php if(isset($_SESSION["usuario"])){echo $_SESSION["usuario"][1];}?>" />
    <input type="text" name="email" placeholder="Email" value="<?php if(isset($_SESSION["usuario"])){echo $_SESSION["usuario"][2];}?>" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Payment</h2>
    <input type="text" name="IBAN" placeholder="Credit Card" />
    <input type="text" name="PIN" placeholder="Security Digits" />
    <input type="text" name="expiration" placeholder="Expiration Date" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="addReserva" class="submit action-button" value="Book" />
  </fieldset>
</form>
</div>   

    <script src="js/payment.js"></script>
</body>

</html>