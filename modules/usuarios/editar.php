<?php
include("../../templates/header.php");
include("../../config/conexion.php");

// 🔐 PROTECCIÓN
if($_SESSION['rol'] != 'admin'){
    echo "<div class='alert alert-danger'>Acceso denegado</div>";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Editar Usuario</h4>
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            El correo ya está en uso
                        </div>
                    <?php endif; ?>

                    <form action="actualizar.php" method="POST">

                        <input type="hidden" name="id" value="<?= $user['id_usuario'] ?>">

                        <div class="mb-3">
                            <label>Tipo Documento</label>
                            <input type="text" class="form-control" 
                                   value="<?= $user['tipo_documento'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Número Documento</label>
                            <input type="text" class="form-control" 
                                   value="<?= $user['numero_documento'] ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" 
                                   value="<?= $user['nombre'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Correo</label>
                            <input type="email" name="correo" class="form-control" 
                                   value="<?= $user['correo'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Rol</label>
                            <select name="rol" class="form-control">
                                <option value="admin" <?= $user['rol']=='admin'?'selected':'' ?>>Admin</option>
                                <option value="recepcionista" <?= $user['rol']=='recepcionista'?'selected':'' ?>>Recepcionista</option>
                                <option value="enfermero" <?= $user['rol']=='enfermero'?'selected':'' ?>>Enfermero</option>
                                <option value="laboratorista" <?= $user['rol']=='laboratorista'?'selected':'' ?>>Laboratorista</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Estado</label>
                            <select name="estado" class="form-control">
                                <option value="activo" <?= $user['estado']=='activo'?'selected':'' ?>>Activo</option>
                                <option value="inactivo" <?= $user['estado']=='inactivo'?'selected':'' ?>>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="listar.php" class="btn btn-secondary">Volver</a>
                            <button class="btn btn-success">Actualizar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
