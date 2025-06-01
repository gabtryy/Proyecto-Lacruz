<?php
session_start();
include_once('app/database.php');
include_once('models/Mlogin.php');
include_once('controladores/login.php');
include_once('controladores/clienteControlador.php');
include_once('controladores/ServicioControlador.php');
include_once('controladores/usuarioControlador.php');
include_once('controladores/provedorControlador.php');



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
        listarCliente();
        break;
    case 'clientes_info':
        require_once 'vistas/clientes/cliente_info.php';
        break;
    case 'registrar_cliente':
        if (isset($_POST['rif']) && isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['direccion'])) {
           crearCliente($_POST['rif'], $_POST['nombre'], $_POST['telefono'], $_POST['email'], $_POST['direccion']);

           header('Location: index.php?action=clientes');

           exit;
        }
        require_once 'vistas/clientes/cliente_registro.php';
        break;
    case 'editarcliente':
         if (isset($_GET['rif'])) {
              $cliente = obtenerCliente($_GET['rif']);
            if (isset($_POST['rif']) && isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['direccion'])) {
                actualizarCliente($_GET['rif'], $_POST['nombre'], $_POST['telefono'], $_POST['email'], $_POST['direccion']);
                header('Location: index.php?action=clientes');
                exit;
            }
          
            require_once 'vistas/clientes/cliente_editar.php'; 
        }
    case 'eliminarC':
        if (isset($_GET['rif'])) {
            eliminarCliente($_GET['rif']);
            $_SESSION['message'] = 'Registro eliminado sastisfactoriamente';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php?action=clientes');
            exit;
        }
        break;
    
        case 'editarServicio':
        if (isset($_GET['id_servicio'])){
        $servicio = obtenerServicio($_GET['id_servicio']); 
            if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio_hora'])) {
                actualizarServicio($_GET['id_servicio'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio_hora']);
                $_SESSION['message'] = 'Registro editado sastisfactoriamente';
            $_SESSION['message_type'] = 'primary';
                header('Location: index.php?action=servicios');
                exit;
            }
            require_once 'vistas/servicios/editar.php';
        }
        break;

    case 'presupuesto':
        require_once 'vistas/presupuesto/registro.php';
        break;
    case 'servicios':
        require_once 'vistas/servicios/servicios.php';
        $servicio = listarServicio();
        break;
    case 'servicios_registro':
        require_once 'vistas/servicios/registro.php';
        break;
    case 'factura':
         require_once 'vistas/factura/factura.php';
        break;
    case 'producto':
         require_once 'vistas/producto/producto.php';
        break;
    case 'producto_registro':
         require_once 'vistas/producto/producto_registro.php';
        break;
    case 'provedores':
        $provedor = listarProvedor();
        require_once 'vistas/provedores/provedores.php';
        break; 
    case 'provedores_registro':
             if (isset($_POST['rif']) && isset($_POST['nombre']) && isset($_POST['telefono']) && isset($_POST['email'])) {
            crearProvedor($_POST['rif'],$_POST['nombre'], $_POST['telefono'], $_POST['email']);
            $_SESSION['message'] = 'Registro guardado sastisfactoriamente';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php?action=provedores');
            exit;
        }
        require_once 'vistas/provedores/provedores_registro.php';
        break;
    case 'eliminarP':
          if (isset($_GET['rif'])) {
            eliminarProvedor($_GET['rif']);
            $_SESSION['message'] = 'Registro eliminado sastisfactoriamente';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php?action=provedores');
            exit;
        }
        break;    
    case 'materia':
        require_once 'vistas/materia/materia.php';
        break;
    case 'materia_registro':
        require_once 'vistas/materia/materia_registro.php';
        break;                                
    case 'usuarios':
        $usuarios = listarU();
        require_once 'vistas/usuarios/usuario.php';
        break;


    case 'crearServicio':
        if (isset($_POST['nombre']) && isset($_POST['descripcion'])&& isset($_POST['precio_hora'])) {
            crearServicio($_POST['nombre'],$_POST['descripcion'], $_POST['precio_hora']);
            $_SESSION['message'] = 'Registro guardado sastisfactoriamente';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php?action=servicios');
            exit;
        }
        require_once 'vistas/servicios/registro.php';
        break;


    case 'eliminarServicio':
        if (isset($_GET['id_servicio'])) {
            eliminarServicio($_GET['id_servicio']);
            $_SESSION['message'] = 'Registro eliminado sastisfactoriamente';
            $_SESSION['message_type'] = 'success';
            header('Location: index.php?action=servicios');
            exit;
        }
        break;
       case 'crearusuario':
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password1'])) {
            crearusuario($_POST['nombre'], $_POST['email'], $_POST['password1'] );
            header('Location: index.php?action=usuarios');
            exit;
        }
        require_once 'vistas/usuarios/registro.php';
        break;

    case 'editarU':
        if (isset($_GET['id'])){
        $usuario = obtenerusuario($_GET['id']); 
            if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password1'])) {
                actualizarusuario($_GET['id'], $_POST['nombre'], $_POST['email'], $_POST['password1']);
                $_SESSION['message'] = 'Registro editado sastisfactoriamente';
            $_SESSION['message_type'] = 'primary';
                header('Location: index.php?action=usuarios');
                exit;
            }
            require_once 'vistas/usuarios/editarU.php';
        }
        break;

    case 'eli':
        if (isset($_GET['id'])) {
            eliminarusuario($_GET['id']);
            header('Location: index.php?action=usuarios');
            exit;
        }
        require_once 'vistas/usuarios/usuario.php';
        break;
        
    default:
        # code...
        break;
}



// Manejar cierre de sesión
if(isset($_POST['btn-cerrar'])) {
    
}


if (!isset($_SESSION['user_id'])) {
    
    exit;
}




// Manejar cierre de sesión
if(isset($_POST['btn-cerrar'])) {
    
}


if (!isset($_SESSION['user_id'])) {
    
    exit;
}