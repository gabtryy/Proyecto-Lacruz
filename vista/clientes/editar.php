<div class="modal fade" id="editarClienteModal" tabindex="-1" aria-labelledby="editarClienteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title text-white" id="editarClienteModalLabel">
                    <i class="fas fa-user-edit me-2"></i> Editar Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="index.php?c=clientes&m=actualizar_cliente" method="POST" id="formEditarCliente">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rif_editar" class="form-label">RIF</label>
                        <input type="text" class="form-control" id="rif_editar" name="rif" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_editar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_editar" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_editar" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido_editar" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_editar" class="form-label">Teléfono</label>
                        <input type="number" class="form-control" id="telefono_editar" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <div class="mb-2">
                            <select class="form-select" id="estado_editar" name="estado" required>
                                <option value="">Seleccione un estado</option>
                                <?php foreach ($estado as $estados): ?>
                                    <option value="<?php echo $estados['id_estado']; ?>"><?php echo $estados['nombre']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <select class="form-select" id="municipio_editar" name="municipio" required disabled>
                                <option value="">Seleccione un municipio</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <select class="form-select" id="ciudad_editar" name="ciudad" required disabled>
                                <option value="">Seleccione una ciudad</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" id="direccion_detalle_editar" name="direccion_detalle" required
                                   placeholder="Calle, avenida, sector, urbanización, casa/apartamento">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email_editar" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email_editar" name="email" required>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="vista/js/editarCliente.js"></script>


