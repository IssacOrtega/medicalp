<?php

// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require '../data/config.php';

// Llamando al archivo de funciones
require '../data/functions.php';




/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

// LLamando al archivo de vista de inicio de sesión
require 'views/index.view.php';