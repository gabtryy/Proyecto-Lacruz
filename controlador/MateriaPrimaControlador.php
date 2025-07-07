<?php
require_once 'modelo/MateriaPrimaModelo.php';
require_once 'modelo/proveedores.php';

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

$materia = new MateriaPrima();
$proveedor = new ProveedorModel();

switch ($metodo) {
    case 'index':
        $materias = $materia->listar();
        $proveedores = $proveedor->listar();
        require_once 'vista/materiaPrima/index.php';
        break;
        
    case 'crear':
        // Solo necesitamos cargar los proveedores para el formulario
        $proveedores = $proveedor->listar();
        require_once 'vista/materiaPrima/index.php';
        break;
        
    case 'guardar':
        $errores = [];
        
        if (empty($_POST['nombre'])) {
            $errores[] = "El nombre de la Materia es obligatorio";
        }
        
        if (empty($_POST['medida'])) {
            $errores[] = "La medida de la Materia es obligatoria";
        }
        
        $id_proveedores = $_POST['id_proveedores'] ?? null;
        if (empty($id_proveedores)) {
            $errores[] = "Debe seleccionar un proveedor válido";
        }
        
        if (empty($_POST['stock']) || !is_numeric($_POST['stock'])) {
            $errores[] = "El stock debe ser un valor numérico válido";
        }
        
        if (!empty($errores)) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = implode("<br>", $errores);
            header("Location: index.php?c=MateriaPrimaControlador&m=crear");
            exit;
        }
        
        $materia->setIdProveedores($id_proveedores);
        $materia->setNombre($_POST['nombre']);
        $materia->setMedida($_POST['medida']);
        $materia->setStock($_POST['stock']);

       
        
        

        if ($materia->registrar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Materia Prima registrada correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al registrar la Materia Prima";
        }
        
        header("Location: index.php?c=MateriaPrimaControlador&m=index");
        break;

    case 'editar':
        $id_materia = $_GET['id'] ?? null;
        
        if (!$id_materia) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'ID no proporcionado']);
                exit;
            }
            header("Location: index.php?c=MateriaPrimaControlador&m=index");
            exit;
        }
        
        $materiaActual = $materia->buscarId($id_materia);
        
        if (!$materiaActual) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Materia Prima no encontrada']);
                exit;
            }
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Materia Prima no encontrada";
            header("Location: index.php?c=MateriaPrimaControlador&m=index");
            exit;
        }
        
        if (isAjaxRequest()) {
            header('Content-Type: application/json');
            echo json_encode([
                'id_materia' => $materiaActual['id_materia'],
                'nombre' => $materiaActual['nombre'],
                'medida' => $materiaActual['medida'],
                'id_proveedores' => $materiaActual['id_provedores'],
                'stock' => $materiaActual['stock']
            ]);
            exit;
        }
        
        // Si no es AJAX, cargamos la vista normal
        $materias = $materia->listar();
        $proveedores = $proveedor->listar();
        require 'vista/materiaPrima/index.php';
        break;

    case 'actualizar':
        $errores = [];
        
        if (empty($_POST['nombre'])) {
            $errores[] = "El nombre de la Materia es obligatorio";
        }
        
        if (empty($_POST['medida'])) {
            $errores[] = "La medida de la Materia es obligatoria";
        }
        
        $id_proveedores = $_POST['id_proveedores'] ?? null;
        if (empty($id_proveedores)) {
            $errores[] = "Debe seleccionar un proveedor válido";
        }
        
        if (empty($_POST['stock']) || !is_numeric($_POST['stock'])) {
            $errores[] = "El stock debe ser un valor numérico válido";
        }
        
        if (!empty($errores)) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = implode("<br>", $errores);
            header("Location: index.php?c=MateriaPrimaControlador&m=editar&id=".$_POST['id_materia']);
            exit;
        }
        
        $materia->setIdMateria($_POST['id_materia']);
        $materia->setIdProveedores($id_proveedores);
        $materia->setNombre($_POST['nombre']);
        $materia->setMedida($_POST['medida']);
        $materia->setStock($_POST['stock']);
        
        if ($materia->actualizar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Materia Prima actualizada correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al actualizar la Materia Prima";
        }
        
        header("Location: index.php?c=MateriaPrimaControlador&m=index");
        break;

    case 'eliminar':
        $id_materia = $_GET['id'] ?? null;
        
        if (!$id_materia) {
            header("Location: index.php?c=MateriaPrimaControlador&m=index");
            exit;
        }
        
        $materia->setIdMateria($id_materia);
        
        if ($materia->eliminar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Materia Prima eliminada correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al eliminar la Materia Prima. Puede que esté en uso.";
        }
        
        header("Location: index.php?c=MateriaPrimaControlador&m=index");
        break;
        
    default:
        // Por defecto cargamos el index
        $materias = $materia->listar();
        $proveedores = $proveedor->listar();
        require_once 'vista/materiaPrima/index.php';
        break;
}
?>