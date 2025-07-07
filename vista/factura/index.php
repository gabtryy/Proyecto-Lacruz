<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="mb-3">Gestión de Facturas</h2>
                <a href="index.php?c=factura&m=generar" class="btn btn-success btn-lg px-4 py-2" style="font-size: 1.3rem;">
                    <i class="fas fa-file-invoice"></i> Generar Factura
                </a>
            </div>
        </div>
        <div class="row">
            <!-- Tabla de Presupuestos -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Presupuestos</h5>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($presupuestos)): ?>
                                        <?php foreach ($presupuestos as $presupuesto): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($presupuesto['rif']) ?></td>
                                                <td><?= htmlspecialchars($presupuesto['nombre_cliente']) ?></td>
                                                <td><?= htmlspecialchars($presupuesto['fecha']) ?></td>
                                                <td><?= htmlspecialchars($presupuesto['total_general']). " BS"?></td>
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm">Facturar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No hay presupuestos registrados.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabla de Facturas -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Facturas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay facturas registradas.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('vista/parcial/footer.php'); ?>