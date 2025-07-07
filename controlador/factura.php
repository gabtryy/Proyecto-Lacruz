<?php
require_once 'modelo/factura.php';
require_once 'modelo/presupuesto.php';

 //$facturaModel = new FacturaModel();
$presupuestoModel = new PresupuestoModel();

switch ($metodo) {
    case 'index':
    default:
        $presupuestos = $presupuestoModel->listar(); // Debe retornar array de presupuestos
        //$facturas = $facturaModel->listar();         // Por ahora puede retornar array vacío
        require 'vista/factura/index.php';
        break;
}
?>
