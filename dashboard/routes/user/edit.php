<?php
// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require_once '../../../data/config.php';

// Insersion de archivo de funciones
require_once '../../../data/functions.php';

$conexion = conexion($bd_config);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = filter_var(cleanData($_POST['id_user']), FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var(cleanData($_POST['name']), FILTER_SANITIZE_STRING);
    $phone = filter_var(cleanData($_POST['phone']), FILTER_SANITIZE_STRING);
    $roll = filter_var(cleanData($_POST['roll']), FILTER_SANITIZE_STRING);
    $email = filter_var(cleanData($_POST['email']), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    $user = filter_var(cleanData(strtolower($_POST['user'])), FILTER_SANITIZE_STRING);
    $pass = filter_var(cleanData($_POST['pass']), FILTER_SANITIZE_STRING);
    $pass2 = filter_var(cleanData($_POST['pass2']), FILTER_SANITIZE_STRING);
    $pass = hash('sha512', $pass);
    $pass = hash('sha256', $pass);
    $pass2 = hash('sha512', $pass2);
    $pass2 = hash('sha256', $pass2);

    if (empty($name) || empty($phone) || empty($roll) || empty($email) || empty($user)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/user.php');
    } else {
        if (empty($pass) || empty($pass2)) {
            $statement = $conexion->prepare(
                'UPDATE user SET name = :name, phone = :phone, roll = :roll, user = :user, email = :email
                WHERE id_user = :id_user');

            $statement->execute(array(
                ':id_user' => $id_user,
                ':name' => $name,
                ':phone' => $phone,
                ':roll' => $roll,
                ':user' => $user,
                ':email' => $email,
            ));

            $_SESSION['edit'] = '1';
            header('Location:' . RUTA . 'dashboard/user.php');
        } else {
            if($pass == $pass2){
                $statement = $conexion->prepare(
                    'UPDATE user SET name = :name, phone = :phone, roll = :roll, user = :user, email = :email, pass = :pass
                WHERE id_user = :id_user'
                );

                $statement->execute(array(
                    ':id_user' => $id_user,
                    ':name' => $name,
                    ':phone' => $phone,
                    ':roll' => $roll,
                    ':user' => $user,
                    ':email' => $email,
                    ':pass' => $pass
                ));

                $_SESSION['edit'] = '1';
                header('Location:' . RUTA . 'dashboard/user.php');
            } else {
                $_SESSION['pass'] = '1';
                header('Location:' . RUTA . 'dashboard/user.php');
            }
        }
    }
} else {
    header('Location: ' . RUTA . 'dashboard/');
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}
