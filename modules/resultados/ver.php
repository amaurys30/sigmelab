<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
$id = $_GET['id_muestra'];

$sql = "SELECT r.*, m.codigo_muestra, p.nombres, p.apellidos, m.tipo_examen
        FROM resultados r
        JOIN muestras m ON r.id_muestra = m.id_muestra
        JOIN pacientes p ON m.id_paciente = p.id_paciente
        WHERE m.id_muestra = $id";

$resultado = $conn->query($sql)->fetch_assoc();
?>

<h4>Resultado del Examen</h4>

<div class="card shadow">
    <div class="card-body">

        <p><strong>Paciente:</strong> <?= $resultado['nombres']." ".$resultado['apellidos'] ?></p>
        <p><strong>Examen:</strong> <?= $resultado['tipo_examen'] ?></p>
        <p><strong>Código:</strong> <?= $resultado['codigo_muestra'] ?></p>
        <p><strong>Fecha:</strong> <?= $resultado['fecha_resultado'] ?></p>

        <hr>

        <p><strong>Resultado:</strong></p>
        <p><?= $resultado['descripcion'] ?></p>

        <hr>

        <a href="../../<?= $resultado['archivo_pdf'] ?>" 
        class="btn btn-primary" target="_blank">
            Ver PDF
        </a>

        <a href="../muestras/listar.php" class="btn btn-secondary">
            Volver
        </a>

    </div>
</div>

<?php include("../../templates/footer.php"); ?>
