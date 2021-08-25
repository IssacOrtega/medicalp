<?php

// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require '../data/config.php';

// Llamando al archivo de funciones
require '../data/functions.php';

// variable de mensajes
$msg = '';

// Insertando la conexion de la base de datos
$conexion = conexion($bd_config);


if ($_SESSION['roll'] != 'Usuario') {
    if(!isset($_GET['search'])){
        // Trae todas las cotizaciones
        $quotations = quotations($conexion, null, null);
    } else {
        $search = filter_var(cleanData($_GET['search']), FILTER_SANITIZE_STRING);
        // Trae todas las cotizaciones
        $quotations = quotations($conexion, null, $search);
    }
} else {
    if (!isset($_GET['search'])) {
        // Trae todas las cotizaciones
        $quotations = quotations($conexion, $_SESSION['id_user'], null);
    } else {
        $search = filter_var(cleanData($_GET['search']), FILTER_SANITIZE_STRING);
        // Trae todas las cotizaciones
        $quotations = quotations($conexion, $_SESSION['id_user'], $search);
    }
}

// Trae todo el catalogo de clientes
$clients = all_clients($conexion);

// Mensaje de error para campos vacios
if (isset($_SESSION['empty'])) {
    unset($_SESSION['empty']);
    $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> Por favor llenar los datos correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de exito para información agregada a la BD
if (isset($_SESSION['add'])) {
    unset($_SESSION['add']);
    $msg .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Éxito!</strong> Los datos se han agregado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de exito para datos actualizados o editados
if (isset($_SESSION['edit'])) {
    unset($_SESSION['edit']);
    $msg .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Éxito!</strong> Los datos se han actualizado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de exito para eliminar cotización
if (isset($_SESSION['deleted'])) {
    unset($_SESSION['deleted']);
    $msg .= '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Éxito!</strong> La cotización se ha eliminado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de error para campos vacios
if (isset($_SESSION['exist'])) {
    unset($_SESSION['exist']);
    $msg .= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>¡Atención!</strong> No se puede repetir el id de la cotización con el id de otra cotización registrada.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_quote = mt_rand() . mt_rand(1, 99);
    $title = filter_var(cleanData($_POST['title']), FILTER_SANITIZE_STRING);
    $client = filter_var(cleanData($_POST['client']),  FILTER_SANITIZE_STRING);
    $date = date('Y-m-d');
    $date_expired = filter_var(cleanData($_POST['date_expired']), FILTER_SANITIZE_STRING);
    $id_user = $_SESSION['id_user'];

    // Trae el id_cotizacion_cliente de la cotizacion existente para no repetirlo
    $id_quote_client_exist = id_quote_client_exist($conexion, $id_quote);

    if (empty($id_quote) || empty($title) || empty($client) || empty($date) || empty($date_expired) || empty($id_user)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/');
    } else {
        if ($id_quote_client_exist != true){
            $statement = $conexion->prepare(
                'INSERT INTO quotation (id_quote, id_quote_client, title, date, validity, id_client, id_user) 
                    VALUES (NULL, :id_quote, :title, :date, :date_expired, :client, :id_user)'
                );

            $statement->execute(array(
                ':id_quote' => $id_quote,
                ':title' => $title,
                ':date' => $date,
                ':date_expired' => $date_expired,
                ':client' => $client,
                ':id_user' => $id_user,
            ));

            $_SESSION['add'] = '1';
            header('Location:' . RUTA . 'dashboard/');
        } else {
            $_SESSION['exist'] = '1';
            header('Location:' . RUTA . 'dashboard/');
        }
        
    }
}



/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

// LLamando al archivo de vista de inicio de sesión
require 'views/index.view.php';
