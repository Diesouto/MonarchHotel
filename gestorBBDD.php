<?php

#region CargarBBDD

/**
 * Devuelve el puntero a la conexión a la BBDD
 * 
 * @return PDO
 */
function loadBBDD() {
    try {
        $res = leer_config(dirname(__FILE__) . "/config/configuracion.xml", dirname(__FILE__) . "/config/configuracion.xsd");
        $bd = new PDO($res[0], $res[1], $res[2]);
        return $bd;
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit();
    }
}

/**
 * Lee un fichero XML
 * 
 * Si el fichero de configuración existe y es válido, devuelve un array con tres
 * valores: la cadena de conexión, el nombre de usuario y la clave.
 * Si no encuentra el fichero o no es válido, lanza una excepción.
 * 
 * @param path $fichero_config_BBDD  Ruta del fichero con los datos de conexión a la BBDD
 * @param path $esquema  Ruta del fichero XSD que valida el $fichero_config_BBDD
 * 
 * @return array
 */
function leer_config($fichero_config_BBDD, $esquema) {
    $config = new DOMDocument();
    $config->load($fichero_config_BBDD);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise el fichero de configuración");
    }
    $datos = simplexml_load_file($fichero_config_BBDD);
    $ip = $datos->xpath("//ip");
    $nombre = $datos->xpath("//nombre");
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $cad = sprintf("mysql:dbname=%s;host=%s", $nombre[0], $ip[0]);
    $resul = [];
    $resul[] = $cad;
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}
#endregion


#region Login/Logout Usuarios

/**
 * Recupera una contraseña
 * 
 * Recupera la contraseña encriptada de la BBDD cuyo usuario (a través del
 * parámetro nombre) es la dirección de correo del usuario que va a realizar el pedido
 * 
 * @param string $nombre Nombre del usuario del que queremos comparar la contraseña
 * 
 * @return string
 */
function loadPass($email) {
    $bd = loadBBDD();
    $ins = "select password from usuarios where email= '$email'";
    $stmt = $bd->query($ins);
    $resul = $stmt->fetch();
    $devol = false;
    if ($resul !== false) {
        $devol = $resul['password'];
    }
    return $devol;
}

/**
 * Comprueba los datos del login
 * 
 * Comprueba los datos que recibe del formulario del login. Si los datos son correctos
 * devuelve un array con dos campos: codRes (el código del restaurante) y correo 
 * con su correo. En caso de error devuelve false
 * 
 * @param string $nombre Nombre del usuario
 * @param string $clave Contraseña del usuario
 * 
 * @return array
 */
function comprobar_usuario($email, $clave) {
    $devol = FALSE;
    $bd = loadBBDD();
    $hash = loadPass($email);
    if (password_verify($clave, $hash)) {
        $ins = "select * from usuarios where email = '$email' ";
        $resul = $bd->query($ins);
        if ($resul->rowCount() === 1) {
            $devol = $resul->fetch();
        }
    }
    return $devol;
}

/**
 * Comprueba si la sesión está iniciada
 * 
 * Si no está iniciada redirige al login
 */
function comprobar_sesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php?redirigido=true");
    }
}


/**
 * Crea un usuario en la bbdd
 */
function signin() {
    if($_POST['password'] == $_POST['confpassword']){
        $bd = loadBBDD();
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT); 
        $nombre = $_POST["nombre"]; 
        $email = $_POST["email"]; 
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        
        $sql = "INSERT INTO usuarios (id, nombre, email, telf, direccion, password, rol_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt= $bd->prepare($sql);
        $stmt->execute([null, $nombre, $email, $telefono, $direccion, $hash, 1]);
        login();
    }
}

/**
 * Almacena variables de usuario en la $_SESSION
 * 
 */
function login() {
    $usu = comprobar_usuario($_POST['email'], $_POST['password']);
    if ($usu === false) {
        header("Location: login.php?error=true");
    } else {
        session_start();
        $_SESSION["usuario"] = $usu; 
        $_SESSION["reserva"] = [];
        header("Location: index.php");
        return;
    }
}

/**
 * Cierra la sesión del usuario
 */
function logout() {
    comprobar_sesion();
    $_SESSION=array(); //Destruye las variables de sesión
    session_destroy(); // Elimina la sesion
    setcookie(session_name(), 123, time() - 1000); // Elimina la cookie de sesión
    header("Location: index.php");
}

#endregion


#region Gets

/**
 * Genera un alert
 * @param mixed $texto Texto del alert
 */
function getAlert($texto) {
    echo "<script type='text/javascript'>
                alert($texto);
          </script>";
}

/**
 * Obtiene los tipos de habitación de la bbdd
 * @param int $select Habitación seleccionada
 * 
 * @return string Con options para el select
 */
