 <?php 

// Declarando la funcion de sesion iniciada
session_start();

// Llamando archvio de configuracion
require 'data/config.php';

// Llamando al archivo de funciones
require 'data/functions.php';

// Variable de mensajes
$msg = '';

// Insertando conexion a la base de datos
$conexion = conexion($bd_config);

// Verificando la conexion a la base de datos
if($conexion){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = filter_var(strtolower(cleanData($_POST['user'])), FILTER_SANITIZE_STRING);
        $pass = filter_var(cleanData($_POST['pass']), FILTER_SANITIZE_STRING);
        $pass = hash('sha512', $pass);
        $pass = hash('sha256', $pass);

        if(logIn($conexion, $user, $pass)){
            $roll = roll($conexion, $user);
            $id_user = logIn($conexion, $user, $pass);
            $_SESSION['id_user'] = $id_user['id_user'];
            $_SESSION['user'] = $user;
            $_SESSION['roll'] = $roll['roll'];
            header('Location: ' . RUTA . 'dashboard/index.php');
        } else {

            $msg .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Error!</strong> El usuario o la contraseña son incorrectos.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }
} else {
}

/* Condicional para verficar si las variable de sesión de usuario esta seteada 
nos redireccione a la pagina de inicio de la aplicación */
if(isset($_SESSION['user'])){
    header('Location: ' . RUTA . 'dashboard/index.php');
}

// LLamando al archivo de vista de inicio de sesión
require 'resource/views/index.view.php';