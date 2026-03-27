<?php include("../../config/conexion.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-4 mx-auto">

        <div class="card shadow">
            <div class="card-body">

                <h4 class="text-center">Iniciar Sesión</h4>
                <?php if(isset($_GET['error'])): ?>

                    <?php if($_GET['error'] == 'usuario'): ?>
                        <div class="alert alert-danger">
                            Credenciales incorrectas
                        </div>
                    <?php elseif($_GET['error'] == 'password'): ?>
                        <div class="alert alert-danger">
                            Credenciales incorrectas
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <form action="validar.php" method="POST">

                    <div class="mb-3">
                        <label>Correo</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Ingresar</button>

                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>