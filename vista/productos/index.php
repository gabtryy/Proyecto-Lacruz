<?php 
    require_once('vista/parcial/header.php'); 
    $materiasPrimas = (new MateriaPrima())->listar();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    window.materiasPrimasGlobal = <?= json_encode($materiasPrimas) ?>;
</script>
<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Productos</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php?c=ProductoControlador&m=crear" class="p-btn" data-bs-toggle="modal" data-bs-target="#registrarProductoModal">
                    <i class="fas fa-plus-circle"></i> Registrar Producto
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensaje']); unset($_SESSION['tipo_mensaje']); ?>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Precicio Unit.</th>
                                <th>Precicio Mayor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($productos)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay productos registrados</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($productos as $p): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p['id_producto']) ?></td>
                                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                                        <td>
                                            <span class="badge <?= $p['stock'] > 0 ? 'bg-success' : 'bg-warning' ?>">
                                                <?= htmlspecialchars($p['stock']) ?>
                                            </span>
                                        </td>
                                        <td><?= number_format($p['precio'], 2, ',', '.') ?></td>
                                        <td><?= number_format($p['precio_mayor'], 2, ',', '.') ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?php if ($p['es_fabricado']): ?>
                                                    <button type="button" class="btn btn-info btn-sm btn-detalle" 
                                                            data-id="<?= $p['id_producto'] ?>" 
                                                            title="Ver materias primas">
                                                        <i class="fas fa-boxes"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button value="<?= $p['id_producto'] ?>" type="button" 
                                                    class="btn btn-primary btn-sm btn-editar" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editarProductoModal"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" 
                                                    class="btn btn-danger btn-sm btn-eliminar" 
                                                    data-id="<?= $p['id_producto'] ?>" 
                                                    data-controlador="ProductoControlador"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>  
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('vista/productos/crear.php')?>
<?php require_once('vista/productos/detalle.php')?>
<?php require_once('vista/productos/editar.php')?>
<?php require_once('vista/productos/eliminar.php')?>
<?php require_once('vista/parcial/footer.php'); ?>
<script type="text/javascript" src="vista/js/eliminar.js"></script>