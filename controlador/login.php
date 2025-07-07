<?php
require_once 'modelo/Usuario.php';

switch ($metodo) {
    case 'login':
        require 'vista/login.php';
        break;

    case 'validar':
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    

    $u = new Usuario();
$usuarioEncontrado = $u->buscarPorCredenciales($usuario);
$hash = $usuarioEncontrado['clave'];
echo "Clave ingresada: " . $usuarioEncontrado['clave']; 

if (password_verify($clave, $hash)) {
 
    $_SESSION['cedula'] = $usuarioEncontrado['cedula'];
    header("Location: index.php?c=login&m=home");
    exit;
} else {
    $error = "Usuario o clave incorrectos.";
    require 'vista/login.php';
}
    break;


    case 'logout':
        session_destroy();
        header("Location: index.php?c=login&m=login");
        break;

    case 'registro':
        require 'registro.php';
        break;

    case 'registrar':
        $usuario = $_POST['usuario'] ?? '';
        $clave   = $_POST['clave'] ?? '';
        $correo  = $_POST['correo'] ?? ''; // Asegúrese de tener este campo en su formulario

        if (empty($usuario) || empty($clave) || empty($correo)) {
            $error = "Todos los campos son obligatorios.";
            require 'registro.php';
            exit;
        }

        $u = new Usuario();
        $exito = $u->registrar($usuario, $clave, $correo);

        if ($exito) {
            $mensaje = "Usuario registrado correctamente. Ahora puede iniciar sesión.";
            require 'vista/login.php';
        } else {
            $error = "No se pudo registrar el usuario.";
            require 'vista/registro.php';
        }
        break;
    case 'home':
        require 'vista/parcial/home.php';
        break;
    default:
        echo "Acción no válida.";
        break;
}