function getTiposHabitacion ($select = 0) {
    $bd = loadBBDD();
    $stmt = "";
    $resultado = "";
    $sql = "select * from habitacion_tipo";

    if (($stmt = $bd->query($sql))) {
        while ($row = $stmt->fetch($bd::FETCH_BOTH)) {
            if ($row['id'] == $select) {
                $resultado .= '<option value="' . $row['tipo_habitacion'] . '" selected="selected">'
                        . $row['tipo_habitacion'] . '</option>';
            } else {
                $resultado .= '<option value="' . $row['tipo_habitacion'] . '">'
                        . $row['tipo_habitacion'] . '</option>';
            }
        }
    } else {
        echo "ERROR: " . print_r($bd->errorInfo());
    }

    unset($stmt);

    return $resultado;
}

/**
 * Obtiene las habitaciones de la bbdd
 * 
 * @return string Con habitaciones
 */
function getHabitaciones () {
    $bd = loadBBDD();
    $stmt = "";
    $resultado = "";
    $sql = "select * from habitaciones";

    if (($stmt = $bd->query($sql))) {
        while ($row = $stmt->fetch($bd::FETCH_BOTH)) {
            $resultado .= '<div class="habitacion flex">
                                <div class="foto">
                                    <img src="img/habitaciones/simple.png">
                                </div>
                                <div class="info">
                                    <h3>' . $row['tipo_de_habitacion'] .'</h3>
                                    <h4>' . $row['precio'] .'</h4>
                                    <ul>
                                        <li>
                                            <h5>Size</h5>
                                            <p>' . $row['m2'] .'m<sup>2</sup></p>
                                            <h5>Window</h5>
                                            <p>' . $row['ventana'] .'</p>
                                        </li>
                                        <li>
                                            <h5>Cleaning service</h5>
                                            <p>' . $row['servicio_limpieza'] .'</p>
                                            <h5>Internet</h5>
                                            <p>' . $row['internet'] .'</p>
                                        </li>
                                    </ul>
                                    <form action = "' . htmlspecialchars("payment.php") .'" method = "POST">
                                        <input name="tipo_de_habitacion" type="hidden" value="' . $row['tipo_de_habitacion'] .'">
                                        <input name="precio" type="hidden" value="' . $row['precio'] .'">
                                        <input name="m2" type="hidden" value="' . $row['m2'] .'">
                                        <input name="ventana" type="hidden" value="' . $row['ventana'] .'">
                                        <input name="servicio_limpieza" type="hidden" value="' . $row['servicio_limpieza'] .'">
                                        <input name="internet" type="hidden" value="' . $row['internet'] .'">
                                        <input name="cargarDatos" class="button" type="submit" value="Book">
                                    </form>
                                </div>
                            </div>';
        }
    } else {
        echo "ERROR: " . print_r($bd->errorInfo());
    }

    unset($stmt);

    return $resultado;
}

/**
 * Obtiene una habitación por el id
 * @param mixed $id id de la habitación a seleccionar
 * 
 * @return string
 */
function getHabitacion ($id) {
    $bd = loadBBDD();
    $stmt = "";
    $resultado = "";
    $sql = "select * from habitaciones where id = $id";

    if (($stmt = $bd->query($sql))) {
        $row = $stmt->fetch($bd::FETCH_BOTH);
        $resultado = '<div class="habitacion flex">
                            <div class="foto">
                                <img src="img/habitaciones/simple.png">
                            </div>
                            <div class="info">
                                <h3>' . $row['tipo_de_habitacion'] .'</h3>
                                <h4>' . $row['precio'] .'</h4>
                                <ul>
                                    <li>
                                        <h5>Size</h5>
                                        <p>' . $row['m2'] .'</p>
                                        <h5>Window</h5>
                                        <p>' . $row['ventana'] .'</p>
                                    </li>
                                    <li>
                                        <h5>Cleaning service</h5>
                                        <p>' . $row['servicio_limpieza'] .'</p>
                                        <h5>Internet</h5>
                                        <p>' . $row['internet'] .'</p>
                                    </li>
                                </ul>
                            </div>
                        </div>';
    } else {
        echo "ERROR: " . print_r($bd->errorInfo());
    }

    unset($stmt);

    return $resultado;
}




#endregion


#region Adds


/**
 * Inserta una habitación en la bbdd
 */
