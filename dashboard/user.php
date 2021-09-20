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
                <strong>¡Éxito!</strong> El usuario se ha eliminado correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de error para email
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
    $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> El email que se esta intentando registrar ya esta en uso, ingresar uno diferencte por favor.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de error para usuario
if (isset($_SESSION['user_error'])) {
    unset($_SESSION['user_error']);
    $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> El usuario que se esta intentando registrar ya esta en uso, ingresar uno diferencte por favor.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

// Mensaje de error para contraseña
if (isset($_SESSION['pass'])) {
    unset($_SESSION['pass']);
    $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> Las contraseñas no coinciden, intentar de nuevo por favor.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}


// Trae todo el catalogo de clientes
if (!isset($_GET['search'])) {
    // Trae todas las cotizaciones
    $users = all_users($conexion, null);
} else {
    $search = filter_var(cleanData($_GET['search']), FILTER_SANITIZE_STRING);
    // Trae todas las cotizaciones
    $users = all_users($conexion, $search);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    if (empty($name) || empty($phone) || empty($roll)|| empty($email) || empty($user) || empty($pass) || empty($pass2)) {
        $_SESSION['empty'] = '1';
        header('Location:' . RUTA . 'dashboard/user.php');
    } else {
        if(validate_users($conexion, null, $email) == false){
            if(validate_users($conexion, $user, null) == false){
                if($pass == $pass2){
                    $statement = $conexion->prepare(
                        'INSERT INTO user (id_user, name, phone, roll, user, email, pass) 
                        VALUES (NULL, :name, :phone, :roll, :user, :email, :pass)'
                    );
    
                    $statement->execute(array(
                        ':name' => $name,
                        ':phone' => $phone,
                        ':roll' => $roll,
                        ':user' => $user,
                        ':email' => $email,
                        ':pass' => $pass
                    ));
    
                    $_SESSION['add'] = '1';
                    header('Location:' . RUTA . 'dashboard/user.php');
                } else {
                    $_SESSION['pass'] = '1';
                    header('Location:' . RUTA . 'dashboard/user.php');
                }
            } else {
                $_SESSION['user_error'] = '1';
                header('Location:' . RUTA . 'dashboard/user.php');
            }
        } else {
            $_SESSION['email'] = '1';
            header('Location:' . RUTA . 'dashboard/user.php');
        }
    }
}


/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if (!isset($_SESSION['user'])) {
    header('Location: ' . RUTA);
}

if($_SESSION['roll'] == 'Usuario'){
    header('Location: ' . RUTA . 'dashboard/');
}

// LLamando al archivo de vista de inicio de sesión
require 'views/user.view.php';
