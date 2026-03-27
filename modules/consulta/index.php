<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Resultados</title>

    <!-- 🔥 Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-5 mx-auto">

        <div class="card shadow-lg border-0">

            <div class="card-header bg-primary text-white text-center">
                <h4>Consulta de Resultados</h4>
            </div>

            <div class="card-body">

                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger text-center">
                        ❌ Documento o código incorrecto
                    </div>
                <?php endif; ?>

                <?php if(isset($_GET['proceso'])): ?>
                    <div class="alert alert-warning text-center">
                        ⏳ Tu resultado aún está en proceso
                    </div>
                <?php endif; ?>

                <form action="buscar.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Número de Documento</label>
                        <input type="text" name="documento" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código de Muestra</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        Consultar Resultado
                    </button>

                </form>

            </div>

        </div>

        <!-- 🔥 FOOTER SIMPLE -->
        <p class="text-center mt-3 text-muted">
            SIGMELAB © <?= date("Y") ?>
        </p>

    </div>
</div>

</body>
</html>