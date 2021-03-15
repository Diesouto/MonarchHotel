<?php

#region CargarBBDD

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

function comprobar_sesion() {
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php?redirigido=true");
    }
}

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

function logout() {
    comprobar_sesion();
    $_SESSION=array(); //Destruye las variables de sesión
    session_destroy(); // Elimina la sesion
    setcookie(session_name(), 123, time() - 1000); // Elimina la cookie de sesión
    header("Location: index.php");
}

#endregion


#region Gets

function getAlert($texto) {
    echo "<script type='text/javascript'>
                alert($texto);
          </script>";
}

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
                                            <h5>Tamaño</h5>
                                            <p>' . $row['m2'] .'</p>
                                            <h5>Ventana</h5>
                                            <p>' . $row['ventana'] .'</p>
                                        </li>
                                        <li>
                                            <h5>Servicio limpieza</h5>
                                            <p>' . $row['servicio_limpieza'] .'</p>
                                            <h5>Internet</h5>
                                            <p>' . $row['internet'] .'</p>
                                        </li>
                                    </ul>
                                    <a href="#"><button class="button">Más información</button></a>
                                </div>
                            </div>';
        }
    } else {
        echo "ERROR: " . print_r($bd->errorInfo());
    }

    unset($stmt);

    return $resultado;
}

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
                                        <h5>Tamaño</h5>
                                        <p>' . $row['m2'] .'</p>
                                        <h5>Ventana</h5>
                                        <p>' . $row['ventana'] .'</p>
                                    </li>
                                    <li>
                                        <h5>Servicio limpieza</h5>
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


#endregion


#region Updates
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