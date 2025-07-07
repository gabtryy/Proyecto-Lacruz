<?php require_once 'vista/parcial/header.php'; ?>

<div class="container mt-5">
    <h2>Registrar Nuevo Usuario</h2>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="index.php?c=usuario&m=guardar" method="POST" class="mt-3">
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="clave" class="form-label">Clave</label>
            <input type="password" name="clave" id="clave" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="confirmar_clave" class="form-label">Confirmar Clave</label>
            <input type="password" name="confirmar_clave" id="confirmar_clave" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Guardar
        </button>
        <a href="index.php?c=usuario&m=index" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </form>
</div>

<?php require_once 'vista/parcial/footer.php'; ?>
