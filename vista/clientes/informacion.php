<?php require_once('vista/parcial/header.php'); ?>

<div class="container py-4">
    <h3 class="mb-4">Presupuestos del Cliente</h3>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-white">
                        <tr>
                            <th>ID Presupuesto</th>
                            <th>Fecha</th>
                            <th>Total</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($presupuestos)): ?>
                            <?php foreach ($presupuestos as $presupuesto): ?>
                                <tr>
                                    <td><?= htmlspecialchars($presupuesto['id_factura']) ?></td>
                                    <td><?= htmlspecialchars($presupuesto['fecha']) ?></td>
                                    <td><?= htmlspecialchars($presupuesto['total_general']) ?>.BS</td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No hay presupuestos para este cliente.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('vista/parcial/footer.php'); ?>