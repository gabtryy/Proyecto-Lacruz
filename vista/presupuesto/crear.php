<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Nuevo Presupuesto</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?c=presupuesto&m=guardar" method="POST">
                          
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    
                                    <label for="cliente_rif" class="form-label">Cliente</label>
                                    <select class="form-select" id="cliente_rif" name="rif_cliente" required>
                                        <option value="">Seleccione un cliente</option>
                                        <?php foreach ($clientes as $cliente): ?>                                            
                                        <option value="<?php echo $cliente['rif']; ?>">
                                            <?php echo htmlspecialchars($cliente['nombre_cliente']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                    
                                </div>
                                
                                
                                <div class="col-md-6">
                                <label for="orden_compra" class="form-label">Orden de compra</label>
                                <input type="text" class="form-control" id="orden_compra" name="orden_compra" value="0"
                                       >

                                       
                                </div>
                                
                            </div>
                            

                           
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Productos</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="btn-add-producto" >
                                        <i class="fas fa-plus"></i> Añadir Producto 
                                    </button>
                                </div>
                                <div id="lista-productos">
                                    
                                </div>
                            </div>

                           
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Servicios</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="btn-add-servicio">
                                        <i class="fas fa-plus"></i> Añadir Servicio
                                    </button>
                                </div>
                                
                                <div id="lista-servicios">
                                    
                                </div>
                            </div>

                            
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Total</span>
                                        <input type="text" class="form-control fw-bold" id="total" name="total" 
                                               value="0.00" readonly>
                                        <span class="input-group-text">Bs.</span>
                                    </div>
                                    <label for="cliente_rif" class="form-label">Forma de pago</label>
                                    <select class="form-select" id="forma_pago" name="forma_pago" required>
                                        <option value="">Seleccione una forma de pago:</option>
                                        <?php foreach ($formasPago as $pagos): ?>                                            
                                        <option value="<?php echo $pagos['id_forma_pago']; ?>">
                                            <?php echo htmlspecialchars($pagos['forma']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>  
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="index.php?action=presupuestos" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Presupuesto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<template id="template-producto">
    <div class="row item-producto mb-2">
        <div class="col-md-6">
            <select class="form-select producto-select" required>
                <option value="" selected disabled>Seleccione productos</option>
                <?php foreach($productos as $producto): ?>
                <option value="<?= $producto['id_producto'] ?>">
                    <?= htmlspecialchars($producto['nombre'])?> - <?= htmlspecialchars($producto['precio']) ?>.bs
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" class="form-control cantidad" min="1" value="1" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger btn-sm btn-remove">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>
<template id="template-servicio">
    <div class="row item-servicio mb-2">
        <div class="col-md-6">
            <select class="form-select servicio-select" required>
                <option value="" selected disabled>Seleccione servicio</option>
                <?php foreach($servicios as $servicio): ?>
                <option value="<?= $servicio['id_servicio'] ?>">
                    <?= htmlspecialchars($servicio['nombre'])?> - <?= htmlspecialchars($servicio['unidad_medida']) ?> - <?= htmlspecialchars($servicio['precio_base']) ?>.bs
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" class="form-control cantidad" min="1" value="1" required>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger btn-sm btn-remove">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>
</template>


<script>
document.addEventListener('DOMContentLoaded', function() {
    let servicioCounter = 0;
    let productoCounter = 0;

    document.getElementById('btn-add-servicio').addEventListener('click', function() {
        const template = document.getElementById('template-servicio');
        const clone = template.content.cloneNode(true);

        // Asigna nombres únicos a los inputs de este servicio
        const select = clone.querySelector('.servicio-select');
        const cantidad = clone.querySelector('.cantidad');

        select.setAttribute('name', `servicios[${servicioCounter}][id_servicio]`);
        cantidad.setAttribute('name', `servicios[${servicioCounter}][cantidad]`);

        document.getElementById('lista-servicios').appendChild(clone);
        servicioCounter++;
    });
    document.getElementById('btn-add-producto').addEventListener('click', function() {
        const template = document.getElementById('template-producto');
        const clone = template.content.cloneNode(true);

        // Asigna nombres únicos a los inputs de este producto
        const select = clone.querySelector('.producto-select');
        const cantidad = clone.querySelector('.cantidad');

        select.setAttribute('name', `producto[${productoCounter}][id_producto]`);
        cantidad.setAttribute('name', `producto[${productoCounter}][cantidad]`);

        document.getElementById('lista-productos').appendChild(clone);
        productoCounter++;
    });
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove')) {
            const itemServicio = e.target.closest('.item-servicio');
            const itemProducto = e.target.closest('.item-producto');
            if (itemServicio) {
                itemServicio.remove();
            } else if (itemProducto) {
                itemProducto.remove();
            }
        }
    });

    // Agrega un servicio por defecto
    document.getElementById('btn-add-servicio').click();
});
</script>

<?php require_once('vista/parcial/footer.php'); ?>