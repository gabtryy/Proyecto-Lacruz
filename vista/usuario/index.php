<?php require_once('vista/parcial/header.php'); 

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de usuario</h2>
            </div>
            <div class="col-md-6 text-end" >
                <a href="index.php?c=usuario&m=crear" class="p-btn">
                    <i class="fas fa-plus-circle"></i> Nuevo usuario
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                            <tr>
                                <th>Cedula</th>
                              
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                               <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['cedula']) ?></td>
                                <td><?= htmlspecialchars($usuario['username']) ?></td>
                                <td><?= htmlspecialchars($usuario['correo']) ?></td>
                                <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                                
                                
                                <td>
                                    <a href="index.php?c=usuario&m=actualizar&cedula=<?= $usuario['cedula'] ?>"  
                                       class="btn btn-primary btn-sm"  >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?c=usuario&m=eliminar&cedula=<?=$usuario['cedula'] ?>"
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('¿Desea eliminar este cliente?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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


<?php require_once('vista/parcial/footer.php'); ?>