<?php include("../../templates/header.php"); 
if($_SESSION['rol'] == 'enfermero' || $_SESSION['rol'] == 'laboratorista'){
    echo "Acceso denegado";
    exit;
}
?>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5>Registrar Paciente</h5>
    </div>

    <?php if(isset($_GET['error'])): ?>

        <?php if($_GET['error'] == 'campos_vacios'): ?>
            <div class="alert alert-danger">Todos los campos son obligatorios</div>
        <?php endif; ?>

        <?php if($_GET['error'] == 'documento_existente'): ?>
            <div class="alert alert-warning">El número de documento ya está registrado</div>
        <?php endif; ?>

    <?php endif; ?>


    <div class="card-body">
        <form action="guardar.php" method="POST">

            <div class="row">
                <div class="col-md-3">
                    <label>Tipo Documento</label>
                    <select name="tipo_documento" class="form-control" required>
                        <option value="CC">CC</option>
                        <option value="TI">TI</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Número</label>
                    <input type="text" name="numero_documento" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-success">Guardar</button>
                <a href="listar.php" class="btn btn-secondary">Volver</a>
            </div>

        </form>
    </div>
</div>


<script>
document.querySelector("form").addEventListener("submit", function(e) {
    let inputs = document.querySelectorAll("input, select");

    for (let input of inputs) {
        if (input.value.trim() === "") {
            alert("Todos los campos son obligatorios");
            e.preventDefault();
            return;
        }
    }
});
</script>

<?php include("../../templates/footer.php"); ?>