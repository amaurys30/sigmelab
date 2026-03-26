<?php include("../templates/header.php"); ?>

<h3>Panel Principal</h3>

<div class="row mt-4">

    <div class="col-md-6">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Pacientes</h5>
                <a href="../modules/pacientes/listar.php" class="btn btn-primary">
                    Ir a Pacientes
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Turnos</h5>
                <a href="../modules/turnos/listar.php" class="btn btn-success">
                    Ver Turnos
                </a>
            </div>
        </div>
    </div>

</div>

<?php include("../templates/footer.php"); ?>
