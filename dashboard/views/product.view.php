<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Productos</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#productModal">+ Nuevo producto</button>
                    </div>
                </div>
                <?php if (!empty($msg)) {
                    echo $msg;
                } ?>
                <div class="table-responsive">
                    <?php if ($products) : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Precio unitario sin IVA</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td class="align-middle"><img src="<?php echo RUTA . $product['image']; ?>" alt="" width="60" height="60"></td>
                                        <td class="align-middle"><?php echo $product['product']; ?></td>
                                        <td class="align-middle"><?php echo $product['brand']; ?></td>
                                        <td class="align-middle">$ <?php echo number_format($product['unit_price'], 2); ?> MXN</td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-primary" data-toggle="modal" data-target="#productEditModal" data-id_product="<?php echo $product['id_product']; ?>" data-product="<?php echo $product['product']; ?>" data-brand="<?php echo $product['brand']; ?>" data-iva="<?php echo $product['iva']; ?>" data-unit_price="<?php echo $product['unit_price']; ?>" data-description="<?php echo $product['description']; ?>" data-img_name="<?php echo $product['image']; ?>" data-image='<img src="<?php echo RUTA . $product['image']; ?>" class="col-12">'><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Editar" width="20" height="20"></button></center>
                                        </td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-danger" data-toggle="modal" data-target="#productDeleteModal" data-id_product="<?php echo $product['id_product']; ?>" data-product="<?php echo $product['product']; ?>" data-image="<?php echo $product['image']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Eliminar" width="20" height="20"></button></center>
                                        </td>
                                    </tr>
                                    <?php if ($product['description'] != null) : ?>
                                        <tr>
                                            <td colspan="7">
                                                <strong style="font-size: medium;">Descripción:</strong><br>
                                                <?php echo nl2br($product['description']); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Marca</th>
                                    <th>Precio unitario sin IVA</th>
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

    <!-- Modal nuevo producto -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Nuevo producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Producto:</label>
                            <input type="text" class="form-control" id="product" name="product" required>
                        </div>
                        <div class="form-group">
                            <label for="brand" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="form-group">
                            <label for="iva" class="col-form-label">Porcentaje de impuesto (IVA):</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="iva" name="iva" placeholder="%" value="0.16" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Precio unitario sin IVA:</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Opcional"></textarea>
                        </div>
                        <label for="exampleFormControlFile1">Foto:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image" required>
                            <label class="custom-file-label" for="image">Imagen de producto</label>
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

    <!-- Modal editar producto -->
    <div class="modal fade" id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="productEditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productEditModalLabel">Editar producto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/product/edit.php'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="id_product" name="id_product">
                        <div class="form-group">
                            <label for="product" class="col-form-label">Producto:</label>
                            <input type="text" class="form-control" id="product" name="product" required>
                        </div>
                        <div class="form-group">
                            <label for="brand" class="col-form-label">Marca:</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="form-group">
                            <label for="iva" class="col-form-label">Porcentaje de impuesto (IVA):</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="iva" name="iva" placeholder="%" value="0.16" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Precio unitario sin IVA:</label>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Opcional"></textarea>
                        </div>
                        <label for="exampleFormControlFile1">Foto:</label>
                        <div class="custom-file">
                            <input type="hidden" id="image_save" name="image_save">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Imagen de producto</label>
                        </div>
                        <hr>
                        <div id="thumb"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal eliminar producto -->
    <div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="productDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDeleteModalLabel">Eliminar Producto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/product/delete.php'); ?>" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro?</p>
                        <input type="hidden" id="id_product" name="id_product">
                        <input type="hidden" id="image" name="image">
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