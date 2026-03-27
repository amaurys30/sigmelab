<?php
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT r.*, 
               m.codigo_muestra, 
               m.fecha_toma,
               p.nombres, p.apellidos
        FROM resultados r
        JOIN muestras m ON r.id_muestra = m.id_muestra
        JOIN pacientes p ON m.id_paciente = p.id_paciente
        WHERE m.id_muestra = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Laboratorio</title>

    <!-- 🔥 Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-8 mx-auto">

        <div class="card shadow-lg border-0">

            <div class="card-header bg-success text-white text-center">
                <h4>Resultado de Laboratorio</h4>
            </div>

            <div class="card-body">

                <!-- 🔷 PACIENTE Y CÓDIGO -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Paciente:</strong><br>
                        <?= $data['nombres']." ".$data['apellidos'] ?>
                    </div>

                    <div class="col-md-6 text-end">
                        <strong>Código:</strong><br>
                        <?= $data['codigo_muestra'] ?>
                    </div>
                </div>

                <hr>

                <!-- 🔷 FECHAS -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Fecha de toma:</strong><br>
                        <?= date("d/m/Y H:i", strtotime($data['fecha_toma'])) ?>
                    </div>

                    <div class="col-md-6 text-end">
                        <strong>Fecha de resultado:</strong><br>
                        <?= date("d/m/Y H:i", strtotime($data['fecha_resultado'])) ?>
                    </div>
                </div>

                <hr>

                <!-- 🔷 RESULTADO -->
                <div class="mb-4">
                    <h5>Descripción del resultado:</h5>
                    <div class="p-3 bg-light border rounded">
                        <?= nl2br($data['descripcion']) ?>
                    </div>
                </div>

                <!-- 🔷 BOTONES -->
                <div class="text-center">

                    <a href="../../<?= $data['archivo_pdf'] ?>" 
                       class="btn btn-success px-4" target="_blank">
                        📄 Descargar PDF
                    </a>

                    <a href="index.php" class="btn btn-secondary px-4">
                        Volver
                    </a>

                </div>

            </div>

        </div>

        <!-- 🔥 FOOTER SIMPLE -->
        <p class="text-center mt-3 text-muted">
            SIGMELAB © <?= date("Y") ?>
        </p>

    </div>
</div>

</body>
</html>