<?php require_once('vista/parcial/header.php'); ?>


<div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="crearClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title text-white" id="crearClienteModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Registro de Nuevo Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="index.php?c=clientes&m=guardar_cliente" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rif" class="form-label">RIF</label>
                        <div class="input-group">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" id="rif" name="rif" required 
                                   placeholder="Ej: 12345678" min="10000000" max="99999999">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    
                    <!-- Campo de Razón Social con Checkbox -->
                    <div class="mb-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="tiene_razon_social" name="razon_social">
                            <label class="form-check-label" for="tiene_razon_social">¿Tiene Razón Social?</label>
                        </div>
                        <input type="text" class="form-control" id="razon_social" name="razon_social" 
                               placeholder="Ingrese Razón Social" disabled>
                    </div>
                    
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" required
                               placeholder="Ej: 04121234567" min="1000000000" max="99999999999">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <div class="mb-2">
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <?php foreach ($estado as $estados): ?>
                                    <option value="<?php echo $estados['id_estado']; ?>"><?php echo $estados['nombre']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <select class="form-select" id="municipio" name="municipio" disabled required>
                                <option value="" selected disabled>Primero seleccione un estado</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <select class="form-select" id="ciudad" name="ciudad" disabled required>
                                <option value="" selected disabled>Primero seleccione un municipio</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" id="direccion_detalle" name="direccion_detalle" required
                                   placeholder="Calle, avenida, sector, urbanización, casa/apartamento">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               placeholder="Ej: cliente@example.com">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script para habilitar/deshabilitar el campo Razón Social -->
<script>
    document.getElementById('tiene_razon_social').addEventListener('change', function() {
        const razonSocialInput = document.getElementById('razon_social');
        razonSocialInput.disabled = !this.checked;
        if (!this.checked) razonSocialInput.value = ''; // Limpiar si se desmarca
    });
</script>
<script src="vista/js/ubicacion.js"></script>
<?php require_once('vista/parcial/footer.php'); ?>