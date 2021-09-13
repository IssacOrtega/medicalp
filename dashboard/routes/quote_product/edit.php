<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_quote_product = filter_var(cleanData($_POST['id_quote_product']),  FILTER_SANITIZE_NUMBER_INT);
    $amount = filter_var(cleanData($_POST['amount']), FILTER_SANITIZE_NUMBER_INT);
    (!empty($_POST['note'])) ? $note = filter_var(cleanData($_POST['note']), FILTER_SANITIZE_STRING) : $note = NULL;
    $id_product = filter_var(cleanData($_POST['product']),  FILTER_SANITIZE_STRING);
    $id_quote = filter_var(cleanData($_POST['id_quote']),  FILTER_SANITIZE_STRING);
    $title = filter_var(cleanData($_POST['title']),  FILTER_SANITIZE_STRING);

    if (empty($id_quote_product) || empty($amount) || empty($id_product) || empty($id_quote) || empty($title)) {
        $_SESSION['empty'] = '1';
        header('Location:' . MENU . 'quote.product.php?id_quote=' . base64_encode($id_quote) . '&title=' . base64_encode($title));
    } else {
        $statement = $conexion->prepare('UPDATE quote_product 
        SET amount = :amount, note = :note, id_product = :id_product
        WHERE id_quote_product = :id_quote_product');

        $statement->execute(array(
            ':id_quote_product' => $id_quote_product,
            ':amount' => $amount,
            ':note' => $note,
            ':id_product' => $id_product,
        ));

        $_SESSION['edit'] = '1';
        header('Location:' . MENU . 'quote.product.php?id_quote=' . base64_encode($id_quote) . '&title=' . base64_encode($title));
    }
} else {
    header('Location: ' . RUTA . 'dashboard');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
