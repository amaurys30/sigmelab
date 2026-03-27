
<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
if($_SESSION['rol'] == 'recepcionista'){
    echo "Acceso denegado";
    exit;
}

$id_paciente = $_GET['id_paciente'];

$sql = "SELECT * FROM pacientes WHERE id_paciente=$id_paciente";
$paciente = $conn->query($sql)->fetch_assoc();
?>

<h4>Registrar Muestra</h4>

<div class="card shadow">
    <div class="card-body">

        <p><strong>Paciente:</strong>
        <?= $paciente['nombres']." ".$paciente['apellidos'] ?></p>

        <form action="guardar.php" method="POST">

            <input type="hidden" name="id_paciente" value="<?= $id_paciente ?>">

            <?php
                $examenes = [
                    "Hemograma",
                    "Glucosa",
                    "Colesterol",
                    "Triglicéridos",
                    "Examen de Orina",
                    "COVID-19",
                    "Perfil Lipídico",
                    "Prueba de Embarazo"
                ];
                ?>

                <div class="mb-3">
                    <label>Tipo de Examen</label>
                    <select name="tipo_examen" class="form-control" required>
                        <option value="" disabled selected>Seleccione un examen</option>

                        <?php foreach($examenes as $ex): ?>
                            <option value="<?= $ex ?>"><?= $ex ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>

            <button class="btn btn-success">Guardar Muestra</button>

        </form>

    </div>
</div>

<?php include("../../templates/footer.php"); ?>