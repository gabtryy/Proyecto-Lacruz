<?php
require_once('header.php');
?>

<div class="container py-5">
        <h2 class="text-center mb-5">Bienvenido!</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <a href="index.php?c=clientes&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/clients.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">Añade o gestiona clientes</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                 <a href="index.php?c=presupuesto&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/money.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Presupuesto</h5>
                        <p class="card-text">Calcula el presupuesto del servicio</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="index.php?c=ServicioControlador&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/service.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Servicio</h5>
                        <p class="card-text">Añade, elimina, o gestiona un servicio</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="index.php?c=factura&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/bill.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Facturación</h5>
                        <p class="card-text">Crea y calcula la factura de un servicio</p>
                    </div>
                </div>
                </a>
            </div>
               <div class="col-md-4">
                <a href="index.php?c=ProductoControlador&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/producto.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Producto</h5>
                        <p class="card-text">Registra, consulta, actualiza y elimina productos de la empresa</p>
                    </div>
                </div>
                </a>
            </div>
                <div class="col-md-4">
                <a href="index.php?c=MateriaPrimaControlador&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/materia_prima.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Materia prima</h5>
                        <p class="card-text">Registra, consulta, actualiza y elimina la materia prima de la empresa</p>
                    </div>
                </div>
                </a>
            </div>
                <div class="col-md-4">
                <a href="index.php?c=proveedores&m=index" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vista/images/proveedor.png" width="50" height="50" />
                        </div>
                        <h5 class="card-title">Proveedores</h5>
                        <p class="card-text">Registra, consulta, actualiza y elimina los proveedores de la empresa</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
        
        
    </div>



    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
