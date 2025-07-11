<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #4e54c8, #8f94fb);">
                <h5 class="modal-title" id="editarProductoModalLabel">
                    <i class="fas fa-edit me-2"></i> Editar Producto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="index.php?c=ProductoControlador&m=actualizar" method="POST" id="formEditarProducto">
                <input type="hidden" id="id_producto" name="id_producto">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="edit_nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                        </div>

                        <div class="col-md-4">
                            <label for="edit_stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="edit_stock" name="stock" min="0">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="edit_precio" class="form-label">Precio Unitario</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0" class="form-control" id="edit_precio" name="precio" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="edit_precio_mayor" class="form-label">Precio al por Mayor</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0" class="form-control" id="edit_precio_mayor" name="precio_mayor" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="edit_unidad_medida" class="form-label">Unidad de Medida</label>
                            <select class="form-select" id="edit_unidad_medida" name="unidades_medida_producto_id" required>
                                <option value="" disabled>Seleccione una unidad</option>
                                <?php foreach ($unidades as $unidad): ?>
                                <option value="<?= $unidad['unidades_medida_producto_id'] ?>">
                                <?= htmlspecialchars($unidad['nombre']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_es_fabricado" name="es_fabricado" value="1">
                                <label class="form-check-label" for="edit_es_fabricado">
                                    <i class="fas fa-industry me-1"></i> Producto fabricado en la empresa
                                </label>
                            </div>
                        </div>
                
                        <div class="col-md-12" id="edit_materiasPrimasSection" style="display: none;">
                            <div class="card border-primary mt-3">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-boxes me-2"></i> Materias Primas Utilizadas
                                </div>
                                <div class="card-body">
                                    <div id="edit_materiasPrimasContainer">
                                
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-3" id="btnEditAgregarMateria">
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
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let editMateriaCounter = 0;
    const materiasPrimas = window.materiasPrimasGlobal || [];
    
    // Función para agregar materia prima (para edición)
    function agregarMateriaPrimaEdicion(materiaExistente = null) {
        const contenedor = $('#edit_materiasPrimasContainer');
        const nuevoId = editMateriaCounter++;
        
        const html = `
            <div class="row g-3 mb-3 materia-prima-item border-bottom pb-3" data-id="${nuevoId}">
                <input type="hidden" name="materias[${nuevoId}][id_promat]" value="${materiaExistente ? materiaExistente.id_promat : ''}">
                <div class="col-md-6">
                    <label class="form-label">Materia Prima</label>
                    <select class="form-select" name="materias[${nuevoId}][id_materia]" required>
                        <option value="" selected disabled>Seleccione una materia prima</option>
                        ${generarOpcionesMaterias(materiaExistente ? materiaExistente.id_materia : null)}
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cantidad</label>
                    <input type="number" step="0.001" min="0.001" class="form-control" 
                           name="materias[${nuevoId}][cantidad]" required
                           value="${materiaExistente ? materiaExistente.cantidad : ''}"
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
    
    // Generar opciones para el select de materias primas
    function generarOpcionesMaterias(selectedId = null) {
        let options = '';
        if (materiasPrimas && materiasPrimas.length > 0) {
            materiasPrimas.forEach(materia => {
                const selected = selectedId == materia.id_materia ? 'selected' : '';
                options += `<option value="${materia.id_materia}" ${selected}>
                              ${materia.nombre} (${materia.medida})
                           </option>`;
            });
        } else {
            options = '<option value="">No hay materias primas disponibles</option>';
        }
        return options;
    }
    
    // Manejar el cambio en el checkbox de fabricado
    $(document).on('change', '#edit_es_fabricado', function() {
        const isChecked = $(this).is(':checked');
        $('#edit_materiasPrimasSection').toggle(isChecked);
        $('#btnEditAgregarMateria').prop('disabled', !isChecked);
        
        if (isChecked && $('#edit_materiasPrimasContainer').children().length === 0) {
            agregarMateriaPrimaEdicion();
        }
        
        if (!isChecked) {
            $('#edit_materiasPrimasContainer').empty();
            editMateriaCounter = 0;
        }
    });
    
    // Botón para agregar nueva materia prima
    $('#btnEditAgregarMateria').click(function() {
        agregarMateriaPrimaEdicion();
    });
    
    // Eliminar materia prima
    $(document).on('click', '.btn-eliminar-materia', function() {
        $(this).closest('.materia-prima-item').fadeOut(300, function() {
            $(this).remove();
        });
    });
    
    // Validación del formulario
    $('#formEditarProducto').submit(function(e) {
        const esFabricado = $('#edit_es_fabricado').is(':checked');
        const tieneMaterias = $('#edit_materiasPrimasContainer').children().length > 0;
        
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

    // Evento para editar producto
    $(document).on('click', '.btn-editar', function() {
        const idProducto = $(this).val();
        
        $.ajax({
            url: 'index.php?c=ProductoControlador&m=editar&id=' + idProducto,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    Swal.fire('Error', response.error, 'error');
                    return;
                }
                
                console.log('Respuesta del servidor:', response);
                
                const producto = response.producto;
                const materiasProducto = response.materiasProducto || [];
                
                $('#id_producto').val(producto.id_producto);
                $('#edit_nombre').val(producto.nombre);
                $('#edit_stock').val(producto.stock);
                $('#edit_precio').val(parseFloat(producto.precio).toFixed(2));
                $('#edit_precio_mayor').val(parseFloat(producto.precio_mayor).toFixed(2));
                
                // Establecer la unidad de medida
                $('#edit_unidad_medida').val(producto.id_unidad_medida_producto);
                
                const esFabricado = producto.es_fabricado == 1;
                $('#edit_es_fabricado').prop('checked', esFabricado);
                $('#edit_materiasPrimasSection').toggle(esFabricado);
                $('#btnEditAgregarMateria').prop('disabled', !esFabricado);
                
                $('#edit_materiasPrimasContainer').empty();
                editMateriaCounter = 0;
                
                if (esFabricado) {
                    console.log('Materias primas del producto:', materiasProducto);
                    
                    if (materiasProducto.length > 0) {
                        materiasProducto.forEach(materia => {
                            console.log('Agregando materia prima:', materia);
                            agregarMateriaPrimaEdicion({
                                id_promat: materia.id_promat,
                                id_materia: materia.id_materia,
                                cantidad: materia.cantidad
                            });
                        });
                    } else {
                        agregarMateriaPrimaEdicion();
                    }
                }

                $('#editarProductoModal').modal('show');
            },
            error: function(xhr, status, error) {
                Swal.fire('Error', 'No se pudo cargar la información del producto', 'error');
                console.error(error);
            }
        });
    });
});
</script>
