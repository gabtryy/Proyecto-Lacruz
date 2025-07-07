<?php require_once 'vista/parcial/header.php'; ?>

<div class="container mt-4">
    <h2>Gestión de Tasas de Cambio</h2>

    <form method="post" action="index.php?c=tasa&m=actualizar">
        <div class="mb-3">
            <label>Tasa Oficial ($ → Bs)</label>
            <input type="number" step="0.01" name="oficial" class="form-control" value="<?= $oficial ?>" required>
        </div>
        <div class="mb-3">
            <label>Tasa Personalizada ($ → Bs)</label>
            <input type="number" step="0.01" name="personalizada" class="form-control" value="<?= $personalizada ?>" required>
        </div>
        <button class="btn btn-primary">Guardar</button>
    </form>
</div>

<?php require_once 'vista/parcial/footer.php'; ?>
