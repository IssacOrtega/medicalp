<?php

// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require '../data/config.php';

// Llamando al archivo de funciones
require '../data/functions.php';

// Insertando la conexion de la base de datos
$conexion = conexion($bd_config);

$msg = '';

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
                <strong>¡Éxito!</strong> El producto se ha eliminado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Trae todo el catalogo de clientes
if (!isset($_GET['search'])) {
    // Trae todas las cotizaciones
    $clients = all_clients($conexion, null);
} else {
    $search = filter_var(cleanData($_GET['search']), FILTER_SANITIZE_STRING);
    // Trae todas las cotizaciones
    $clients = all_clients($conexion, $search);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = filter_var(cleanData($_POST['name']), FILTER_SANITIZE_STRING);
    $phone = filter_var(cleanData($_POST['phone']), FILTER_SANITIZE_STRING);
    $business = filter_var(cleanData($_POST['business']), FILTER_SANITIZE_STRING);
    (!empty($_POST['email'])) ? $email = filter_var(cleanData($_POST['email']), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL) : $email = NULL;
    $state = filter_var(cleanData($_POST['state']), FILTER_SANITIZE_STRING);
    (!empty($_POST['municipality'])) ? $municipality = filter_var(cleanData($_POST['municipality']), FILTER_SANITIZE_STRING) : $municipality = NULL;
    (!empty($_POST['address'])) ? $address = filter_var(cleanData($_POST['address']), FILTER_SANITIZE_STRING) : $address = NULL;

    if(empty($name) || empty($phone) || empty($business) || empty($state)){
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/client.php');
    } else {
        $statement = $conexion->prepare(
            'INSERT INTO client (id_client, name_client, phone_client, business, email_client, state, municipality, address) 
                    VALUES (NULL, :name, :phone, :business, :email, :state, :municipality, :address)'
        );

        $statement->execute(array(
            ':name' => $name,
            ':phone' => $phone,
            ':business' => $business,
            ':email' => $email,
            ':state' => $state,
            ':municipality' => $municipality,
            ':address' => $address,
        ));

        $_SESSION['add'] = '1';
        header('Location:' . RUTA . 'dashboard/client.php');
    }
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

// LLamando al archivo de vista de inicio de sesión
require 'views/client.view.php';
