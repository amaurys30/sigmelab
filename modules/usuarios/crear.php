<?php include("../../templates/header.php"); ?>

<?php
// 🔐 PROTECCIÓN
if($_SESSION['rol'] != 'admin'){
    echo "<div class='alert alert-danger'>Acceso denegado</div>";
    exit;
}
?>

<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Registrar Usuario</h4>

                    <!-- 🔥 MENSAJES -->
                    <?php if(isset($_GET['error'])): ?>

                        <?php if($_GET['error'] == 'documento'): ?>
                            <div class="alert alert-danger">
                                El número de documento ya está registrado
                            </div>
                        <?php elseif($_GET['error'] == 'correo'): ?>
                            <div class="alert alert-danger">
                                El correo ya está registrado
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <form action="guardar.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Tipo de Documento</label>
                            <select name="tipo_documento" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Número de Documento</label>
                            <input type="text" name="numero_documento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="rol" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="admin">Admin</option>
                                <option value="recepcionista">Recepcionista</option>
                                <option value="enfermero">Enfermero</option>
                                <option value="laboratorista">Laboratorista</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="listar.php" class="btn btn-secondary">
                                Volver
                            </a>

                            <button class="btn btn-success">
                                Guardar Usuario
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?php include("../../templates/footer.php"); ?>