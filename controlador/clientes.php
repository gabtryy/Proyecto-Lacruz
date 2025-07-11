<?php
require_once 'modelo/ubicacion.php';
require_once 'modelo/cliente.php';
$estadoModel = new UbicacionModel();
$clienteModel = new ClienteModel();
switch ($metodo) {
    case 'index':
        
        $cliente = $clienteModel->listar();
        $estado = $estadoModel->listarE(); // <-- agrega esta línea
        require 'vista/clientes/index.php';
        break;

    case 'crear':
        $estado = $estadoModel->listarE();
        require 'vista/clientes/crear.php';
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

    case 'guardar_cliente':
        $fecha_registro = date("Y-m-d H:i:s");

        $ranzon_social = "no aplica";
        
        $datosDireccion = [
            'id_estado' => $_POST['estado'],
            'id_ciudad' => $_POST['ciudad'],
            'id_municipio' => $_POST['municipio'],
            'calle' => $_POST['direccion_detalle']
        ];
        $idDireccion = $estadoModel->registrarDireccion($datosDireccion);

        
        $clienteModel = new ClienteModel();
        $clienteModel->setRif($_POST['rif']);
        $clienteModel->setNombre($_POST['nombre']);
        $clienteModel->setApellido($_POST['apellido']);
        $clienteModel->setTelefono($_POST['telefono']);
        $clienteModel->setCorreo($_POST['email']);
        $clienteModel->setCedulaUsuario($_SESSION['cedula']);
        $clienteModel->setIdDireccion($idDireccion);
        $clienteModel->setFechaRegistro($fecha_registro);
        if (isset($_POST['razon_social']) && !empty($_POST['razon_social'])) {
            $clienteModel->setRazonSocial($_POST['razon_social']);
        } else {
            $clienteModel->setRazonSocial("no aplica");
        }

        $clienteModel->registrarCliente();

        header("Location: index.php?c=clientes&m=index");
        exit;
        break;

    case 'eliminar':
        if (isset($_GET['rif'])) {
            $clienteModel = new ClienteModel();
            $clienteModel->eliminar($_GET['rif']);
        }
        header("Location: index.php?c=clientes&m=index");
        exit;
        break;

    case 'editarC':
        if (isset($_GET['rif'])) {
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->obtener($_GET['rif']);
            $estados = $estadoModel->listarE();
            require 'vista/clientes/editar.php';
        }
        break;

    case 'actualizar_cliente':
        // Validación básica
        if (
            empty($_POST['estado']) ||
            empty($_POST['municipio']) ||
            empty($_POST['ciudad'])
        ) {
            // Puedes mostrar un mensaje de error o redirigir
            var_dump($_POST['estado'], $_POST['municipio'], $_POST['ciudad']);
            die('Debe seleccionar estado, municipio y ciudad.');
        }

        $rifCliente = $_POST['rif'];
        $datosCliente = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'telefono' => $_POST['telefono'],
            'correo' => $_POST['email']
        ];
        $datosDireccion = [
            'calle' => $_POST['direccion_detalle'],
            'id_estado' => $_POST['estado'],
            'id_ciudad' => $_POST['ciudad'],
            'id_municipio' => $_POST['municipio']
        ];
        $clienteModel = new ClienteModel();
        $clienteModel->editarClienteYDireccion($rifCliente, $datosCliente, $datosDireccion);
        header("Location: index.php?c=clientes&m=index");
        exit;
        break;

    case 'obtenerClienteAjax':
        $rif = $_GET['rif'];
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->obtener($rif);
        header('Content-Type: application/json');
        echo json_encode($cliente);
        exit;
        break;
    case 'informacion':
        
        if (isset($_GET['rif'])) {
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->obtener($_GET['rif']);
           
            $presupuestos = $clienteModel->obtenerpresupuestos($_GET['rif']);
            require 'vista/clientes/informacion.php';
        } else {
            header("Location: index.php?c=clientes&m=index");
            exit;
        }
        break;
    default:
        header("Location: index.php?c=clientes&m=index");
        exit;
}
?>