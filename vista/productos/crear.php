<div class="modal fade" id="registrarProductoModal" tabindex="-1" aria-labelledby="registrarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title" id="registrarProductoModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Registrar Nuevo Producto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="index.php?c=ProductoControlador&m=guardar" method="POST" id="formCrearProducto">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-4">
                            <label for="stock" class="form-label">Stock Inicial</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" value="0">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio Unitario</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="precio_mayor" class="form-label">Precio al por Mayor</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0" class="form-control" id="precio_mayor" name="precio_mayor" required>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                            <select class="form-select" id="unidad_medida" name="unidades_medida_producto_id" required>
                                <option value="" selected disabled>Seleccione una unidad</option>
                                <?php foreach ($unidades as $unidad): ?>
                                    <option value="<?= $unidad['unidades_medida_producto_id'] ?>">
                                        <?= htmlspecialchars($unidad['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="es_fabricado" name="es_fabricado" value="1">
                                <label class="form-check-label" for="es_fabricado">
                                    <i class="fas fa-industry me-1"></i> Producto fabricado en la empresa
                                </label>
                            </div>
                        </div>
                
                        <div class="col-md-12" id="materiasPrimasSection" style="display: none;">
                            <div class="card border-primary mt-3">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-boxes me-2"></i> Materias Primas Utilizadas
                                </div>
                                <div class="card-body">
                                    <div id="materiasPrimasContainer">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-3" id="btnAgregarMateria">
                                        <i class="fas fa-plus-circle me-1"></i> Añadir Materia Prima
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    let materiaCounter = 0;
    const materiasPrimas = <?= json_encode($materiasPrimas) ?? '[]' ?>;
    
    $(document).on('change', '#es_fabricado', function() {
        const isChecked = $(this).is(':checked');
        
        $('#materiasPrimasSection').toggle(isChecked);
        

        $('#btnAgregarMateria').prop('disabled', !isChecked);
        

        if (isChecked && $('#materiasPrimasContainer').children().length === 0) {
            agregarMateriaPrima();
        }
        

        if (!isChecked) {
            $('#materiasPrimasContainer').empty();
            materiaCounter = 0;
        }
    });
    
    function agregarMateriaPrima() {
    const contenedor = $('#materiasPrimasContainer');
    const nuevoId = materiaCounter++;
    
    const html = `
        <div class="row g-3 mb-3 materia-prima-item border-bottom pb-3" data-id="${nuevoId}">
            <div class="col-md-6">
                <label class="form-label">Materia Prima</label>
                <select class="form-select" name="materias[${nuevoId}][id_materia]" required>
                    <option value="" selected disabled>Seleccione una materia prima</option>
                    ${generarOpcionesMaterias()}
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cantidad</label>
                <!-- CORRECCIÓN: Agregar placeholder para formato decimal -->
                <input type="number" step="0.001" min="0.001" class="form-control" 
                       name="materias[${nuevoId}][cantidad]" required
                       placeholder="0.000">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-eliminar-materia w-100">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    `;
    
    contenedor.append(html);
}

    function generarOpcionesMaterias() {
        let options = '';
        if (materiasPrimas && materiasPrimas.length > 0) {
            materiasPrimas.forEach(materia => {
                options += `<option value="${materia.id_materia}">
                              ${materia.nombre} (${materia.medida})
                           </option>`;
            });
        } else {
            options = '<option value="">No hay materias primas disponibles</option>';
        }
        return options;
    }
    
    $('#btnAgregarMateria').click(agregarMateriaPrima);

    $(document).on('click', '.btn-eliminar-materia', function() {
        $(this).closest('.materia-prima-item').fadeOut(300, function() {
            $(this).remove();
        });
    });
    

    $('#formCrearProducto').submit(function(e) {
    const esFabricado = $('#es_fabricado').is(':checked');
    const tieneMaterias = $('#materiasPrimasContainer').children().length > 0;
    
    if (esFabricado && !tieneMaterias) {
        e.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Materias Primas Requeridas',
            text: 'Debe agregar al menos una materia prima para productos fabricados',
        });
        return false;
    }
    
    if (esFabricado) {
        let materiasValidas = true;
        $('.materia-prima-item').each(function() {
            const idMateria = $(this).find('select').val();
            const cantidad = parseFloat($(this).find('input[type="number"]').val());
            
            if (!idMateria) {
                $(this).find('select').addClass('is-invalid');
                materiasValidas = false;
            } else {
                $(this).find('select').removeClass('is-invalid');
            }
            
            if (isNaN(cantidad) || cantidad <= 0) {
                $(this).find('input[type="number"]').addClass('is-invalid');
                materiasValidas = false;
            } else {
                $(this).find('input[type="number"]').removeClass('is-invalid');
            }
        });
        
        if (!materiasValidas) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error en Materias Primas',
                text: 'Por favor complete todos los campos de materias primas correctamente',
            });
            return false;
        }
    }
    
    return true;
});
});
</script>