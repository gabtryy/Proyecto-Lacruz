<?php require_once('vista/parcial/header.php'); ?>

<div class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Gestión de Clientes</h2>
            </div>
            <div class="col-md-6 text-end" >
                <a href="index.php?c=clientes&m=crear" class="p-btn">
                    <i class="fas fa-plus-circle"></i> Nuevo Cliente
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                            <tr>
                                <th>RIF</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cliente 1 -->
                            <tr>
                                <td>J-123456789</td>
                                <td>12345678</td>
                                <td>Juan Pérez</td>
                                <td>Av. Principal, Caracas</td>
                                <td>04121234567</td>
                                <td>juan@example.com</td>
                                <td>15/03/2023</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Cliente 2 -->
                            <tr>
                                <td>V-987654321</td>
                                <td>87654321</td>
                                <td>María González</td>
                                <td>Calle Libertad, Valencia</td>
                                <td>04241234567</td>
                                <td>maria@example.com</td>
                                <td>22/05/2023</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Cliente 3 -->
                            <tr>
                                <td>E-456789123</td>
                                <td>45678912</td>
                                <td>Carlos Rodríguez</td>
                                <td>Urb. Las Acacias, Maracaibo</td>
                                <td>04161234567</td>
                                <td>carlos@example.com</td>
                                <td>10/01/2024</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Cliente 4 -->
                            <tr>
                                <td>G-789123456</td>
                                <td>78912345</td>
                                <td>Ana López</td>
                                <td>Av. Bolívar, Barquisimeto</td>
                                <td>04261234567</td>
                                <td>ana@example.com</td>
                                <td>05/02/2024</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Cliente 5 -->
                            <tr>
                                <td>J-321654987</td>
                                <td>32165498</td>
                                <td>Pedro Martínez</td>
                                <td>Urbanización El Recreo, Mérida</td>
                                <td>04141234567</td>
                                <td>pedro@example.com</td>
                                <td>18/04/2024</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-info btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Función de ejemplo para eliminar
    function confirmarEliminar() {
        return confirm('¿Está seguro que desea eliminar este cliente?');
    }
    
    // Asignar evento a los botones de eliminar
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', confirmarEliminar);
    });
</script>

<?php require_once('vista/parcial/footer.php'); ?>