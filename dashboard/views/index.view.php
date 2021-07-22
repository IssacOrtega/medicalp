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
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newQuoteModal">+ Nueva cotización</button>
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
                                    <center><button class="btn btn-primary" data-toggle="modal" data-target="#editQuoteModal" data-id_quote="3216" data-title="Cotización Servidor" data-id_client="1" data-client="Karina Emiliano Arellano" data-date="2021-07-21" data-date_expired="2021-07-25"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                </td>
                                <td class="align-middle">
                                    <center><button class="btn btn-danger"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal nueva cotización -->
    <div class="modal fade" id="newQuoteModal" tabindex="-1" role="dialog" aria-labelledby="newQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newQuoteModalLabel">Nueva cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="id_quote" class="col-form-label">ID de cotización:</label>
                            <input type="number" class="form-control" id="id_quote" name="id_quote" required>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-form-label">Título de cotización:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="client" class="col-form-label">Seleccionar un cliente:</label>
                            <select class="form-control" id="client" name="client" required>
                                <option selected></option>
                                <option value="1">Karina Emiliano Arellano</option>
                                <option value="2">Jorge Uribe Cabrera</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-form-label">Fecha de emisión:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="date_expired" class="col-form-label">Fecha de expiración:</label>
                            <input type="date" class="form-control" id="date_expired" name="date_expired" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal editar cotización -->
    <div class="modal fade" id="editQuoteModal" tabindex="-1" role="dialog" aria-labelledby="editQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQuoteModalLabel">Editar cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="id_quote" class="col-form-label">ID de cotización:</label>
                            <input type="number" class="form-control" id="id_quote" name="id_quote" required>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-form-label">Título de cotización:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="client" class="col-form-label">Seleccionar un cliente:</label>
                            <select class="form-control" id="client" name="client" required>
                                <option value="1">Jorge Uribe Cabrera</option>
                                <option value="2">Karina Emiliano Arellano</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-form-label">Fecha de emisión:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="date_expired" class="col-form-label">Fecha de expiración:</label>
                            <input type="date" class="form-control" id="date_expired" name="date_expired" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo RUTA . 'resource/assets/js/jquery-3.6.0.min.js'; ?>"></script>
    <script src="<?php echo RUTA . 'resource/assets/js/bootstrap.bundle.min.js'; ?>"></script>
    <script src="<?php echo RUTA . 'resource/assets/js/dashboard.js'; ?>"></script>
</body>

</html>