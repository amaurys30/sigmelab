<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
if($_SESSION['rol'] == 'laboratorista'){
        echo "Acceso denegado";
        exit;
    }

$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;

if($id_paciente){
    $sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
    $paciente = $conn->query($sql)->fetch_assoc();
}
?>

<h4>Asignar Turno</h4>

<div class="card shadow">
    <div class="card-body">

        <form action="guardar.php" method="POST">

            <?php if($id_paciente): ?>

                <!-- 🔥 MOSTRAR INFO DEL PACIENTE -->
                <p><strong>Paciente:</strong> 
                <?= $paciente['nombres']." ".$paciente['apellidos'] ?></p>

                <input type="hidden" name="id_paciente" value="<?= $id_paciente ?>">

            <?php else: ?>

                <!-- 🔥 SELECT NORMAL -->
                <div class="mb-3">
                    <label>Paciente</label>
                    <select name="id_paciente" class="form-control" required>
                        <option value="">Seleccione</option>

                        <?php
                        $pacientes = $conn->query("SELECT * FROM pacientes");
                        while($p = $pacientes->fetch_assoc()):
                        ?>
                            <option value="<?= $p['id_paciente'] ?>">
                                <?= $p['nombres']." ".$p['apellidos'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

            <?php endif; ?>

            <button class="btn btn-success">Asignar Turno</button>
            <a href="listar.php" class="btn btn-secondary">Volver</a>

        </form>

    </div>
</div>

<?php include("../../templates/footer.php"); ?>