<?php
require_once 'modelo/ServicioModelo.php';
require_once 'modelo/UnidadMedidaServicioModelo.php';

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

$servicio = new Servicio();
$unidadMedida = new UnidadMedidaServicio();

switch ($metodo) {
   case 'index':
    $unidades = $unidadMedida->listar();
    $servicios = $servicio->listar();
    
    if (isset($_GET['editar']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $servicioActual = $servicio->buscarPorId($id);
    }
    
    require 'vista/servicios/index.php';
    break;

case 'editar':
    $id = $_GET['id'] ?? null;
    if (!$id) {
        if (isAjaxRequest()) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }
        header("Location: index.php?c=ServicioControlador&m=index");
        exit;
    }
    
    $servicioActual = $servicio->buscarPorId($id);
    if (!$servicioActual) {
        if (isAjaxRequest()) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Servicio no encontrado']);
            exit;
        }
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Servicio no encontrado";
        header("Location: index.php?c=ServicioControlador&m=index");
        exit;
    }
    
    if (isAjaxRequest()) {
        header('Content-Type: application/json');
        echo json_encode([
            'id_servicio' => $servicioActual['id_servicio'],
            'nombre' => $servicioActual['nombre'],
            'descripcion' => $servicioActual['descripcion'],
            'precio_base' => $servicioActual['precio_base'],
            'id_unidad_medida' => $servicioActual['id_unidad_medida_servicio']
        ]);
        exit;
    }
    
    $unidades = $unidadMedida->listar();
    require 'vista/servicios/index.php';
    break;
    
    case 'guardar':
        if (empty($_POST['nombre'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El nombre del servicio es obligatorio";
            header("Location: index.php?c=ServicioControlador&m=crear");
            exit;
        }

        if (empty($_POST['precio_base']) || !is_numeric($_POST['precio_base'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El precio base debe ser un valor numérico válido";
            header("Location: index.php?c=ServicioControlador&m=crear");
            exit;
        }

        $id_unidad_medida = $_POST['id_unidad_medida'] ?? null;
        if (empty($id_unidad_medida)) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Debe seleccionar una unidad de medida válida";
            header("Location: index.php?c=ServicioControlador&m=crear");
            exit;
        }

        $servicio->setIdUnidadMedida($id_unidad_medida);
        $servicio->setNombre(trim($_POST['nombre']));
        $servicio->setDescripcion(trim($_POST['descripcion'] ?? ''));
        $servicio->setPrecioBase((float)$_POST['precio_base']);

        if ($servicio->registrar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Servicio registrado correctamente";
            header("Location: index.php?c=ServicioControlador&m=index");
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al registrar el servicio";
            header("Location: index.php?c=ServicioControlador&m=crear");
        }
        break;

    case 'actualizar':
        $id = $_POST['id_servicio'] ?? null;
        if (!$id) {
            header("Location: index.php?c=ServicioControlador&m=index");
            exit;
        }

        if (empty($_POST['nombre'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El nombre del servicio es obligatorio";
            header("Location: index.php?c=ServicioControlador&m=editar&id=".$id);
            exit;
        }

        if (empty($_POST['precio_base']) || !is_numeric($_POST['precio_base'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El precio base debe ser un valor numérico válido";
            header("Location: index.php?c=ServicioControlador&m=editar&id=".$id);
            exit;
        }

        $id_unidad_medida = $_POST['id_unidad_medida'] ?? null;
        if (empty($id_unidad_medida)) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Debe seleccionar una unidad de medida válida";
            header("Location: index.php?c=ServicioControlador&m=editar&id=".$id);
            exit;
        }

        $servicio->setIdServicio($id);
        $servicio->setIdUnidadMedida($id_unidad_medida);
        $servicio->setNombre(trim($_POST['nombre']));
        $servicio->setDescripcion(trim($_POST['descripcion'] ?? ''));
        $servicio->setPrecioBase((float)$_POST['precio_base']);

        if ($servicio->actualizar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Servicio editado correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al actualizar el servicio";
        }
        header("Location: index.php?c=ServicioControlador&m=index");
        break;


    case 'eliminar':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?c=ServicioControlador&m=index");
            exit;
        }

        $servicio->setIdServicio($id);
        if ($servicio->eliminar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Servicio eliminado correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al eliminar el servicio. Puede que esté en uso.";
        }
        header("Location: index.php?c=ServicioControlador&m=index");
        break;
}
?>