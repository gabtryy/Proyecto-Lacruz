<?php

require_once 'modelo/presupuesto.php';
require_once 'modelo/cliente.php';
require_once 'modelo/ServicioModelo.php';
require_once 'modelo/ProductoModelo.php';

$presupuestoModel = new PresupuestoModel();
$clienteModel = new ClienteModel();
$servicioModel = new Servicio();
$productoModel = new Producto();

switch ($metodo) {
    case 'index':
        
        $presupuestos = $presupuestoModel->listar();
        require 'vista/presupuesto/index.php';
        break;

    case 'crear':
        $formasPago = $presupuestoModel->formasdePago();
        $clientes = $clienteModel->listar();
        $servicios = $servicioModel->listar();
        $productos = $productoModel->listar();
        
        require 'vista/presupuesto/crear.php';
        break;

    case 'guardar':

        $tasa = $presupuestoModel->tasa();
        $tasaid = $tasa['id_tasa'];
        $ivaArray = $presupuestoModel->iva();
        $iva = $ivaArray[0];
        $ivaid = $iva['id_iva'];
        $porcentajeIva = $iva['porcentaje'];

        $fecha_registro = date("Y-m-d H:i:s");

        // Calcular subtotales y total en el backend
        $productos = [];
        $servicios = [];
        $total = 0;

        if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
            foreach ($_POST['servicios'] as $servicio) {
                if (
                    isset($servicio['id_servicio']) &&
                    isset($servicio['cantidad'])
                ) {
                    // Obtener precio real desde la base de datos
                    $infoServicio = $servicioModel->buscarPorId($servicio['id_servicio']);
                    $precio = $infoServicio['precio_base'];
                    $cantidad = (int)$servicio['cantidad'];
                    $subtotal = $precio * $cantidad;
                    $total += $subtotal;

                    $servicios[] = [
                        'id_servicio' => $servicio['id_servicio'],
                        'cantidad' => $cantidad,
                        'subtotal' => $subtotal
                    ];
                }
            }
        }
        if (isset($_POST['producto']) && is_array($_POST['producto'])) {
            foreach ($_POST['producto'] as $producto) {
                if (
                    isset($producto['id_producto']) &&
                    isset($producto['cantidad'])
                ) {
                    // Obtener precio real desde la base de datos
                    $infoProducto = $productoModel->buscarPorId($producto['id_producto']);
                    $precio = $infoProducto['precio'];
                    $cantidad = (int)$producto['cantidad'];
                    $subtotal = $precio * $cantidad;
                    $total += $subtotal;

                    $productos[] = [
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $cantidad,
                        'subtotal' => $subtotal
                    ];
                }
            }
        }

        $ivapor = ($total * $porcentajeIva) / 100;
        $totaliva = $total + $ivapor;

        $datosPresupuesto = [
            'rif' => $_POST['rif_cliente'],
            'fecha' => $fecha_registro,
            'orden_compra' => $_POST['orden_compra'],
            'forma_pago' => $_POST['forma_pago'],
            'id_iva' => $ivaid,
            'total_iva' => $totaliva,
            'total' => $total,
            'id_tasa' => $tasaid,
            'estado_pago' => 'pendiente',
            'estatus' => 'presupuesto'
        ];

        $presupuestoModel->guardarpresupuesto($datosPresupuesto, $servicios, $productos);

        header("Location: index.php?c=presupuesto&m=index");
        break;

    case 'eliminar':
        $id = $_GET['id'];
        if ($presupuestoModel->eliminarPresupuesto($id)) {
            header("Location: index.php?c=presupuesto&m=index&status=success_delete");
        } else {
            header("Location: index.php?c=presupuesto&m=index&status=error_delete");
        }
        break;

    case 'ver':
        $id = $_GET['id'];
        $presupuesto = $presupuestoModel->obtener($id);
        $servicios = $presupuestoModel->obtenerServicios($id);
        $productos = $presupuestoModel->obtenerProductos($id);
        require 'vista/presupuestos/ver.php';
        break;

    case 'aprobar':
        $id = $_GET['id'];
        if ($presupuestoModel->cambiarEstado($id, 'aprobado')) {
            header("Location: index.php?c=presupuestos&m=ver&id=$id&status=success_approve");
        } else {
            header("Location: index.php?c=presupuestos&m=ver&id=$id&status=error_approve");
        }
        break;

    case 'rechazar':
        $id = $_GET['id'];
        if ($presupuestoModel->cambiarEstado($id, 'rechazado')) {
            header("Location: index.php?c=presupuestos&m=ver&id=$id&status=success_reject");
        } else {
            header("Location: index.php?c=presupuestos&m=ver&id=$id&status=error_reject");
        }
        break;

    

    case 'generarFactura':
        $id = $_GET['id'];
        // Aquí iría la lógica para generar la factura
        // Por ahora solo redirigimos
        header("Location: index.php?c=facturas&m=crear&id_presupuesto=$id");
        break;

    default:
        echo "Acción no válida.";
        break;
}