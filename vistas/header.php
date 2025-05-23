<?php

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
        .noselec {
       user-select: none; /* Bloquea la selección de texto */
    -webkit-user-select: none; /* Para navegadores basados en WebKit (Chrome, Safari) */
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
}
        a {
        text-decoration: none; /* Elimina el subrayado */
        }
          .table-transparent {
        background-color: transparent !important;
        border-collapse: collapse;
        width: 100%;
        }
  
        .table-transparent th,
        .table-transparent td {
        background-color: transparent !important;
        color: white; /* Cambia este color según tu diseño */
        border-bottom: 2px solid rgba(255, 255, 255, 0.1); /* Líneas divisorias */
        padding: 12px;
        }
  
        .table-transparent thead th {
        border-bottom: 2px solid rgba(255, 255, 255, 0.2); /* Línea más gruesa para el encabezado */
        }
        .cardj {
            background-image: linear-gradient(to bottom right,rgb(0, 140, 255),rgba(0, 4, 255, 0.9));
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.64);
        
        }
        
        .card {
           cursor: pointer; /* Mano al pasar el ratón */
           user-select: none;
        }
        .navbar {
          font-family: 'Arial', sans-serif;
          font-weight: 700; 
          font-style: italic;
            background-image: linear-gradient(rgb(76, 255, 255),rgb(129, 135, 255)); /* Fondo blanco para la tarjeta */
             box-shadow: 0 8px 16px rgba(0, 0, 0, 0.64); 
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
        .tbc {
          font-family: 'Arial', 'sans-serif';
          font-weight: 600;
          color:rgb(255, 255, 255); /* Color azul para el botón */
          border: none;
          
          
        }
        .tbc:hover {
          
            color:rgb(0, 255, 255); /* Color azul para el botón */
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
    <a class="navbar-brand" href="index.php?action=home">J.Lacruz</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=usuarios">Usuarios</a>
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
          <a class="nav-link" href="<?php echo $URL; ?>/index.php?action=cerrar">cerrar sesion</a>
        </li>
       
      </ul>
      
    </div>
  </div>
</nav>