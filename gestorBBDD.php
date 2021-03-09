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
        $ins = "select id, nombre, email, rol_usuario from usuarios where email = '$email' ";
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
    if($_POST['password']===$_POST['confpassword']){
        $bd = loadBBDD();
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT); 
        $ins = 'INSERT INTO usuarios (id, nombre, email, telf, direccion, password, rol_usuario) VALUES (NULL, $_POST["nombre"], $_POST["email"], $_POST["telefono"], $_POST["direccion"], $hash, 1)';
        $bd->query($ins);
    }
}

function login() {
    $usu = comprobar_usuario($_POST['email'], $_POST['password']);
    if ($usu === false) {
        header("Location: login.php?error=true");
    } else {
        session_start();
        // $usu tiene campos correo y codRes, correo 
        $_SESSION['usuario'] = $usu; //array de 4 elementos
        $_SESSION['reserva'] = [];
        header("Location: index.php");
        return;
    }
}

function logout() {
    comprobar_sesion();
    $_SESSION=array(); //Destruye las variables de sesión
    session_destroy(); // Elimina la sesion
    setcookie(session_name(), 123, time() - 1000); // Elimina la cookie de sesión
}

#endregion


#region CargarContenidos


#endregion



?>