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
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-image: linear-gradient(to bottom right,rgb(255, 255, 255), #8f94fb);
            min-height: 100vh;
            margin: 0;
            padding-top: 56px; /* Para el navbar fijo */
        }
        
        /* Navbar Fijo (igual que tu diseño) */
        .navbar {
            font-family: 'Arial', sans-serif;
            font-weight: 700; 
            font-style: italic;
            background-color: #f8f9fa;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.64);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        /* Botón de hamburguesa */
        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            margin-right: 15px;
            cursor: pointer;
            display: inline-block; /* Visible pero sin funcionalidad */
        }

        /* Sidebar Siempre Cerrado */
        .sidebar {
            width: 60px; /* Ancho reducido solo para íconos */
            background-color: rgba(248, 249, 250, 0.95);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            z-index: 1020;
            overflow-x: hidden;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 250px; /* Ancho original para evitar saltos */
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .sidebar-menu li a:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: rgb(55, 0, 255);
        }
        
        .sidebar-menu li a i {
            margin-right: 15px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }
        
        .sidebar-menu li a span {
            opacity: 0;
            width: 0;
            transition: opacity 0.3s ease;
        }

        /* Contenido principal ajustado */
        .main-content {
            margin-left: 60px; /* Margen para sidebar cerrado */
            padding: 20px;
        }

        /* Todos tus otros estilos se mantienen EXACTAMENTE IGUAL */
        .noselec {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        a {
            text-decoration: none;
        }
        .navbar-brand {
            color:rgb(55, 0, 255);
        }
        .dropdown-menu:hover {
            color:rgb(0, 128, 255);
        }
        .nav-link {
            color:rgb(0, 0, 0);
            border: none;
        }
        .tbc {
            font-family: 'Arial', 'sans-serif';
            font-weight: 600;
            color:rgb(255, 255, 255);
            border: none;
        }
        .tbc:hover {
            color:rgb(0, 255, 255);
        }
        .nav-link:hover {
            color:rgb(84, 153, 199);
        }
        .navbar-brand:hover {
            color:rgb(139, 216, 252);
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
        .table-transparent {
            background-color: transparent !important;
            border-collapse: collapse;
            width: 100%;
        }
        .table-transparent th,
        .table-transparent td {
            background-color: transparent !important;
            color: white;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding: 12px;
        }
        .table-transparent thead th {
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }
        .cardj {
            background-image: linear-gradient(to bottom right,rgb(0, 140, 255),rgba(0, 4, 255, 0.9));
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.64);
        }
        
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-60px);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar con botón de hamburguesa (sin funcionalidad) -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i> <!-- Icono de hamburguesa -->
            </button>
            <img src="vistas/images/logo2.png" style="width: 50px;" alt="logo">
            <a class="navbar-brand" href="index.php?action=home">J.Lacruz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=usuarios">Usuarios</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $URL; ?>/index.php?action=cerrar">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar (siempre cerrado) -->
    <div class="sidebar" id="sidebar">
        <nav>
            <ul class="sidebar-menu">
                <li>
                    <a href="index.php?action=home" title="Inicio">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=servicios" title="Servicios">
                        <i class="fas fa-tools"></i>
                        <span>Servicios</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=producto" title="Productos">
                        <i class="fas fa-box-open"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=clientes" title="Clientes">
                        <i class="fas fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?action=presupuesto" title="Presupuestos">
                        <i class="fas fa-calculator"></i>
                        <span>Presupuestos</span>
                    </a>
                </li>
                 <li>
                    <a href="index.php?action=factura" title="factura">
                        <i class="fas fa-book"></i>
                        <span>factura</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
   
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script solo para tooltips (el botón no hace nada) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips para los íconos
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover',
                    placement: 'right'
                });
            });
        });
    </script>
</body>
</html>