<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Presupuestos</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php?c=presupuesto&m=crear" class="p-btn">
                    <i class="fas fa-plus-circle"></i> Registrar Presupuesto
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                            <tr>
                                <th>N° Presupuesto</th>
                                <th>Cliente</th>
                                
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($presupuestos as $presupuesto): ?>
                            <tr>
                                <td><?= htmlspecialchars($presupuesto['rif']) ?></td>
                                <td><?= htmlspecialchars($presupuesto['nombre_cliente']) ?></td>
                                <td><?= htmlspecialchars(number_format($presupuesto['total_general'], 2, ',', '.')) ?> Bs.</td>
                                <td><?= htmlspecialchars($presupuesto['fecha']) ?></td>
                                <td>
                                    <a href="index.php?c=presupuesto&m=ver&id=<?= $presupuesto['id_factura'] ?>" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="index.php?c=presupuesto&m=editar&id=<?= $presupuesto['id_factura'] ?>" 
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                  
                                    <button type="button" class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $presupuesto['id_factura'] ?>"data-controlador="presupuesto">
                                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('vista/presupuesto/eliminar.php'); ?>
<?php require_once('vista/parcial/footer.php'); ?>
<script src="vista/js/eliminar.js"></script>