<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_client = filter_var(cleanData($_POST['id_client']), FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
    $name = filter_var(cleanData($_POST['name']), FILTER_SANITIZE_STRING);
    $phone = filter_var(cleanData($_POST['phone']), FILTER_SANITIZE_STRING);
    $business = filter_var(cleanData($_POST['business']), FILTER_SANITIZE_STRING);
    (!empty($_POST['email'])) ? $email = filter_var(cleanData($_POST['email']), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL) : $email = NULL;
    $state = filter_var(cleanData($_POST['state']), FILTER_SANITIZE_STRING);
    (!empty($_POST['municipality'])) ? $municipality = filter_var(cleanData($_POST['municipality']), FILTER_SANITIZE_STRING) : $municipality = NULL;
    (!empty($_POST['address'])) ? $address = filter_var(cleanData($_POST['address']), FILTER_SANITIZE_STRING) : $address = NULL;

    if (empty($id_client) || empty($name) || empty($phone) || empty($business) || empty($state)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/client.php');
    } else {
        $statement = $conexion->prepare('UPDATE client 
        SET name_client = :name, phone_client = :phone, business = :business, email_client = :email, state = :state, municipality = :municipality, address = :address
        WHERE id_client = :id_client');

        $statement->execute(array(
            ':id_client' => $id_client,
            ':name' => $name,
            ':phone' => $phone,
            ':business' => $business,
            ':email' => $email,
            ':state' => $state,
            ':municipality' => $municipality,
            ':address' => $address,
        ));

        $_SESSION['edit'] = '1';
        header('Location:' . RUTA . 'dashboard/client.php');
    }
} else {
    header('Location: ' . RUTA . 'dashboard/');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
