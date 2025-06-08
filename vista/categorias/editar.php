<?php include 'vista/parcial/header.php'; ?>
<div class="container mt-4">
    <h2>Editar Categoría</h2>
    <form action="index.php?c=categoria&m=actualizar" method="post">
        <input type="hidden" name="id" value="<?= $dato['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= $dato['nombre'] ?>" required>
        </div>
        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a href="index.php?c=categoria&m=index" class="btn btn-secondary">Volver</a>
    </form>
</div>
<?php include 'vista/parcial/footer.php'; ?>
