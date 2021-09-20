<?php

date_default_timezone_set('Mexico/General');
setlocale(LC_ALL, "es_MX");
header('Content-Type: text/html; charset=utf-8');

// Borrar reportes de error para produccion
error_reporting(0);

// Variable definida para utilizar en los enlaces o en la reedirecci贸n
define('RUTA', "https://{$_SERVER['SERVER_NAME']}/");

define('MENU', "/dashboard/");

//  Arreglo de configuracion de la Base de datos
$bd_config = array(
    // Nombre de dominio o host
    'host' => '192.169.151.159',
    // nombre de la base de datos
    'db' => '_quotes_medicalp',
    // Usurio de base de datos
    'user' => 'iortega',
    // Contrase帽a de base de datos
    'pass' => 'Issac1997*'
);
