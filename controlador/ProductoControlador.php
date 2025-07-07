<?php
require_once 'modelo/ProductoModelo.php';
require_once 'modelo/ProductoMateriaModelo.php';
require_once 'modelo/MateriaPrimaModelo.php';

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

$producto = new Producto();
$productoMateria = new ProductoMateria();
$materiaPrima = new MateriaPrima();

switch ($metodo) {
    case 'index':
        $productos = $producto->listar();
        $materiasPrimas = $materiaPrima->listar();
        require 'vista/productos/index.php';
        break;

    case 'editar':
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'ID no proporcionado']);
                exit;
            }
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }
        
        $productoActual = $producto->buscarPorId($id);
        if (!$productoActual) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Producto no encontrado']);
                exit;
            }
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Producto no encontrado";
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }
        
        if (isAjaxRequest()) {
            $materiasProducto = $productoMateria->listarPorProducto($id);
            
            header('Content-Type: application/json');
            echo json_encode([
                'producto' => $productoActual,
                'materiasProducto' => $materiasProducto,
                'materiasPrimas' => $materiaPrima->listar()
            ]);
            exit;
        }
        break;
        
    case 'guardar':
        $data = $_POST;

        if (empty($data['nombre'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El nombre es obligatorio";
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }

        if (!isset($data['precio']) || !is_numeric($data['precio']) || $data['precio'] <= 0) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El precio debe ser un valor numérico válido";
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }

        if (!isset($data['precio_mayor']) || !is_numeric($data['precio_mayor']) || $data['precio_mayor'] <= 0) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El precio al mayor debe ser un valor numérico válido";
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }

        $esFabricado = isset($data['es_fabricado']) ? 1 : 0;
        
        if ($esFabricado) {
            if (empty($data['materias'])) {
                $_SESSION['tipo_mensaje'] = "error";
                $_SESSION['mensaje'] = "Debe agregar al menos una materia prima para productos fabricados";
                header("Location: index.php?c=ProductoControlador&m=index");
                exit;
            }

            foreach ($data['materias'] as $materia) {
                if (empty($materia['id_materia']) || empty($materia['cantidad']) || $materia['cantidad'] <= 0) {
                    $_SESSION['tipo_mensaje'] = "error";
                    $_SESSION['mensaje'] = "Todas las materias primas deben tener un material seleccionado y una cantidad válida";
                    header("Location: index.php?c=ProductoControlador&m=index");
                    exit;
                }
            }
        }
        
        $producto->setNombre($data['nombre']);
        $producto->setStock($data['stock'] ?? 0);
        $producto->setPrecio($data['precio']);
        $producto->setPrecioMayor($data['precio_mayor']);
        $producto->setEsFabricado($esFabricado);

      try {
    $conexion = $producto->getConexion();
    $conexion->beginTransaction();
    
    if (!$producto->registrar()) {
        throw new Exception("Error al registrar el producto principal");
    }
    
    $idProducto = $conexion->lastInsertId();
    
    if ($esFabricado) {
        foreach ($data['materias'] as $materia) {
  
            $sql = "INSERT INTO producto_materia (id_materia, id_producto, cantidad)
                    VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                $materia['id_materia'],
                $idProducto,
                number_format((float)$materia['cantidad'], 3, '.', '')
            ]);
        }
    }
            
            $conexion->commit();
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Producto registrado correctamente";
        } catch (Exception $e) {
            if (isset($conexion) && $conexion->inTransaction()) {
                $conexion->rollBack();
            }
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error: " . $e->getMessage();
            error_log("Error al guardar producto: " . $e->getMessage());
        }
        
        header("Location: index.php?c=ProductoControlador&m=index");
        break;

    case 'actualizar':
    $id = $_POST['id_producto'] ?? null;
    if (!$id) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "ID de producto no proporcionado";
        header("Location: index.php?c=ProductoControlador&m=index");
        exit;
    }

    if (empty($_POST['nombre'])) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "El nombre del producto es obligatorio";
        header("Location: index.php?c=ProductoControlador&m=index");
        exit;
    }

    if (!isset($_POST['precio']) || !is_numeric($_POST['precio']) || $_POST['precio'] <= 0) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "El precio unitario debe ser un valor numérico válido";
        header("Location: index.php?c=ProductoControlador&m=index");
        exit;
    }

    if (!isset($_POST['precio_mayor']) || !is_numeric($_POST['precio_mayor']) || $_POST['precio_mayor'] <= 0) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "El precio al por mayor debe ser un valor numérico válido";
        header("Location: index.php?c=ProductoControlador&m=index");
        exit;
    }

    try {
        $conexion = $producto->getConexion();
        $conexion->beginTransaction();
        
        $producto->setIdProducto($id);
        $producto->setNombre($_POST['nombre']);
        $producto->setStock($_POST['stock'] ?? 0);
        $producto->setPrecio($_POST['precio']);
        $producto->setPrecioMayor($_POST['precio_mayor']);
        $esFabricado = isset($_POST['es_fabricado']) ? 1 : 0;
        $producto->setEsFabricado($esFabricado);
        
        if (!$producto->actualizar()) {
            throw new Exception("Error al actualizar el producto principal");
        }

        if ($esFabricado) {
            $materiasNuevas = $_POST['materias'] ?? [];
            $materiasActuales = $productoMateria->listarPorProducto($id);
            
            $actualesMap = [];
            foreach ($materiasActuales as $m) {
                $actualesMap[$m['id_promat']] = $m;
            }

            foreach ($materiasNuevas as $materia) {
                $idPromat = $materia['id_promat'] ?? null;
                $idMateria = $materia['id_materia'];
                $cantidad = number_format((float)$materia['cantidad'], 3, '.', '');
                
                if ($idPromat && isset($actualesMap[$idPromat])) {
                    $productoMateria->setIdPromat($idPromat);
                    $productoMateria->setIdMateria($idMateria);
                    $productoMateria->setCantidad($cantidad);
                    
                    if (!$productoMateria->actualizar()) {
                        throw new Exception("Error al actualizar materia prima");
                    }
                    unset($actualesMap[$idPromat]); 
                } else {
                    $productoMateria->setIdProducto($id);
                    $productoMateria->setIdMateria($idMateria);
                    $productoMateria->setCantidad($cantidad);
                    
                    if (!$productoMateria->registrar()) {
                        throw new Exception("Error al registrar nueva materia prima");
                    }
                }
            }
            
            foreach ($actualesMap as $materia) {
                $productoMateria->setIdPromat($materia['id_promat']);
                if (!$productoMateria->eliminar()) {
                    throw new Exception("Error al eliminar relación obsoleta");
                }
            }
        } else {

            if (!$productoMateria->eliminarPorProducto($id)) {
                throw new Exception("Error al eliminar materias primas de producto no fabricado");
            }
        }
        
        $conexion->commit();
        $_SESSION['tipo_mensaje'] = "success";
        $_SESSION['mensaje'] = "Producto actualizado correctamente";
    } catch (Exception $e) {
        if (isset($conexion) && $conexion->inTransaction()) {
            $conexion->rollBack();
        }
        error_log("Error al actualizar producto ID $id: " . $e->getMessage());
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Error al actualizar: " . $e->getMessage();
    }
    
    header("Location: index.php?c=ProductoControlador&m=index");
    break;

    case 'eliminar':
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            header("Location: index.php?c=ProductoControlador&m=index");
            exit;
        }

        try {
            $conexion = $producto->getConexion();
            $conexion->beginTransaction();
            
            if (!$productoMateria->eliminarPorProducto($id)) {
                throw new Exception("Error al eliminar materias primas asociadas");
            }
            
            $producto->setIdProducto($id);
            if (!$producto->eliminar()) {
                throw new Exception("Error al eliminar el producto");
            }
            
            $conexion->commit();
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Producto eliminado correctamente";
        } catch (Exception $e) {
            if (isset($conexion) && $conexion->inTransaction()) {
                $conexion->rollBack();
            }
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al eliminar: " . $e->getMessage();
        }
        
        header("Location: index.php?c=ProductoControlador&m=index");
        break;

    case 'obtenerMateriasPrimas':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $materias = $productoMateria->listarPorProducto($id);
        header('Content-Type: application/json');
        echo json_encode($materias);
        exit;
        break;
}
?>