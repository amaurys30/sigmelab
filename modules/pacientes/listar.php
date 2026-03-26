<?php include("../../templates/header.php"); ?>
<?php include("../../config/conexion.php"); ?>

<?php
    $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

    $limite = 10;
    $offset = ($pagina - 1) * $limite;

    if($buscar != ''){
        $param = "%$buscar%";

        // Total registros filtrados
        $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM pacientes 
        WHERE numero_documento LIKE ? 
        OR nombres LIKE ? 
        OR apellidos LIKE ?");
        $stmt_total->bind_param("sss", $param, $param, $param);
        $stmt_total->execute();
        $total = $stmt_total->get_result()->fetch_assoc()['total'];

        // Datos paginados
        $stmt = $conn->prepare("SELECT * FROM pacientes 
        WHERE numero_documento LIKE ? 
        OR nombres LIKE ? 
        OR apellidos LIKE ?
        LIMIT ? OFFSET ?");
        
        $stmt->bind_param("sssii", $param, $param, $param, $limite, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

    } else {

        // Total registros
        $total = $conn->query("SELECT COUNT(*) as total FROM pacientes")
                    ->fetch_assoc()['total'];

        // Datos paginados
        $result = $conn->query("SELECT * FROM pacientes LIMIT $limite OFFSET $offset");
    }

    $total_paginas = ceil($total / $limite);
?>


<div class="d-flex justify-content-between mb-3">
    <h4>Pacientes</h4>
    <a href="crear.php" class="btn btn-primary">Nuevo Paciente</a>
</div>

<div class="card shadow">
    <div class="card-body">

        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success">Paciente registrado correctamente</div>
        <?php endif; ?>
        <?php if(isset($_GET['update'])): ?>
            <div class="alert alert-info">
                Paciente actualizado correctamente
            </div>
        <?php endif; ?>


        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por documento o nombre" > <!--value="<?= isset($_GET['buscar']) ? $_GET['buscar'] : '' ?>"-->
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id_paciente'] ?></td>
                            <td><?= $row['numero_documento'] ?></td>
                            <td><?= $row['nombres']." ".$row['apellidos'] ?></td>
                            <td><?= $row['telefono'] ?></td>
                            <td><?= $row['correo'] ?></td>
                            <td>
                                <a href="editar.php?id=<?= $row['id_paciente'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-danger">
                            No se encontraron resultados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

        <nav>
            <ul class="pagination justify-content-center">

            <?php for($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
                    <a class="page-link" 
                    href="?pagina=<?= $i ?><?= $buscar ? '&buscar='.$buscar : '' ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            </ul>
        </nav>

    </div>
</div>

<script>
setTimeout(() => {
    let alert = document.querySelector('.alert');
    if(alert){
        alert.style.display = 'none';
    }
}, 3000);
</script>

<?php include("../../templates/footer.php"); ?>