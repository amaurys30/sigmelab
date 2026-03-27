<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : null;

if($id_paciente){
    $sql = "SELECT m.*, p.nombres, p.apellidos 
            FROM muestras m
            JOIN pacientes p ON m.id_paciente = p.id_paciente
            WHERE m.id_paciente = $id_paciente
            ORDER BY 
            (m.estado = 'finalizada') ASC,
            m.fecha_toma DESC";
} else {
    $sql = "SELECT m.*, p.nombres, p.apellidos 
            FROM muestras m
            JOIN pacientes p ON m.id_paciente = p.id_paciente
            ORDER BY 
            (m.estado = 'finalizada') ASC,
            m.fecha_toma DESC";
}

$result = $conn->query($sql);
?>

<h4>Muestras</h4>

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Código</th>
            <th>Paciente</th>
            <th>Examen</th>
            <th>Estado</th>
            <th>Acciones</th> <!-- 🔥 NUEVA COLUMNA -->
        </tr>
    </thead>

    <tbody>
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['codigo_muestra'] ?></td>
                    <td><?= $row['nombres']." ".$row['apellidos'] ?></td>
                    <td><?= $row['tipo_examen'] ?></td>
                    
                    <td>
                        <?php if($row['estado'] == 'registrada'): ?>
                            <span class="badge bg-warning">Registrada</span>
                        <?php elseif($row['estado'] == 'en_proceso'): ?>
                            <span class="badge bg-primary">En Proceso</span>
                        <?php elseif($row['estado'] == 'finalizada'): ?>
                            <span class="badge bg-success">Finalizada</span>
                        <?php endif; ?>
                    </td>

                    <td>

                        <!-- 🔥 SOLO SI NO ESTÁ FINALIZADA -->
                        <?php if($row['estado'] != 'finalizada'): ?>
                            
                            <a href="imprimir.php?id=<?= $row['id_muestra'] ?>" 
                            class="btn btn-secondary btn-sm" target="_blank">
                                Imprimir
                            </a>

                            <a href="../resultados/crear.php?id_muestra=<?= $row['id_muestra'] ?>" 
                            class="btn btn-success btn-sm">
                                Registrar Resultado
                            </a>

                        <?php else: ?>

                            <!-- 🔥 BOTÓN VER RESULTADO -->
                            <a href="../resultados/ver.php?id_muestra=<?= $row['id_muestra'] ?>" 
                            class="btn btn-info btn-sm">
                                Ver Resultado
                            </a>

                            <button class="btn btn-dark btn-sm" disabled>
                                Finalizada
                            </button>

                        <?php endif; ?>

                    </td>

                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">
                    No hay muestras registradas
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include("../../templates/footer.php"); ?>