<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><a class="btn btn-light" href="<?php echo RUTA . 'dashboard/'; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/flech.png' ?>" alt="Regresar" width="15" height="15"></a> Agregar Productos <small>(Cotización <?php echo $title; ?>)</small></h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newProductModal">+ Nuevo producto</button>
                    </div>
                </div>
                <?php if (!empty($msg)) {
                    echo $msg;
                } ?>
                <div class="table-responsive">
                    <?php if ($quote_products) : ?>
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
                                <?php foreach ($quote_products as $quote_product) : ?>
                                    <tr>
                                        <td class="align-middle"><img src="<?php echo RUTA . $quote_product['image']; ?>" alt="" width="60" height="60"></td>
                                        <td class="align-middle"><?php echo $quote_product['product']; ?></td>
                                        <td class="align-middle"><?php echo $quote_product['brand']; ?></td>
                                        <td class="align-middle"><?php echo $quote_product['amount']; ?></td>
                                        <td class="align-middle">$ <?php echo number_format($quote_product['unit_price'], 2); ?> MXN</td>
                                        <td class="align-middle">$ <?php echo number_format(($quote_product['unit_price'] * $quote_product['iva'] + $quote_product['unit_price']), 2); ?> MXN</td>
                                        <td class="align-middle">$ <?php echo number_format(($quote_product['unit_price'] * $quote_product['amount']), 2); ?> MXN</td>
                                        <td class="align-middle">$ <?php $cant = ($quote_product['unit_price'] * $quote_product['amount']);
                                                                    echo number_format(($cant * $quote_product['iva'] + $cant), 2); ?> MXN</td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-primary" data-toggle="modal" data-target="#editProductModal" data-id_quote_product="<?php echo $quote_product['id_quote_product']; ?>" data-amount="<?php echo $quote_product['amount']; ?>" data-note="<?php echo $quote_product['note']; ?>" data-id_product="<?php echo $quote_product['id_product']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Editar" width="20" height="20"></button></center>
                                        </td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal" data-id_quote_product="<?php echo $quote_product['id_quote_product']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Eliminar" width="20" height="20"></button></center>
                                        </td>
                                    </tr>
                                    <?php if ($quote_product['description'] != null) : ?>
                                        <tr>
                                            <td colspan="10">
                                                <strong style="font-size: medium;">Descripción:</strong><br>
                                                <?php echo nl2br($quote_product['description']); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if ($quote_product['note'] != null) : ?>
                                        <tr>
                                            <td class="text-danger" colspan="10">
                                                <strong style="font-size: medium;">Notas:</strong><br>
                                                <?php echo nl2br($quote_product['note']); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="10" class="bg-white border-0">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-white border-0">
                                    </td>
                                    <td colspan="2" class="align-middle">
                                        <strong style="font-size: medium;">Subtotal:</strong><br>
                                    </td>
                                    <td colspan="2" class="align-middle text-right">
                                        <strong style="font-size: medium;">$ <?php echo number_format($subtotal_price['total_price'], 2); ?> MXN</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-white border-0">
                                    </td>
                                    <td colspan="2" class="align-middle">
                                        <strong style="font-size: medium;">IVA:</strong><br>
                                    </td>
                                    <td colspan="2" class="align-middle text-right">
                                        <strong style="font-size: medium;">$ <?php echo number_format(($subtotal_price['total_price'] * $subtotal_price['iva']), 2); ?> MXN</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="bg-white border-0">
                                    </td>
                                    <td colspan="2" class="align-middle">
                                        <strong style="font-size: medium;">Total:</strong><br>
                                    </td>
                                    <td colspan="2" class="align-middle text-right">
                                        <strong style="font-size: medium;">$ <?php echo number_format(($subtotal_price['total_price'] * $subtotal_price['iva']) + $subtotal_price['total_price'], 2); ?> MXN</strong><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="bg-white border-0">
                                    </td>
                                    <td colspan="3" class="align-middle">
                                        <a class="btn btn-success col-12 mb-1 mt-1" target="_blank" href="<?php echo MENU . 'formato.php?id_quote=' .  base64_encode($id_quote) . '&title=' . base64_encode($title); ?>">Imprimir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else : ?>
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
                                    <th colspan="10">
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Seleccionar un producto:</label>
                            <select class="form-control" id="product" name="product" required>
                                <option selected></option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?php echo $product['id_product']; ?>"><?php echo $product['product']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="note" class="col-form-label">Nota:</label>
                            <textarea class="form-control" id="note" name="note" placeholder="Opcional"></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="id_quote" name="id_quote" value="<?php echo $id_quote; ?>" required>
                        <input type="hidden" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
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
                    <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/quote_product/edit.php'); ?>" method="POST">
                        <input type="hidden" class="form-control" id="id_quote_product" name="id_quote_product" required>
                        <div class="form-group">
                            <label for="product" class="col-form-label">Seleccionar un producto:</label>
                            <select class="form-control" id="product" name="product" required>
                                <option selected></option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?php echo $product['id_product']; ?>"><?php echo $product['product']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-form-label">Cantidad:</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="note" class="col-form-label">Nota:</label>
                            <textarea class="form-control" id="note" name="note" placeholder="Opcional"></textarea>
                        </div>
                        <input type="hidden" class="form-control" id="id_quote" name="id_quote" value="<?php echo $id_quote; ?>" required>
                        <input type="hidden" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal eliminar producto a cotizazar-->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteQuoteModalLabel">Eliminar cotización #</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/quote_product/delete.php'); ?>" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro?</p>
                        <input type="hidden" id="id_quote_product" name="id_quote_product">
                        <input type="hidden" class="form-control" id="id_quote" name="id_quote" value="<?php echo $id_quote; ?>" required>
                        <input type="hidden" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
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