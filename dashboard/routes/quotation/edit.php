<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_quote = filter_var(cleanData($_POST['id_quote']),  FILTER_SANITIZE_STRING);
    // $id_quote_client = filter_var(cleanData($_POST['id_quote_client']),  FILTER_SANITIZE_STRING);
    $title = filter_var(cleanData($_POST['title']), FILTER_SANITIZE_STRING);
    $client = filter_var(cleanData($_POST['client']),  FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    // $date = filter_var(cleanData($_POST['date']), FILTER_SANITIZE_STRING);
    $date_expired = filter_var(cleanData($_POST['date_expired']), FILTER_SANITIZE_STRING);

    if (empty($id_quote) || empty($title) || empty($client) || empty($date_expired)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/');
    } else {
        $statement = $conexion->prepare('UPDATE quotation 
        SET title = :title, validity = :date_expired, id_client = :id_client
        WHERE id_quote = :id_quote');

        $statement->execute(array(
            ':id_quote' => $id_quote,
            ':title' => $title,
            ':date_expired' => $date_expired,
            ':id_client' => $client,
        ));

        $_SESSION['edit'] = '1';
        header('Location:' . RUTA . 'dashboard/');
    }
} else {
    header('Location: ' . RUTA . 'dashboard');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
