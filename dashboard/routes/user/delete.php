<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_var(cleanData($_POST['id_user']), FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    if (!empty($id)) {
        $statement = $conexion->prepare('DELETE FROM user WHERE id_user = :id');
        $statement->execute(array(':id' => $id));
        $_SESSION['deleted'] = '1';
        header('Location: ' . RUTA . '/dashboard/user.php');
    }
} else {
    header('Location: ' . RUTA . '/dashboard');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
