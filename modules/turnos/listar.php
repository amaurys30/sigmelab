<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); 

if($_SESSION['rol'] == 'laboratorista'){
        echo "Acceso denegado";
        exit;
    }

?>

<h4>Turnos del Día</h4>

<a href="crear.php" class="btn btn-primary mb-3">
    Nuevo Turno
</a>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Turno</th>
            <th>Paciente</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $sql = "SELECT t.*, p.nombres, p.apellidos 
                FROM turnos t
                JOIN pacientes p ON t.id_paciente = p.id_paciente
                WHERE fecha = CURDATE()
                ORDER BY estado='pendiente' DESC, numero_turno ASC";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['numero_turno'] ?></td>
            <td><?= $row['nombres']." ".$row['apellidos'] ?></td>
            <td>
                <?php if($row['estado'] == 'pendiente'): ?>
                    <span class="badge bg-warning">Pendiente</span>
                <?php elseif($row['estado'] == 'atendido'): ?>
                    <span class="badge bg-success">Atendido</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($row['estado'] == 'pendiente'): ?>
                    <a href="atender.php?id=<?= $row['id_turno'] ?>" class="btn btn-success btn-sm">
                        Atender
                    </a>
                <?php endif; ?>

                <?php if($row['estado'] == 'atendido'): ?>
                        <a href="../muestras/crear.php?id_paciente=<?= $row['id_paciente'] ?>" 
                        class="btn btn-primary btn-sm">
                            Registrar Muestra
                        </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include("../../templates/footer.php"); ?>
