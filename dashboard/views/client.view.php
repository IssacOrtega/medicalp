<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Clientes</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newClientModal">+ Nuevo cliente</button>
                    </div>
                </div>
                <?php if (!empty($msg)) {
                    echo $msg;
                } ?>
                <div class="table-responsive">
                    <?php if ($clients) : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Lada/Teléfono</th>
                                    <th>Email</th>
                                    <th>Institución</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $client) : ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $client['name_client']; ?></td>
                                        <td class="align-middle"><a href="tel:<?php echo $client['phone_client']; ?>"><?php echo $client['phone_client']; ?></a></td>
                                        <td class="align-middle"><?php echo ($client['email_client'] == null) ? 'Sin registro' : '<a href="mailto:' . $client['email_client'] . '">' . $client['email_client'] . '</a>'; ?></td>
                                        <td class="align-middle"><?php echo $client['business']; ?></td>
                                        <td class="align-middle"><button class="btn btn-link" data-toggle="modal" data-target="#addressModal" data-name="<?php echo $client['name_client']; ?>" data-state="<?php echo $client['state']; ?>" data-municipality="<?php echo ($client['municipality'] == null) ? 'Sin registro.' : $client['municipality']; ?>" data-address="<?php echo ($client['address'] == null) ? 'Sin registro.' : $client['address']; ?>">Ver</button></td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-primary" data-toggle="modal" data-target="#editClientModal" data-id_client="<?php echo $client['id_client']; ?>" data-name="<?php echo $client['name_client']; ?>" data-phone="<?php echo $client['phone_client']; ?>" data-business="<?php echo $client['business']; ?>" data-email="<?php echo ($client['email_client'] == null) ? '' : $client['email_client']; ?>" data-state="<?php echo $client['state']; ?>" data-municipality="<?php echo ($client['municipality'] == null) ? '' : $client['municipality']; ?>" data-address="<?php echo ($client['address'] == null) ? '' : $client['address']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                        </td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-danger" data-toggle="modal" data-target="#deleteClientModal" data-id_client="<?php echo $client['id_client']; ?>" data-name="<?php echo $client['name_client']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Lada/Teléfono</th>
                                    <th>Email</th>
                                    <th>Institución</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="7">
                                        <center>
                                            <strong style="font-size: 25px;">No hay datos.</strong>
                                        </center>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal nuevo cliente -->
    <div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newClientModalLabel">Registrar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre completo:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Número Teléfonico:</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="business" class="col-form-label">Nombre de la institución:</label>
                            <input type="text" class="form-control" id="business" name="business" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="(Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="state" class="col-form-label">País/Estado/Zona:</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="municipality" class="col-form-label">Municipio/C.P.:</label>
                            <input type="text" class="form-control" id="municipality" name="municipality" placeholder="(Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Dirección:</label>
                            <textarea class="form-control" id="address" name="address" placeholder="(Opcional)"></textarea>
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

    <!-- Modal ver dirección-->
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalTitle">Dirección de cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="font-weight-bold">País/Estado/Zona:</h6>
                    <p id="state"></p>
                    <h6 class="font-weight-bold">Municipio/C.P.:</h6>
                    <p id="municipality"></p>
                    <h6 class="font-weight-bold">Dirección:</h6>
                    <p id="address"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar cliente -->
    <div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/client/edit.php'); ?>" method="POST">
                        <input type="hidden" id="id_client" name="id_client">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre completo:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Número Teléfonico:</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="business" class="col-form-label">Nombre de la institución:</label>
                            <input type="text" class="form-control" id="business" name="business" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="(Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="state" class="col-form-label">País/Estado/Zona:</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="municipality" class="col-form-label">Municipio/C.P.:</label>
                            <input type="text" class="form-control" id="municipality" name="municipality" placeholder="(Opcional)">
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Dirección:</label>
                            <textarea class="form-control" id="address" name="address" placeholder="(Opcional)"></textarea>
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

    <!-- Modal eliminar cliente -->
    <div class="modal fade" id="deleteClientModal" tabindex="-1" role="dialog" aria-labelledby="deleteClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteClientModalLabel">Eliminar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/client/delete.php'); ?>" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro de?</p>
                        <input type="hidden" id="id_client" name="id_client">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
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