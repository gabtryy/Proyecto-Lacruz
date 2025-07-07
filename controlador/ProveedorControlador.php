<?php
require_once 'modelo/ProveedorModelo.php';
require_once 'modelo/DireccionModelo.php';

function isAjaxRequest() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

$proveedor = new Proveedor();
$ubicacion = new Ubicacion();

switch ($metodo) {
    case 'index':
        $proveedores = $proveedor->listar();
        $estados = $ubicacion->listarEstados();
        require 'vista/proveedores/index.php';
        break;

    case 'editar':
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'ID no proporcionado']);
                exit;
            }
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }
        
        $proveedorActual = $proveedor->buscarPorId($id);
        if (!$proveedorActual) {
            if (isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Proveedor no encontrado']);
                exit;
            }
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Proveedor no encontrado";
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }
        
        if (isAjaxRequest()) {
        $municipios = $ubicacion->listarMunicipios($proveedorActual['id_estado']);
        $parroquias = $ubicacion->listarParroquias($proveedorActual['id_municipio']);
        
        header('Content-Type: application/json');
        echo json_encode([
            'proveedor' => $proveedorActual,
            'municipios' => $municipios,
            'parroquias' => $parroquias,
            'estados' => $ubicacion->listarEstados() 
            ]);
        exit;
        }
        break;
        
    case 'guardar':
        if (empty($_POST['nombre'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El nombre es obligatorio";
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }

        if (empty($_POST['telefono']) || !is_numeric($_POST['telefono'])) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "El teléfono debe ser un valor numérico válido";
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }

        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Debe proporcionar un correo electrónico válido";
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }

           if(empty($_POST['estado']) || empty($_POST['municipio']) || empty($_POST['parroquia']) || empty($_POST['direccion_detalle'])) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Todos los campos de dirección son obligatorios";
        header("Location: index.php?c=ProveedorControlador&m=index");
        exit;
    }

    $datosDireccion = [
        'id_estado' => (int)$_POST['estado'],
        'id_municipio' => (int)$_POST['municipio'],
        'id_parroquia' => (int)$_POST['parroquia'], 
        'calle' => $_POST['direccion_detalle']
    ];
    
    // Debug: Ver los datos antes de insertar
    error_log("Datos de dirección a insertar: " . print_r($datosDireccion, true));
    
    $idDireccion = $ubicacion->registrarDireccion($datosDireccion);
    
    if (!$idDireccion) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Error al registrar la dirección. Verifique que los datos de ubicación sean válidos.";
        header("Location: index.php?c=ProveedorControlador&m=index");
        exit;
    }

        $proveedor->setIdDireccion($idDireccion);
        $proveedor->setNombre($_POST['nombre']);
        $proveedor->setTelefono($_POST['telefono']);
        $proveedor->setCorreo($_POST['email']);

        if ($proveedor->registrar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Proveedor registrado correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al registrar el proveedor";
        }
        header("Location: index.php?c=ProveedorControlador&m=index");
        break;

    case 'actualizar':
    $id = $_POST['id_proveedores'] ?? null;
    if (!$id) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "ID de proveedor no proporcionado";
        header("Location: index.php?c=ProveedorControlador&m=index");
        exit;
    }

    // Validar datos básicos
    if(empty($_POST['nombre']) || empty($_POST['telefono']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Datos del proveedor inválidos";
        header("Location: index.php?c=ProveedorControlador&m=index");
        exit;
    }

    // Validar dirección
    if(empty($_POST['estado']) || empty($_POST['municipio']) || empty($_POST['parroquia']) || empty($_POST['direccion_detalle'])) {
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Datos de dirección incompletos";
        header("Location: index.php?c=ProveedorControlador&m=index");
        exit;
    }

    try {
        $proveedor->getConexion()->beginTransaction();
        
        // Actualizar dirección
        $datosDireccion = [
            'id_estado' => (int)$_POST['estado'],
            'id_municipio' => (int)$_POST['municipio'],
            'id_parroquia' => (int)$_POST['parroquia'],
            'calle' => $_POST['direccion_detalle'],
            'id_direccion' => (int)$_POST['id_direccion']
        ];
        
        error_log("Datos de dirección a actualizar: " . print_r($datosDireccion, true));
        $actualizacionDireccion = $ubicacion->actualizarDireccion($datosDireccion);
        
        if (!$actualizacionDireccion) {
            throw new Exception("Error al actualizar la dirección");
        }

        // Actualizar proveedor
        $proveedor->setIdProveedores($id);
        $proveedor->setNombre($_POST['nombre']);
        $proveedor->setTelefono($_POST['telefono']);
        $proveedor->setCorreo($_POST['email']);
        $proveedor->setIdDireccion($_POST['id_direccion']);
        
        $resultado = $proveedor->actualizar();
        
        if (!$resultado) {
            throw new Exception("Error al actualizar el proveedor");
        }

        $proveedor->getConexion()->commit();
        $_SESSION['tipo_mensaje'] = "success";
        $_SESSION['mensaje'] = "Proveedor actualizado correctamente";
    } catch (Exception $e) {
        if ($proveedor->getConexion()->inTransaction()) {
            $proveedor->getConexion()->rollBack();
        }
        error_log("Error al actualizar proveedor: " . $e->getMessage());
        $_SESSION['tipo_mensaje'] = "error";
        $_SESSION['mensaje'] = "Error al actualizar: " . $e->getMessage();
    }
    
    header("Location: index.php?c=ProveedorControlador&m=index");
    break;

    case 'eliminar':
        $id = $_GET['id'] ?? null; 
        if (!$id) {
            header("Location: index.php?c=ProveedorControlador&m=index");
            exit;
        }

        $proveedor->setIdProveedores($id);
        if ($proveedor->eliminar()) {
            $_SESSION['tipo_mensaje'] = "success";
            $_SESSION['mensaje'] = "Proveedor eliminado correctamente";
        } else {
            $_SESSION['tipo_mensaje'] = "error";
            $_SESSION['mensaje'] = "Error al eliminar el proveedor. Puede que esté en uso.";
        }
        header("Location: index.php?c=ProveedorControlador&m=index");
        break;

    case 'obtenerMunicipios':
        $id_estado = $_GET['id_estado'] ?? null;
        if ($id_estado) {
            $municipios = $ubicacion->listarMunicipios($id_estado);
            header('Content-Type: application/json');
            echo json_encode($municipios);
        }
    break;

    case 'obtenerParroquias':
    $id_municipio = $_GET['id_municipio'] ?? null;
    if ($id_municipio) {
        $parroquias = $ubicacion->listarParroquias($id_municipio);
        header('Content-Type: application/json');
        echo json_encode($parroquias ?: []); 
    }
    break;
}

?>