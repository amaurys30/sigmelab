<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
if($_SESSION['rol'] != 'laboratorista' && $_SESSION['rol'] != 'admin'){
    echo "Acceso denegado";
    exit;
}

$id_muestra = $_GET['id_muestra'];

$sql = "SELECT m.*, p.nombres, p.apellidos 
        FROM muestras m
        JOIN pacientes p ON m.id_paciente = p.id_paciente
        WHERE m.id_muestra = $id_muestra";

$muestra = $conn->query($sql)->fetch_assoc();
?>

<h4>Registrar Resultado</h4>

<div class="card shadow">
    <div class="card-body">

        <p><strong>Paciente:</strong> <?= $muestra['nombres']." ".$muestra['apellidos'] ?></p>
        <p><strong>Examen:</strong> <?= $muestra['tipo_examen'] ?></p>

        <form action="guardar.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id_muestra" value="<?= $id_muestra ?>">

            <div class="mb-3">
                <label>Resultado</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Archivo PDF</label>
                <input type="file" name="archivo_pdf" class="form-control" accept="application/pdf" required>
            </div>

            <button class="btn btn-success">Guardar Resultado</button>
            <a href="../muestras/listar.php" class="btn btn-secondary">Volver</a>

        </form>

    </div>
</div>

<?php include("../../templates/footer.php"); ?>