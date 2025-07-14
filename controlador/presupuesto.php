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
        $condicionPago = $presupuestoModel->formasdePago();
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

        $subtotal = 0;
        $productos = [];
        $servicios = [];

        
        if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
            foreach ($_POST['servicios'] as $servicio) {
                if (
                    isset($servicio['id_servicio']) &&
                    isset($servicio['cantidad'])
                ) {
                    $infoServicio = $servicioModel->buscarPorId($servicio['id_servicio']);
                    $precio = $infoServicio['precio_base'];
                    $cantidad = (int)$servicio['cantidad'];
                    $servicio_subtotal = $precio * $cantidad;
                    $subtotal += $servicio_subtotal;

                    $servicios[] = [
                        'id_servicio' => $servicio['id_servicio'],
                        'cantidad' => $cantidad,
                        'subtotal' => $servicio_subtotal
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
                    $infoProducto = $productoModel->buscarPorId($producto['id_producto']);
                    $precio = $infoProducto['precio'];
                    $cantidad = (int)$producto['cantidad'];
                    $producto_subtotal = $precio * $cantidad;
                    $subtotal += $producto_subtotal;

                    $productos[] = [
                        'id_producto' => $producto['id_producto'],
                        'cantidad' => $cantidad,
                        'subtotal' => $producto_subtotal
                    ];
                }
            }
        }

        
        $iva_monto = ($subtotal * $porcentajeIva) / 100;
        $total_general = $subtotal + $iva_monto;

        $datosPresupuesto = [
            'rif' => $_POST['rif_cliente'],
            'fecha' => $fecha_registro,
            'orden_compra' => $_POST['orden_compra'],
            'id_iva' => $ivaid,
            'total_iva' => $iva_monto,
            'total' => $subtotal,
            'total_general' => $total_general,
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
        $data = $presupuestoModel->obtenerP($id);
        $presupuesto = $data['presupuesto'];
        $productos = $data['productos'];
        $servicios = $data['servicios'];
        require 'vista/presupuesto/ver.php';
        break;

 

    

  
    default:
        echo "Acción no válida.";
        break;
}