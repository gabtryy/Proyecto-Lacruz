<?php include 'vista/parcial/header.php'; ?>
<div class="container mt-4">
    <h2>Editar Proveedor</h2>
    <form action="index.php?c=proveedor&m=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $dato['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" value="<?= $dato['nombre'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Contacto:</label>
            <input type="text" name="contacto" value="<?= $dato['telefono'] ?>" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a href="index.php?c=proveedor&m=index" class="btn btn-secondary">Volver</a>
    </form>
</div>
<?php include 'vista/parcial/footer.php'; ?>