function addHabitacion () {
    $bd = loadBBDD();
    $sql = "INSERT INTO habitaciones (`id`, `m2`, `ventana`, `tipo_de_habitacion`, `servicio_limpieza`, `internet`, `precio`, `reservable`)
                VALUES (null, ?, ?, ?, ?, ?, ?, ?);";

    try {
        $stmt = $bd->prepare($sql);

        $stmt->bindValue(1, $_POST['m2']);
        $stmt->bindValue(2, $_POST['ventana']);
        $stmt->bindValue(3, $_POST['tipo']);
        $stmt->bindValue(4, $_POST['servicio_limpieza']);
        $stmt->bindValue(5, $_POST['internet']);
        $stmt->bindValue(6, $_POST['precio']);
        $stmt->bindValue(7, $_POST['reservable']);

        $stmt->execute();
    } 
    catch (\Exception $e) {
        $bd->rollback();
        throw $e;
    }
    unset($stmt);
}


/**
 * Almacena en la sesión datos de la reserva
 */
function addDatosReserva() {
    $checkin = $_POST['checkin'];
    $chekout = $_POST['checkout'];
    $diasReserva = $chekout->diff($checkin)->format("%a");

    $_SESSION['reserva'][0] = $_SESSION['usuario'][0];
    $_SESSION['reserva'][1] = $checkin;
    $_SESSION['reserva'][2] = $diasReserva;
}

/**
 * Inserta una reserva en la base de datos
 */
function addReserva() {
    session_start();
    $bd = loadBBDD();
    $sql = "INSERT INTO RESERVAS (`num_reserva`, `id_usuario`, `fecha_reserva`, `num_dias`)
            VALUES (?,?,?,?)";

    try {
        $stmt = $bd->prepare($sql);

        $stmt->bindValue(1, null);
        $stmt->bindValue(2, $_SESSION['reserva'][0]);
        $stmt->bindValue(3, $_SESSION['reserva'][1]);
        $stmt->bindValue(4, $_SESSION['reserva'][2]);

        $stmt->execute();
    } 
    catch (\Exception $e) {
        $bd->rollback();
        throw $e;
    }
    unset($stmt);
}

#endregion


#region Updates


/**
 * Actualiza los datos de un usuario de la base de datos
 */
function updateUsuario() {
    $bd = loadBBDD();
    $sql = "UPDATE usuarios SET nombre=?, email=?, telf=?, direccion=? WHERE id=?";
    $stmt= $bd->prepare($sql);

    $stmt->execute([$_POST['nombre'], $_POST['email'], $_POST['telf'], $_POST['direccion'], $_SESSION['usuario'][0]]);

    if($_POST['password'] != ""){
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT); 
        $sql = "UPDATE usuarios SET password=? WHERE id=?";
        $stmt= $bd->prepare($sql);

        $stmt->execute([$hash, $_SESSION['usuario'][0]]);
    }

    getAlert("Datos modificados con éxito");
}


#endregion

#region Mail

require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Envía el email de la página de contacto
 * 
 * Lee el fichero de configuración correo.xml para obtener la cuenta de correo usada para enviar los emails
 * @return string
 */
function enviar_email_contacto() {
    $res = leer_configCorreo (dirname(__FILE__) . "/config/correo.xml", dirname(__FILE__) . "/config/correo.xsd");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;  // cambiar a 1 o 2 para ver errores
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = $res[0];  //usuario de gmail
    $mail->Password = $res[1]; //contraseña de gmail          
    $mail->SetFrom($_POST['email'], $_POST['nombre']); //No funciona en gmail por motivos de seguridad
    $mail->AddReplyTo($_POST['email'], $_POST['nombre']);
    $mail->Subject = utf8_decode($_POST['asunto']);
    $mail->MsgHTML($_POST['mensaje']);
    /* Divide la lista de correos por la coma */
    $mail->AddAddress($res[0]);

    if (!$mail->Send()) {
        return $mail->ErrorInfo;
    } else {
        return "Correo enviado con éxito";
    }
}


/**
 * Lee un fichero XML
 * 
 * Si el fichero de configuración existe y es válido, devuelve un array con dos
 * valores: el usuario y la clave.
 * Si no encuentra el fichero o no es válido, lanza una excepción.
 * 
 * @param path $nombre  Ruta del fichero con los datos de correo electrónico
 * @param path $esquema  Ruta del fichero XSD que valida el fichero de correo
 * 
 * @return array
 */
function leer_configCorreo ($nombre, $esquema) {
    $config = new DOMDocument();
    $config->load($nombre);
    $res = $config->schemaValidate($esquema);
    if ($res === FALSE) {
        throw new InvalidArgumentException("Revise fichero de configuración");
    }
    $datos = simplexml_load_file($nombre);
    $usu = $datos->xpath("//usuario");
    $clave = $datos->xpath("//clave");
    $resul = [];
    $resul[] = $usu[0];
    $resul[] = $clave[0];
    return $resul;
}
#endregion

?>