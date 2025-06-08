<?php include 'vista/parcial/header.php'; ?>

<div class="container mt-4">
    <h2>Editar Usuario</h2>

<form action="index.php?c=usuario&m=actualizar" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

    <div class="mb-3">
        <label for="usuario" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="clave" class="form-label">Nueva Clave</label>
        <input type="password" class="form-control" name="clave" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>


<?php include 'vista/parcial/footer.php'; ?>

