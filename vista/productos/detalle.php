<div class="modal fade" id="detalleMateriasModal" tabindex="-1" aria-labelledby="detalleMateriasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #0d6efd, #0b5ed7);">
                <h5 class="modal-title" id="detalleMateriasModalLabel">
                    <i class="fas fa-boxes me-2"></i> Detalle de Materias Primas
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0" id="nombreProductoDetalle"></h4>
                    <span class="badge bg-primary" id="fabricadoBadge">Fabricado</span>
                </div>
                
                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle" id="tablaMateriasDetalle">
                        <thead class="table-primary">
                            <tr>
                                <th>Materia Prima</th>
                                <th>Cantidad</th>
                                <th>Unidad de Medida</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     $(document).ready(function() {
    $(document).on('click', '.btn-detalle', function() {
        const idProducto = $(this).data('id');
        const modal = new bootstrap.Modal(document.getElementById('detalleMateriasModal'));
        
        $('#tablaMateriasDetalle tbody').html(`
            <tr>
                <td colspan="4" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </td>
            </tr>
        `);
        
        modal.show();
        
        $.ajax({
            url: 'index.php?c=ProductoControlador&m=editar&id=' + idProducto,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.producto) {
                    const producto = response.producto;
                    
                    $('#nombreProductoDetalle').text(producto.nombre);
                    
                    if (!producto.es_fabricado) {
                        $('#fabricadoBadge').hide();
                    } else {
                        $('#fabricadoBadge').show();
                    }
                    
                    if (response.materiasProducto && response.materiasProducto.length > 0) {
                        let html = '';
                        response.materiasProducto.forEach(function(materia) {
                            html += `
                                <tr>
                                    <td>${materia.materia_prima}</td>
                                    <td>${parseFloat(materia.cantidad).toFixed(3)}</td>
                                    <td>${materia.medida}</td>
                                </tr>
                            `;
                        });
                        $('#tablaMateriasDetalle tbody').html(html);
                    } else {
                        $('#tablaMateriasDetalle tbody').html(`
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-2"></i> 
                                    Este producto no utiliza materias primas registradas
                                </td>
                            </tr>
                        `);
                    }
                } else {
                    $('#tablaMateriasDetalle tbody').html(`
                        <tr>
                            <td colspan="4" class="text-center text-danger py-4">
                                <i class="fas fa-exclamation-triangle me-2"></i> 
                                Error al cargar los detalles del producto
                            </td>
                        </tr>
                    `);
                }
            },
            error: function() {
                $('#tablaMateriasDetalle tbody').html(`
                    <tr>
                        <td colspan="4" class="text-center text-danger py-4">
                            <i class="fas fa-exclamation-triangle me-2"></i> 
                            Error al cargar los detalles del producto
                        </td>
                    </tr>
                `);
            }
        });
    });

    $('#detalleMateriasModal').on('hidden.bs.modal', function () {
        $('#tablaMateriasDetalle tbody').empty();
        $('#nombreProductoDetalle').empty();
        $('#fabricadoBadge').show();
    });
});
</script>