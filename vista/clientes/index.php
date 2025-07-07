<?php require_once('vista/parcial/header.php'); 

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Clientes</h2>
            </div>
            <div class="col-md-6 text-end" >
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearClienteModal">
                    <i class="fas fa-plus-circle"></i> Registrar Cliente
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                            <tr>
                                <th>RIF</th>
                              
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Direccion</th>
                                <th>Quien registra</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                               <?php foreach ($cliente as $cli): ?>
                            <tr>
                                <td><?= htmlspecialchars($cli['rif']) ?></td>
                                <td><?= htmlspecialchars($cli['nombre_cliente']) ?> <?= htmlspecialchars($cli['apellido_cliente']) ?></td>
                                <td><?= htmlspecialchars($cli['correo']) ?></td>
                                <td><?= htmlspecialchars($cli['telefono']) ?></td>
                                
                                <td><?= htmlspecialchars($cli['estado']) ?> <?= htmlspecialchars($cli['municipio']) ?> <?= htmlspecialchars($cli['ciudad']) ?> <?= htmlspecialchars($cli['calle']) ?></td>
                                <td><?= htmlspecialchars($cli['nombre_usuario']) ?></td>
                                 <td><?= htmlspecialchars($cli['fecha_registro']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-editar-cliente"
        data-rif="<?= $cli['rif'] ?>">
    <i class="fas fa-edit"></i>
</button>
                                
                                     <button type="button" class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $cli['rif'] ?>"data-controlador="clientes">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
   
   
</script>

<?php require_once('vista/parcial/footer.php'); ?>
<?php require_once('vista/clientes/crear.php'); // Incluye el modal aquí ?>
<?php require_once('vista/clientes/eliminar.php'); ?>
<?php require_once('vista/clientes/editar.php'); // Incluye el modal de editar ?>
<script src="vista/js/eliminar.js"></script>