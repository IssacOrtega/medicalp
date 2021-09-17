<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_product = filter_var(cleanData($_POST['id_product']), FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $product = filter_var(cleanData($_POST['product']), FILTER_SANITIZE_STRING);
    $brand = filter_var(cleanData($_POST['brand']), FILTER_SANITIZE_STRING);
    $iva = filter_var(cleanData($_POST['iva']), FILTER_SANITIZE_STRING);
    $price = filter_var(cleanData($_POST['price']), FILTER_SANITIZE_STRING);
    (!empty($_POST['description'])) ? $description = filter_var(cleanData($_POST['description']), FILTER_SANITIZE_STRING) : $description = NULL;
    $image_save = filter_var(cleanData($_POST['image_save']), FILTER_SANITIZE_STRING);
    $image = @getimagesize($_FILES['image']['tmp_name']);

    if ($image == false) {
        $final_name = $image_save;
    } else {
        if ($image !== false) {
            unlink('../../../' . $image_save);
            $carpeta_destino = '../../../resource/assets/products/';
            $image_name = uniqid(mt_rand(), true) . '_' . $_FILES['image']['name'];
            $archivo_subido = $carpeta_destino . $image_name;
            move_uploaded_file($_FILES['image']['tmp_name'], $archivo_subido);
            $final_name = 'resource/assets/products/' . $image_name;
        } else {
            $_SESSION['image'] = '1';
            header('Location:' . RUTA . 'dashboard/product.php');
        }
    }


    if (empty($id_product) || empty($product) || empty($brand) || empty($iva) || empty($price)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/product.php');
    } else {

        $statement = $conexion->prepare(
            'UPDATE product 
            SET product = :product, brand = :brand, iva = :iva, unit_price = :unit_price, description = :description, image = :image
            WHERE id_product = :id_product'
        );

        $statement->execute(array(
            ':id_product' => $id_product,
            ':product' => $product,
            ':brand' => $brand,
            ':iva' => $iva,
            ':unit_price' => $price,
            ':description' => $description,
            ':image' => $final_name,
        ));

        $_SESSION['edit'] = '1';
        header('Location:' . RUTA . 'dashboard/product.php');
    }
} else {
    header('Location: ' . RUTA . 'dashboard');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
