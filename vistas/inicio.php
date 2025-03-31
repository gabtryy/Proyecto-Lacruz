
<?php
session_start();
if (!isset($_SESSION['user_email']))
{
    header('Location: ../login.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
                /* Fondo con degradado */
            background-image: linear-gradient(to bottom right,rgb(255, 255, 255), #8f94fb);
            min-height: 100vh; /* Asegura que el degradado cubra toda la pantalla */
          
           
        }
        .navbar {
            background-color:   rgb(56, 165, 255); /* Fondo blanco para la tarjeta */
            
        }
        .navbar-brand {
            color:rgb(55, 0, 255);
            
        }
        .dropdown-menu:hover {
           color: #e9ecef; /* Mantener el fondo gris al enfocar */
           
        }
        .nav-link {
            color:rgb(0, 0, 0); /* Color azul para el botón */
            border: none;
        }
        .nav-link:hover {
            color:rgb(255, 255, 255); /* Color azul para el botón */
            border: none;
        }
        .navbar-brand:hover {
            color:rgb(255, 255, 255); /* Color azul más oscuro al pasar el mouse */
        }
        .step-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
        .step-card {
            height: 100%;
            transition: all 0.3s ease;
        }
        .step-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>

<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">J.Laracruz</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Usuarios</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Clientes</a></li>
            <li><a class="dropdown-item" href="#">Presupuesto</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Servicios</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../controladores/cerrar.php">cerrar sesion</a>
        </li>
       
      </ul>
      
    </div>
  </div>
</nav>

<div class="container py-5">
        <h2 class="text-center mb-5">Gestion de servicios</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="images/clients.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">añade o gestiona clientes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="images/money.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Presupuesto</h5>
                        <p class="card-text">calcula el presupuesto del servicio</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="images/box.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">Servicio</h5>
                        <p class="card-text">añade, elimina, o gestiona un servicio</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card step-card">
                    <div class="card-body text-center">
                        <div class="step-icon mx-auto">
                        <img src="images/bill.png"   width="50" height="50" />
                        </div>
                        <h5 class="card-title">facturacion</h5>
                        <p class="card-text">crea y calcula la factura de un servicio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>