<?php
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "SELECT m.*, p.nombres, p.apellidos 
        FROM muestras m
        JOIN pacientes p ON m.id_paciente = p.id_paciente
        WHERE m.id_muestra = $id";

$muestra = $conn->query($sql)->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Etiqueta Muestra</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
        }
        .etiqueta {
            border: 2px solid black;
            padding: 10px;
            width: 300px;
            margin: auto;
        }
        .codigo {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">

<div class="etiqueta">
    <p><strong>Paciente:</strong></p>
    <p><?= $muestra['nombres']." ".$muestra['apellidos'] ?></p>

    <p><strong>Examen:</strong></p>
    <p><?= $muestra['tipo_examen'] ?></p>

    <p class="codigo">
        <?= $muestra['codigo_muestra'] ?>
    </p>
</div>

</body>
</html>