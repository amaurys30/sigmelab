<?php
include("../../config/conexion.php");

$documento = $_POST['documento'];
$codigo = $_POST['codigo'];

// 🔍 Buscar la muestra (sin importar estado)
$sql = "SELECT m.*, p.numero_documento
        FROM muestras m
        JOIN pacientes p ON m.id_paciente = p.id_paciente
        WHERE p.numero_documento = ?
        AND m.codigo_muestra = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $documento, $codigo);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    // 🔒 VALIDAR SI YA ESTÁ FINALIZADA
    if($row['estado'] != 'finalizada'){
        header("Location: index.php?proceso=1");
        exit;
    }

    header("Location: resultado.php?id=".$row['id_muestra']);

} else {
    header("Location: index.php?error=1");
}
?>