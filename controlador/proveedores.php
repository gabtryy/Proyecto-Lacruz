<?php
require_once 'modelo/ubicacion.php';
require_once 'modelo/proveedores.php';
$estadoModel = new UbicacionModel();

switch ($metodo) {
    case 'index':
        $proveedorModel = new ProveedorModel();
        $proveedor = $proveedorModel->listar();
         $estado = $estadoModel->listarE();
        require 'vista/proveedores/index.php';
        break;
    case 'crear':
        $estado = $estadoModel->listarE();
        require 'vista/proveedores/crear.php';
        break;
    case 'obtenerU':
        $id_estado = $_GET['id_estado'];
        $municipios = $estadoModel->Omunicipios($id_estado);
        header('Content-Type: application/json');
        echo json_encode($municipios);
        exit;
        break;
    case 'obtenerC':
        $id_municipio = $_GET['id_municipio'];
        $ciudades = $estadoModel->Ociudades($id_municipio);
        header('Content-Type: application/json');
        echo json_encode($ciudades);
        exit;
        break;
    case 'guardar_proveedores':
        //$fecha_registro = date("Y-m-d H:i:s");
        $datosProveedor = [
            'id_proveedores' => $_POST['rif'],
            'nombre' => $_POST['nombre'],
            'telefono' => $_POST['telefono'],
            'correo' => $_POST['email'],
        ];

        $datosDireccion = [
            'id_estado' => $_POST['estado'],
            'id_ciudad' => $_POST['ciudad'],
            'id_municipio' => $_POST['municipio'],
            'calle' => $_POST['direccion_detalle']
        ];

        $proveedorModel = new ProveedorModel();
        $ubicacionModel = new UbicacionModel();

        $idDireccion = $ubicacionModel->registrarDireccion($datosDireccion);

        $datosProveedor['id_direccion'] = $idDireccion;
        $proveedorModel->registrarProveedor($datosProveedor);

        header("Location: index.php?c=proveedores&m=index");
        exit;
        break;

    case 'eliminarC':
        $proveedorModel = new ProveedorModel();
        $id_proveedores = $_GET['rif'];
        $proveedorModel->eliminar($id_proveedores);
        header("Location: index.php?c=proveedores&m=index");
        break;

    case 'editarP': 
        $id_proveedores = $_GET['rif'];
        $proveedorModel = new ProveedorModel();
        $ubicacionModel = new UbicacionModel(); 

        $estado = $ubicacionModel->listarE(); 

        $proveedor = $proveedorModel->obtener($id_proveedores); 

        
        $municipiosProveedor = [];
        $ciudadesProveedor = [];
        if ($proveedor) {
            if (!empty($proveedor['id_estado'])) {
                $municipiosProveedor = $ubicacionModel->Omunicipios($proveedor['id_estado']);
            }
            if (!empty($proveedor['id_municipio'])) {
                $ciudadesProveedor = $ubicacionModel->Ociudades($proveedor['id_municipio']);
            }
        }
        
        require 'vista/proveedores/editar.php';
        break;

    case 'actualizar_proveedor': 
        $id_proveedores = $_POST['id_proveedores']; 
        
        $datosProveedor = [
            'nombre' => $_POST['nombre'],
            'telefono' => $_POST['telefono'],
            'correo' => $_POST['email']
        ];
        
        $datosDireccion = [
            'id_estado' => $_POST['estado'],
            'id_ciudad' => $_POST['ciudad'],
            'id_municipio' => $_POST['municipio'],
            'calle' => $_POST['direccion_detalle']
        ];
        
        $proveedorModel = new ProveedorModel();
        
        $resultado = $proveedorModel->editarProveedorYDireccion($id_proveedores, $datosProveedor, $datosDireccion);
        
        if ($resultado) {
            
            header("Location: index.php?c=proveedores&m=index&status=success_edit");
        } else {
            
            header("Location: index.php?c=proveedores&m=editarC&id_proveedores=" . $id_proveedores . "&status=error_edit");
        }
        exit;
        break;

    case 'obtenerProveedorAjax':
        $id_proveedores = $_GET['id_proveedores'];
        $proveedorModel = new ProveedorModel();
        $proveedor = $proveedorModel->obtener($id_proveedores);
        header('Content-Type: application/json');
        echo json_encode($proveedor);
        exit;
        break;

    default:
        echo "Acción no válida.";
        break;
}
?>