<?php

date_default_timezone_set('Mexico/General');
setlocale(LC_ALL, "es_MX");

// Borrar reportes de error para produccion
error_reporting(0);

// Variable definida para utilizar en los enlaces o en la reedirección
define('RUTA', "https://{$_SERVER['SERVER_NAME']}/");

define('MENU', "/dashboard/");

//  Arreglo de configuracion de la Base de datos
$bd_config = array(
    // Nombre de dominio o host
    'host' => 'localhost:3306',
    // nombre de la base de datos
    'db' => '_quotes_medicalp',
    // Usurio de base de datos
    'user' => 'iortega',
    // Contraseña de base de datos
    'pass' => 'Issac1997*'
);
