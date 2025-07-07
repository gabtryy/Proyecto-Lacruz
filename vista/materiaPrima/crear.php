<div class="modal fade" id="registrarMateriaModal" tabindex="-1" aria-labelledby="registrarMateriaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title" id="registrarMateriaModalLabel">
                    <i class="fas fa-tools me-2"></i> Registrar Nueva Materia Prima
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="index.php?c=MateriaPrimaControlador&m=guardar" method="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label">Nombre de la Materia Prima</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-12">
                            <label for="medida" class="form-label">Medida de la Materia Prima</label>
                            <input type="text" class="form-control" id="medida" name="medida" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="proveedores" class="form-label">Proveedor</label>
                            <select class="form-select" id="proveedores" name="id_proveedores" required>
                                <option value="" selected disabled>Seleccione un proveedor</option>
                                <?php foreach ($proveedores as $proveedor): ?>
                                <option value="<?= $proveedor['id_proveedores'] ?>">
                                <?= htmlspecialchars($proveedor['nombre_provedor']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock</label>
                            <div class="input-group">
                                <input type="number" step="0" min="0" class="form-control" id="stock" name="stock" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer" style="background-color: #f8f9fa;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #4e54c8, #8f94fb); border: none;">
                        <i class="fas fa-save me-2"></i> Guardar Materia Prima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>