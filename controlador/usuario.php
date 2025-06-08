<?php
require_once 'modelo/Usuario.php';

$usuario = new Usuario();

switch ($metodo) {
    case 'index':
        $usuarios = $usuario->listar();
        require 'vista/usuarios/index.php';
        break;

    case 'crear':
        require 'vista/usuarios/crear.php';
        break;

    case 'guardar':
        $nombre = $_POST['usuario'] ?? '';
        $clave  = $_POST['clave'] ?? '';

        if (empty($nombre) || empty($clave)) {
            $error = "Todos los campos son obligatorios.";
            require 'vista/usuario/crear.php';
            exit;
        }

        $usuario->registrar($nombre, $clave);
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
        $id = $_GET['id'] ?? null;

        if ($id) {
            $usuario->eliminar($id);
        }

        header("Location: index.php?c=usuario&m=index");
        break;

    default:
        echo "Acción no válida.";
        break;
}
