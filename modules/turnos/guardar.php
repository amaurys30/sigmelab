<?php
include("../../config/conexion.php");

$id_paciente = $_POST['id_paciente'];

// 🔥 VALIDAR SI YA TIENE TURNO PENDIENTE
$sql = "SELECT * FROM turnos 
        WHERE id_paciente = ? 
        AND estado = 'pendiente'
        AND fecha = CURDATE()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script>
        alert('El paciente ya tiene un turno pendiente');
        window.history.back();
    </script>";
    exit;
}

// 🔥 GENERAR TURNO
$sql = "SELECT MAX(numero_turno) as ultimo FROM turnos WHERE fecha = CURDATE()";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$numero_turno = $row['ultimo'] ? $row['ultimo'] + 1 : 1;

$stmt = $conn->prepare("INSERT INTO turnos (id_paciente, numero_turno, fecha) VALUES (?, ?, CURDATE())");
$stmt->bind_param("ii", $id_paciente, $numero_turno);
$stmt->execute();

header("Location: listar.php");
?>