<?php require 'helpers/header.php'; ?>

<body>

    <?php require 'helpers/navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <?php require 'helpers/menu.php'; ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Usuarios</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newUserModal">+ Nuevo usuario</button>
                    </div>
                </div>
                <?php if (!empty($msg)) {
                    echo $msg;
                } ?>
                <div class="table-responsive">
                    <?php if ($users) : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Permisos</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $user['id_user']; ?></td>
                                        <td class="align-middle"><?php echo $user['name']; ?></td>
                                        <td class="align-middle"><a href="tel:<?php echo $user['phone']; ?>"><?php echo $user['phone']; ?></a></td>
                                        <td class="align-middle"><?php echo $user['roll']; ?></td>
                                        <td class="align-middle"><?php echo $user['user']; ?></td>
                                        <td class="align-middle"><a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a></td>
                                        <td class="align-middle">
                                            <center><button class="btn btn-primary" data-toggle="modal" data-target="#editUserModal" data-id_user="<?php echo $user['id_user']; ?>" data-name="<?php echo $user['name']; ?>" data-phone="<?php echo $user['phone']; ?>" data-roll="<?php echo $user['roll']; ?>" data-user="<?php echo $user['user']; ?>" data-email="<?php echo $user['email']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/edit.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                        </td>
                                        <td class="align-middle">
                                            <?php if ($user['user'] != 'fmm') : ?>
                                                <center><button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal" data-id_user="<?php echo $user['id_user']; ?>" data-name="<?php echo $user['name']; ?>"><img src="<?php echo RUTA . 'resource/assets/icons/trash.png' ?>" alt="Imprimir" width="20" height="20"></button></center>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <table class="table table-striped table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Permisos</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
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

    <!-- Modal nuevo usuario-->
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserModalLabel">Nuevo usuario</h5>
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
                            <label for="phone" class="col-form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="roll" class="col-form-label">Permisos:</label>
                            <select class="form-control" id="roll" name="roll" required>
                                <option selected></option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                        <div class="form-group">
                            <label for="pass2" class="col-form-label">Confirma la contraseña:</label>
                            <input type="password" class="form-control" id="pass2" name="pass2" required>
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

    <!-- Modal editar usuario-->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/user/edit.php'); ?>" method="POST">
                        <input type="hidden" id="id_user" name="id_user">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre completo:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Teléfono:</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="roll" class="col-form-label">Permisos:</label>
                            <select class="form-control" id="roll" name="roll" required>
                                <option selected></option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="user" class="col-form-label">Usuario:</label>
                            <input type="text" class="form-control" id="user" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="col-form-label">Nueva contraseña (Llenar o dejar en blanco):</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Llenar en caso de cambiar">
                        </div>
                        <div class="form-group">
                            <label for="pass2" class="col-form-label">Confirma la nueva contraseña (Llenar o dejar en blanco):</label>
                            <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Llenar en caso de cambiar">
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
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserModalLabel">Eliminar cotización #</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars(RUTA . '/dashboard/routes/user/delete.php'); ?>" method="POST">
                    <div class="modal-body">
                        <p id="message">¿Estas segur@ de eliminar el registro?</p>
                        <input type="hidden" id="id_user" name="id_user">
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