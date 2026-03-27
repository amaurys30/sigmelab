<?php
include("../../config/conexion.php");

$id_muestra = $_POST['id_muestra'];
$descripcion = $_POST['descripcion'];

$sql = "SELECT * FROM resultados WHERE id_muestra = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_muestra);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows > 0){
    echo "<script>
        alert('Este resultado ya fue registrado');
        window.location='../muestras/listar.php';
    </script>";
    exit;
}

// 🔥 MANEJO DEL ARCHIVO
$archivo = $_FILES['archivo_pdf'];
$nombreArchivo = time() . "_" . $archivo['name'];
$ruta = "../../uploads/" . $nombreArchivo;

move_uploaded_file($archivo['tmp_name'], $ruta);

// 🔥 GUARDAR EN BD (ruta relativa)
$ruta_db = "uploads/" . $nombreArchivo;

// 🔥 INSERTAR RESULTADO
$stmt = $conn->prepare("INSERT INTO resultados 
(id_muestra, descripcion, archivo_pdf, fecha_resultado) 
VALUES (?, ?, ?, NOW())");

$stmt->bind_param("iss", $id_muestra, $descripcion, $ruta_db);
$stmt->execute();

// 🔥 ACTUALIZAR ESTADO
$stmt = $conn->prepare("UPDATE muestras SET estado='finalizada' WHERE id_muestra=?");
$stmt->bind_param("i", $id_muestra);
$stmt->execute();

// 🔥 RESPUESTA
echo "<script>
    alert('Resultado registrado correctamente');
    window.location='../muestras/listar.php';
</script>";
?>
