<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?php echo RUTA . 'dashboard/'; ?>">
        <img class="mb-1" src="<?php echo RUTA . 'resource/assets/brand/Logo.png' ?>" alt="Medical Planet" width="20" height="20">
        Medical Planet
    </a>
    <!-- <div class="text-white">&nbsp;Administrador de Cotizaciones</div> -->
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php if ($_SERVER['PHP_SELF'] != MENU . 'quote.product.php') : ?>
        <form class="w-100" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input class="form-control form-control-dark w-100" type="text" name="search" placeholder="Buscar" aria-label="Search">
        </form>
    <?php endif; ?>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="<?php echo RUTA . 'dashboard/routes/logout.php'; ?>">Cerrar Sesión</a>
        </li>
    </ul>
</nav>