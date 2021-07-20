<?php

// Funcion de conexion a la base de datos
function conexion($bd_config)
{
    try {
        $conexion = new PDO("mysql:host=" . $bd_config["host"] . ";dbname=" . $bd_config["basededatos"], $bd_config["usuario"], $bd_config["pass"]);
        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

function limpiarDatos($datos)
{
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = strip_tags($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}