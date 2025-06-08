<?php include 'vista/parcial/header.php'; ?>
<div class="container mt-4">
    <h2>Proveedores</h2>
    <a href="index.php?c=proveedor&m=crear" class="btn btn-primary mb-3">Nuevo Proveedor</a>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nombre</th><th>Contacto</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $d): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><?= $d['nombre'] ?></td>
                    <td><?= $d['telefono'] ?></td>
                    <td>
                        <a href="index.php?c=proveedor&m=editar&id=<?= $d['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?c=proveedor&m=eliminar&id=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
   onclick="return confirm('¿Está seguro de que desea eliminar este proveedor?');">Eliminar</a>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php include 'vista/parcial/footer.php'; ?>
