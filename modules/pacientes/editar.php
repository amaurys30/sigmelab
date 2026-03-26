<?php
include("../../config/conexion.php");
$id = $_GET['id'];

$sql = "SELECT * FROM pacientes WHERE id_paciente=$id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<?php include("../../templates/header.php"); ?>

<div class="card shadow">
    <div class="card-header bg-warning">
        <h5>Editar Paciente</h5>
    </div>

    <div class="card-body">
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id_paciente'] ?>">

            <input type="text" name="nombres" value="<?= $data['nombres'] ?>" class="form-control mb-2">
            <input type="text" name="apellidos" value="<?= $data['apellidos'] ?>" class="form-control mb-2">
            <input type="text" name="telefono" value="<?= $data['telefono'] ?>" class="form-control mb-2">
            <input type="email" name="correo" value="<?= $data['correo'] ?>" class="form-control mb-2">

            <button class="btn btn-success">Actualizar</button>
            <a href="listar.php" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>