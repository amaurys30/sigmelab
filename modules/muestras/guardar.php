<?php
session_start();
include("../../config/conexion.php");

// 🔐 Validar sesión
if(!isset($_SESSION['id_usuario'])){
    header("Location: ../auth/login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_paciente = $_POST['id_paciente'];
$tipo = $_POST['tipo_examen'];

// 🔥 VALIDAR EXAMEN DUPLICADO
$sql = "SELECT * FROM muestras 
        WHERE id_paciente = ? 
        AND tipo_examen = ? 
        AND DATE(fecha_toma) = CURDATE()";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id_paciente, $tipo);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script>
        alert('Este examen ya fue registrado para el paciente hoy');
        window.history.back();
    </script>";
    exit;
}

// 🔥 GENERAR CÓDIGO
$codigo = "MUE-" . date("YmdHis");

// 🔥 INSERT CORREGIDO (4 CAMPOS)
$stmt = $conn->prepare("INSERT INTO muestras 
(id_paciente, id_usuario, codigo_muestra, tipo_examen)
VALUES (?, ?, ?, ?)");

$stmt->bind_param("iiss", $id_paciente, $id_usuario, $codigo, $tipo);
$stmt->execute();

// 🔥 OBTENER ID
$id_muestra = $conn->insert_id;

// 🔥 FLUJO
echo "<script>
    alert('Muestra registrada correctamente');

    window.open('imprimir.php?id=$id_muestra', '_blank');
    setTimeout(function(){
        window.location='listar.php';
    }, 1000);
</script>";

?>

