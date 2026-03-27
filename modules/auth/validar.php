<?php
session_start();
include("../../config/conexion.php");

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){

        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: ../../public/dashboard.php");

    } else {
        header("Location: login.php?error=password");
    }

} else {
    header("Location: login.php?error=usuario");
}
?>