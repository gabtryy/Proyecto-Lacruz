
<?php
require_once('header.php');
?>

<div class="container py-5">
        <h2 class="text-center mb-5">Gestion de servicios</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <a href="<?php echo $URL; ?>/index.php?action=clientes" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vistas/images/clients.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">añade o gestiona clientes</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                 <a href="<?php echo $URL; ?>/index.php?action=presupuesto" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vistas/images/money.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Presupuesto</h5>
                        <p class="card-text">calcula el presupuesto del servicio</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="index.php?action=servicios" style="text-decoration: none; color: inherit;">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vistas/images/service.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Servicio</h5>
                        <p class="card-text">añade, elimina, o gestiona un servicio</p>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="index.php?action=factura" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vistas/images/bill.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">facturacion</h5>
                        <p class="card-text">crea y calcula la factura de un servicio</p>
                    </div>
                </div>
                </a>
            </div>
               <div class="col-md-4">
                <a href="index.php?action=producto" style="text-decoration: none; color: inherit;">
                <div class="card step-card ">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="vistas/images/producto.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">producto</h5>
                        <p class="card-text">crea y calcula la factura de un servicio</p>
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
