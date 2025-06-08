<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Registro de Nuevo Cliente</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=guardar_cliente" method="POST">
                            <!-- Campo RIF -->
                            <div class="mb-3">
                                <label for="rif" class="form-label">RIF</label>
                                <div class="input-group">
                                    <select class="form-select" id="rif_prefix" name="rif_prefix" style="max-width: 80px;">
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                        <option value="J" selected>J</option>
                                        <option value="G">G</option>
                                        <option value="P">P</option>
                                    </select>
                                    <span class="input-group-text">-</span>
                                    <input type="number" class="form-control" id="rif" name="rif" required 
                                           placeholder="Ej: 12345678" min="1000000" max="999999999">
                                </div>
                            </div>

                            <!-- Campo Cédula -->
                            <div class="mb-3">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="number" class="form-control" id="cedula" name="cedula" required
                                       placeholder="Ej: 12345678" min="1000000" max="99999999">
                            </div>

                            <!-- Campo Nombre -->
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                       placeholder="Ej: Juan Pérez">
                            </div>

                            <!-- Campo Teléfono -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required
                                       placeholder="Ej: 04121234567" min="1000000" max="999999999999">
                            </div>

                            <!-- Campo Dirección (Select) -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <select class="form-select" id="direccion" name="direccion" required>
                                    <option value="" selected disabled>Seleccione una dirección</option>
                                    <option value="Av. Principal, Caracas">Av. Principal, Caracas</option>
                                    <option value="Calle Libertad, Valencia">Calle Libertad, Valencia</option>
                                    <option value="Urb. Las Acacias, Maracaibo">Urb. Las Acacias, Maracaibo</option>
                                    <option value="Av. Bolívar, Barquisimeto">Av. Bolívar, Barquisimeto</option>
                                    <option value="Urbanización El Recreo, Mérida">Urbanización El Recreo, Mérida</option>
                                    <option value="Otra">Otra (especificar en observaciones)</option>
                                </select>
                            </div>

                            <!-- Campo Correo -->
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required
                                       placeholder="Ej: cliente@example.com">
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php?c=clientes&m=index" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="p-btn">
                                    <i class="fas fa-save"></i> Guardar Cliente
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