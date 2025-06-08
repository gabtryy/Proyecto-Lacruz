<?php include 'vista/parcial/header.php'; ?>
<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<div class="container mt-4">
    <h2>Crear Proveedor</h2>
    <form action="index.php?c=proveedor&m=guardar" method="post">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contacto:</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>
        <button class="btn btn-success" type="submit">Guardar</button>
        <a href="index.php?c=proveedor&m=index" class="btn btn-secondary">Volver</a>
    </form>
</div>
<?php include 'vista/parcial/footer.php'; ?>

