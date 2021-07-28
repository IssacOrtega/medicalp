<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><a class="btn btn-light" href="<?php echo RUTA . 'dashboard/'; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/flech.png' ?>" alt="Regresar" width="15" height="15"></a> Agregar Productos <small>(Cotización Servidor)</small></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newProductModal">+ Nuevo producto</button>
                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#addDescriptionModal" data-id_quote="3216">+ Añadir descripción</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Cantidad</th>
                                <th>Precio unitario sin IVA</th>
                                <th>Precio unitario con IVA</th>
                                <th>Precio total sin IVA</th>
                                <th>Precio total con IVA</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle"><img src="<?php echo RUTA . 'resource/assets/products/mesa.jpg' ?>" alt="" width="60" height="60"></td>
                                <td class="align-middle">Mesa Riñon 1 Cercha Acero Inox</td>
                                <td class="align-middle">MEDPLAN</td>
                                <td class="align-middle">3</td>
                                <td class="align-middle">$4830.00MXN</td>
                                <td class="align-middle">$5602.80MXN</td>
                                <td class="align-middle">$14490.00MXN</td>
                                <td class="align-middle">$16808.40MXN</td>
                                <td class="align-middle">
                                    <center><button class="btn btn-primary" data-toggle="modal" data-target="#editProductModal" data-id_quote_product="1" data-amount="3" data-unit_price="4830.00"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Editar" width="20" height="20"></button></center>
                                </td>
                                <td class="align-middle">
                                    <center><button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal" data-id_quote_product="1"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Eliminar" width="20" height="20"></button></center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10">
                                    <strong style="font-size: medium;">Descripción:</strong><br>
                                    El concentrador de oxígeno Stratus 5 producido por 3B ™ Medical Solutions puede suministrar a un paciente con oxígeno constante en un flujo ajustable, seguro, confiable, de bajo costo.
                                    Este concentrador está cuidadosamente diseñado teniendo en cuenta el rendimiento y la fiabilidad, incluidas características únicas, como un innovador sistema de refrigeración para proteger los lechos de tamices y un monitor de pureza de oxígeno.
                                    El bajo mantenimiento, el funcionamiento ultra silencioso y la mayor presión de salida para garantizar una entrega adecuada hacen que esta unidad sea ideal para su uso en hogares, instituciones, vehículos y otros entornos móviles diversos
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal nueva producto a cotizar -->
    <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="newProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newProductModalLabel">Nuevo Producto a Cotizar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Seleccionar un producto:</label>
                            <select class="form-control" id="product" name="product" required>
                                <option selected></option>
                                <option value="1">Mesa Riñon 1 Cercha Acero Inox</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="unit_price" class="col-form-label">Precio unitario sin IVA:</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="$0.0" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal editar producto a cotizar -->
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Nuevo Producto a Cotizar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <input type="hidden" id="id_quote_product" name="id_quote_product">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Seleccionar un producto:</label>
                            <select class="form-control" id="product" name="product" required>
                                <option selected></option>
                                <option value="1">Mesa Riñon 1 Cercha Acero Inox</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="unit_price" class="col-form-label">Precio unitario sin IVA:</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="$0.0" required>
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
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">Eliminar cotización #</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro?</p>
                        <input type="hidden" id="id_quote_product" name="id_quote_product">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal añadir descripción -->
    <div class="modal fade" id="addDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="addDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDescriptionModalLabel">Añadir descripción a la cotización</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Descripcion:</label>
                            <input type="hidden" id="id_quote" name="id_quote">
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
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