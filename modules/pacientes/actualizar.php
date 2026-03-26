<?php
include("../../config/conexion.php");

$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$sql = "UPDATE pacientes SET 
nombres='$nombres',
apellidos='$apellidos',
telefono='$telefono',
correo='$correo'
WHERE id_paciente=$id";

$conn->query($sql);

// 🔥 Redirigir con mensaje
header("Location: listar.php?update=1");
exit();
?>