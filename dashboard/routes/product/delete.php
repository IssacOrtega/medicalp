<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_var(cleanData($_POST['id_product']), FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $image = filter_var(cleanData($_POST['image']), FILTER_SANITIZE_STRING);
    if (!empty($id)) {
        $statement = $conexion->prepare('DELETE FROM product WHERE id_product = :id');
        $statement->execute(array(':id' => $id));
        unlink('../../../' . $image);
        $_SESSION['deleted'] = '1';
        header('Location: ' . RUTA . '/dashboard/product.php');
    }
} else {
    header('Location: ' . RUTA . '/dashboard/product.php');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
