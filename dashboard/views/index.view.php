<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Cotizaciones</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-success">+ Nueva cotización</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Cliente</th>
                                <th>Emisor</th>
                                <th>Fecha</th>
                                <th>Imprimir</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">3216</td>
                                <td class="align-middle"><a class="btn btn-link" href="#">Cotización Servidor</a></td>
                                <td class="align-middle">Karina Emiliano Arellano</td>
                                <td class="align-middle">Gerardo Issac Ortega Cervantes</td>
                                <td class="align-middle">21/07/2021</td>
                                <td class="align-middle">
                                    <center><a class="btn btn-info"><img src="<?php echo RUTA . 'resource/assets/icons/printing.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                                <td class="align-middle">
                                    <center><a class="btn btn-primary"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                                <td class="align-middle">
                                    <center><a class="btn btn-danger"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">5847</td>
                                <td class="align-middle"><a class="btn btn-link" href="#">Cotixación cama electrica</a></td>
                                <td class="align-middle">Jorge Uribe Cabrera</td>
                                <td class="align-middle">Roberto Carranco Plancarte</td>
                                <td class="align-middle">21/07/2021</td>
                                <td class="align-middle">
                                    <center><a class="btn btn-info"><img src="<?php echo RUTA . 'resource/assets/icons/printing.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                                <td class="align-middle">
                                    <center><a class="btn btn-primary"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                                <td class="align-middle">
                                    <center><a class="btn btn-danger"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="<?php echo RUTA . 'resource/assets/js/jquery-3.6.0.min.js'; ?>"></script>
    <script src="<?php echo RUTA . 'resource/assets/js/bootstrap.bundle.min.js'; ?>"></script>
</body>

</html>