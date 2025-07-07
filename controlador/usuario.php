<?php
require_once 'modelo/Usuario.php';




$usuario = new Usuario();

switch ($metodo) {
    case 'index':
        
        $usuarios = $usuario->listar();
        require 'vista/usuario/index.php';
        break;

    case 'crear':
        $roles = $usuario->listarRol();
     
        require 'vista/usuario/crear.php';
        break;

    case 'guardar':
        $cedula = $_POST['cedula'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $correo = $_POST['email'] ?? '';
        $rol = $_POST['rol'] ?? '';
        $password  = $_POST['password'] ?? '';
        
        
        $clave = password_hash($password, PASSWORD_BCRYPT);
        if (empty($nombre) || empty($clave)) {
            $error = "Todos los campos son obligatorios.";
            require 'vista/usuario/crear.php';
            exit;
        }

        $usuario->registrar($cedula, $rol, $nombre, $telefono, $correo, $clave);
        header("Location: index.php?c=usuario&m=index");
        break;

    case 'editar':
    $id = $_GET['id'] ?? null;
    if ($id) {
        $modelo = new Usuario();
        $usuario = $modelo->buscarPorId($id);

        if ($usuario) {
            require 'vista/usuarios/editar.php';
        } else {
            echo "<p>No se encontró el usuario con ID $id</p>";
        }
    } else {
        echo "<p>ID de usuario no proporcionado</p>";
    }
    break;


    case 'actualizar':
        $id     = $_POST['id'] ?? null;
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave'] ?? null;

        if (!$id || empty($nombre)) {
            echo "Datos insuficientes para actualizar.";
            exit;
        }

        $usuario->actualizar($id, $nombre, $clave);
        header("Location: index.php?c=usuario&m=index");
        break;

    case 'eliminar':

        $usuario = new Usuario();
        $cedula = $_GET['cedula'];

        
        $usuario->eliminar($cedula);
       

        header("Location: index.php?c=usuario&m=index");
        break;

    default:
        echo "Acción no válida.";
        break;
}
