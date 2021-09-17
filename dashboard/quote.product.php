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
                <strong>¡Éxito!</strong> El producto a cotizar se ha eliminado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_quote = filter_var(cleanData(base64_decode($_GET['id_quote'])), FILTER_SANITIZE_STRING);
    $title = filter_var(cleanData(base64_decode($_GET['title'])), FILTER_SANITIZE_STRING);

    if ($id_quote != '') {
        $quote_products = quote_product_all($conexion, $id_quote);
        $subtotal_price = subtotal_price($conexion, $id_quote);
        $products = all_products($conexion, null);
    } else {
        header('Location: ' . MENU);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = filter_var(cleanData($_POST['amount']), FILTER_SANITIZE_NUMBER_INT);
    (!empty($_POST['note'])) ? $note = filter_var(cleanData($_POST['note']), FILTER_SANITIZE_STRING) : $note = NULL;
    $id_product = filter_var(cleanData($_POST['product']),  FILTER_SANITIZE_STRING);
    $id_quote = filter_var(cleanData($_POST['id_quote']),  FILTER_SANITIZE_STRING);
    $title = filter_var(cleanData($_POST['title']),  FILTER_SANITIZE_STRING);

    if (empty($amount) || empty($id_product) || empty($id_quote)) {
        $_SESSION['empty'] = '1';
        header('Location:' . MENU . 'quote.product.php?id_quote=' . base64_encode($id_quote) . '&title=' . base64_encode($title));
    } else {
        $statement = $conexion->prepare(
            'INSERT INTO quote_product (id_quote_product, amount, note, id_product, id_quote) 
                VALUES (NULL, :amount, :note, :id_product, :id_quote)'
        );

        $statement->execute(array(
            ':amount' => $amount,
            ':note' => $note,
            ':id_product' => $id_product,
            ':id_quote' => $id_quote,
        ));

        $_SESSION['add'] = '1';
        header('Location:' . MENU . 'quote.product.php?id_quote=' . base64_encode($id_quote) . '&title=' . base64_encode($title));
    }
}


/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

// LLamando al archivo de vista de inicio de sesión
require 'views/quote.product.view.php';
