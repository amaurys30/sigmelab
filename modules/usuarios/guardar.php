<?php
include("../../config/conexion.php");

// 🔥 CAPTURAR DATOS
$nombre = $_POST['nombre'];
$tipo_documento = $_POST['tipo_documento'];
$numero_documento = $_POST['numero_documento'];
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];


// 🔴 VALIDAR DOCUMENTO DUPLICADO
$sql = "SELECT * FROM usuarios WHERE numero_documento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $numero_documento);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    header("Location: crear.php?error=documento");
    exit;
}


// 🔴 VALIDAR CORREO DUPLICADO
$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    header("Location: crear.php?error=correo");
    exit;
}


// 🔥 INSERT CORRECTO
$stmt = $conn->prepare("INSERT INTO usuarios 
(tipo_documento, numero_documento, nombre, correo, password, rol)
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", 
    $tipo_documento, 
    $numero_documento, 
    $nombre, 
    $correo, 
    $password, 
    $rol
);

$stmt->execute();

// 🔥 REDIRECCIÓN CON MENSAJE
header("Location: listar.php?success=1");
?>