<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="/web/sigmelab/public/dashboard.php">
            SIGMELAB
        </a>

        <div class="collapse navbar-collapse">

            <!-- 🔷 MENÚ IZQUIERDA -->
            <ul class="navbar-nav me-auto">

                <!-- 👤 ADMIN -->
                <?php if($_SESSION['rol'] == 'admin'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/pacientes/listar.php">
                            Pacientes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/turnos/listar.php">
                            Turnos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/muestras/listar.php">
                            Muestras
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/usuarios/listar.php">
                            Usuarios
                        </a>
                    </li>

                <?php endif; ?>

                <!-- 👤 RECEPCIONISTA -->
                <?php if($_SESSION['rol'] == 'recepcionista'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/pacientes/listar.php">
                            Pacientes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/turnos/listar.php">
                            Turnos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/muestras/listar.php">
                            Muestras
                        </a>
                    </li>

                <?php endif; ?>

                <!-- 👤 ENFERMERO -->
                <?php if($_SESSION['rol'] == 'enfermero'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/turnos/listar.php">
                            Turnos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/muestras/listar.php">
                            Muestras
                        </a>
                    </li>

                <?php endif; ?>

                <!-- 👤 LABORATORISTA -->
                <?php if($_SESSION['rol'] == 'laboratorista'): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/pacientes/listar.php">
                            Pacientes
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/web/sigmelab/modules/muestras/listar.php">
                            Muestras
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

            <!-- 🔷 MENÚ DERECHA -->
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <span class="nav-link text-white">
                        <?= $_SESSION['nombre'] ?>
                    </span>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white ms-2 px-3"
                       href="/web/sigmelab/modules/auth/logout.php"
                       onclick="return confirm('¿Cerrar sesión?')">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>