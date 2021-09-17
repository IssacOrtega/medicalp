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

// Mensaje de formato de imagen
if (isset($_SESSION['image'])) {
    unset($_SESSION['image']);
    $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Erro!</strong> La imagen no cumple con los requisitos.
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

if (!isset($_GET['search'])) {
    // Trae todas las cotizaciones
    $products = all_products($conexion, null);
} else {
    $search = filter_var(cleanData($_GET['search']), FILTER_SANITIZE_STRING);
    // Trae todas las cotizaciones
    $products = all_products($conexion, $search);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {
    $product = filter_var(cleanData($_POST['product']), FILTER_SANITIZE_STRING);
    $brand = filter_var(cleanData($_POST['brand']), FILTER_SANITIZE_STRING);
    $iva = filter_var(cleanData($_POST['iva']), FILTER_SANITIZE_STRING);
    $price = filter_var(cleanData($_POST['price']), FILTER_SANITIZE_STRING);
    (!empty($_POST['description'])) ? $description = filter_var(cleanData($_POST['description']), FILTER_SANITIZE_STRING) : $description = NULL;
    $image = @getimagesize($_FILES['image']['tmp_name']);
    $carpeta_destino = '../resource/assets/products/';
    $image_name = uniqid(mt_rand(), true) . '_' . $_FILES['image']['name'];
    $archivo_subido = $carpeta_destino . $image_name;
    move_uploaded_file($_FILES['image']['tmp_name'], $archivo_subido);
    $final_name = 'resource/assets/products/' . $image_name;

    if(empty($product) || empty($brand) || empty($iva) || empty($price)){
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/product.php');
    } else {
        if($image !== false){
            
            $statement = $conexion->prepare(
                'INSERT INTO product (id_product, product, brand, iva, unit_price, description, image) 
            VALUES (NULL, :product, :brand, :iva, :unit_price, :description, :image)'
            );

            $statement->execute(array(
                ':product' => $product,
                ':brand' => $brand,
                ':iva' => $iva,
                ':unit_price' => $price,
                ':description' => $description,
                ':image' => $final_name,
            ));

            $_SESSION['add'] = '1';
            header('Location:' . RUTA . 'dashboard/product.php');
        } else {
            unlink($archivo_subido);
            $_SESSION['image'] = '1';
            header('Location:' . RUTA . 'dashboard/product.php');
        }
    }

}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

// LLamando al archivo de vista de inicio de sesión
require 'views/product.view.php';
