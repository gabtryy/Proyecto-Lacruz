<?php require_once 'vista/parcial/header.php'; ?>

<div class="container mt-5">
    <h2>Gestión de Usuarios</h2>

    <?php if (isset($mensaje)) : ?>
        <div class="alert alert-success"><?= $mensaje ?></div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="index.php?c=usuario&m=crear" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nuevo Usuario
        </a>
    </div>

    <?php if (!empty($usuarios)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['usuario']) ?></td>
                            <td>
                                <a href="index.php?c=usuario&m=editar&id=<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="index.php?c=usuario&m=eliminar&id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="alert alert-info">No hay usuarios registrados.</div>
    <?php endif; ?>
</div>

<?php require_once 'vista/parcial/footer.php'; ?>
