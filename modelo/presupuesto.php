<?php

require_once 'modelo/conexion.php';

class PresupuestoModel extends Conexion {

    public function listar(){
        $sql = "SELECT
f.id_factura,
c.rif,
c.nombre AS nombre_cliente,
f.total_general,
f.fecha
FROM factura f 

JOIN cliente c ON f.rif = c.rif";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tasa(){
        $sql = "SELECT * FROM tasa_cambio";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function formasdePago() {
        $sql = "SELECT * FROM forma_pago";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function iva() {
        $sql = "SELECT * FROM iva";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function guardarpresupuesto($datosPresupuesto, $servicios) {
    $this->pdo->beginTransaction();

    $sqlPresupuesto = "INSERT INTO factura (rif, fecha, numero_orden, id_forma_pago, id_iva, total_iva, total_general, id_tasa, estado_pago, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtPresupuesto = $this->pdo->prepare($sqlPresupuesto);
    $stmtPresupuesto->execute([
        $datosPresupuesto['rif'],
        $datosPresupuesto['fecha'],
        $datosPresupuesto['orden_compra'],
        $datosPresupuesto['forma_pago'],
        $datosPresupuesto['id_iva'],
        $datosPresupuesto['total_iva'],
        $datosPresupuesto['total'],
        $datosPresupuesto['id_tasa'],
        $datosPresupuesto['estado_pago'],
        $datosPresupuesto['estatus']
    ]);
    
    $idPresupuesto = $this->pdo->lastInsertId();

    foreach ($servicios as $servicio) {
        $sqlServicio = "INSERT INTO servicio_det (id_servicio, id_factura, cantidad) VALUES (?, ?, ?)";
        $stmtServicio = $this->pdo->prepare($sqlServicio);
        $stmtServicio->execute([
            $servicio['id_servicio'],
            $idPresupuesto,
            $servicio['cantidad']
        ]);
    }
    $this->pdo->commit();
   }


   

    public function eliminarPresupuesto($id) {
        $this->pdo->beginTransaction();
        
        $sqlEliminarServicios = "DELETE FROM servicio_det WHERE id_factura = ?";
        $stmtServicios = $this->pdo->prepare($sqlEliminarServicios);
        $stmtServicios->execute([$id]);
        
        $sqlEliminarPresupuesto = "DELETE FROM factura WHERE id_factura = ?";
        $stmtPresupuesto = $this->pdo->prepare($sqlEliminarPresupuesto);
        $stmtPresupuesto->execute([$id]);
        
        $this->pdo->commit();
    }
}