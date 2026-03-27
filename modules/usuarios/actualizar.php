<?php
include("../../config/conexion.php");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$rol = $_POST['rol'];
$estado = $_POST['estado'];

// 🔴 VALIDAR CORREO DUPLICADO (EXCEPTO EL MISMO)
$sql = "SELECT * FROM usuarios 
        WHERE correo = ? AND id_usuario != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $correo, $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    header("Location: editar.php?id=$id&error=correo");
    exit;
}

// 🔥 ACTUALIZAR
$stmt = $conn->prepare("UPDATE usuarios 
SET nombre=?, correo=?, rol=?, estado=? 
WHERE id_usuario=?");

$stmt->bind_param("ssssi", $nombre, $correo, $rol, $estado, $id);
$stmt->execute();

header("Location: listar.php?update=1");
?>