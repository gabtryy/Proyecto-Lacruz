<?php require_once('vista/parcial/header.php'); ?>

<div class="container py-4">
    <h2 class="mb-4">Detalle de Presupuesto #<?= htmlspecialchars($presupuesto['id_factura']) ?></h2>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Datos del Presupuesto</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4"><strong>Fecha:</strong> <?= htmlspecialchars($presupuesto['fecha']) ?></div>
                <div class="col-md-4"><strong>N° Orden:</strong> <?= htmlspecialchars($presupuesto['numero_orden']) ?></div>
                <div class="col-md-4"><strong>Condición de Pago:</strong> <?= htmlspecialchars($presupuesto['condicion_pago']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><strong>Total General:</strong> <?= htmlspecialchars($presupuesto['total_general']) ?> BS</div>
                <div class="col-md-4"><strong>Total IVA:</strong> <?= htmlspecialchars($presupuesto['total_iva']) ?> BS</div>
                <div class="col-md-4"><strong>Estatus:</strong> <?= htmlspecialchars($presupuesto['estatus']) ?></div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <strong>Datos del Cliente</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-4"><strong>RIF:</strong> <?= htmlspecialchars($presupuesto['rif']) ?></div>
                <div class="col-md-4"><strong>Razón Social:</strong> <?= htmlspecialchars($presupuesto['razon_social']) ?></div>
                <div class="col-md-4"><strong>Nombre:</strong> <?= htmlspecialchars($presupuesto['nombre_cliente']) ?> <?= htmlspecialchars($presupuesto['apellido_cliente']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4"><strong>Teléfono:</strong> <?= htmlspecialchars($presupuesto['telefono_cliente']) ?></div>
                <div class="col-md-4"><strong>Correo:</strong> <?= htmlspecialchars($presupuesto['correo_cliente']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12">
                    <strong>Dirección:</strong>
                    <?= htmlspecialchars($presupuesto['estado']) ?>,
                    <?= htmlspecialchars($presupuesto['municipio']) ?>,
                    <?= htmlspecialchars($presupuesto['ciudad']) ?>,
                    <?= htmlspecialchars($presupuesto['calle']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <strong>Productos</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($productos)): ?>
                            <?php foreach ($productos as $prod): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prod['id_producto']) ?></td>
                                    <td><?= htmlspecialchars($prod['producto_nombre']) ?></td>
                                    <td><?= htmlspecialchars($prod['producto_cantidad']) ?></td>
                                    <td><?= htmlspecialchars($prod['producto_precio_unitario']) ?> BS</td>
                                    <td><?= htmlspecialchars($prod['producto_subtotal']) ?> BS</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay productos en este presupuesto.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Servicios -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">
            <strong>Servicios</strong>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID Servicio</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($servicios)): ?>
                            <?php foreach ($servicios as $serv): ?>
                                <tr>
                                    <td><?= htmlspecialchars($serv['id_servicio']) ?></td>
                                    <td><?= htmlspecialchars($serv['servicio_nombre']) ?></td>
                                    <td><?= htmlspecialchars($serv['servicio_cantidad']) ?></td>
                                    <td><?= htmlspecialchars($serv['servicio_precio_unitario']) ?> BS</td>
                                    <td><?= htmlspecialchars($serv['servicio_subtotal']) ?> BS</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay servicios en este presupuesto.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once('vista/parcial/footer.php'); ?>