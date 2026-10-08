<?php

session_start();

require 'vendor/autoload.php'; 

date_default_timezone_set('Europe/Madrid');

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$email = trim($_POST['email'] ?? '');

$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}
else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ]+$/", $nombre)) {
    $errores[] = "El nombre solo puede contener letras.";
}

if (empty($apellido)) {
    $errores[] = "El apellido es obligatorio.";
}
else if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ]+$/", $apellido)) {
    $errores[] = "El apellido solo puede contener letras.";
}

if (empty($email)) {
    $errores[] = "El correo electrónico es obligatorio.";
}
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo electrónico no es válido.";
}

if (empty($errores)) {
    try {
        $uri = getenv('MONGO_URI');

        if (!$uri) {
            throw new Exception("La variable de entorno MONGO_URI no está definida.");
        }
        
        $cliente = new MongoDB\Client($uri);
        $coleccion = $cliente->pruebaDB->usuarios;
        
        $documento = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'fecha_registro' => date('d-m-Y H:i:s')
        ];

        $coleccion->insertOne($documento);

        $_SESSION['status'] = 'exito';
        $_SESSION['mensaje'] = "¡Validación correcta! Los datos se han guardado en MongoDB con éxito.";
        $_SESSION['datos'] = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email
        ];

    } catch (MongoDB\Driver\Exception\Exception $e) {
        $_SESSION['status'] = 'error';
        $_SESSION['errores'] = ["Error de Base de Datos: " . $e->getMessage()];
    }
} else {
    $_SESSION['status'] = 'error';
    $_SESSION['errores'] = $errores;
}

header("Location: resultado.php");
exit();