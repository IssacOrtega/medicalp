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

// Funcion para traer todas las cotizaciones de administrador
function quotations($conexion)
{
    $statement = $conexion->query('SELECT a.id_quote, a.id_quote_client, a.title, a.date, a.validity, b.id_client, b.name_client, c.name 
    FROM quotation a inner JOIN client b ON a.id_client = b.id_client inner JOIN user c ON a.id_user = c.id_user ORDER BY id_quote DESC');
    $resultado = $statement->fetchAll();
    return ($resultado) ? $resultado : false;
}

// Funcion para traer todas las cotizaciones de administrador
function quotations_user($conexion, $id_user)
{
    $statement = $conexion->query("SELECT a.id_quote, a.id_quote_client, a.title, a.date, a.validity, b.id_client, b.name_client, c.name 
    FROM quotation a inner JOIN client b ON a.id_client = b.id_client inner JOIN user c ON a.id_user = c.id_user WHERE a.id_user = $id_user ORDER BY id_quote DESC");
    $resultado = $statement->fetchAll();
    return ($resultado) ? $resultado : false;
}

// Funcion para traer todas las cotizaciones de administrador
function quote_product_exist($conexion, $id_quote)
{
    $statement = $conexion->query("SELECT * FROM quote_product WHERE id_quote = $id_quote");
    $resultado = $statement->fetchAll();
    return ($resultado) ? $resultado : false;
}

// Funcion para traer todos los clientes
function all_clients($conexion)
{
    $statement = $conexion->query("SELECT * FROM client");
    $resultado = $statement->fetchAll();
    return ($resultado) ? $resultado : false;
}

// Funcion para traer todas las cotizaciones de administrador
function id_quote_client_exist($conexion, $id_quote_client)
{
    $statement = $conexion->query("SELECT id_quote_client FROM quotation WHERE id_quote_client = $id_quote_client");
    $resultado = $statement->fetchAll();
    return ($resultado) ? $resultado : false;
}