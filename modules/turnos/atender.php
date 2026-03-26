<?php
include("../../config/conexion.php");

$id = $_GET['id'];

$conn->query("UPDATE turnos SET estado='atendido' WHERE id_turno=$id");

header("Location: listar.php");
?>
