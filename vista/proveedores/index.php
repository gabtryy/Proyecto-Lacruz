<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Proveedores</h2>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearProveedorModal">
                    <i class="fas fa-plus-circle"></i> Registrar Proveedor
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
                                <th>Dirección</th>
                                <th>Nombre</th>
                                <th>Correo Electrónico</th>
                                <th>Contacto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proveedor as $pro): ?>
                            <tr>
                                <td><?= htmlspecialchars($pro['id_proveedores']) ?></td>
                                <td><?= htmlspecialchars($pro['estado']) ?> <?= htmlspecialchars($pro['municipio']) ?> <?= htmlspecialchars($pro['ciudad']) ?> <?= htmlspecialchars($pro['calle']) ?></td>
                                <td><?= htmlspecialchars($pro['nombre']) ?></td>
                                <td><?= htmlspecialchars($pro['correo']) ?></td>
                                <td><?= htmlspecialchars($pro['telefono']) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-editar-proveedor"
                                            data-id="<?= $pro['id_proveedores'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="index.php?c=proveedores&m=eliminarC&rif=<?= $pro['id_proveedores'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Desea eliminar este proveedor?');">
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

<!-- Modal Crear Proveedor -->
<div class="modal fade" id="crearProveedorModal" tabindex="-1" aria-labelledby="crearProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title text-white" id="crearProveedorModalLabel">
                    <i class="fas fa-user-plus me-2"></i> Registro de Nuevo Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="index.php?c=proveedores&m=guardar_proveedores" method="POST">
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
                                    <option value="<?= $estados['id_estado']; ?>"><?= $estados['nombre']; ?></option>
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
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               placeholder="Ej: proveedor@example.com">
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8f9fa;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Proveedor -->
<div class="modal fade" id="editarProveedorModal" tabindex="-1" aria-labelledby="editarProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title text-white" id="editarProveedorModalLabel">
                    <i class="fas fa-user-edit me-2"></i> Editar Proveedor
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="index.php?c=proveedores&m=actualizar_proveedor" method="POST" id="formEditarProveedor">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_proveedores" class="form-label">RIF</label>
                        <input type="text" class="form-control" id="id_proveedores" name="id_proveedores" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_editar" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_editar" name="nombre" required>
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
                                    <option value="<?= $estados['id_estado']; ?>"><?= $estados['nombre']; ?></option>
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

<script src="vista/js/ubicacion.js"></script>
<script src="vista/js/editarProveedor.js"></script>
<?php require_once('vista/parcial/footer.php'); ?>