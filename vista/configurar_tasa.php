<?php
if (!isset($_SESSION)) session_start();

// Redirige si no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php?c=login&m=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configurar Tasa de Cambio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'parcial/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Configurar Tasa de Cambio</h2>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
        </div>
    <?php endif; ?>

    <form action="/inventario/index.php?c=venta&m=guardarTasa" method="POST" class="row g-3">
    <div class="col-md-6">
        <label for="tasa_oficial" class="form-label">Tasa Oficial (Bs/USD)</label>
        <input type="number" step="0.01" min="0.01" name="tasa_oficial" id="tasa_oficial" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="tasa_personalizada" class="form-label">Tasa Personalizada (Bs/USD)</label>
        <input type="number" step="0.01" min="0.01" name="tasa_personalizada" id="tasa_personalizada" class="form-control" required>
    </div>

    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Guardar Tasas</button>
    </div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include 'parcial/footer.php'; ?>
