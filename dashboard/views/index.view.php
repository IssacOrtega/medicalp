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
                        <!-- <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Para desbloquear agregar clientes y productos">
                            <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Disabled button</button>
                        </span> -->
                    </div>
                </div>
                <?php if (!empty($msg)) {
                    echo $msg;
                } ?>
                <div class="table-responsive">
                    <?php if ($quotations) : ?>
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
                                <?php foreach ($quotations as $quote) :
                                    $quote_product_exist = quote_product_exist($conexion, $quote['id_quote']) ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $quote['id_quote_client'] ?></td>
                                        <td class="align-middle"><a class="btn btn-link" href="<?php echo RUTA . 'dashboard/quote.product.php?id_quote=' .  base64_encode($quote['id_quote']) . '&title=' . base64_encode($quote['title']); ?>"><?php echo $quote['title'] ?></a></td>
                                        <td class="align-middle"><?php echo $quote['name_client'] ?></td>
                                        <td class="align-middle"><?php echo $quote['name'] ?></td>
                                        <td class="align-middle"><?php echo date('d/m/Y', strtotime($quote['date'])); ?></td>
                                        <?php if ($quote_product_exist) : ?>
                                            <td class="align-middle">
                                                <center><a class="btn btn-info" target="_blank" href="<?php echo RUTA . 'dashboard/formato.php?id_quote=' .  base64_encode($quote['id_quote']) . '&title=' . base64_encode($quote['title']); ?>"><img src="<?php echo RUTA . 'resource/assets/icons/printing.png' ?>" alt="Imprimir" width="20" height="20"></a></center>
                                            </td>
                                        <?php else : ?>
                                            <td class="align-middle">
                                                <center><a class="btn btn-secondary disabled"><img src="<?php echo RUTA . 'resource/assets/icons/printing.png' ?>" alt="Imprimir" width="20" height="20" disabled></a></center>
                                            </td>
                                        <?php endif; ?>
                                        <td class="align-middle">
                                            <center><button class="btn btn-primary" data-toggle="modal" data-target="#editQuoteModal" data-id_quote="<?php echo $quote['id_quote']; ?>" data-id_quote_client="<?php echo $quote['id_quote_client']; ?>" data-title="<?php echo $quote['title']; ?>" data-client="<?php echo $quote['id_client']; ?>" data-date="<?php echo $quote['date']; ?>" data-date_expired="<?php echo $quote['validity']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                        </td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-danger" data-toggle="modal" data-target="#deleteQuoteModal" data-id_quote="<?php echo $quote['id_quote']; ?>" data-id_quote_client="<?php echo $quote['id_quote_client']; ?>" data-title="<?php echo $quote['title']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- ---------------------------------------------------------------------------------------------- -->
                    <?php else : ?>
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
                                    <th colspan="8">
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Título de cotización:</label>
                            <input type="text" class="form-control" id="title" name="title" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="client" class="col-form-label">Seleccionar un cliente:</label>
                            <select class="form-control" id="client" name="client" required>
                                <option selected></option>
                                <?php foreach ($clients as $client) : ?>
                                    <option value="<?php echo $client['id_client'] ?>"><?php echo $client['name_client'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
                    <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/quotation/edit.php'); ?>" method="POST">
                        <input type="hidden" id="id_quote" name="id_quote">
                        <input type="hidden" id="id_quote_client" name="id_quote_client">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Título de cotización:</label>
                            <input type="text" class="form-control" id="title" name="title" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="client" class="col-form-label">Seleccionar un cliente:</label>
                            <select class="form-control" id="client" name="client" required>
                                <option selected></option>
                                <?php foreach ($clients as $client) : ?>
                                    <option value="<?php echo $client['id_client'] ?>"><?php echo $client['name_client'] ?></option>
                                <?php endforeach; ?>
                            </select>
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

    <!-- Modal eliminar cotización -->
    <div class="modal fade" id="deleteQuoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteQuoteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">Eliminar cotización #</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/quotation/delete.php'); ?>" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro?</p>
                        <input type="hidden" id="id_quote" name="id_quote">
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