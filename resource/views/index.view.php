<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo RUTA . 'resource/assets/css/bootstrap.min.css'; ?>" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo RUTA . 'resource/assets/css/signin.css'; ?>" rel="stylesheet">
</head>

<body class="text-center">

    <form class="form-signin">
        <img class="mb-4" src="<?php echo RUTA . 'resource/assets/brand/Logo.png' ?>" alt="Medical Planet" width="150" height="150">
        <h1 class="h3 mb-3 font-weight-normal">Cotiza Medical Planet</h1>
        <label for="inputUser" class="sr-only">Usuario</label>
        <input type="text" id="inputUser" name="user" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Recuerdame
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
        <p class="mt-5 mb-3 text-muted">Copyright &copy; Medical Planet 2021</p>
    </form>



</body>

</html>