<?php

// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require '../data/config.php';

// Llamando al archivo de funciones
require '../data/functions.php';

// Llamando a la lase de Mpdf para el fromato
require '../vendor/autoload.php';

use Mpdf\Mpdf;

// Insertando la conexion de la base de datos
$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_quote = filter_var(cleanData(base64_decode($_GET['id_quote'])), FILTER_SANITIZE_STRING);
    $title = filter_var(cleanData(base64_decode($_GET['title'])), FILTER_SANITIZE_STRING);

    if ($id_quote != '') {
        $quote_products = quote_product_all($conexion, $id_quote);
        $subtotal_price = subtotal_price($conexion, $id_quote);

        $css = file_get_contents(RUTA . 'resource/assets/css/style.css');
        $mpdf = new Mpdf([]);
        $mpdf->SetTitle('Cotización');
        $template = report($quote_products, $subtotal_price);
        $mpdf->writeHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($template, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->output('cotizacion_' . uniqid() . '.pdf', 'I');

    } else {
        header('Location: ' . MENU);
    }
}


/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}