<?php
include("../../config/conexion.php");

$id_paciente = $_POST['id_paciente'];
$tipo = $_POST['tipo_examen'];

// 🔥 VALIDAR EXAMEN DUPLICADO EN EL MISMO DÍA
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

// 🔥 GENERAR CÓDIGO ÚNICO
$codigo = "MUE-" . date("YmdHis");

// 🔥 INSERTAR MUESTRA
$stmt = $conn->prepare("INSERT INTO muestras 
(id_paciente, codigo_muestra, tipo_examen)
VALUES (?, ?, ?)");

$stmt->bind_param("iss", $id_paciente, $codigo, $tipo);
$stmt->execute();


// 🔥 OBTENER ID DE LA MUESTRA
$id_muestra = $conn->insert_id;

// 🔥 ABRIR IMPRESIÓN AUTOMÁTICA
echo "<script>
    alert('Muestra registrada correctamente');

    // abrir impresión
    var ventana = window.open('imprimir.php?id=$id_muestra', '_blank');

    // esperar antes de redirigir
    setTimeout(function(){
        window.location='listar.php';
    }, 1000);
</script>";

?>