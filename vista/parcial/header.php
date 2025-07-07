<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J.Lacruz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/proyecto-lacruz-j/vista/css/header.css">
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg noselec">
        <div class="container-fluid">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <img src="vista/images/logo2.png" class="navbar-logo" alt="logo">
            <a class="navbar-brand" href="index.php?c=login&m=home">J.Lacruz</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?c=usuario&m=index">Usuarios</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="logout-btn" href="index.php?c=login&m=logout">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar noselec" id="sidebar">
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
                    <a href="index.php?action=factura" title="Facturas">
                        <i class="fas fa-file-invoice"></i>
                        <span>Facturas</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
        <script>
    // Control del sidebar

</script>
    <!-- Contenedor principal donde se inyectará el contenido -->
    <div class="main-content" id="mainContent">



