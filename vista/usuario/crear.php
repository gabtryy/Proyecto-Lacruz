<?php require_once('vista/parcial/header.php');

?>



<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Registro de Nuevo Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?c=usuario&m=guardar" method="POST">
                            
                            <div class="mb-3">
                                <label for="rif" class="form-label">Cedula</label>
                                <div class="input-group">
                                   
                                    <span class="input-group-text">-</span>
                                    <input type="number" class="form-control" id="cedula" name="cedula" required 
                                           placeholder="Ej: 12345678" >
                                </div>
                            </div>

                       
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                       placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required
                                       placeholder="Ej: 04121234567" >
                            </div>

                           
                            <div class="mb-3">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                       placeholder="Ej: cliente@example.com">
                            </div>
                                <label for="nombre" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                        <option value="" >seleccione un rol</option>
                                        <?php foreach ($roles as $rol): ?>                                            
                                         
                                        <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['tipo_usuario']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>

                            <div class="mb-3">
                                <label for="rif" class="form-label">contraseña</label>
                                <div class="input-group">
                                   
                                    <span class="input-group-text">-</span>
                                    <input type="password" class="form-control" id="password" name="password" required 
                                            >
                                </div>
                            </div>

                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php?action=clientes" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require_once('vista/parcial/footer.php'); ?>