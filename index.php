<?php
session_start();
include_once('app/database.php');
include_once('models/Mlogin.php');
include_once('controladores/login.php');

$loginControl = new usuario();

$action = isset($_GET['action']) ? $_GET['action']:'login';    

// Verificar si ya está logueado

switch ($action) {
    case 'login':
        if (isset($_SESSION['user_id'])) {
    
    require_once 'vistas/inicio.php';
    exit;
}
$loginControl->MostrarLogin();
    break;
    case 'entrar':
        if(isset($_POST['email']) && isset($_POST['password']))
        {
            loginC($_POST['email'], $_POST['password']);
        }
        break;
    case 'home':
        require_once 'vistas/inicio.php';
        break;
    case 'cerrar':
        cerrar();
        break;
    case 'clientes':
        require_once 'vistas/clientes/cliente.php';
        break;
    case 'clientes_info':
        require_once 'vistas/clientes/cliente_info.php';
        break;
    case 'registrar_cliente':
        require_once 'vistas/clientes/cliente_registro.php';
        break;
    case 'presupuesto':
        require_once 'vistas/presupuesto/registro.php';
        break;
    case 'servicios':
        require_once 'vistas/servicios/servicios.php';
        break;
    case 'servicios_registro':
        require_once 'vistas/servicios/registro.php';
        break;        
    case 'usuarios':
        $usuarios = listarU();
        require_once 'vistas/usuarios/usuario.php';
        break;    
    default:
        # code...
        break;
}



// Manejar cierre de sesión
if(isset($_POST['btn-cerrar'])) {
    
}

// Mostrar login si no está autenticado
if (!isset($_SESSION['user_id'])) {
    
    exit;
}