<?php
include("../../config/conexion.php");

// Validar campos
foreach($_POST as $campo){
    if(empty($campo)){
        header("Location: crear.php?error=campos_vacios");
        exit();
    }
}

$tipo = $_POST['tipo_documento'];
$numero = $_POST['numero_documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

// Verificar si ya existe el documento
$check = $conn->prepare("SELECT id_paciente FROM pacientes WHERE numero_documento = ?");
$check->bind_param("s", $numero);
$check->execute();
$result = $check->get_result();

if($result->num_rows > 0){
    header("Location: crear.php?error=documento_existente");
    exit();
}

// Insertar paciente (PREPARED STATEMENT 🔥)
$stmt = $conn->prepare("INSERT INTO pacientes 
(tipo_documento, numero_documento, nombres, apellidos, telefono, correo)
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", $tipo, $numero, $nombres, $apellidos, $telefono, $correo);
$stmt->execute();

header("Location: listar.php?success=1");
?>