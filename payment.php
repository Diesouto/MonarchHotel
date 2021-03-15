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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //pagar();
        }
    ?>

<div class="form_holder">
<h2 class="fs-title" style="color:#fff;">steps jquery form with Icons</h2>
<form id="msform">
  <ul id="progressbar">
    <li class="active">Datos de la reserva</li>
    <li>Datos del usuario</li>
    <li>Pago</li>
  </ul>
  <fieldset>
    <h2 class="fs-title">Tu reserva</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
    <input type="text" name="email" placeholder="Email" />
    <input type="password" name="pass" placeholder="Password" />
    <input type="password" name="cpass" placeholder="Confirm Password" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Tus datos</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="facebook" placeholder="Facebook" />
    <input type="text" name="gplus" placeholder="Google Plus" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Pagamiento</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
</div>   

    <script src="js/payment.js"></script>
</body>

</html>