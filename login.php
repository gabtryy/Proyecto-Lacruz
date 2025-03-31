<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color:rgb(82, 160, 255); /* Fondo gris claro */
        }
        .card {
            background-color:rgb(105, 192, 191); /* Fondo blanco para la tarjeta */
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        .form-control {
            background-color: #e9ecef; /* Fondo gris para los inputs */
            border: 1px solid #ced4da; /* Borde gris */
        }
        .form-control:focus {
            background-color: #e9ecef; /* Mantener el fondo gris al enfocar */
            border-color: #80bdff; /* Borde azul al enfocar */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Sombra al enfocar */
        }
        .btn-primary {
            background-color:rgb(0, 47, 96); /* Color azul para el botón */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Color azul más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <form action ="index.php" method ="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">email</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="btnLogin" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>