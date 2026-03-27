<?php
session_start();
include("../../config/conexion.php");

// 🔐 PROTEGER SOLO ADMIN
if(!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    echo "<div class='alert alert-danger'>Acceso denegado</div>";
    exit;
}

// 🔥 CONSULTA
$sql = "SELECT * FROM usuarios ORDER BY id_usuario DESC";
$result = $conn->query($sql);
?>

<?php include("../../templates/header.php"); ?>

<div class="d-flex justify-content-between mb-3">
    <h4>Gestión de Usuarios</h4>

    <a href="crear.php" class="btn btn-primary">
        Nuevo Usuario
    </a>
</div>

<div class="card shadow">
    <div class="card-body">

        <!-- 🔥 MENSAJE -->
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">
                Usuario registrado correctamente
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['update'])): ?>
            <div class="alert alert-success">
                Usuario actualizado correctamente
            </div>
        <?php endif; ?>


        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_usuario'] ?></td>
                            <td><?= $row['numero_documento'] ?></td>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['correo'] ?></td>

                            <td>
                                <?php if($row['rol'] == 'admin'): ?>
                                    <span class="badge bg-danger">Admin</span>
                                <?php elseif($row['rol'] == 'recepcionista'): ?>
                                    <span class="badge bg-primary">Recepcionista</span>
                                <?php elseif($row['rol'] == 'enfermero'): ?>
                                    <span class="badge bg-success">Enfermero</span>
                                <?php elseif($row['rol'] == 'laboratorista'): ?>
                                    <span class="badge bg-warning text-dark">Laboratorista</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($row['estado'] == 'activo'): ?>
                                    <span class="badge bg-success">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="editar.php?id=<?= $row['id_usuario'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay usuarios registrados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
</div>

<?php include("../../templates/footer.php"); ?>