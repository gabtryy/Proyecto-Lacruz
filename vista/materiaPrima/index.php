<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Materia Prima</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php?c=MateriaPrimaControlador&m=crear" class="p-btn" data-bs-toggle="modal" data-bs-target="#registrarMateriaModal">
                    <i class="fas fa-plus-circle"></i> Registrar Materia Prima
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
                                <th>Medida</th>
                                <th>Proveedor</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($materias)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay materias primas registradas</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($materias as $m): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($m['id_materia']) ?></td>
                                        <td><?= htmlspecialchars($m['nombre']) ?></td>
                                        <td><?= htmlspecialchars($m['medida']) ?></td>
                                        <td><?= htmlspecialchars($m['proveedor']) ?></td>
                                        <td><?= htmlspecialchars($m['stock']) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button value="<?= $m['id_materia'] ?>" type="button" class="btn btn-primary btn-sm btn-editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $m['id_materia'] ?>" data-controlador="MateriaPrimaControlador">
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

<?php include_once('vista/materiaPrima/crear.php'); ?>
<?php include_once('vista/materiaPrima/editar.php'); ?>
<?php include_once('vista/materiaPrima/eliminar.php'); ?>
<?php require_once('vista/parcial/footer.php'); ?>
<script type="text/javascript" src="vista/js/editarMateriaPrima.js"></script>
<script type="text/javascript" src="vista/js/eliminar.js"></script>