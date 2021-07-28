<?php

// Funcion de conexion a la base de datos
function conexion($bd_config)
{
    try {
        $conexion = new PDO("mysql:host=" . $bd_config["host"] . ";dbname=" . $bd_config["db"], $bd_config["user"], $bd_config["pass"]);
        return $conexion;
    } catch (PDOException $e) {
        return false;
    }
}

// Funcion para limpiar datos
function cleanData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Funcion para validar el inicio de sesion
function logIn($conexion, $user, $password)
{
    $statement = $conexion->prepare("SELECT * FROM user WHERE user = :user AND pass = :pass LIMIT 1");
    $statement->execute(array(":user" => $user, ":pass" => $password));
    $result = $statement->fetch();
    return ($result) ? $result : false;
}